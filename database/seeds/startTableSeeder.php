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
use App\Fase;
use App\Equipo;
use App\Insumo;
use App\Fabricante;


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
        $tipo->desc = "Tiene acceso a todos los mantenedores y funcionalidades";
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = "Administrativo";
        $tipo->desc = "Tiene acceso a ver mantenciones y graficas";
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = "Jefe de area";
        $tipo->desc = "Tiene acceso a algunos mantenedores y planificar mantenciones";
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = "Supervisor";
        $tipo->desc = "Tiene acceso a ver las mantenciones y modificar el estado de sus fases";
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
        $user->email = "j.sanhueza@ezzplan.com";
        $user->password = Hash::make('1qazxsw2');
        $user->tipo_id = 2;
        $user->estado_id = 1;
        $user->empresa_id = 2;
        $user->save();

        $user = new User();
        $user->run = "19555555-2";
        $user->name = "Carlos";
        $user->apellido = "Molina";
        $user->email = "cmolina@ezzplan.com";
        $user->password = Hash::make('1qazxsw2');
        $user->tipo_id = 3;
        $user->estado_id = 1;
        $user->empresa_id = 1;
        $user->save();

        $user = new User();
        $user->run = "1955555ee5-2";
        $user->name = "Victor";
        $user->apellido = "Polanco";
        $user->email = "vpolanco@ezzplan.com";
        $user->password = Hash::make('1qazxsw2');
        $user->tipo_id = 4;
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

        $departamento = new Departamento();
        $departamento->nombre = "Automotriz";
        $departamento->desc = "Departamento encargado de las Reparaciones automotriz";
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

        //fases

        $fase = new Fase();
        $fase->nombre = "Inicio";
        $fase->desc = "Inicio de la Mantencion";
        $fase->estado_id = 1;
        $fase->user_id = 1;
        $fase->save();

        $fase = new Fase();
        $fase->nombre = "Reemplazo de Toner";
        $fase->desc = "Reemplazo de los toner de impresora";
        $fase->estado_id = 1;
        $fase->user_id = 1;
        $fase->save();

        $fase = new Fase();
        $fase->nombre = "Acceder a impresora";
        $fase->desc = "Acceder a la configuracion de la impresora";
        $fase->estado_id = 1;
        $fase->user_id = 1;
        $fase->save();

        $fase = new Fase();
        $fase->nombre = "Desmontar llanta";
        $fase->desc = "Proseso de desmontar neumatico antiguo ";
        $fase->estado_id = 1;
        $fase->user_id = 1;
        $fase->save();

        $fase = new Fase();
        $fase->nombre = "instalar nuevo neumatico";
        $fase->desc = "Proceso de montar nuevo neumatico";
        $fase->estado_id = 1;
        $fase->user_id = 1;
        $fase->save();

        $fase = new Fase();
        $fase->nombre = "Final";
        $fase->desc = "Final de la Mantencion";
        $fase->estado_id = 1;
        $fase->user_id = 1;
        $fase->save();

        //insumo

        $insumo = new Insumo();
        $insumo->nombre = "destornillador cruz";
        $insumo->desc = "destornillador de cruz";
        $insumo->estado_id = 1;
        $insumo->user_id = 1;
        $insumo->save();

        $insumo = new Insumo();
        $insumo->nombre = "Llave de rueda";
        $insumo->desc = "llave de 4 puntas para tuercas de neumaticos";
        $insumo->estado_id = 1;
        $insumo->user_id = 1;
        $insumo->save();

        $insumo = new Insumo();
        $insumo->nombre = "Desmontador de neumaticos";
        $insumo->desc = "Metal especializado para desmontar neumaticos";
        $insumo->estado_id = 1;
        $insumo->user_id = 1;
        $insumo->save();

        $insumo = new Insumo();
        $insumo->nombre = "Gata automotriz";
        $insumo->desc = "Gata para levantar vehiculo ";
        $insumo->estado_id = 1;
        $insumo->user_id = 1;
        $insumo->save();

        //fabricante

        $fabricante = new Fabricante();
        $fabricante->nombre = "Asus";
        $fabricante->desc = "Empresa de computacion y equipamento";
        $fabricante->Origen = "EEUU";
        $fabricante->telefono = 983803809;
        $fabricante->Correo = "contacto@asus.cl";
        $fabricante->Web = "";
        $fabricante->estado_id = 1;
        $fabricante->user_id = 1;
        $fabricante->save();

        $fabricante = new Fabricante();
        $fabricante->nombre = "toyota";
        $fabricante->desc = "Empresa de fabricacion de vehiculos";
        $fabricante->Origen = "Japon";
        $fabricante->telefono = 983803809;
        $fabricante->Correo = "contacto@toyota.cl";
        $fabricante->Web = "";
        $fabricante->estado_id = 1;
        $fabricante->user_id = 1;
        $fabricante->save();

        //Equipos

        $equipo = new Equipo();
        $equipo->nombre = "Impresora imyeccion tinta";
        $equipo->desc = "Impresora con inyeccion tinta asus";
        $equipo->qr = "221321asdasdaswqeqwe";
        $equipo->tipo_id = 3;
        $equipo->departamento_id = 1;
        $equipo->fabricante_id = 1;
        $equipo->fechaIngreso = "2019-10-12";
        $equipo->estado_id = 1;
        $equipo->user_id = 1;
        $equipo->save();

        $equipo = new Equipo();
        $equipo->nombre = "Camioneta toyota";
        $equipo->desc = "Camioneta toyota ss";
        $equipo->qr = "221321asdasdjkljkljklkj";
        $equipo->tipo_id = 4;
        $equipo->departamento_id = 1;
        $equipo->fabricante_id = 1;
        $equipo->fechaIngreso = "2019-10-12";
        $equipo->estado_id = 1;
        $equipo->user_id = 1;
        $equipo->save();


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
        $mantencion->title = "Reemplazo de Toner";
        $mantencion->desc = "Reemplazo de la hoja cortadora en la fila de proceso 2";
        $mantencion->start = '2019-12-10 14:00:00';
        $mantencion->end = '2019-12-11 14:00:00';
        $mantencion->responsable_id = 1;
        $mantencion->planificador_id = 1;
        $mantencion->estado_id = 1;
        $mantencion->prioridad_id = 2;
        $mantencion->save();
        $mantencion->fases()->attach([1,2,3,6]);
        $mantencion->equipos()->attach(1);
        $mantencion->trabajadores()->attach([1,2]);
        $mantencion->insumos()->attach( 1 );


        $mantencion = new Mantencion();
        $mantencion->title = "Reemplazo de Neumaticos";
        $mantencion->desc = "Reemplazo del cardan camion 2";
        $mantencion->start = '2019-12-20 10:00:00';
        $mantencion->end = '2019-12-20 16:00:00';
        $mantencion->responsable_id = 1;
        $mantencion->planificador_id = 1;
        $mantencion->estado_id = 1;
        $mantencion->prioridad_id = 2;
        $mantencion->save();
        $mantencion->fases()->attach([1,4,5,6]);
        $mantencion->equipos()->attach(2);
        $mantencion->trabajadores()->attach(2);
        $mantencion->insumos()->attach( [2,3,4] );


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
        $mantencion->fases()->attach([1,2,3,6]);
        $mantencion->equipos()->attach(1);
        $mantencion->trabajadores()->attach([1,2]);
        $mantencion->insumos()->attach( 1);


    }
}
