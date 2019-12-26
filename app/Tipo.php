<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{   
    //inversa
    public function users()
    { //Relacion usuario-> tipo
        return $this->belongsTo(User::class); //tiene un tipo.
    }
    
}
