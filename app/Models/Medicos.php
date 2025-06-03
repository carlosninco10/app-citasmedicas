<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicos extends Model
{

    protected $table = 'medicos_especialistas';
    public $timestamps = true;
    protected $fillable = [
        'medico_id',
        'especialidad_id',
        'estado'
    ];

        public function usuario()
    {
        return $this->belongsTo(User::class, 'medico_id');
    }

    public function especialista()
    {
        return $this->belongsTo(Especialistas::class, 'especialidad_id');
    }

    public function disponibilidades()
    {
        return $this->hasMany(Disponibilidades::class, 'medico_especialidad_id');
    }
}
