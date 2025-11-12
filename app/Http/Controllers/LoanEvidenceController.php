<?php

namespace App\Http\Controllers;

use App\Models\LoanEvidence;
use App\Models\LoanResource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoanEvidenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('loan-evidences.index', [
            'loanEvidences' => LoanEvidence::with('loanResource')->latest()->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('loan-evidences.create', [
            'loanResources' => LoanResource::with(['loan', 'resource'])->where('is_active', true)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'loan_resource_id' => 'required|exists:loan_resources,id',
            'loan_type' => 'required|in:prestamo,devuelución',
            'photo_path' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        LoanEvidence::create($validated);

        return redirect()->route('loan-evidences.index')
            ->with('success', 'Evidencia de préstamo creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LoanEvidence $loanEvidence): View
    {
        return view('loan-evidences.show', [
            'loanEvidence' => $loanEvidence->load('loanResource')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LoanEvidence $loanEvidence): View
    {
        return view('loan-evidences.edit', [
            'loanEvidence' => $loanEvidence,
            'loanResources' => LoanResource::with(['loan', 'resource'])->where('is_active', true)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LoanEvidence $loanEvidence): RedirectResponse
    {
        $validated = $request->validate([
            'loan_resource_id' => 'required|exists:loan_resources,id',
            'loan_type' => 'required|in:prestamo,devuelución',
            'photo_path' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $loanEvidence->update($validated);

        return redirect()->route('loan-evidences.index')
            ->with('success', 'Evidencia de préstamo actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LoanEvidence $loanEvidence): RedirectResponse
    {
        $loanEvidence->delete();

        return redirect()->route('loan-evidences.index')
            ->with('success', 'Evidencia de préstamo eliminada exitosamente.');
    }
}
