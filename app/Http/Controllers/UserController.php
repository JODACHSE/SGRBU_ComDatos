<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DocumentType;
use App\Models\Gender;
use App\Models\CampusProgram;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin,staff']);
    }

    public function index(): View
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => route('home')],
            ['name' => 'Gestión de Usuarios']
        ];

        return view('modules.users.index', [
            'users' => User::with(['documentType', 'gender', 'campusProgram'])
                ->latest()
                ->paginate(20),
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function create(): View
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => route('home')],
            ['name' => 'Gestión de Usuarios', 'url' => route('users.index')],
            ['name' => 'Crear Usuario']
        ];

        return view('modules.users.create', [
            'documentTypes' => DocumentType::where('is_active', true)->get(),
            'genders' => Gender::where('is_active', true)->get(),
            'campusPrograms' => CampusProgram::with(['campus', 'program'])
                ->where('is_active', true)
                ->get(),
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'second_name' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'second_lastname' => 'nullable|string|max:255',
            'document_type_id' => 'required|exists:document_types,id',
            'identification_number' => 'required|string|max:255|unique:users',
            'gender_id' => 'required|exists:genders,id',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:255',
            'role' => 'required|in:admin,staff,profesor,estudiante',
            'campus_program_id' => 'nullable|exists:campus_programs,id',
            'academic_status' => 'required|in:activo,baja temporal,baja permanente,condicional,egresado',
            'student_code' => 'nullable|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        User::create($validated);

        return redirect()->route('users.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    public function show(User $user): View
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => route('home')],
            ['name' => 'Gestión de Usuarios', 'url' => route('users.index')],
            ['name' => 'Detalles del Usuario']
        ];

        return view('modules.users.show', [
            'user' => $user->load(['documentType', 'gender', 'campusProgram.campus', 'campusProgram.program', 'contacts', 'loans']),
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function edit(User $user): View
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => route('home')],
            ['name' => 'Gestión de Usuarios', 'url' => route('users.index')],
            ['name' => 'Editar Usuario']
        ];

        return view('modules.users.edit', [
            'user' => $user,
            'documentTypes' => DocumentType::where('is_active', true)->get(),
            'genders' => Gender::where('is_active', true)->get(),
            'campusPrograms' => CampusProgram::with(['campus', 'program'])
                ->where('is_active', true)
                ->get(),
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
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

        // Solo admin puede cambiar el rol
        if (Auth::user()->role === 'admin') {
            $rules['role'] = 'required|in:admin,staff,profesor,estudiante';
        }

        $validated = $request->validate($rules);

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->route('users.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }

    public function restore($id): RedirectResponse
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('users.index')
            ->with('success', 'Usuario restaurado exitosamente.');
    }

    public function forceDelete($id): RedirectResponse
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();
        return redirect()->route('users.trashed')
            ->with('success', 'Usuario eliminado permanentemente.');
    }

    public function trashed(): View
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => route('home')],
            ['name' => 'Gestión de Usuarios', 'url' => route('users.index')],
            ['name' => 'Usuarios Eliminados']
        ];

        return view('modules.users.trashed', [
            'users' => User::onlyTrashed()->latest()->paginate(10),
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function profile(): View
    {
        $user = Auth::user();

        // Cargar relaciones usando with() en una nueva consulta
        $userWithRelations = User::with(['documentType', 'gender', 'campusProgram.campus', 'campusProgram.program'])
            ->find($user->id);

        return view('modules.users.profile', [
            'user' => $userWithRelations
        ]);
    }
}
