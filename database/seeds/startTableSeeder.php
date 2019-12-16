<?php

use App\Empresa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Estado;
use App\Tipo;
use App\User;
use App\Departamento;
use App\Prioridad;
use App\Cargo;
use App\Trabajador;
use App\Mantencion;


class startTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //prioridades

        $p = new Prioridad();
        $p->nombre = "Baja";
        $p->save();

        $p = new Prioridad();
        $p->nombre = "Media";
        $p->save();

        $p = new Prioridad();
        $p->nombre = "Alta";
        $p->save();

        //Estados
        $estado = new Estado();
        $estado->nombre = "Activo";
        $estado->save();

        $estado = new Estado();
        $estado->nombre = "Inactivo";
        $estado->save();

        $estado = new Estado();
        $estado->nombre = "Pendiente";
        $estado->save();

        $estado = new Estado();
        $estado->nombre = "Finalizado";
        $estado->save();

        $estado = new Estado();
        $estado->nombre = "En desarrollo";
        $estado->save();

        //tipos 
        $tipo = new Tipo();
        $tipo->nombre = "Administrador";
        $tipo->desc = "Tiene acceso a todos los mantenedores y usuarios";
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = "Gerente";
        $tipo->desc = "Tiene acceso a algunos de los mantenedores y usuarios";
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = "Articulo de oficina";
        $tipo->desc = "Articulos presentes dentro de las oficinas";
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = "Maquinaria industrial";
        $tipo->desc = "Maquinaria pesada del tipo industrial";
        $tipo->save();
        

        //empresas

        $empresa = new Empresa();
        $empresa->nombre = "Ezzplan";
        $empresa->giro = "Venta de software";
        $empresa->nacionalidad = "Chilena";
        $empresa->estado_id = 1;
        $empresa->save();

        $empresa = new Empresa();
        $empresa->nombre = "Inacap";
        $empresa->giro = "Educacion";
        $empresa->nacionalidad = "Chilena";
        $empresa->estado_id = 1;
        $empresa->save();


        //usuario

        $user = new User();
        $user->run = "18770142-2";
        $user->name = "Francisco";
        $user->apellido = "Sanhueza";
        $user->email = "can@ezzplan.com";
        $user->password = Hash::make('12345678');
        $user->tipo_id = 1;
        $user->estado_id = 1;
        $user->empresa_id = 1;
        $user->save();

        $user = new User();
        $user->run = "10146527-6";
        $user->name = "Jose";
        $user->apellido = "Sanhueza";
        $user->email = "j.sanhueza@gmail.com";
        $user->password = Hash::make('1qazxsw2');
        $user->tipo_id = 1;
        $user->estado_id = 1;
        $user->empresa_id = 2;
        $user->save();

        $user = new User();
        $user->run = "19555555-2";
        $user->name = "Carlos";
        $user->apellido = "Molina";
        $user->email = "cmolina@ezzplan.com";
        $user->password = Hash::make('1qazxsw2');
        $user->tipo_id = 1;
        $user->estado_id = 1;
        $user->empresa_id = 1;
        $user->save();
        
        //departamento

        $departamento = new Departamento();
        $departamento->nombre = "Finanzas";
        $departamento->desc = "Departamento encargado de las finanzas";
        $departamento->estado_id = 1;
        $departamento->user_id = 1;
        $departamento->save();

        //cargo 

        $cargo = new Cargo();
        $cargo->nombre = "Soldador";
        $cargo->funcion = "soldador al oxigeno";
        $cargo->estado_id = 1;
        $cargo->user_id = 1;
        $cargo->save();

        $cargo = new Cargo();
        $cargo->nombre = "Mecanico";
        $cargo->funcion = "Mecanico con titulo en mantencion industrial";
        $cargo->estado_id = 1;
        $cargo->user_id = 1;
        $cargo->save();

        $cargo = new Cargo();
        $cargo->nombre = "Ingeniero";
        $cargo->funcion = "Con cargo de supervisor";
        $cargo->estado_id = 1;
        $cargo->user_id = 1;
        $cargo->save();

        //trabajador

        $trabajador = new Trabajador();
        $trabajador->run = "10146537-3";
        $trabajador->nombre = "Celinda";
        $trabajador->apellido = "Anabalon";
        $trabajador->telefono = 93218876;
        $trabajador->cargo_id = 1;
        $trabajador->user_id = 1;
        $trabajador->estado_id = 1;
        $trabajador->save();

        $trabajador = new Trabajador();
        $trabajador->run = "10146527-6";
        $trabajador->nombre = "Carlos";
        $trabajador->apellido = "Molina";
        $trabajador->telefono = 93218876;
        $trabajador->cargo_id = 3;
        $trabajador->user_id = 1;
        $trabajador->estado_id = 1;
        $trabajador->save();

        //mantencion

        $mantencion = new Mantencion();
        $mantencion->title = "Reemplazo de hoja";
        $mantencion->desc = "Reemplazo de la hoja cortadora en la fila de proceso 2";
        $mantencion->start = '2019-12-10 14:00:00';
        $mantencion->end = '2019-12-11 14:00:00';
        $mantencion->responsable_id = 1;
        $mantencion->planificador_id = 1;
        $mantencion->estado_id = 1;
        $mantencion->prioridad_id = 2;
        $mantencion->save();


        $mantencion = new Mantencion();
        $mantencion->title = "Reemplazo de cardan";
        $mantencion->desc = "Reemplazo del cardan camion 2";
        $mantencion->start = '2019-12-20 10:00:00';
        $mantencion->end = '2019-12-20 16:00:00';
        $mantencion->responsable_id = 1;
        $mantencion->planificador_id = 1;
        $mantencion->estado_id = 1;
        $mantencion->prioridad_id = 2;
        $mantencion->save();

        $mantencion = new Mantencion();
        $mantencion->title = "Destruccion planta";
        $mantencion->desc = "Destruccion de la planta";
        $mantencion->start = '2019-12-28 8:00:00';
        $mantencion->end = '2019-12-29 17:00:00';
        $mantencion->responsable_id = 1;
        $mantencion->planificador_id = 1;
        $mantencion->estado_id = 1;
        $mantencion->prioridad_id = 2;
        $mantencion->save();

    }
}
