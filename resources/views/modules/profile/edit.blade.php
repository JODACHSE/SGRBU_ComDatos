@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach($breadcrumbs as $breadcrumb)
            @if(isset($breadcrumb['url']))
            <li class="breadcrumb-item"><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a></li>
            @else
            <li class="breadcrumb-item active">{{ $breadcrumb['name'] }}</li>
            @endif
            @endforeach
        </ol>
    </nav>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">
                <i class="bi bi-pencil-square me-2"></i>Editar Perfil
            </h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Información Personal -->
                    <div class="col-md-6">
                        <h6 class="border-bottom pb-2 mb-3">Información Personal</h6>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nombre *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="second_name" class="form-label">Segundo Nombre</label>
                                <input type="text" class="form-control @error('second_name') is-invalid @enderror"
                                    id="second_name" name="second_name" value="{{ old('second_name', $user->second_name) }}">
                                @error('second_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="lastname" class="form-label">Apellido *</label>
                                <input type="text" class="form-control @error('lastname') is-invalid @enderror"
                                    id="lastname" name="lastname" value="{{ old('lastname', $user->lastname) }}" required>
                                @error('lastname')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="second_lastname" class="form-label">Segundo Apellido</label>
                                <input type="text" class="form-control @error('second_lastname') is-invalid @enderror"
                                    id="second_lastname" name="second_lastname" value="{{ old('second_lastname', $user->second_lastname) }}">
                                @error('second_lastname')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="document_type_id" class="form-label">Tipo de Documento *</label>
                                <select class="form-control @error('document_type_id') is-invalid @enderror"
                                    id="document_type_id" name="document_type_id" required>
                                    <option value="">Seleccione...</option>
                                    @foreach($documentTypes as $documentType)
                                    <option value="{{ $documentType->id }}"
                                        {{ old('document_type_id', $user->document_type_id) == $documentType->id ? 'selected' : '' }}>
                                        {{ $documentType->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('document_type_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="identification_number" class="form-label">Número de Identificación *</label>
                                <input type="text" class="form-control @error('identification_number') is-invalid @enderror"
                                    id="identification_number" name="identification_number"
                                    value="{{ old('identification_number', $user->identification_number) }}" required>
                                @error('identification_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="gender_id" class="form-label">Género *</label>
                            <select class="form-control @error('gender_id') is-invalid @enderror"
                                id="gender_id" name="gender_id" required>
                                <option value="">Seleccione...</option>
                                @foreach($genders as $gender)
                                <option value="{{ $gender->id }}"
                                    {{ old('gender_id', $user->gender_id) == $gender->id ? 'selected' : '' }}>
                                    {{ $gender->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('gender_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Información de Contacto y Académica -->
                    <div class="col-md-6">
                        <h6 class="border-bottom pb-2 mb-3">Información de Contacto</h6>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="emergency_contact_name" class="form-label">Contacto de Emergencia *</label>
                            <input type="text" class="form-control @error('emergency_contact_name') is-invalid @enderror"
                                id="emergency_contact_name" name="emergency_contact_name"
                                value="{{ old('emergency_contact_name', $user->emergency_contact_name) }}" required>
                            @error('emergency_contact_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="emergency_contact_phone" class="form-label">Teléfono de Emergencia *</label>
                            <input type="text" class="form-control @error('emergency_contact_phone') is-invalid @enderror"
                                id="emergency_contact_phone" name="emergency_contact_phone"
                                value="{{ old('emergency_contact_phone', $user->emergency_contact_phone) }}" required>
                            @error('emergency_contact_phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if(in_array($user->role, ['estudiante', 'profesor']))
                        <h6 class="border-bottom pb-2 mb-3 mt-4">Información Académica</h6>

                        <div class="mb-3">
                            <label for="campus_program_id" class="form-label">Programa y Sede</label>
                            <select class="form-control @error('campus_program_id') is-invalid @enderror"
                                id="campus_program_id" name="campus_program_id">
                                <option value="">Seleccione...</option>
                                @foreach($campusPrograms as $campusProgram)
                                <option value="{{ $campusProgram->id }}"
                                    {{ old('campus_program_id', $user->campus_program_id) == $campusProgram->id ? 'selected' : '' }}>
                                    {{ $campusProgram->program->name }} - {{ $campusProgram->campus->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('campus_program_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="academic_status" class="form-label">Estado Académico *</label>
                            <select class="form-control @error('academic_status') is-invalid @enderror"
                                id="academic_status" name="academic_status" required>
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

                        <div class="mb-3">
                            <label for="student_code" class="form-label">Código de Estudiante</label>
                            <input type="text" class="form-control @error('student_code') is-invalid @enderror"
                                id="student_code" name="student_code"
                                value="{{ old('student_code', $user->student_code) }}">
                            @error('student_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @endif

                        <h6 class="border-bottom pb-2 mb-3 mt-4">Seguridad</h6>

                        <div class="mb-3">
                            <label for="password" class="form-label">Nueva Contraseña</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Dejar en blanco para no cambiar">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
                            <input type="password" class="form-control"
                                id="password_confirmation" name="password_confirmation">
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>Actualizar Perfil
                            </button>
                            <a href="{{ route('profile.show') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-2"></i>Cancelar
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection