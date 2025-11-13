<?php

namespace App\Http\Controllers;

use App\Models\ResourceType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResourceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('modules.catalogs.index', [
            'catalogs' => ['genders', 'document-types', 'contact-types', 'program-types', 'resource-types', 'resource-statuses'],
            'selectedCatalog' => 'resource-types',
            'records' => ResourceType::latest()->paginate(20),
            'modelName' => 'ResourceType'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('modules.catalogs.create', [
            'catalogName' => 'resource-types'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:resource_types',
            'description' => 'nullable|string|max:255',
        ]);

        ResourceType::create($validated);

        return redirect()->route('resource-types.index')
            ->with('success', 'Tipo de recurso creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ResourceType $resourceType): View
    {
        return view('modules.catalogs.show', [
            'record' => $resourceType,
            'catalogName' => 'resource-types'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ResourceType $resourceType): View
    {
        return view('modules.catalogs.edit', [
            'record' => $resourceType,
            'catalogName' => 'resource-types'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ResourceType $resourceType): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:resource_types,name,' . $resourceType->id,
            'description' => 'nullable|string|max:255',
        ]);

        $resourceType->update($validated);

        return redirect()->route('resource-types.index')
            ->with('success', 'Tipo de recurso actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ResourceType $resourceType): RedirectResponse
    {
        $resourceType->delete();

        return redirect()->route('resource-types.index')
            ->with('success', 'Tipo de recurso eliminado exitosamente.');
    }
}
