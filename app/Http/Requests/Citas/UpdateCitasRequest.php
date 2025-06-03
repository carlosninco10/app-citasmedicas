<?php

namespace App\Http\Requests\Citas;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCitasRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'paciente_id' => 'required|exists:users,id',
            'disponibilidad_id' => 'required|exists:disponibilidades,id',
            'observaciones' => 'nullable|string|max:1000',
            'estado' => 'required|in:pendiente,confirmada,cancelada,realizada',
        ];
    }
}
