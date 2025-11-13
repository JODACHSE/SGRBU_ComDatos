<?php

namespace App\Http\Controllers;

use App\Models\ResourceStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResourceStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('modules.catalogs.index', [
            'catalogs' => ['genders', 'document-types', 'contact-types', 'program-types', 'resource-types', 'resource-statuses'],
            'selectedCatalog' => 'resource-statuses',
            'records' => ResourceStatus::latest()->paginate(20),
            'modelName' => 'ResourceStatus'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('modules.catalogs.create', [
            'catalogName' => 'resource-statuses'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:resource_statuses',
            'description' => 'nullable|string|max:255',
        ]);

        ResourceStatus::create($validated);

        return redirect()->route('resource-statuses.index')
            ->with('success', 'Estado de recurso creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ResourceStatus $resourceStatus): View
    {
        return view('modules.catalogs.show', [
            'record' => $resourceStatus,
            'catalogName' => 'resource-statuses'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ResourceStatus $resourceStatus): View
    {
        return view('modules.catalogs.edit', [
            'record' => $resourceStatus,
            'catalogName' => 'resource-statuses'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ResourceStatus $resourceStatus): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:resource_statuses,name,' . $resourceStatus->id,
            'description' => 'nullable|string|max:255',
        ]);

        $resourceStatus->update($validated);

        return redirect()->route('resource-statuses.index')
            ->with('success', 'Estado de recurso actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ResourceStatus $resourceStatus): RedirectResponse
    {
        $resourceStatus->delete();

        return redirect()->route('resource-statuses.index')
            ->with('success', 'Estado de recurso eliminado exitosamente.');
    }
}
