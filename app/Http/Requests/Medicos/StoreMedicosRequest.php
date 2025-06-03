<?php

namespace App\Http\Requests\Medicos;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicosRequest extends FormRequest
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
            'medico_id' => 'required|exists:users,id',
            'especialidad_id' => 'required|distinct'
        ];
    }

    public function attributes()
    {
        return [
            'medico_id' => 'medico',
            'especialidad_id' => 'especialista'
        ];
    }

    // public function messages()
    // {
    // return [
    //        'especialidad_id.distinct' => 'No se permiten productos repetidos en el mismo envío.'
    //      ];
    //  }
}
