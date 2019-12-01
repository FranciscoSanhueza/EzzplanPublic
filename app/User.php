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
        'run', 'name', 'apellido', 'email', 'password', 'tipo_id', 'estado_id'
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

    public function tipo()
    { //Relacion usuario-> tipo
        return $this->belongsTo(Tipo::class); //tiene un tipo.
    }

    public function estado()
    { //Relacion usuario-> Estado
        return $this->belongsTo(Estado::class); //tiene un tipo.
    }

    public function empresa()
    { //Relacion usuario-> Empresa
        return $this->belongsTo(Empresa::class); //tiene un Empresa.
    }


    //relacion muchos a muchos

    public function fases()
    {
        return $this->belongsToMany(Fase::class)->withTimestamps();; // Muchos a muchos
    }

    public function cargos()
    {
        return $this->belongsToMany(Cargo::class)->withTimestamps();; // Muchos a muchos
    }

    public function insumos()
    {
        return $this->belongsToMany(Insumo::class)->withTimestamps();; // Muchos a muchos
    }

    public function trabajadores()
    {
        return $this->belongsToMany(Trabajador::class)->withTimestamps();; // Muchos a muchos
    }
}
