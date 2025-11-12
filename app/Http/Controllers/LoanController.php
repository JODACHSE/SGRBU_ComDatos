<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use App\Models\Campus;
use App\Models\Resource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('loans.index', [
            'loans' => Loan::with(['user', 'campus', 'loanResources'])
                ->latest()
                ->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('loans.create', [
            'users' => User::where('is_active', true)->get(),
            'campuses' => Campus::where('is_active', true)->get(),
            'resources' => Resource::where('is_active', true)
                ->where('resource_status_id', 1) // Disponible
                ->get()
        ]);
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
            'resources' => 'required|array',
            'resources.*' => 'exists:resources,id'
        ]);

        $loan = Loan::create($validated);

        // Asociar recursos al préstamo
        foreach ($request->resources as $resourceId) {
            $loan->loanResources()->create(['resource_id' => $resourceId]);

            // Actualizar estado del recurso a "Prestado"
            Resource::find($resourceId)->update(['resource_status_id' => 2]);
        }

        return redirect()->route('loans.index')
            ->with('success', 'Préstamo creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan): View
    {
        return view('loans.show', [
            'loan' => $loan->load(['user', 'campus', 'loanResources.resource'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan $loan): View
    {
        return view('loans.edit', [
            'loan' => $loan,
            'users' => User::where('is_active', true)->get(),
            'campuses' => Campus::where('is_active', true)->get(),
        ]);
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
            'actual_return_date' => 'nullable|date|after:loan_date',
            'loan_status' => 'required|in:pendiente,aprovado,activo,completado,vencido,cancelado',
            'notes' => 'nullable|string',
        ]);

        $loan->update($validated);

        // Si el préstamo se completa, liberar recursos
        if ($request->loan_status === 'completado' && !$loan->actual_return_date) {
            $loan->update(['actual_return_date' => now()]);

            foreach ($loan->loanResources as $loanResource) {
                $loanResource->resource()->update(['resource_status_id' => 1]); // Disponible
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
            $loanResource->resource()->update(['resource_status_id' => 1]);
        }

        return redirect()->route('loans.index')
            ->with('success', 'Préstamo marcado como devuelto.');
    }
}
