<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alerts = Alert::with(['user', 'loan'])
            ->latest()
            ->paginate(20);

        return view('modules.alerts.index', compact('alerts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::active()->get();
        $loans = Loan::with(['user', 'campus'])->active()->get();
        
        return view('modules.alerts.create', compact('users', 'loans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'loan_id' => 'required|exists:loans,id',
            'alert_status' => 'required|in:reportado,en_revision,resuelto',
            'description' => 'required|string|max:1000',
            'is_active' => 'boolean'
        ]);

        Alert::create($validated);

        return redirect()->route('alerts.index')
            ->with('success', 'Alerta creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Alert $alert)
    {
        $alert->load(['user', 'loan.user', 'loan.campus']);
        
        return view('modules.alerts.show', compact('alert'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alert $alert)
    {
        $users = User::active()->get();
        $loans = Loan::with(['user', 'campus'])->active()->get();
        
        return view('modules.alerts.edit', compact('alert', 'users', 'loans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alert $alert)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'loan_id' => 'required|exists:loans,id',
            'alert_status' => 'required|in:reportado,en_revision,resuelto',
            'description' => 'required|string|max:1000',
            'is_active' => 'boolean'
        ]);

        $alert->update($validated);

        return redirect()->route('alerts.index')
            ->with('success', 'Alerta actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alert $alert)
    {
        $alert->delete();

        return redirect()->route('alerts.index')
            ->with('success', 'Alerta eliminada exitosamente.');
    }

    /**
     * Restore a soft deleted alert
     */
    public function restore($id)
    {
        $alert = Alert::withTrashed()->findOrFail($id);
        $alert->restore();

        return redirect()->route('alerts.index')
            ->with('success', 'Alerta restaurada exitosamente.');
    }

    /**
     * Force delete an alert
     */
    public function forceDelete($id)
    {
        $alert = Alert::withTrashed()->findOrFail($id);
        $alert->forceDelete();

        return redirect()->route('alerts.trashed')
            ->with('success', 'Alerta eliminada permanentemente.');
    }

    /**
     * Show trashed alerts
     */
    public function trashed()
    {
        $alerts = Alert::onlyTrashed()
            ->with(['user', 'loan'])
            ->latest()
            ->paginate(10);

        return view('modules.alerts.trashed', compact('alerts'));
    }
}