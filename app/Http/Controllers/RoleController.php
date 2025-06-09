<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permisos = Permission::all();
        return view('roles.create', compact('permisos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->permission);
        //validar request
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required'
        ]);

        try {
            DB::beginTransaction();
            //crear rol
            $rol = Role::create(['name' => $request->name]);
            
            //Asignar permisos
            $permisos = Permission::whereIn('id', $request->permission)->pluck('name')->toArray();
            $rol->syncPermissions($permisos);
            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('roles.index')->with('success', 'Rol registrado');
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
    public function edit(Role $role)
    {
        $permisos = Permission::all();
        return view('roles.edit', compact('role', 'permisos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,'.$role->id,
            'permission' => 'required'
        ]);

        try {
            DB::beginTransaction();
            //crear rol
            $roles = Role::where('id', $role->id)
            ->update([
                'name'=> $request->name
            ]);
            
            //Asignar permisos
            $permisos = Permission::whereIn('id', $request->permission)->pluck('name')->toArray();
            $role->syncPermissions($permisos);
            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('roles.index')->with('success', 'Rol editado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::where('id', $id)->delete();

        return redirect()->route('roles.index')->with('success', 'Rol Eliminado');
    }
}
