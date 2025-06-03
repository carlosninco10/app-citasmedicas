<?php

namespace App\Http\Controllers;

use App\Http\Requests\Citas\StoreCitasRequest;
use App\Http\Requests\Citas\UpdateCitasRequest;
use App\Models\Citas;
use App\Models\Disponibilidades;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $citas = Citas::with([
            'paciente', // relación con el modelo Usuario (paciente)
            'disponibilidad.medicoEspecialista.usuario', // médico
            'disponibilidad.medicoEspecialista.especialista' // especialidad
        ])->latest()->get();

        return view('citas.index', compact('citas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Pacientes (usuarios con rol 'paciente' y estado activo)
        $pacientes = User::where('rol', 'paciente')
            ->where('estado', 1)
            ->orderBy('name')
            ->get();

        $disponibilidades = Disponibilidades::with(['medicoEspecialista.usuario', 'medicoEspecialista.especialista'])
            ->where('estado', 1)
            ->orderBy('fecha')
            ->get();

        //dd($disponibilidades);
        return view('citas.create', compact('pacientes', 'disponibilidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCitasRequest $request)
    {
        // Validación de campos
        $request->validated();

        // Verificar si ya existe una cita con esa disponibilidad
        $citaExistente = Citas::where('disponibilidad_id', $request->disponibilidad_id)->first();
        if ($citaExistente) {
            return redirect()->back()
                ->withErrors(['disponibilidad_id' => 'La disponibilidad ya está asignada a otra cita.'])
                ->withInput();
        }

        // Crear la cita
        DB::beginTransaction();
        try {
            Citas::create([
                'paciente_id' => $request->paciente_id,
                'disponibilidad_id' => $request->disponibilidad_id,
                'observaciones' => $request->observaciones
            ]);

            DB::commit();
            return redirect()->route('citas.index')->with('success', 'Cita registrada correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => 'Error al registrar la cita: ' . $e->getMessage()])
                ->withInput();
        }
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
    public function edit(string $id)
    {
        $cita = Citas::findOrFail($id);

        $pacientes = User::where('rol', 'paciente')->where('estado', 1)->get();
        $disponibilidades = Disponibilidades::with('medicoEspecialista.usuario')
            ->where('estado', 1)->get();

        return view('citas.edit', compact('cita', 'pacientes', 'disponibilidades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCitasRequest $request, string $id)
    {
        $request->validated();

        $cita = Citas::findOrFail($id);

        // Verificar si la disponibilidad ya está asignada a otra cita
        $existe = Citas::where('disponibilidad_id', $request->disponibilidad_id)
            ->where('id', '!=', $id)
            ->exists();

        if ($existe) {
            return redirect()->back()
                ->withErrors(['disponibilidad_id' => 'Esta disponibilidad ya está asignada a otra cita.'])
                ->withInput();
        }
        // Actualizar
        $cita->update([
            'paciente_id' => $request->paciente_id,
            'disponibilidad_id' => $request->disponibilidad_id,
            'observaciones' => $request->observaciones,
            'estado' => $request->estado,
            'updated_at' => now()
        ]);

        return redirect()->route('citas.index')->with('success', 'Cita actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
