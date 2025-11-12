<?php

namespace App\Http\Controllers;

use App\Models\LoanResource;
use App\Models\Loan;
use App\Models\Resource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoanResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('loan-resources.index', [
            'loanResources' => LoanResource::with(['loan', 'resource'])->latest()->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('loan-resources.create', [
            'loans' => Loan::where('is_active', true)->get(),
            'resources' => Resource::where('is_active', true)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'loan_id' => 'required|exists:loans,id',
            'resource_id' => 'required|exists:resources,id',
        ]);

        LoanResource::create($validated);

        return redirect()->route('loan-resources.index')
            ->with('success', 'Recurso de préstamo creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LoanResource $loanResource): View
    {
        return view('loan-resources.show', [
            'loanResource' => $loanResource->load(['loan', 'resource', 'loanEvidences'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LoanResource $loanResource): View
    {
        return view('loan-resources.edit', [
            'loanResource' => $loanResource,
            'loans' => Loan::where('is_active', true)->get(),
            'resources' => Resource::where('is_active', true)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LoanResource $loanResource): RedirectResponse
    {
        $validated = $request->validate([
            'loan_id' => 'required|exists:loans,id',
            'resource_id' => 'required|exists:resources,id',
        ]);

        $loanResource->update($validated);

        return redirect()->route('loan-resources.index')
            ->with('success', 'Recurso de préstamo actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LoanResource $loanResource): RedirectResponse
    {
        $loanResource->delete();

        return redirect()->route('loan-resources.index')
            ->with('success', 'Recurso de préstamo eliminado exitosamente.');
    }
}
