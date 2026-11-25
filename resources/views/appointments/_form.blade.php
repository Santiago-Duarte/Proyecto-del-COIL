@php($appointment = $appointment ?? null)

<div class="row">
    <div class="col-md-6">
        <div class="form-group label-floating">
            <label for="pet_id" class="control-label">Pet <strong class="text-danger">(*)</strong></label>
            <select name="pet_id" id="pet_id" class="form-control select2 @error('pet_id') is-invalid @enderror" required style="width: 100%;">
                <option value="">Select Pet…</option>
                @foreach ($pets as $pet)
                    <option value="{{ $pet->id }}" @selected(old('pet_id', $appointment->pet_id ?? '') == $pet->id)>
                        {{ $pet->name }} ({{ $pet->species }}) - Owner: {{ $pet->owner->name }}
                    </option>
                @endforeach
            </select>
            @error('pet_id')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group label-floating">
            <label for="veterinarian_id" class="control-label">Veterinarian <strong class="text-danger">(*)</strong></label>
            <select name="veterinarian_id" id="veterinarian_id" class="form-control select2 @error('veterinarian_id') is-invalid @enderror" required style="width: 100%;">
                <option value="">Select Veterinarian…</option>
                @foreach ($veterinarians as $vet)
                    <option value="{{ $vet->id }}" @selected(old('veterinarian_id', $appointment->veterinarian_id ?? '') == $vet->id)>
                        {{ $vet->name }} {{ $vet->specialty ? '- ' . $vet->specialty : '' }}
                    </option>
                @endforeach
            </select>
            @error('veterinarian_id')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="form-group label-floating">
    <label for="appointment_date" class="control-label">Date & Time <strong class="text-danger">(*)</strong></label>
    <div class="input-group date" id="appointment_date" data-target-input="nearest">
        <input type="text" name="appointment_date" id="appointment_date_input" class="form-control datetimepicker-input @error('appointment_date') is-invalid @enderror"
               value="{{ old('appointment_date', $appointment?->appointment_date?->format('Y-m-d\TH:i') ?? '') }}" required data-target="#appointment_date"/>
        <div class="input-group-append" data-target="#appointment_date" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fas fa-calendar"></i></div>
        </div>
    </div>
    @error('appointment_date')
        <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
    @enderror
</div>

<div class="form-group label-floating">
    <label for="reason" class="control-label">Reason <strong class="text-danger">(*)</strong></label>
    <textarea
        name="reason"
        id="reason"
        class="form-control @error('reason') is-invalid @enderror"
        rows="3"
        maxlength="1000"
        placeholder="Reason for the appointment (symptoms, check-up type, etc.)"
        required
    >{{ old('reason', $appointment->reason ?? '') }}</textarea>
    @error('reason')
        <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
    @enderror
</div>

<div class="form-group label-floating">
    <label for="status" class="control-label">Status <strong class="text-danger">(*)</strong></label>
    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
        <option value="Pending" @selected(old('status', $appointment->status ?? 'Pending') === 'Pending')>Pending</option>
        <option value="In Consultation" @selected(old('status', $appointment->status ?? '') === 'In Consultation')>In Consultation</option>
        <option value="Attended" @selected(old('status', $appointment->status ?? '') === 'Attended')>Attended</option>
    </select>
    @error('status')
        <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
    @enderror
</div>

<div class="form-group label-floating">
    <label for="notes" class="control-label">Notes</label>
    <textarea
        name="notes"
        id="notes"
        class="form-control @error('notes') is-invalid @enderror"
        rows="3"
        maxlength="1000"
        placeholder="Additional notes, diagnosis, treatment plan..."
    >{{ old('notes', $appointment->notes ?? '') }}</textarea>
    @error('notes')
        <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
    @enderror
</div>

@push('css')
<link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.js') }}"></script>
<script>
    $(function () {
        $('#pet_id, #veterinarian_id').select2({
            theme: 'bootstrap4',
            placeholder: 'Select…',
            allowClear: true,
            width: '100%',
        });

        $('#appointment_date').datetimepicker({
            format: 'YYYY-MM-DDTHH:mm',
            icons: {
                time: 'fas fa-clock',
                date: 'fas fa-calendar',
                up: 'fas fa-arrow-up',
                down: 'fas fa-arrow-down',
                previous: 'fas fa-chevron-left',
                next: 'fas fa-chevron-right',
                today: 'fas fa-calendar-check',
                clear: 'fas fa-trash',
                close: 'fas fa-times'
            }
        });
    });
</script>
@endpush