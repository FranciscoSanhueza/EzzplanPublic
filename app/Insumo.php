<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    //relacion uno a muchos
    public function estado(){ //Relacion Equipo-> tipo
        return $this->belongsTo(Estado::class); //tiene un tipo.
    }
}
