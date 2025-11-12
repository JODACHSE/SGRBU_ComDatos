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
        return view('program-types.index', [
            'programTypes' => ProgramType::latest()->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('program-types.create');
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
        return view('program-types.show', compact('programType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramType $programType): View
    {
        return view('program-types.edit', compact('programType'));
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
