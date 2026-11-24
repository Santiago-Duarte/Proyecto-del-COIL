<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PersonaExternaRequest extends FormRequest
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
        $personaExterna = $this->route('personaExterna');

        return [
            'nombre' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('persona_externas', 'email')->ignore($personaExterna?->id),
            ],
            'celular' => ['required', 'string', 'max:20'],
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser texto.',
            'nombre.max' => 'El nombre no debe superar los 255 caracteres.',
            'apellidos.required' => 'El apellido es obligatorio.',
            'apellidos.string' => 'El apellido debe ser texto.',
            'apellidos.max' => 'El apellido no debe superar los 255 caracteres.',
            'email.required' => 'El email es obligatorio.',
            'email.string' => 'El email debe ser texto.',
            'email.email' => 'Ingresa un email válido.',
            'email.max' => 'El email no debe superar los 255 caracteres.',
            'email.unique' => 'Este email ya está registrado.',
            'celular.required' => 'El celular es obligatorio.',
            'celular.string' => 'El celular debe ser texto.',
            'celular.max' => 'El celular no debe superar los 20 caracteres.',
        ];
    }
}
