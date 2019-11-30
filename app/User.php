<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //relacion uno a muchos
    
    public function tipo(){ //Relacion Equipo-> tipo
        return $this->belongsTo(Tipo::class); //tiene un tipo.
    }

    public function estado(){ //Relacion Equipo-> tipo
        return $this->belongsTo(Estado::class); //tiene un tipo.
    }


    //relacion muchos a muchos

    public function fases(){
        return $this->belongsToMany(Fase::class); // Muchos a muchos
    }

    public function cargos(){
        return $this->belongsToMany(Cargo::class); // Muchos a muchos
    }

    public function insumos(){
        return $this->belongsToMany(Insumo::class); // Muchos a muchos
    }

    public function trabajadores(){
        return $this->belongsToMany(Trabajador::class); // Muchos a muchos
    }

}
