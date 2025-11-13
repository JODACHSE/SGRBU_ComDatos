<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CampusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('modules.campuses.index', [
            'campuses' => Campus::withCount('programs')->latest()->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('modules.campuses.create'); // CORREGIDO: cambiado de 'campuses.create'
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'campus_type' => 'required|in:Principal,Seccional,Extensión,Oficinas',
            'department' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        Campus::create($validated);

        return redirect()->route('campuses.index')
            ->with('success', 'Campus creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Campus $campus): View
    {
        return view('modules.campuses.show', [
            'campus' => $campus->load(['programs', 'resources', 'loans'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Campus $campus): View
    {
        return view('modules.campuses.edit', compact('campus')); // CORREGIDO: cambiado de 'campuses.edit'
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Campus $campus): RedirectResponse
    {
        $validated = $request->validate([
            'campus_type' => 'required|in:Principal,Seccional,Extensión,Oficinas',
            'department' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        $campus->update($validated);

        return redirect()->route('campuses.index')
            ->with('success', 'Campus actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campus $campus): RedirectResponse
    {
        $campus->delete();
        return redirect()->route('campuses.index')
            ->with('success', 'Campus eliminado exitosamente.');
    }
}
