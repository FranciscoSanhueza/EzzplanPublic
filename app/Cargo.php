<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    //relacion uno a muchos
    public function estado()
    { //Relacion Equipo-> tipo
        return $this->belongsTo(Estado::class); //tiene un tipo.
    }

    public function user()
    {
        return $this->belongsTo(User::class); // Muchos a muchos
    }
}
