<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disponibilidades extends Model
{
        // Esto habilita el manejo automático de created_at y updated_at
    public $timestamps = true;
    protected $fillable = [
        'medico_especialidad_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'estado'
    ];

    public function medicoEspecialista()
    {
        return $this->belongsTo(Medicos::class, 'medico_especialidad_id');
    }
        // Relación con las citas
    public function citas()
    {
        return $this->hasMany(Citas::class, 'disponibilidad_id');
    }
    // public function medicosUsuarios()
    // {
    //     return $this->belongsTo(Usuarios::class, 'medico_id');
    // }
    // public function especialista()
    // {
    //     return $this->hasOne(Especialistas::class, 'especialidad_id');
    // }

}
