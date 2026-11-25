<?php

namespace App\Http\Requests;

use App\Models\Owner;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePetRequest extends FormRequest
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
        $pet = $this->route('pet');

        return [
            'name' => ['required', 'string', 'max:255'],
            'species' => ['required', 'string', 'max:100'],
            'breed' => ['nullable', 'string', 'max:100'],
            'owner_id' => ['required', 'integer', Rule::exists(Owner::class, 'id')],
            'birth_date' => ['nullable', 'date', 'before_or_equal:today'],
            'gender' => ['nullable', Rule::in(['Male', 'Female'])],
            'color' => ['nullable', 'string', 'max:50'],
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
            'name.required' => 'The pet name is required.',
            'name.string' => 'The pet name must be text.',
            'name.max' => 'The pet name must not exceed 255 characters.',
            'species.required' => 'The species is required.',
            'species.string' => 'The species must be text.',
            'species.max' => 'The species must not exceed 100 characters.',
            'breed.string' => 'The breed must be text.',
            'breed.max' => 'The breed must not exceed 100 characters.',
            'owner_id.required' => 'The owner is required.',
            'owner_id.integer' => 'The owner must be a valid ID.',
            'owner_id.exists' => 'The selected owner does not exist.',
            'birth_date.date' => 'The birth date must be a valid date.',
            'birth_date.before_or_equal' => 'The birth date cannot be in the future.',
            'gender.in' => 'The gender must be Male or Female.',
            'color.string' => 'The color must be text.',
            'color.max' => 'The color must not exceed 50 characters.',
            'notes.string' => 'The notes must be text.',
            'notes.max' => 'The notes must not exceed 1000 characters.',
        ];
    }
}
