<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DocumentType;
use App\Models\Gender;
use App\Models\CampusProgram;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(): View
    {
        /** @var User $user */
        $user = Auth::user();

        // Cargar relaciones de forma segura
        $userWithRelations = User::with([
            'documentType',
            'gender',
            'campusProgram.campus',
            'campusProgram.program'
        ])->findOrFail($user->id);

        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => route('home')],
            ['name' => 'Mi Perfil']
        ];

        return view('modules.profile.show', [
            'user' => $userWithRelations,
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function edit(): View
    {
        /** @var User $user */
        $user = Auth::user();

        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => route('home')],
            ['name' => 'Mi Perfil', 'url' => route('profile.show')],
            ['name' => 'Editar Perfil']
        ];

        return view('modules.profile.edit', [
            'user' => $user,
            'documentTypes' => DocumentType::where('is_active', true)->get(),
            'genders' => Gender::where('is_active', true)->get(),
            'campusPrograms' => CampusProgram::with(['campus', 'program'])
                ->where('is_active', true)
                ->get(),
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $rules = [
            'name' => 'required|string|max:255',
            'second_name' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'second_lastname' => 'nullable|string|max:255',
            'document_type_id' => 'required|exists:document_types,id',
            'identification_number' => 'required|string|max:255|unique:users,identification_number,' . $user->id,
            'gender_id' => 'required|exists:genders,id',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:255',
            'campus_program_id' => 'nullable|exists:campus_programs,id',
            'academic_status' => 'required|in:activo,baja temporal,baja permanente,condicional,egresado',
            'student_code' => 'nullable|string|max:255|unique:users,student_code,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ];

        // Si el usuario es estudiante, se requieren campus_program_id y academic_status
        if ($user->role === 'estudiante') {
            $rules['campus_program_id'] = 'required|exists:campus_programs,id';
        }

        $validated = $request->validate($rules);

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Actualizar el usuario
        $user->update($validated);

        return redirect()->route('profile.show')
            ->with('success', 'Perfil actualizado exitosamente.');
    }
}
