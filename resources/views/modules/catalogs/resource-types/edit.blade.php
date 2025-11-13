@extends('layouts.app')

@section('title', 'Edit Resource types')

@section('content')
<script>
    window.location.href = "{{ route('catalogs.edit', ['catalog' => 'resource-types', 'id' => $resourceTypes->id]) }}";
</script>
<div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Redirigiendo...</span>
    </div>
    <p class="ms-3 mb-0">Redirigiendo al sistema de catálogos...</p>
</div>
@endsection