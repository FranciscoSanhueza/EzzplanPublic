<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    public function cargo(){ //Relacion trabajador-> cargo
        return $this->belongsTo(Cargo::class); //tiene un cargo.
    }
}
