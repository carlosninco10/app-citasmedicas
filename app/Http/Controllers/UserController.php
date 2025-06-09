<?php

namespace App\Http\Controllers;

use App\Http\Requests\Usuarios\StoreUserRequest;
use App\Http\Requests\Usuarios\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

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
        $roles = Role::all();
        return view('usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //dd($request->rol);
        // Validación de campos
        $request->validated();


        $usuarios = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol
        ]);
        $usuarios->save();
        $usuarios->assignRole($request->rol);

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
        $roles = Role::all();
        //return view("usuarios.edit", ["usuario" => $usuario]);
        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $usuario)
    {
        //$request->validated();


        // $usuario->fill($request->input());
        // $usuario->password = Hash::make($usuario->password);
        // $usuario->updated_at = now();
        // $usuario->saveOrFail();

        try {
            DB::beginTransaction();

            if(empty($request->password)) {
                $request = Arr::exept($request, array('password'));
            } else {
                $fieldHash = Hash::make($request->password);
                $request->merge(['password' => $fieldHash]);
            }
          
            $usuario->update($request->all()); 
            $usuario->syncRoles([$request->rol]); 
            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
        }

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
