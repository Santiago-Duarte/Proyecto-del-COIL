@php($owner = $owner ?? null)

<div class="form-group label-floating">
    <label for="name" class="control-label">Name <strong class="text-danger">(*)</strong></label>
    <input
        type="text"
        name="name"
        id="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $owner->name ?? '') }}"
        placeholder="For example, John Doe"
        maxlength="255"
        required
    >
    @error('name')
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
        value="{{ old('phone', $owner->phone ?? '') }}"
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
        value="{{ old('email', $owner->email ?? '') }}"
        placeholder="For example, john@example.com"
        maxlength="255"
        required
    >
    @error('email')
        <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
    @enderror
</div>

<div class="form-group label-floating">
    <label for="address" class="control-label">Address</label>
    <textarea
        name="address"
        id="address"
        class="form-control @error('address') is-invalid @enderror"
        rows="3"
        maxlength="500"
        placeholder="Full address including city, state, zip code"
    >{{ old('address', $owner->address ?? '') }}</textarea>
    @error('address')
        <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
    @enderror
</div>