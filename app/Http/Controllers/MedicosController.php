<?php

namespace App\Http\Controllers;

use App\Http\Requests\Medicos\StoreMedicosRequest;
use App\Http\Requests\Medicos\UpdateMedicosRequest;
use App\Models\Especialistas;
use App\Models\Medicos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicos = Medicos::whereHas('usuario.medicoEspecialista', function ($query) {
            $query->where('users.estado', 1)->where('users.rol', 'medico');
        })
            ->whereHas('especialista', function ($query) {
                $query->where('especialistas.estado', 1);
            })
            ->with(['usuario.medicoEspecialista', 'especialista'])->latest()->get();
        //dd($medicos);
        return view('medicos.index', compact('medicos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $medicos = User::all()->where('rol', 'medico')->where('estado', 1);
        $especialistas = Especialistas::all()->where('estado', 1);

        return view('medicos.create', compact('medicos', 'especialistas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMedicosRequest $request)
    {

        $request->validated();

        $medicoId = $request->input('medico_id');
        $especialidades = $request->input('especialidad_id'); // Esto es un array


        // Verificar cuáles especialista, ya existen para este usuario
        $existentes = DB::table('medicos_especialistas')
            ->where('medico_id', $medicoId)
            ->whereIn('especialidad_id', $especialidades)
            ->pluck('especialidad_id')
            ->toArray();

        if (!empty($existentes)) {
            return redirect()->back()->withErrors([
                'especialidad_id' => 'El/Los especialista(s) ya han sido agregados previamente por este usuario.'
            ]);
        }

        foreach ($especialidades as $especialidadId) {
            DB::table('medicos_especialistas')->insert([
                'medico_id' => $medicoId,
                'especialidad_id' => $especialidadId
            ]);
        }
        // Mensaje dinámico
        $message = count($especialidades) > 1
            ? 'Especialidades guardadas correctamente.'
            : 'Especialidad guardada correctamente.';


        return redirect()->route('medicos.index')->with('success', $message);
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
    public function edit(Medicos $medico)
    {

        $medicosUsuarios = User::all()->where('rol', 'medico')->where('estado', 1);
        $especialistas = Especialistas::all()->where('estado', 1);

        return view("medicos.edit", compact('medico', 'medicosUsuarios', 'especialistas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedicosRequest $request, Medicos $medico)
    {
        $request->validated();

        $medicoId = $request->input('medico_id');
        $especialidades = $request->input('especialidad_id'); // Esto es un array


        foreach ($especialidades as $especialidadId) {
            DB::table('medicos_especialistas')->where('id', $medico->id)->update([
                'medico_id' => $medicoId,
                'especialidad_id' => $especialidadId,
                'updated_at' => now()
            ]);
        }
        // Mensaje dinámico
        $message = count($especialidades) > 1
            ? 'Especialidades guardadas correctamente.'
            : 'Especialidad guardada correctamente.';


        return redirect()->route('medicos.index')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicos $medico)
    {
        $message = "";
        if ($medico->estado == 1) {
            $medico->estado = 0;
            $medico->updated_at = now();
            $medico->saveOrFail();
            $message = "Usuario eliminado";
        } else {
            $medico->estado = 1;
            $medico->updated_at = now();
            $medico->saveOrFail();
            $message = "Usuario restaurada";
        }

        return redirect()->route("medicos.index")->with("success", $message);
    }
}
