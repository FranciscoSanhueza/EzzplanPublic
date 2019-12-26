<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    public function tipo()
    { //Relacion Equipo-> tipo
        return $this->belongsTo(Tipo::class); //tiene un tipo.
    }

    public function departamento()
    { //Relacion Equipo-> departamento
        return $this->belongsTo(Departamento::class); //Pertenece a un departamento.
    }

    public function fabricante()
    { //Relacion Equipo-> fabricante
        return $this->belongsTo(Fabricante::class); //Pertenece a un fabricante.
    }

    public function estado()
    { //Relacion Equipo-> estado
        return $this->belongsTo(Estado::class); //tiene un estado.
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
