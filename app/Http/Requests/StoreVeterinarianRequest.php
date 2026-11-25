<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreVeterinarianRequest extends FormRequest
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
        $veterinarian = $this->route('veterinarian');

        return [
            'name' => ['required', 'string', 'max:255'],
            'specialty' => ['nullable', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('veterinarians', 'email')->ignore($veterinarian?->id),
            ],
            'is_active' => ['boolean'],
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
            'name.required' => 'The name is required.',
            'name.string' => 'The name must be text.',
            'name.max' => 'The name must not exceed 255 characters.',
            'specialty.string' => 'The specialty must be text.',
            'specialty.max' => 'The specialty must not exceed 255 characters.',
            'phone.required' => 'The phone number is required.',
            'phone.string' => 'The phone number must be text.',
            'phone.max' => 'The phone number must not exceed 20 characters.',
            'email.required' => 'The email is required.',
            'email.string' => 'The email must be text.',
            'email.email' => 'Enter a valid email address.',
            'email.max' => 'The email must not exceed 255 characters.',
            'email.unique' => 'This email is already registered.',
            'is_active.boolean' => 'The status must be true or false.',
        ];
    }
}
