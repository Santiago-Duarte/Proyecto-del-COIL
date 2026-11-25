@php($pet = $pet ?? null)

<div class="row">
    <div class="col-md-6">
        <div class="form-group label-floating">
            <label for="name" class="control-label">Name <strong class="text-danger">(*)</strong></label>
            <input
                type="text"
                name="name"
                id="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $pet->name ?? '') }}"
                placeholder="For example, Max"
                maxlength="255"
                required
            >
            @error('name')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group label-floating">
            <label for="species" class="control-label">Species <strong class="text-danger">(*)</strong></label>
            <input
                type="text"
                name="species"
                id="species"
                class="form-control @error('species') is-invalid @enderror"
                value="{{ old('species', $pet->species ?? '') }}"
                placeholder="For example, Dog, Cat, Bird"
                maxlength="100"
                required
            >
            @error('species')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group label-floating">
            <label for="breed" class="control-label">Breed</label>
            <input
                type="text"
                name="breed"
                id="breed"
                class="form-control @error('breed') is-invalid @enderror"
                value="{{ old('breed', $pet->breed ?? '') }}"
                placeholder="For example, Golden Retriever"
                maxlength="100"
            >
            @error('breed')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group label-floating">
            <label for="owner_id" class="control-label">Owner <strong class="text-danger">(*)</strong></label>
            <select name="owner_id" id="owner_id" class="form-control select2 @error('owner_id') is-invalid @enderror" required style="width: 100%;">
                <option value="">Select Owner…</option>
                @foreach ($owners as $owner)
                    <option value="{{ $owner->id }}" @selected(old('owner_id', $pet->owner_id ?? '') == $owner->id)>
                        {{ $owner->name }} ({{ $owner->phone }})
                    </option>
                @endforeach
            </select>
            @error('owner_id')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group label-floating">
            <label for="birth_date" class="control-label">Birth Date</label>
            <input
                type="date"
                name="birth_date"
                id="birth_date"
                class="form-control @error('birth_date') is-invalid @enderror"
                value="{{ old('birth_date', $pet?->birth_date?->format('Y-m-d') ?? '') }}"
                max="{{ now()->format('Y-m-d') }}"
            >
            @error('birth_date')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group label-floating">
            <label for="gender" class="control-label">Gender</label>
            <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
                <option value="">Select…</option>
                <option value="Male" @selected(old('gender', $pet->gender ?? '') === 'Male')>Male</option>
                <option value="Female" @selected(old('gender', $pet->gender ?? '') === 'Female')>Female</option>
            </select>
            @error('gender')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group label-floating">
            <label for="color" class="control-label">Color</label>
            <input
                type="text"
                name="color"
                id="color"
                class="form-control @error('color') is-invalid @enderror"
                value="{{ old('color', $pet->color ?? '') }}"
                placeholder="For example, Golden, Black, White"
                maxlength="50"
            >
            @error('color')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="form-group label-floating">
    <label for="notes" class="control-label">Notes</label>
    <textarea
        name="notes"
        id="notes"
        class="form-control @error('notes') is-invalid @enderror"
        rows="3"
        maxlength="1000"
        placeholder="Medical history, allergies, special care instructions..."
    >{{ old('notes', $pet->notes ?? '') }}</textarea>
    @error('notes')
        <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
    @enderror
</div>

@push('css')
<link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(function () {
        $('#owner_id').select2({
            theme: 'bootstrap4',
            placeholder: 'Select Owner…',
            allowClear: true,
            width: '100%',
        });
    });
</script>
@endpush