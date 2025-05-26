<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicos extends Model
{
    //
    public function medicosUsuarios(){
//        return $this->hasOne(Usuarios::class);
        return $this->belongsToMany(Usuarios::class)->withTimestamps()->withPivot('medico_id', 'especialidad_id');
    }
    public function medicosEspecialista(){
        return $this->hasOne(Especialistas::class)->withTimestamps()->withPivot('medico_id', 'especialidad_id');;
    }
    public function medicosDisponible(){
        return $this->belongsTo(Disponibilidades::class);
    }
}
