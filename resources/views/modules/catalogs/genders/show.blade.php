@extends('layouts.app')

@section('title', 'Show Genders')

@section('content')
<script>
    window.location.href = "{{ route('catalogs.show', ['catalog' => 'genders', 'id' => $genders->id]) }}";
</script>
<div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Redirigiendo...</span>
    </div>
    <p class="ms-3 mb-0">Redirigiendo al sistema de catálogos...</p>
</div>
@endsection