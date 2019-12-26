<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    //relacion uno a muchos
    public function estado()
    { //Relacion Equipo-> tipo
        return $this->belongsTo(Estado::class); //tiene un tipo.
    }

    public function cargo()
    { //Relacion trabajador-> cargo
        return $this->belongsTo(Cargo::class); //tiene un cargo.
    }

    public function user()
    {
        return $this->belongsTo(User::class); // Muchos a muchos
    }

     //inversa
     public function mantenciones(){ 
        return $this->belongsToMany(Mantencion::class)->withTimestamps(); // Muchos a muchos
    }
}
