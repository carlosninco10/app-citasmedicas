<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Citas extends Model
{
    //
    public function citasPacientes(){
        return $this->hasOne(Usuarios::class);
    }
    public function citasMedicosDis(){
        return $this->hasOne(Usuarios::class);
    }
}
