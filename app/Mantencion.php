<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mantencion extends Model
{

    //relaciones uno a muchos
    public function Responsable(){ //Relacion Mantencion-> Trabajador
        return $this->belongsTo(Trabajador::class); //tiene un Trabajador.
    }

    public function planificador(){ //Relacion Mantencion-> User
        return $this->belongsTo(User::class); //la planifica un usuario
    }

    public function estado(){ //Relacion Mantencion-> Estado
        return $this->belongsTo(Estado::class); //tiene un Estado.
    }

    //relaciones muchos a muchos

    public function fases(){
        return $this->belongsToMany(Fase::class); // Muchos a muchos
    }
    public function insumos(){
        return $this->belongsToMany(Insumo::class); // Muchos a muchos
    }
    public function equipos(){
        return $this->belongsToMany(Equipo::class); // Muchos a muchos
    }
    public function trabajadores(){
        return $this->belongsToMany(Trabajador::class); // Muchos a muchos
    }
}
