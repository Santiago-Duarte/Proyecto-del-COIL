<?php

namespace App\Http\Requests;

use App\Models\Pet;
use App\Models\Veterinarian;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $appointment = $this->route('appointment');

        return [
            'pet_id' => ['required', 'integer', Rule::exists(Pet::class, 'id')],
            'veterinarian_id' => ['required', 'integer', Rule::exists(Veterinarian::class, 'id')],
            'appointment_date' => ['required', 'date_format:Y-m-d\TH:i'],
            'reason' => ['required', 'string', 'max:1000'],
            'status' => ['required', Rule::in(['Pending', 'In Consultation', 'Attended'])],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * Get custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'pet_id.required' => 'The pet is required.',
            'pet_id.integer' => 'The pet must be a valid ID.',
            'pet_id.exists' => 'The selected pet does not exist.',
            'veterinarian_id.required' => 'The veterinarian is required.',
            'veterinarian_id.integer' => 'The veterinarian must be a valid ID.',
            'veterinarian_id.exists' => 'The selected veterinarian does not exist.',
            'appointment_date.required' => 'The appointment date and time is required.',
            'appointment_date.date_format' => 'The appointment date must be a valid date and time.',
            'reason.required' => 'The reason is required.',
            'reason.string' => 'The reason must be text.',
            'reason.max' => 'The reason must not exceed 1000 characters.',
            'status.required' => 'The status is required.',
            'status.in' => 'The status must be Pending, In Consultation, or Attended.',
            'notes.string' => 'The notes must be text.',
            'notes.max' => 'The notes must not exceed 1000 characters.',
        ];
    }
}
