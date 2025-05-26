<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disponibilidades extends Model
{
    //
    public function disponiblesMedicos(){
        return $this->hasOne(Usuarios::class);
    }

}
