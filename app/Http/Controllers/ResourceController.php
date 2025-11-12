<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\Campus;
use App\Models\ResourceType;
use App\Models\ResourceStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('resources.index', [
            'resources' => Resource::with(['campus', 'resourceType', 'resourceStatus'])
                ->latest()
                ->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('resources.create', [
            'campuses' => Campus::where('is_active', true)->get(),
            'resourceTypes' => ResourceType::where('is_active', true)->get(),
            'resourceStatuses' => ResourceStatus::where('is_active', true)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'campus_id' => 'required|exists:campuses,id',
            'resource_type_id' => 'required|exists:resource_types,id',
            'resource_status_id' => 'required|exists:resource_statuses,id',
            'name' => 'required|string|max:255',
            'resource_code' => 'required|string|max:255|unique:resources',
            'description' => 'nullable|string',
        ]);

        Resource::create($validated);

        return redirect()->route('resources.index')
            ->with('success', 'Recurso creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Resource $resource): View
    {
        return view('resources.show', [
            'resource' => $resource->load(['campus', 'resourceType', 'resourceStatus', 'loanResources'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resource $resource): View
    {
        return view('resources.edit', [
            'resource' => $resource,
            'campuses' => Campus::where('is_active', true)->get(),
            'resourceTypes' => ResourceType::where('is_active', true)->get(),
            'resourceStatuses' => ResourceStatus::where('is_active', true)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resource $resource): RedirectResponse
    {
        $validated = $request->validate([
            'campus_id' => 'required|exists:campuses,id',
            'resource_type_id' => 'required|exists:resource_types,id',
            'resource_status_id' => 'required|exists:resource_statuses,id',
            'name' => 'required|string|max:255',
            'resource_code' => 'required|string|max:255|unique:resources,resource_code,' . $resource->id,
            'description' => 'nullable|string',
        ]);

        $resource->update($validated);

        return redirect()->route('resources.index')
            ->with('success', 'Recurso actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resource $resource): RedirectResponse
    {
        $resource->delete();
        return redirect()->route('resources.index')
            ->with('success', 'Recurso eliminado exitosamente.');
    }
}
