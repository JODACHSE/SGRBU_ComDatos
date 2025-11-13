<div class="mb-3">
    @if(isset($label))
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    @endif

    <input type="{{ $type ?? 'text' }}"
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-control @error($name) is-invalid @enderror"
        value="{{ old($name, $value ?? '') }}"
        {{ $attributes }}>

    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>