<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use App\Models\Campus;
use App\Models\Resource;
use App\Models\LoanResource;
use App\Models\LoanEvidence;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $loans = Loan::with(['user', 'campus', 'loanResources.resource'])
            ->latest()
            ->paginate(20);

        return view('modules.loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $users = User::where('is_active', true)->get();
        $campuses = Campus::where('is_active', true)->get();
        $resources = Resource::where('is_active', true)
            ->where('resource_status_id', 1) // Disponible
            ->with('resourceType')
            ->get();

        return view('modules.loans.create', compact('users', 'campuses', 'resources'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'campus_id' => 'required|exists:campuses,id',
            'loan_date' => 'required|date',
            'expected_return_date' => 'required|date|after:loan_date',
            'loan_status' => 'required|in:pendiente,aprovado,activo,completado,vencido,cancelado',
            'notes' => 'nullable|string',
            'resources' => 'required|array|min:1',
            'resources.*' => 'exists:resources,id',
            'evidences' => 'required|array|min:1',
            'evidences.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB máximo
        ]);

        // Crear el préstamo
        $loan = Loan::create([
            'user_id' => $validated['user_id'],
            'campus_id' => $validated['campus_id'],
            'loan_date' => $validated['loan_date'],
            'expected_return_date' => $validated['expected_return_date'],
            'loan_status' => $validated['loan_status'],
            'notes' => $validated['notes'],
            'is_active' => true
        ]);

        // Asociar recursos al préstamo y guardar evidencias
        foreach ($request->resources as $index => $resourceId) {
            // Crear loan_resource
            $loanResource = LoanResource::create([
                'loan_id' => $loan->id,
                'resource_id' => $resourceId,
                'is_active' => true
            ]);

            // Guardar evidencia si existe
            if ($request->hasFile("evidences.{$index}")) {
                $evidenceFile = $request->file("evidences.{$index}");
                $evidencePath = $evidenceFile->store('loan-evidences', 'public');

                LoanEvidence::create([
                    'loan_resource_id' => $loanResource->id,
                    'loan_type' => 'prestamo',
                    'photo_path' => $evidencePath,
                    'notes' => 'Evidencia de préstamo - ' . now()->format('d/m/Y H:i'),
                    'is_active' => true
                ]);
            }

            // Actualizar estado del recurso a "Prestado" (asumiendo que 2 = Prestado)
            Resource::where('id', $resourceId)->update(['resource_status_id' => 2]);
        }

        return redirect()->route('loans.index')
            ->with('success', 'Préstamo creado exitosamente con evidencias.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan): View
    {
        $loan->load([
            'user',
            'campus',
            'loanResources.resource.resourceType',
            'loanResources.resource.resourceStatus',
            'loanResources.loanEvidences'
        ]);

        return view('modules.loans.show', compact('loan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan $loan): View
    {
        $loan->load(['loanResources.resource.resourceType', 'loanResources.resource.resourceStatus']);
        $users = User::where('is_active', true)->get();
        $campuses = Campus::where('is_active', true)->get();

        return view('modules.loans.edit', compact('loan', 'users', 'campuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loan $loan): RedirectResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'campus_id' => 'required|exists:campuses,id',
            'loan_date' => 'required|date',
            'expected_return_date' => 'required|date|after:loan_date',
            'actual_return_date' => 'nullable|date|after_or_equal:loan_date',
            'loan_status' => 'required|in:pendiente,aprovado,activo,completado,vencido,cancelado',
            'notes' => 'nullable|string',
            'return_evidences' => 'nullable|array',
            'return_evidences.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $loan->update($validated);

        // Si el préstamo se completa, liberar recursos y guardar evidencias de devolución
        if (($request->loan_status === 'completado' && !$loan->actual_return_date) ||
            ($request->actual_return_date && $request->loan_status === 'completado')
        ) {

            $loan->update(['actual_return_date' => now()]);

            foreach ($loan->loanResources as $index => $loanResource) {
                if ($loanResource->resource) {
                    $loanResource->resource()->update(['resource_status_id' => 1]); // Disponible
                }

                // Guardar evidencia de devolución si existe
                if ($request->hasFile("return_evidences.{$index}")) {
                    $returnEvidenceFile = $request->file("return_evidences.{$index}");
                    $returnEvidencePath = $returnEvidenceFile->store('loan-evidences', 'public');

                    LoanEvidence::create([
                        'loan_resource_id' => $loanResource->id,
                        'loan_type' => 'devuelución',
                        'photo_path' => $returnEvidencePath,
                        'notes' => 'Evidencia de devolución - ' . now()->format('d/m/Y H:i'),
                        'is_active' => true
                    ]);
                }
            }
        }

        return redirect()->route('loans.index')
            ->with('success', 'Préstamo actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan): RedirectResponse
    {
        // Liberar recursos antes de eliminar
        foreach ($loan->loanResources as $loanResource) {
            if ($loanResource->resource) {
                $loanResource->resource()->update(['resource_status_id' => 1]); // Disponible
            }
        }

        $loan->update(['is_active' => false]);
        $loan->delete();

        return redirect()->route('loans.index')
            ->with('success', 'Préstamo eliminado exitosamente.');
    }

    /**
     * Mark loan as returned.
     */
    public function markAsReturned(Loan $loan): RedirectResponse
    {
        $loan->update([
            'actual_return_date' => now(),
            'loan_status' => 'completado'
        ]);

        // Liberar recursos
        foreach ($loan->loanResources as $loanResource) {
            if ($loanResource->resource) {
                $loanResource->resource()->update(['resource_status_id' => 1]); // Disponible
            }
        }

        return redirect()->route('loans.index')
            ->with('success', 'Préstamo marcado como devuelto.');
    }
}
