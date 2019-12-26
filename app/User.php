<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function controlroles($tipo){
        if($this->hasAnyRole($tipo)){
            return true;
        }
        abort(401, "accion no autorizada");
    }
    
    //Permite verificar mas de un rol a la vez pasando un array
    private function hasAnyRole($tipo){
        if(is_array($tipo)){
            foreach ($tipo as $item) {
                if($this->tipo()->where('id',$item)->first()){
                    return true;
                }
            }
        }else{
            if($this->hasRole($tipo)){
                return true;
            }
        }
        return false;
    }

    //revisa si el rol existe
    public function hasRole($tipo){
        if($this->tipo()->where('id',$tipo)->first()){
            return true;
        }
        return false;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'run', 'name', 'apellido', 'email', 'password', 'tipo_id', 'estado_id', 'empresa_id'
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

    public function fase()
    {
        return $this->belongsTo(Fase::class); // Muchos a muchos
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class); // Muchos a muchos
    }

    public function insumo()
    {
        return $this->belongsTo(Insumo::class); // Muchos a muchos
    }

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class); // Muchos a muchos
    }

    public function fabricante()
    {
        return $this->belongsTo(Fabricante::class); // Muchos a muchos
    }

    public function equipo()
    {
        return $this->belongsTo(Equipo::class); // Muchos a muchos
    }

    public function departamento()
    {
        return $this->belongsTo(User::class); // Muchos a muchos
    }


    //relacion muchos a muchos
}
