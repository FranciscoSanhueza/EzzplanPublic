<?php

namespace App\Http\Controllers;

use App\Mantencion;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
        return view('mantenciones.list');
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
    public function store(Request $request)
    {

        if($request->ajax()){
            $request->validate([
                'title' => 'required|string',
                'desc' => 'required|string|',
                'start' => 'required',
                'startH' => 'required',
                'end' => 'required',
                'endH' => 'required',
            ]);

            $mantencion = new Mantencion();
            $mantencion->title = $request->input('title');
            $mantencion->desc = $request->input('desc');
            $mantencion->start = $request->input('start')." ".$request->input('startH');
            $mantencion->end = $request->input('end')." ".$request->input('endH');
            $mantencion->responsable_id = 2;
            $mantencion->planificador_id = auth()->user()->id;
            $mantencion->estado_id = 1;
            $mantencion->prioridad_id = 2;
            $mantencion->save();
            return response()->json([
                
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
}
