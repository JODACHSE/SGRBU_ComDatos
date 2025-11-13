@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<div class="container-fluid">
    <x-alert />

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-pencil me-2"></i>Editar Usuario
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-bold">Nombre <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="second_name" class="form-label fw-bold">Segundo Nombre</label>
                                <input type="text" class="form-control @error('second_name') is-invalid @enderror"
                                    id="second_name" name="second_name" value="{{ old('second_name', $user->second_name) }}">
                                @error('second_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="lastname" class="form-label fw-bold">Primer Apellido <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('lastname') is-invalid @enderror"
                                    id="lastname" name="lastname" value="{{ old('lastname', $user->lastname) }}" required>
                                @error('lastname')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="second_lastname" class="form-label fw-bold">Segundo Apellido</label>
                                <input type="text" class="form-control @error('second_lastname') is-invalid @enderror"
                                    id="second_lastname" name="second_lastname" value="{{ old('second_lastname', $user->second_lastname) }}">
                                @error('second_lastname')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="document_type_id" class="form-label fw-bold">Tipo de Documento <span class="text-danger">*</span></label>
                                <select class="form-select @error('document_type_id') is-invalid @enderror"
                                    id="document_type_id" name="document_type_id" required>
                                    <option value="">Seleccione un tipo de documento</option>
                                    @foreach($documentTypes as $documentType)
                                    <option value="{{ $documentType->id }}" {{ old('document_type_id', $user->document_type_id) == $documentType->id ? 'selected' : '' }}>
                                        {{ $documentType->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('document_type_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="identification_number" class="form-label fw-bold">Número de Identificación <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('identification_number') is-invalid @enderror"
                                    id="identification_number" name="identification_number" value="{{ old('identification_number', $user->identification_number) }}" required>
                                @error('identification_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="gender_id" class="form-label fw-bold">Género <span class="text-danger">*</span></label>
                                <select class="form-select @error('gender_id') is-invalid @enderror"
                                    id="gender_id" name="gender_id" required>
                                    <option value="">Seleccione un género</option>
                                    @foreach($genders as $gender)
                                    <option value="{{ $gender->id }}" {{ old('gender_id', $user->gender_id) == $gender->id ? 'selected' : '' }}>
                                        {{ $gender->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('gender_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="role" class="form-label fw-bold">Rol <span class="text-danger">*</span></label>
                                <select class="form-select @error('role') is-invalid @enderror"
                                    id="role" name="role" required
                                    {{ Auth::user()->role !== 'admin' ? 'disabled' : '' }}>
                                    <option value="">Seleccione un rol</option>
                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrador</option>
                                    <option value="staff" {{ old('role', $user->role) == 'staff' ? 'selected' : '' }}>Staff</option>
                                    <option value="profesor" {{ old('role', $user->role) == 'profesor' ? 'selected' : '' }}>Profesor</option>
                                    <option value="estudiante" {{ old('role', $user->role) == 'estudiante' ? 'selected' : '' }}>Estudiante</option>
                                </select>
                                @if(auth()->user()->role !== 'admin')
                                <input type="hidden" name="role" value="{{ $user->role }}">
                                @endif
                                @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="campus_program_id" class="form-label fw-bold">Programa de Campus</label>
                                <select class="form-select @error('campus_program_id') is-invalid @enderror"
                                    id="campus_program_id" name="campus_program_id">
                                    <option value="">Seleccione un programa</option>
                                    @foreach($campusPrograms as $campusProgram)
                                    <option value="{{ $campusProgram->id }}" {{ old('campus_program_id', $user->campus_program_id) == $campusProgram->id ? 'selected' : '' }}>
                                        {{ $campusProgram->campus->name }} - {{ $campusProgram->program->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('campus_program_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="academic_status" class="form-label fw-bold">Estado Académico</label>
                                <select class="form-select @error('academic_status') is-invalid @enderror"
                                    id="academic_status" name="academic_status">
                                    <option value="">Seleccione un estado</option>
                                    <option value="activo" {{ old('academic_status', $user->academic_status) == 'activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="baja temporal" {{ old('academic_status', $user->academic_status) == 'baja temporal' ? 'selected' : '' }}>Baja Temporal</option>
                                    <option value="baja permanente" {{ old('academic_status', $user->academic_status) == 'baja permanente' ? 'selected' : '' }}>Baja Permanente</option>
                                    <option value="condicional" {{ old('academic_status', $user->academic_status) == 'condicional' ? 'selected' : '' }}>Condicional</option>
                                    <option value="egresado" {{ old('academic_status', $user->academic_status) == 'egresado' ? 'selected' : '' }}>Egresado</option>
                                </select>
                                @error('academic_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="student_code" class="form-label fw-bold">Código Estudiantil</label>
                                <input type="text" class="form-control @error('student_code') is-invalid @enderror"
                                    id="student_code" name="student_code" value="{{ old('student_code', $user->student_code) }}">
                                @error('student_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="emergency_contact_name" class="form-label fw-bold">Nombre Contacto Emergencia <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('emergency_contact_name') is-invalid @enderror"
                                    id="emergency_contact_name" name="emergency_contact_name" value="{{ old('emergency_contact_name', $user->emergency_contact_name) }}" required>
                                @error('emergency_contact_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="emergency_contact_phone" class="form-label fw-bold">Teléfono Contacto Emergencia <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('emergency_contact_phone') is-invalid @enderror"
                                    id="emergency_contact_phone" name="emergency_contact_phone" value="{{ old('emergency_contact_phone', $user->emergency_contact_phone) }}" required>
                                @error('emergency_contact_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label fw-bold">Contraseña</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password">
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Dejar en blanco para mantener la contraseña actual</small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label fw-bold">Confirmar Contraseña</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Cancelar
                            </a>

                            <div class="btn-group">
                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-check-circle me-2"></i>Actualizar Usuario
                                </button>
                                <a href="{{ route('users.show', $user) }}" class="btn btn-info ms-2">
                                    <i class="bi bi-eye me-2"></i>Ver Detalles
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endsection