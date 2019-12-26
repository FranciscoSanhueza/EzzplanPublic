<?php

namespace App\Http\Controllers;

use App\Mantencion;
use Illuminate\Http\Request;
use App\Http\Requests\mantencionRequest;
use Illuminate\View\View;
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
            $mantencion = new Mantencion();
            $mantencion->title = $request->input('title');
            $mantencion->desc = $request->input('desc');
            $mantencion->start = $request->input('start')." ".$request->input('startH');
            $mantencion->end = $request->input('end')." ".$request->input('endH');
            $mantencion->responsable_id = $request->input('id');
            $mantencion->planificador_id = $user->id;
            $mantencion->estado_id = 1;
            $mantencion->prioridad_id = $request->input('prioridad');
            $mantencion->save();
            $cod = Mantencion::max('id');
            $mantencionFind = Mantencion::find($cod); 
            $fases = $request->input('fases');
            for ($i=0; $i < count($fases) ; $i++) { 
                $mantencionFind->fases()->attach( $fases[$i], ['estado_id' => 3]);
            }
            $equipos = $request->input('equipos');
            for ($i=0; $i < count($equipos) ; $i++) { 
                $mantencionFind->equipos()->attach( $equipos[$i]);
            }
            $trabajadores = $request->input('trabajadores');
            for ($i=0; $i < count($trabajadores) ; $i++) { 
                $mantencionFind->trabajadores()->attach( $trabajadores[$i]);
            }
            $insumos = $request->input('insumos');
            for ($i=0; $i < count($insumos) ; $i++) { 
                $mantencionFind->insumos()->attach( $insumos[$i] );
            }
            return response()->json([
                "tipo" => 1,
                "title" => "Registrado",
                "desc" => "Ingresado Correctamente"
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
    public function edit(Mantencion $mantencion, Request $request)
    {
        //
        $request->user()->controlroles(['1','3','2','4']);

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
}
