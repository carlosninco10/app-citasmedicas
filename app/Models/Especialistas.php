<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especialistas extends Model
{
    //
    public function especialistaMedicos(){
        return $this->belongsTo(Medicos::class);
    }
}
