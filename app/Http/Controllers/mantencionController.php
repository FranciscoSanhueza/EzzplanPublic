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
    public function index()
    {
        $fases = $this::fases();
        $equipos = $this::equipos();
        $trabajadores = $this::trabajadores();
        $insumos = $this::insumos();
        $responsables = $this::responsables();
        return view('mantenciones.list' , compact('fases','trabajadores', 'insumos', 'equipos'  , 'responsables'));
    }

    public function calendario(){
        $mantenciones = Mantencion::all();
        return $mantenciones;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(mantencionRequest $request)
    {
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
                "title" => "Registrado",
                "desc" => "Ingresado Correctamente"
            ]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mantencion  $mantencion
     * @return \Illuminate\Http\Response
     */
    public function show(Mantencion $mantencion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mantencion  $mantencion
     * @return \Illuminate\Http\Response
     */
    public function edit(Mantencion $mantencion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mantencion  $mantencion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mantencion $mantencion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mantencion  $mantencion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mantencion $mantencion)
    {
        //
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
