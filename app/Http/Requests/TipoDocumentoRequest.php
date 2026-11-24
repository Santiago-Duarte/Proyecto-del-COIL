<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TipoDocumentoRequest extends FormRequest
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
        $tipoDocumento = $this->route('tipoDocumento');

        return [
            'tipo_documento' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tipo_documentos', 'tipo_documento')->ignore($tipoDocumento?->id),
            ],
            'abreviatura' => [
                'required',
                'string',
                'max:10',
                Rule::unique('tipo_documentos', 'abreviatura')->ignore($tipoDocumento?->id),
            ],
            'estado' => ['required', 'boolean'],
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
            'tipo_documento.required' => 'El tipo de documento es obligatorio.',
            'tipo_documento.string' => 'El tipo de documento debe ser texto.',
            'tipo_documento.max' => 'El tipo de documento no debe superar los 255 caracteres.',
            'tipo_documento.unique' => 'Este tipo de documento ya está registrado.',
            'abreviatura.required' => 'La abreviatura es obligatoria.',
            'abreviatura.string' => 'La abreviatura debe ser texto.',
            'abreviatura.max' => 'La abreviatura no debe superar los 10 caracteres.',
            'abreviatura.unique' => 'Esta abreviatura ya está registrada.',
            'estado.required' => 'Selecciona un estado.',
            'estado.boolean' => 'El estado seleccionado no es válido.',
        ];
    }
}
