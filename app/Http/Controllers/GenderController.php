<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GenderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('genders.index', [
            'genders' => Gender::latest()->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('genders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:genders',
            'description' => 'nullable|string|max:255',
        ]);

        Gender::create($validated);

        return redirect()->route('genders.index')
            ->with('success', 'Género creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gender $gender): View
    {
        return view('genders.show', compact('gender'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gender $gender): View
    {
        return view('genders.edit', compact('gender'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gender $gender): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:genders,name,' . $gender->id,
            'description' => 'nullable|string|max:255',
        ]);

        $gender->update($validated);

        return redirect()->route('genders.index')
            ->with('success', 'Género actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gender $gender): RedirectResponse
    {
        $gender->delete();

        return redirect()->route('genders.index')
            ->with('success', 'Género eliminado exitosamente.');
    }
}
