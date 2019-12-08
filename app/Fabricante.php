<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fabricante extends Model
{
    public function estado()
    { //Relacion Equipo-> estado
        return $this->belongsTo(Estado::class); //tiene un estado.
    }

    public function user()
    {
        return $this->belongsTo(User::class); // Muchos a muchos
    }
}
