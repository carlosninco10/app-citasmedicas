<?php

namespace App\Http\Requests\Especialistas;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEspecialistasRequest extends FormRequest
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
        $especialista = $this->route('especialista');
        $especialistaId = $especialista->id;
        return [
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255,' . $especialistaId,
        ];
    }
}
