<?php

use Illuminate\Database\Seeder;
use App\Estado;
use App\Tipo;
use App\User;

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
        $tipo = new tipo();
        $tipo->nombre = "Administrador";
        $tipo->desc = "Tiene acceso a todos los mantenedores y usuarios";
        $tipo->save();

        //usuario
        $user = new User();
        $user->run = "18770142-2";
        $user->name = "Francisco";
        $user->apellido = "Sanhueza";
        $user->email = "can@ezzplan.com";
        $user->password = "12345678";
        $user->tipo_id = 1;
        $user->estado_id = 1;
        $user->save();
    }
}
