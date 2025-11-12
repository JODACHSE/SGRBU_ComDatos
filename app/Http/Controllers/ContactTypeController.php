<?php

namespace App\Http\Controllers;

use App\Models\ContactType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('contact-types.index', [
            'contactTypes' => ContactType::latest()->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('contact-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:contact_types',
            'description' => 'nullable|string|max:255',
        ]);

        ContactType::create($validated);

        return redirect()->route('contact-types.index')
            ->with('success', 'Tipo de contacto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactType $contactType): View
    {
        return view('contact-types.show', compact('contactType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactType $contactType): View
    {
        return view('contact-types.edit', compact('contactType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContactType $contactType): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:contact_types,name,' . $contactType->id,
            'description' => 'nullable|string|max:255',
        ]);

        $contactType->update($validated);

        return redirect()->route('contact-types.index')
            ->with('success', 'Tipo de contacto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactType $contactType): RedirectResponse
    {
        $contactType->delete();

        return redirect()->route('contact-types.index')
            ->with('success', 'Tipo de contacto eliminado exitosamente.');
    }
}
