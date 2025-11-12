<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\ProgramType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('programs.index', [
            'programs' => Program::with('programType')->latest()->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('programs.create', [
            'programTypes' => ProgramType::where('is_active', true)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'program_type_id' => 'required|exists:program_types,id',
            'name' => 'required|string|max:255|unique:programs',
            'description' => 'nullable|string|max:255',
        ]);

        Program::create($validated);

        return redirect()->route('programs.index')
            ->with('success', 'Programa creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program): View
    {
        return view('programs.show', [
            'program' => $program->load(['programType', 'campuses', 'campusPrograms'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program): View
    {
        return view('programs.edit', [
            'program' => $program,
            'programTypes' => ProgramType::where('is_active', true)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program): RedirectResponse
    {
        $validated = $request->validate([
            'program_type_id' => 'required|exists:program_types,id',
            'name' => 'required|string|max:255|unique:programs,name,' . $program->id,
            'description' => 'nullable|string|max:255',
        ]);

        $program->update($validated);

        return redirect()->route('programs.index')
            ->with('success', 'Programa actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program): RedirectResponse
    {
        $program->delete();
        return redirect()->route('programs.index')
            ->with('success', 'Programa eliminado exitosamente.');
    }
}
