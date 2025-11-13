<?php

namespace App\Http\Controllers;

use App\Models\ProgramType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProgramTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('modules.catalogs.index', [
            'catalogs' => ['genders', 'document-types', 'contact-types', 'program-types', 'resource-types', 'resource-statuses'],
            'selectedCatalog' => 'program-types',
            'records' => ProgramType::latest()->paginate(20),
            'modelName' => 'ProgramType'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('modules.catalogs.create', [
            'catalogName' => 'program-types'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:program_types',
            'description' => 'nullable|string|max:255',
        ]);

        ProgramType::create($validated);

        return redirect()->route('program-types.index')
            ->with('success', 'Tipo de programa creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProgramType $programType): View
    {
        return view('modules.catalogs.show', [
            'record' => $programType,
            'catalogName' => 'program-types'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramType $programType): View
    {
        return view('modules.catalogs.edit', [
            'record' => $programType,
            'catalogName' => 'program-types'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramType $programType): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:program_types,name,' . $programType->id,
            'description' => 'nullable|string|max:255',
        ]);

        $programType->update($validated);

        return redirect()->route('program-types.index')
            ->with('success', 'Tipo de programa actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramType $programType): RedirectResponse
    {
        $programType->delete();

        return redirect()->route('program-types.index')
            ->with('success', 'Tipo de programa eliminado exitosamente.');
    }
}
