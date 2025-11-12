<?php

namespace App\Http\Controllers;

use App\Models\CampusProgram;
use App\Models\Campus;
use App\Models\Program;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CampusProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('campus-programs.index', [
            'campusPrograms' => CampusProgram::with(['campus', 'program'])->latest()->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('campus-programs.create', [
            'campuses' => Campus::where('is_active', true)->get(),
            'programs' => Program::where('is_active', true)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'campus_id' => 'required|exists:campuses,id',
            'program_id' => 'required|exists:programs,id',
        ]);

        // Verificar que la combinación no exista
        if (CampusProgram::where('campus_id', $validated['campus_id'])->where('program_id', $validated['program_id'])->exists()) {
            return redirect()->back()->withErrors(['campus_id' => 'Esta combinación de campus y programa ya existe.']);
        }

        CampusProgram::create($validated);

        return redirect()->route('campus-programs.index')
            ->with('success', 'Relación Campus-Programa creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CampusProgram $campusProgram): View
    {
        return view('campus-programs.show', [
            'campusProgram' => $campusProgram->load(['campus', 'program', 'users'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CampusProgram $campusProgram): View
    {
        return view('campus-programs.edit', [
            'campusProgram' => $campusProgram,
            'campuses' => Campus::where('is_active', true)->get(),
            'programs' => Program::where('is_active', true)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CampusProgram $campusProgram): RedirectResponse
    {
        $validated = $request->validate([
            'campus_id' => 'required|exists:campuses,id',
            'program_id' => 'required|exists:programs,id',
        ]);

        // Verificar que la combinación no exista (excluyendo el actual)
        if (CampusProgram::where('campus_id', $validated['campus_id'])
            ->where('program_id', $validated['program_id'])
            ->where('id', '!=', $campusProgram->id)
            ->exists()
        ) {
            return redirect()->back()->withErrors(['campus_id' => 'Esta combinación de campus y programa ya existe.']);
        }

        $campusProgram->update($validated);

        return redirect()->route('campus-programs.index')
            ->with('success', 'Relación Campus-Programa actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CampusProgram $campusProgram): RedirectResponse
    {
        $campusProgram->delete();

        return redirect()->route('campus-programs.index')
            ->with('success', 'Relación Campus-Programa eliminada exitosamente.');
    }
}
