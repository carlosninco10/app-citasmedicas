<?php

namespace App\Http\Controllers;

use App\Http\Requests\Usuarios\StoreUsuariosRequest;
use App\Http\Requests\Usuarios\UpdateUsuariosRequest;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     return view('auth.login');
    // }

    public function index()
    {
        return view('usuarios.index', ["usuarios" => Usuarios::latest('created_at')->get()]);
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
    public function store(StoreUsuariosRequest $request)
    {
        $request->validated();


        $usuarios = new Usuarios([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'contrasena' => Hash::make($request->contrasena),
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
    public function edit(Usuarios $usuario)
    {
         return view("usuarios.edit", ["usuario" => $usuario]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsuariosRequest $request, Usuarios $usuario)
    {
        $request->validated();


        $usuario->fill($request->input());
        $usuario->contrasena = Hash::make($usuario->contrasena);
        $usuario->saveOrFail();

        return redirect()->route("usuarios.index")->with("success", "Usuario actualizado");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuarios $usuario)
    {
        $usuario->delete();
        return redirect()->route("usuarios.index")->with("success", "Usuario eliminado");
    }
}
