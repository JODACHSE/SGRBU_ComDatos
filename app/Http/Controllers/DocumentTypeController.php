<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('document-types.index', [
            'documentTypes' => DocumentType::latest()->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('document-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:document_types',
            'description' => 'nullable|string|max:255',
        ]);

        DocumentType::create($validated);

        return redirect()->route('document-types.index')
            ->with('success', 'Tipo de documento creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DocumentType $documentType): View
    {
        return view('document-types.show', compact('documentType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DocumentType $documentType): View
    {
        return view('document-types.edit', compact('documentType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DocumentType $documentType): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:document_types,name,' . $documentType->id,
            'description' => 'nullable|string|max:255',
        ]);

        $documentType->update($validated);

        return redirect()->route('document-types.index')
            ->with('success', 'Tipo de documento actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DocumentType $documentType): RedirectResponse
    {
        $documentType->delete();

        return redirect()->route('document-types.index')
            ->with('success', 'Tipo de documento eliminado exitosamente.');
    }
}
