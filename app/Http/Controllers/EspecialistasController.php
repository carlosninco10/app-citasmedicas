<?php

namespace App\Http\Controllers;

use App\Http\Requests\Especialistas\StoreEspecialistasRequest;
use App\Http\Requests\Especialistas\UpdateEspecialistasRequest;
use App\Models\Especialistas;
use Illuminate\Http\Request;

class EspecialistasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('especialistas.index', ["especialistas" => Especialistas::latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('especialistas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEspecialistasRequest $request)
    {
        $request->validated();

        $especialista = new Especialistas([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion
        ]);
        $especialista->save();

        return redirect()->route('especialistas.index')->with('success', 'Usuario registrado');
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
    public function edit(Especialistas $especialista)
    {
        return view("especialistas.edit", ["especialista" => $especialista]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEspecialistasRequest $request, Especialistas $especialista)
    {


        $especialista->fill($request->validated());
        $especialista->updated_at = now();
        $especialista->saveOrFail();

        return redirect()->route("especialistas.index")->with("success", "Usuario actualizado");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Especialistas $especialista)
    {
        $message = "";
        if ($especialista->estado == 1) {
            $especialista->estado = 0;
            $especialista->updated_at = now();
            $especialista->saveOrFail();
            $message = "Usuario eliminado";
        } else {
            $especialista->estado = 1;
            $especialista->updated_at = now();
            $especialista->saveOrFail();
            $message = "Usuario restaurada";
        }

        return redirect()->route("especialistas.index")->with("success", $message);
    }
}
