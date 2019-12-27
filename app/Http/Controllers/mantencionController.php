<?php

namespace App\Http\Controllers;

use App\Mantencion;
use Illuminate\Http\Request;
use App\Http\Requests\mantencionRequest;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Builder;
use App\Fase;
use App\Trabajador;
use App\Insumo;
use App\Equipo;
use App\User;


class mantencionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->controlroles(['1','3','2','4']);
        $fases = $this::fases();
        $equipos = $this::equipos();
        $trabajadores = $this::trabajadores();
        $insumos = $this::insumos();
        $responsables = $this::responsables();
        return view('mantenciones.list' , compact('fases','trabajadores', 'insumos', 'equipos'  , 'responsables'));
    }

    public function calendario(){
        $user = auth()->user()->id;
        $mantenciones = Mantencion::where([
            ['planificador_id', '=', $user],
            ['estado_id', '=', 1],
        ])->get();
        return $mantenciones;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->controlroles(['1','3','2','4']);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(mantencionRequest $request)
    {
        $request->user()->controlroles(['1','3','2','4']);
        $user = auth()->user();
        if($request->ajax()){
            $fases = $request->input('fases');
            $equipos = $request->input('equipos');
            $trabajadores = $request->input('trabajadores');
            $insumos = $request->input('insumos');
            $start = $request->input('start')." ".$request->input('startH');
            $end = $request->input('end')." ".$request->input('endH');
            $prioridad = $request->input('prioridad');
            if($this->validateEquipo($equipos , $start , $end)){
                if($this->validateTrabajador($trabajadores, $start , $end)){
                    if($request->input('cantidad') == null and $request->input('salto') == null){
                        $mantencion = new Mantencion();
                        $mantencion->title = $request->input('title');
                        $mantencion->desc = $request->input('desc');
                        $mantencion->start = $start;
                        $mantencion->end = $end;
                        $mantencion->responsable_id = $request->input('id');
                        $mantencion->planificador_id = $user->id;
                        $mantencion->estado_id = 1;
                        $mantencion->prioridad_id = $prioridad;
                        switch ($prioridad) {
                            case 1:
                                $mantencion->color = "";
                                $mantencion->textColor = "";
                                break;
                            case 2:
                                $mantencion->color = "YELLOW";
                                $mantencion->textColor = "BLACK";
                                break;
                            case 3:
                                $mantencion->color = "Red";
                                $mantencion->textColor = "";
                                break;
                        }
                        $mantencion->save();
                        $cod = Mantencion::max('id');
                        $mantencionFind = Mantencion::find($cod); 
                        //Registro de fases
                        for ($i=0; $i < count($fases) ; $i++) { 
                            $mantencionFind->fases()->attach( $fases[$i], ['estado_id' => 3]);
                        }
                        //Registro de equipos
                        for ($i=0; $i < count($equipos) ; $i++) { 
                            $mantencionFind->equipos()->attach( $equipos[$i]);
                        }
                        //Registro de trabajadores
                        for ($i=0; $i < count($trabajadores) ; $i++) { 
                            $mantencionFind->trabajadores()->attach( $trabajadores[$i]);
                        }
                        //Registro de insumos
                        for ($i=0; $i < count($insumos) ; $i++) { 
                            $mantencionFind->insumos()->attach( $insumos[$i] );
                        }
                        return response()->json([
                            "tipo" => 1,
                            "title" => "Registrado",
                            "desc" => "Ingresado Correctamente"
                        ]);
                    }else{
                        $fechasRep =  $this->getFechas($start,  $this->intervaloForm($request->input('cantidad'), $request->input('salto')) , $this->dateDiff($start , $end));
                        //recorre las fechas
                        
                        for ($h=0; $h < count($fechasRep) ; $h++) { 
                            $mantencion = new Mantencion();
                            $mantencion->title = $request->input('title');
                            $mantencion->desc = $request->input('desc');
                            $mantencion->start = $fechasRep[$h]["Inicio"]->format('Y-m-d H:i:s');
                            $mantencion->end = $fechasRep[$h]["Fin"]->format('Y-m-d H:i:s');
                            $mantencion->responsable_id = $request->input('id');
                            $mantencion->planificador_id = $user->id;
                            $mantencion->estado_id = 1;
                            $mantencion->prioridad_id = $prioridad;
                            switch ($prioridad) {
                                case 1:
                                    $mantencion->color = "";
                                    $mantencion->textColor = "";
                                    break;
                                case 2:
                                    $mantencion->color = "YELLOW";
                                    $mantencion->textColor = "BLACK";
                                    break;
                                case 3:
                                    $mantencion->color = "Red";
                                    $mantencion->textColor = "";
                                    break;
                            }
                            $mantencion->save();
                            $cod = Mantencion::max('id');
                            $mantencionFind = Mantencion::find($cod); 
                            //Registro de fases
                            for ($i=0; $i < count($fases) ; $i++) { 
                                $mantencionFind->fases()->attach( $fases[$i], ['estado_id' => 3]);
                            }
                            //Registro de equipos
                            for ($i=0; $i < count($equipos) ; $i++) { 
                                $mantencionFind->equipos()->attach( $equipos[$i]);
                            }
                            //Registro de trabajadores
                            for ($i=0; $i < count($trabajadores) ; $i++) { 
                                $mantencionFind->trabajadores()->attach( $trabajadores[$i]);
                            }
                            //Registro de insumos
                            for ($i=0; $i < count($insumos) ; $i++) { 
                                $mantencionFind->insumos()->attach( $insumos[$i] );
                            }
                        }
                        return response()->json([
                            "tipo" => 1,
                            "title" => "Registrado",
                            "desc" => "Ingresado Correctamente"
                        ]);
                    }
                }else{
                    return response()->json([
                        "tipo" => 2,
                        "title" => "Error Trabajador",
                        "desc" => "Uno o varios de los Trabajadores seleccionados
                                ya se encuetran en mantencion durante la fecha ".
                                $request->input('start')." hasta ".$request->input('end')
                    ]);
                }
            }else{
                return response()->json([
                    "tipo" => 2,
                    "title" => "Error Equipo",
                    "desc" => "Uno o varios de los equipos seleccionados
                            ya se encuetran en mantencion durante la fecha ".
                            $request->input('start')." hasta ".$request->input('end')
                ]);
        }        
        }else{
            return response()->json([
                "tipo" => 2,
                "title" => "Error ajax",
                "desc" => "Solo se permiten envios de tipo ajax"
            ]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mantencion  $mantencion
     * @return \Illuminate\Http\Response
     */
    public function show($mantencion, Request $request)
    {
            $request->user()->controlroles(['1','3','2','4']);
            $user = auth()->user();
            $mantencionF = Mantencion::findorfail($mantencion);
            $planificador = $mantencionF->planificador;
            if($planificador->empresa_id == $user->empresa_id){
                $fases = $mantencionF->fases;
                $equipos = $mantencionF->equipos;
                $trabajadores = $mantencionF->trabajadores;
                $insumos = $mantencionF->insumos;
                return response()->json([
                    "core" => $mantencionF
                ]);
            }else{
                return response()->json([
                    "tipo" => 2,
                    "title" => "No se registra",
                    "desc" => "Mantencion no encontrada"
                ]);
            }
      
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mantencion  $mantencion
     * @return \Illuminate\Http\Response
     */
    public function edit( $mantencion, Request $request)
    {
        //
        $request->user()->controlroles(['1','3','2','4']);
        return $this->validateEquipo($mantencion , "2019-12-10 20:00" , "2019-12-10 21:00");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mantencion  $mantencion
     * @return \Illuminate\Http\Response
     */
    public function update(mantencionRequest $request, $mantencionid)
    {
        $request->user()->controlroles(['1','3','2','4']);
        $user = auth()->user();
        if($request->ajax()){
            //core
            $mantencion = Mantencion::findOrFail($mantencionid);
            $mantencion->title = $request->input('title');
            $mantencion->desc = $request->input('desc');
            $mantencion->start = $request->input('start')." ".$request->input('startH');
            $mantencion->end = $request->input('end')." ".$request->input('endH');
            $mantencion->responsable_id = $request->input('id');
            $mantencion->planificador_id = $user->id;
            $mantencion->estado_id = 1;
            $mantencion->prioridad_id = $request->input('prioridad');
            $mantencion->save();
            //core actualizado
            //intermedias
            $cod = $mantencion->id;
            $mantencionFind = Mantencion::find($cod); 
            //actuliaza fases de la mantencion
            $fases = $request->input('fases');
            $fasesid = [];
            for ($i=0; $i < count($fases) ; $i++) { 
                $fasesid[] = $fases[$i];
            }
            $mantencionFind->fases()->sync( $fases);
            $equiposid = [];
            //actuliaza equipos de la mantencion
            $equipos = $request->input('equipos');
            for ($i=0; $i < count($equipos) ; $i++) { 
                $equiposid[] = $equipos[$i];
            }
            $mantencionFind->equipos()->sync( $equiposid);
            //actuliaza Tranajadores de la mantencion
            $trabajadores = $request->input('trabajadores');
            $trabajadoresid = [];
            for ($i=0; $i < count($trabajadores) ; $i++) { 
                $trabajadoresid[] = $trabajadores[$i];
            }
            $mantencionFind->trabajadores()->sync( $trabajadoresid);
            //actuliaza insumos de la mantencion
            $insumos = $request->input('insumos');
            $insumosid = [];
            for ($i=0; $i < count($insumos) ; $i++) { 
                $insumosid[] = $insumos[$i];
            }
            $mantencionFind->insumos()->sync( $insumosid );
            return response()->json([
                "tipo" => 1,
                "title" => "Actualizado",
                "desc" => "Mantencion Actualizada Correctamente"
            ]);
        }else{
            return response()->json([
                "tipo" => 2,
                "title" => "Error ajax",
                "desc" => "Solo se permiten envios de tipo ajax"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mantencion  $mantencion
     * @return \Illuminate\Http\Response
     */
    public function destroy( $mantencionid, Request $request)
    {
        $request->user()->controlroles(['1','3','2','4']);
        $user = auth()->user()->id;
        $mantencion = Mantencion::findOrFail($mantencionid);
        if($mantencion->planificador_id == $user){
            $mantencion->fases()->detach();
            $mantencion->equipos()->detach();
            $mantencion->trabajadores()->detach();
            $mantencion->insumos()->detach();
            $mantencion->delete();
            return response()->json([
                "tipo" => 1,
                "title" => "Eliminado",
                "desc" => "Mantencion Eliminada Correctamente"
            ]);
        }else{
            return response()->json([
                "tipo" => 2,
                "title" => "Error",
                "desc" => "Mantencion No se encuentra en los registros"
            ]);
        }
    }


    private function fases(){
        $user = auth()->user()->id;
        $fases = Fase::where([
            ['user_id', '=', $user],
            ['estado_id', '=', 1],
        ])->orderBy('nombre')
        ->get();
        return $fases;
    }

    private function equipos(){
        $user = auth()->user()->id;
        $equipos = Equipo::where([
            ['user_id', '=', $user],
            ['estado_id', '=', 1],
        ])->orderBy('nombre')
        ->get();
        return $equipos;
    }

    private function insumos(){
        $user = auth()->user()->id;
        $insumos = Insumo::where([
            ['user_id', '=', $user],
            ['estado_id', '=', 1],
        ])->orderBy('nombre')
        ->get();
        return $insumos;
    }

    private function trabajadores(){
        $user = auth()->user()->id;
        $trabajadores = Trabajador::where([
            ['user_id', '=', $user],
            ['estado_id', '=', 1],
        ])->orderBy('nombre')
        ->get();
        return $trabajadores;
    }

    private function responsables(){
        $user = auth()->user()->empresa->id;
        $responsable = User::where([
            ['empresa_id', '=', $user],
            ['estado_id', '=', 1],
        ])->orderBy('name')
        ->get();
        return $responsable;
    }

    private function validateEquipo($EquipoV, $start , $end){
        if(is_array($EquipoV)){
            for ($i=0; $i < count($EquipoV) ; $i++) { 
                $equipo = Equipo::find($EquipoV[$i]);
                $mantenciones = $equipo->mantenciones;
                foreach ($mantenciones as $mantencion) {
                    if($this->check_in_range($start, $end, $mantencion->start) or $this->check_in_range($start, $end, $mantencion->end)){
                        return false;
                    }else {
                        if($this->check_in_range($mantencion->start, $mantencion->end, $start) or $this->check_in_range($mantencion->start, $mantencion->end, $end)){
                        return false;
                        }
                    }
                }
            }
            return true;
        }else{
            $equipo = Equipo::find($EquipoV);
            $mantenciones = $equipo->mantenciones;
            foreach ($mantenciones as $mantencion) {
                if($this->check_in_range($start, $end, $mantencion->start) or $this->check_in_range($start, $end, $mantencion->end)){
                    return false;
                }else {
                    if($this->check_in_range($mantencion->start, $mantencion->end, $start) or $this->check_in_range($mantencion->start, $mantencion->end, $end)){
                    return false;
                    }
                }
            }
            return true;
        }
    }

    private function validateTrabajador($trabajadores, $start , $end){
        if(is_array($trabajadores)){
            for ($i=0; $i < count($trabajadores) ; $i++) { 
                $trabajador = Trabajador::find($trabajadores[$i]);
                $mantenciones = $trabajador->mantenciones;
                foreach ($mantenciones as $mantencion) {
                    if($this->check_in_range($start, $end, $mantencion->start) or $this->check_in_range($start, $end, $mantencion->end)){
                        return false;
                    }else {
                        if($this->check_in_range($mantencion->start, $mantencion->end, $start) or $this->check_in_range($mantencion->start, $mantencion->end, $end)){
                        return false;
                        }
                    }
                }
            }
            return true;
        }else{
            $trabajador = Trabajador::find($trabajadores);
            $mantenciones = $trabajador->mantenciones;
            foreach ($mantenciones as $mantencion) {
                if($this->check_in_range($start, $end, $mantencion->start) or $this->check_in_range($start, $end, $mantencion->end)){
                    return false;
                }else {
                    if($this->check_in_range($mantencion->start, $mantencion->end, $start) or $this->check_in_range($mantencion->start, $mantencion->end, $end)){
                    return false;
                    }
                }
            }
            return true;
        }
    }
    //compara si una mfecha este en un rango de fechas
    private function check_in_range($fecha_inicio, $fecha_fin, $fecha){
        $fecha_inicio = strtotime($fecha_inicio);
        $fecha_fin = strtotime($fecha_fin);
        $fecha = strtotime($fecha);
        if(($fecha >= $fecha_inicio) && ($fecha <= $fecha_fin)) {
            return true;
        } else {
            return false;
        }
    }


    private function getFechas($inicio, $intervalo , $duracion)
    {
        $_inicio=new \DateTime($inicio);
        $fin = new \DateTime($inicio);
        $_fin  = $fin->modify('+360 day'); 

        $_intervalo = new \DateInterval($intervalo);
        $fechas = new \DatePeriod($_inicio, $_intervalo ,$_fin);

        $ret = array();
        foreach ($fechas as $fecha)
            {
                $inicioEvento = $fecha;
                $finEvento= clone $fecha;
                $finEvento->modify($duracion);
                if ($finEvento<=$fin){
                    $ret[]=array('Inicio' => $inicioEvento,
                            'Fin' => $finEvento);
                }
            }
        return $ret;
    }

    private function dateDiff($start , $end){
        $inicio = new \DateTime($start);
        $final = new \DateTime($end);
        $diff = $inicio->diff($final);
        return "+".$diff->d." day ".$diff->h." hours";
    }

    private function intervaloForm($cantida, $salto){
        switch ($salto) {
            case 1:
                $intervalo = "P".(360/$cantida)."D";
                break;
            case 2:
                $intervalo = "P".(30/$cantida)."D";
                break;
            case 3:
                $intervalo = "P".(7/$cantida)."D";
                break;
        }
        return $intervalo;
    }
   
}
