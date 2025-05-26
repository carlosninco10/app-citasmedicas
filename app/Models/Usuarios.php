<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'correo',
        'contrasena',
        'rol'
    ];
    //
    public function usuariosMedicos(){
        return $this->belongsTo(Medicos::class);
    }
    public function usuariosMedicosDis(){
        return $this->belongsTo(Disponibilidades::class);
    }
    public function usuariosPacientes(){
        return $this->belongsTo(Citas::class);
    }
    public function usuariosmedicosCit(){
        return $this->belongsTo(Citas::class);
    }
}
