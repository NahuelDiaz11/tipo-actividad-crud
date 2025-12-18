<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTipoActividadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'descripcion' => 'required|string|max:255|unique:actividades_laborales,descripcion',
            'orden_adicional' => 'nullable|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.unique' => 'Ya existe un tipo de actividad con esa descripción.',
            'orden_adicional.integer' => 'El orden debe ser un número.',
            'orden_adicional.min' => 'El orden no puede ser negativo.',
        ];
    }
}
