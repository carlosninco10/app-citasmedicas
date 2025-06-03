<?php

namespace App\Http\Controllers;

use App\Http\Requests\Usuarios\StoreUserRequest;
use App\Http\Requests\Usuarios\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('usuarios.index', ["usuarios" => User::latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        // Validación de campos
        $request->validated();


        $usuarios = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol
        ]);
        $usuarios->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario registrado');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $usuario)
    {
        return view("usuarios.edit", ["usuario" => $usuario]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $usuario)
    {
        $request->validated();


        $usuario->fill($request->input());
        $usuario->password = Hash::make($usuario->password);
        $usuario->updated_at = now();
        $usuario->saveOrFail();

        return redirect()->route("usuarios.index")->with("success", "Usuario actualizado");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        // $usuario->delete();
        $message = "";
        if ($usuario->estado == 1) {
            $usuario->estado = 0;
            $usuario->updated_at = now();
            $usuario->saveOrFail();
            $message = "Usuario eliminado";
        } else {
            $usuario->estado = 1;
            $usuario->updated_at = now();
            $usuario->saveOrFail();
            $message = "Usuario restaurada";
        }

        return redirect()->route("usuarios.index")->with("success", $message);
    }
}
