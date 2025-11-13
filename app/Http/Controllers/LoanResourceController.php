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
        return view('modules.loan-resources.index', [ // CORREGIDO
            'loanResources' => LoanResource::with(['loan.user', 'loan.campus', 'resource'])->latest()->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('modules.loan-resources.create', [ // CORREGIDO
            'loans' => Loan::where('is_active', true)->with('user')->get(),
            'resources' => Resource::where('is_active', true)->where('resource_status_id', 1)->get() // Solo recursos disponibles
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

        // Verificar que el recurso esté disponible
        $resource = Resource::find($validated['resource_id']);
        if ($resource->resource_status_id != 1) {
            return redirect()->back()
                ->with('error', 'El recurso no está disponible para préstamo.')
                ->withInput();
        }

        LoanResource::create([
            'loan_id' => $validated['loan_id'],
            'resource_id' => $validated['resource_id'],
            'is_active' => true
        ]);

        // Actualizar estado del recurso a "Prestado"
        $resource->update(['resource_status_id' => 2]);

        return redirect()->route('loan-resources.index')
            ->with('success', 'Recurso de préstamo creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LoanResource $loanResource): View
    {
        return view('modules.loan-resources.show', [ // CORREGIDO
            'loanResource' => $loanResource->load(['loan.user', 'loan.campus', 'resource.resourceType', 'resource.resourceStatus', 'loanEvidences'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LoanResource $loanResource): View
    {
        return view('modules.loan-resources.edit', [ // CORREGIDO
            'loanResource' => $loanResource,
            'loans' => Loan::where('is_active', true)->with('user')->get(),
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
        // Liberar recurso (cambiar estado a disponible)
        if ($loanResource->resource) {
            $loanResource->resource()->update(['resource_status_id' => 1]);
        }

        $loanResource->delete();

        return redirect()->route('loan-resources.index')
            ->with('success', 'Recurso de préstamo eliminado exitosamente.');
    }
}
