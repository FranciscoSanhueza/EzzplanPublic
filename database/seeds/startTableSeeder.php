<?php

use App\Empresa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Estado;
use App\Tipo;
use App\User;
use App\Departamento;


class startTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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

        $departamento = new Departamento();
        $departamento->nombre = "Finanzas";
        $departamento->desc = "Departamento encargado de las finanzas";
        $departamento->estado_id = 1;
        $departamento->user_id = 1;
        $departamento->save();
        

    }
}
