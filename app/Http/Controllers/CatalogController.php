<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CatalogController extends Controller
{
    private $catalogModels = [
        'genders' => \App\Models\Gender::class,
        'document-types' => \App\Models\DocumentType::class,
        'contact-types' => \App\Models\ContactType::class,
        'program-types' => \App\Models\ProgramType::class,
        'resource-types' => \App\Models\ResourceType::class,
        'resource-statuses' => \App\Models\ResourceStatus::class,
    ];

    public function index(Request $request)
    {
        $selectedCatalog = $request->get('catalog', 'genders');

        if (!array_key_exists($selectedCatalog, $this->catalogModels)) {
            abort(404, 'Catálogo no encontrado');
        }

        $model = $this->catalogModels[$selectedCatalog];
        $records = $model::latest()->paginate(10);

        return view('modules.catalogs.index', [ // CORREGIDO
            'catalogs' => array_keys($this->catalogModels),
            'selectedCatalog' => $selectedCatalog,
            'records' => $records,
            'modelName' => class_basename($model)
        ]);
    }

    public function show(string $catalog, $id)
    {
        if (!array_key_exists($catalog, $this->catalogModels)) {
            abort(404, 'Catálogo no encontrado');
        }

        $model = $this->catalogModels[$catalog];
        $record = $model::findOrFail($id);

        return view('modules.catalogs.show', [ // CORREGIDO
            'record' => $record,
            'catalogName' => $catalog
        ]);
    }

    public function create(string $catalog)
    {
        if (!array_key_exists($catalog, $this->catalogModels)) {
            abort(404, 'Catálogo no encontrado');
        }

        return view('modules.catalogs.create', [ // CORREGIDO
            'catalogName' => $catalog
        ]);
    }

    public function edit(string $catalog, $id)
    {
        if (!array_key_exists($catalog, $this->catalogModels)) {
            abort(404, 'Catálogo no encontrado');
        }

        $model = $this->catalogModels[$catalog];
        $record = $model::findOrFail($id);

        return view('modules.catalogs.edit', [ // CORREGIDO
            'record' => $record,
            'catalogName' => $catalog
        ]);
    }

    public function toggleActive(Request $request, string $catalog, $id): RedirectResponse
    {
        if (!array_key_exists($catalog, $this->catalogModels)) {
            abort(404, 'Catálogo no encontrado');
        }

        $model = $this->catalogModels[$catalog];
        $record = $model::findOrFail($id);

        $record->update(['is_active' => !$record->is_active]);

        return redirect()->route('catalogs.index', ['catalog' => $catalog])
            ->with('success', 'Estado actualizado exitosamente.');
    }
}
