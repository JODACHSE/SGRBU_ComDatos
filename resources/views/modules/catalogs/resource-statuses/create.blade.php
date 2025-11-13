@extends('layouts.app')

@section('title', 'Create Resource statuses')

@section('content')
<script>
    window.location.href = "{{ route('catalogs.create', ['catalog' => 'resource-statuses']) }}";
</script>
<div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Redirigiendo...</span>
    </div>
    <p class="ms-3 mb-0">Redirigiendo al sistema de catálogos...</p>
</div>
@endsection