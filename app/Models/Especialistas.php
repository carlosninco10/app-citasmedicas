<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especialistas extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'nombre',
        'descripcion',
        'estado'
    ];
    //
    public function medicoEspecialista()
    {
        //return $this->belongsTo(Medicos::class);
        return $this->hasMany(Medicos::class, 'especialidad_id');
    }
}
