@php($veterinarian = $veterinarian ?? null)

<div class="form-group label-floating">
    <label for="name" class="control-label">Name <strong class="text-danger">(*)</strong></label>
    <input
        type="text"
        name="name"
        id="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $veterinarian->name ?? '') }}"
        placeholder="For example, Dr. Jane Smith"
        maxlength="255"
        required
    >
    @error('name')
        <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
    @enderror
</div>

<div class="form-group label-floating">
    <label for="specialty" class="control-label">Specialty</label>
    <input
        type="text"
        name="specialty"
        id="specialty"
        class="form-control @error('specialty') is-invalid @enderror"
        value="{{ old('specialty', $veterinarian->specialty ?? '') }}"
        placeholder="For example, Surgery, Cardiology, Dermatology"
        maxlength="255"
    >
    @error('specialty')
        <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
    @enderror
</div>

<div class="form-group label-floating">
    <label for="phone" class="control-label">Phone <strong class="text-danger">(*)</strong></label>
    <input
        type="text"
        name="phone"
        id="phone"
        class="form-control @error('phone') is-invalid @enderror"
        value="{{ old('phone', $veterinarian->phone ?? '') }}"
        placeholder="For example, 555-123-4567"
        maxlength="20"
        required
    >
    @error('phone')
        <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
    @enderror
</div>

<div class="form-group label-floating">
    <label for="email" class="control-label">Email <strong class="text-danger">(*)</strong></label>
    <input
        type="email"
        name="email"
        id="email"
        class="form-control @error('email') is-invalid @enderror"
        value="{{ old('email', $veterinarian->email ?? '') }}"
        placeholder="For example, jane.smith@vetclinic.com"
        maxlength="255"
        required
    >
    @error('email')
        <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label class="control-label">Status</label>
    <div class="custom-control custom-switch">
        <input
            type="checkbox"
            name="is_active"
            id="is_active"
            class="custom-control-input"
            {{ old('is_active', $veterinarian->is_active ?? true) ? 'checked' : '' }}
        >
        <label class="custom-control-label" for="is_active">Active</label>
    </div>
</div>