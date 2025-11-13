<?php

namespace App\Http\Controllers;

use App\Models\LoanEvidence;
use App\Models\LoanResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LoanEvidenceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin,staff']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evidences = LoanEvidence::with(['loanResource.loan.user', 'loanResource.resource'])
            ->latest()
            ->paginate(10);

        return view('modules.loan-evidences.index', compact('evidences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $loanResources = LoanResource::with(['loan.user', 'resource'])
            ->where('is_active', true) // Cambiar de active() a where
            ->get();

        return view('modules.loan-evidences.create', compact('loanResources'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'loan_resource_id' => 'required|exists:loan_resources,id',
            'loan_type' => 'required|in:prestamo,devuelución', // Corregir acento
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'notes' => 'nullable|string|max:1000',
            'is_active' => 'boolean'
        ]);

        // Subir la foto
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('loan-evidences', 'public');
            $validated['photo_path'] = $path;
        }

        LoanEvidence::create($validated);

        return redirect()->route('loan-evidences.index')
            ->with('success', 'Evidencia creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LoanEvidence $loanEvidence)
    {
        $loanEvidence->load(['loanResource.loan.user', 'loanResource.resource']);

        return view('modules.loan-evidences.show', compact('loanEvidence'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LoanEvidence $loanEvidence)
    {
        $loanResources = LoanResource::with(['loan.user', 'resource'])
            ->where('is_active', true) // Cambiar de active() a where
            ->get();

        return view('modules.loan-evidences.edit', compact('loanEvidence', 'loanResources'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LoanEvidence $loanEvidence)
    {
        $validated = $request->validate([
            'loan_resource_id' => 'required|exists:loan_resources,id',
            'loan_type' => 'required|in:prestamo,devuelución', // Corregir acento
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'notes' => 'nullable|string|max:1000',
            'is_active' => 'boolean'
        ]);

        // Si se sube una nueva foto, reemplazar la anterior
        if ($request->hasFile('photo')) {
            // Eliminar la foto anterior si existe
            if ($loanEvidence->photo_path && Storage::disk('public')->exists($loanEvidence->photo_path)) {
                Storage::disk('public')->delete($loanEvidence->photo_path);
            }

            $path = $request->file('photo')->store('loan-evidences', 'public');
            $validated['photo_path'] = $path;
        }

        $loanEvidence->update($validated);

        return redirect()->route('loan-evidences.index')
            ->with('success', 'Evidencia actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LoanEvidence $loanEvidence)
    {
        // Eliminar la foto del almacenamiento
        if ($loanEvidence->photo_path && Storage::disk('public')->exists($loanEvidence->photo_path)) {
            Storage::disk('public')->delete($loanEvidence->photo_path);
        }

        $loanEvidence->delete();

        return redirect()->route('loan-evidences.index')
            ->with('success', 'Evidencia eliminada exitosamente.');
    }

    /**
     * Restore a soft deleted evidence
     */
    public function restore($id)
    {
        $evidence = LoanEvidence::withTrashed()->findOrFail($id);
        $evidence->restore();

        return redirect()->route('loan-evidences.index')
            ->with('success', 'Evidencia restaurada exitosamente.');
    }

    /**
     * Force delete an evidence
     */
    public function forceDelete($id)
    {
        $evidence = LoanEvidence::withTrashed()->findOrFail($id);

        // Eliminar la foto del almacenamiento
        if ($evidence->photo_path && Storage::disk('public')->exists($evidence->photo_path)) {
            Storage::disk('public')->delete($evidence->photo_path);
        }

        $evidence->forceDelete();

        return redirect()->route('loan-evidences.trashed')
            ->with('success', 'Evidencia eliminada permanentemente.');
    }

    /**
     * Show trashed evidences
     */
    public function trashed()
    {
        $evidences = LoanEvidence::onlyTrashed()
            ->with(['loanResource.loan.user', 'loanResource.resource'])
            ->latest()
            ->paginate(10);

        return view('modules.loan-evidences.trashed', compact('evidences'));
    }
}
