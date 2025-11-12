<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use App\Models\ContactType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('contacts.index', [
            'contacts' => Contact::with(['user', 'contactType'])->latest()->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('contacts.create', [
            'users' => User::where('is_active', true)->get(),
            'contactTypes' => ContactType::where('is_active', true)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'contact_type_id' => 'required|exists:contact_types,id',
            'contact_value' => 'required|string|max:255',
            'is_principal' => 'boolean',
        ]);

        // Si se marca como principal, quitar principal de otros contactos del usuario
        if ($request->has('is_principal') && $request->is_principal) {
            Contact::where('user_id', $validated['user_id'])->update(['is_principal' => false]);
        }

        Contact::create($validated);

        return redirect()->route('contacts.index')
            ->with('success', 'Contacto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact): View
    {
        return view('contacts.show', [
            'contact' => $contact->load(['user', 'contactType'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact): View
    {
        return view('contacts.edit', [
            'contact' => $contact,
            'users' => User::where('is_active', true)->get(),
            'contactTypes' => ContactType::where('is_active', true)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact): RedirectResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'contact_type_id' => 'required|exists:contact_types,id',
            'contact_value' => 'required|string|max:255',
            'is_principal' => 'boolean',
        ]);

        // Si se marca como principal, quitar principal de otros contactos del usuario
        if ($request->has('is_principal') && $request->is_principal) {
            Contact::where('user_id', $validated['user_id'])->where('id', '!=', $contact->id)->update(['is_principal' => false]);
        }

        $contact->update($validated);

        return redirect()->route('contacts.index')
            ->with('success', 'Contacto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();

        return redirect()->route('contacts.index')
            ->with('success', 'Contacto eliminado exitosamente.');
    }
}
