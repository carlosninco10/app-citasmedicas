<?php

namespace App\Http\Requests\Usuarios;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsuariosRequest extends FormRequest
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
        $usuario = $this->route('usuario');
        $usuarioId = $usuario->id;
        return [
            'nombre' => 'required|string|max:100',
            'correo'=>'required|email|unique:usuarios,correo,'.$usuarioId,
            'contrasena' => 'required|max:255',
            'rol' => 'required'
        ];
    }
}
