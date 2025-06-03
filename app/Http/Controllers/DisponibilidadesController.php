<?php

namespace App\Http\Controllers;

use App\Http\Requests\Disponibilidades\StoreDisponibilidadesRequest;
use App\Http\Requests\Disponibilidades\UpdateDisponibilidadesRequest;
use App\Models\Disponibilidades;
use App\Models\Medicos;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DisponibilidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $disponibilidades = Disponibilidades::whereHas('medicoEspecialista.usuario', function ($query) {
            $query->where('users.estado', 1)->where('users.rol', 'medico');
        })
            ->whereHas('medicoEspecialista.especialista', function ($query) {
                $query->where('especialistas.estado', 1);
            })
            ->with(['medicoEspecialista.usuario', 'medicoEspecialista.especialista'])->latest()->get();

        return view('disponibilidades.index', compact('disponibilidades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $medicos = Medicos::whereHas('usuario', function ($query) {
            $query->where('users.estado', 1)
                ->where('users.rol', 'medico');
        })
            ->whereHas('especialista', function ($query) {
                $query->where('especialistas.estado', 1);
            })
            ->with(['usuario', 'especialista'])
            ->latest()
            ->get();

        return view('disponibilidades.create', compact('medicos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDisponibilidadesRequest $request)
    {
        $request->validated();

        $usuarios = new Disponibilidades([
            'medico_especialidad_id' => $request->medico_especialidad_id,
            'fecha' => $request->fecha,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin
        ]);
        $usuarios->save();

        return redirect()->route('disponibilidades.index')->with('success', 'Disponibilidad registrado');
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
    public function edit($id)
    {
        $disponibilidad = Disponibilidades::with('medicoEspecialista.usuario', 'medicoEspecialista.especialista')
            ->findOrFail($id);
        // También necesitas los médicos para el <select>
        $medicos = Medicos::whereHas('usuario', function ($query) {
            $query->where('users.estado', 1)
                ->where('users.rol', 'medico');
        })
            ->whereHas('especialista', function ($query) {
                $query->where('especialistas.estado', 1);
            })
            ->with(['usuario', 'especialista'])
            ->latest()
            ->get();

        return view('disponibilidades.edit', compact('disponibilidad', 'medicos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDisponibilidadesRequest $request, $id)
    {

        $disponibilidad = Disponibilidades::findOrFail($id);

        $disponibilidad->fill($request->validated());
        $disponibilidad->updated_at = now();
        $disponibilidad->saveOrFail();
        return redirect()->route("disponibilidades.index")->with("success", "Disponibilidad actualizada correctamente");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $disponibilidad = Disponibilidades::findOrFail($id);

        $message = "";
        if ($disponibilidad->estado == 1) {
            $disponibilidad->estado = 0;
            $disponibilidad->updated_at = now();
            $disponibilidad->saveOrFail();
            $message = "disponibilidad eliminada";
        } else {
            $disponibilidad->estado = 1;
            $disponibilidad->updated_at = now();
            $disponibilidad->saveOrFail();
            $message = "disponibilidad restaurada";
        }

        return redirect()->route("disponibilidades.index")->with("success", $message);
    }
}
