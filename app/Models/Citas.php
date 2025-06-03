<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Citas extends Model
{
    // Esto habilita el manejo automático de created_at y updated_at
    public $timestamps = true;
    protected $fillable = [
        'paciente_id',
        'disponibilidad_id',
        'observaciones', // Asegúrate de que esté incluido
        'estado'
    ];
    // Relación con el paciente (usuario)
    public function paciente()
    {
        return $this->belongsTo(User::class, 'paciente_id');
    }
    // Relación con la disponibilidades
    public function disponibilidad()
    {
        return $this->belongsTo(Disponibilidades::class, 'disponibilidad_id');
    }
}
