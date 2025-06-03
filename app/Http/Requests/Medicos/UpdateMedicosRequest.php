<?php

namespace App\Http\Requests\Medicos;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMedicosRequest extends FormRequest
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
            'medico_id' => 'required|integer|exists:users,id',
            'especialidad_id' => 'required|exists:especialistas,id'
        ];
    }

    public function attributes()
    {
        return [
            'medico_id' => 'medico',
            'especialidad_id' => 'especialidad'
        ];
    }
}
