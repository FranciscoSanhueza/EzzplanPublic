<?php

namespace App\Http\Controllers;

use App\Fase;
use Illuminate\Http\Request;

class faseController extends Controller
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
        $request->user()->controlroles(['1','3']);//control de roles
        $user = auth()->user()->id;
        $fases = Fase::where([
            ['user_id', '=', $user],
            ['estado_id', '=', 1],
        ])->get();
        return view('fases.list', compact('fases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->controlroles(['1','3']);
        return view('fases.insert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->controlroles(['1','3']);
        //validacion
        $request->validate([
            'nombre' => 'required|string',
            'desc' => 'required|string',
        ]);
        //obtenemos datos del request
        $fase = new Fase();
        $fase->nombre = $request->input("nombre");
        $fase->desc = $request->input("desc");
        $fase->estado_id = 1;
        $fase->user_id = auth()->user()->id;
        $fase->save();

        $msgInsert = "Ingresado Correctamente";
        return  view('fases.insert', compact('msgInsert'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fase  $fase
     * @return \Illuminate\Http\Response
     */
    public function show($fase , Request $request)
    {
        $request->user()->controlroles(['1','3']);
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fase  $fase
     * @return \Illuminate\Http\Response
     */
    public function edit($fase , Request $request)
    {
        $request->user()->controlroles(['1','3']);
        $faseed = Fase::FindOrFail($fase);
        if ($faseed->user_id == auth()->user()->id) {
            return view('fases.edit', compact('faseed'));
        } else {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fase  $fase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $fase)
    {
        $request->user()->controlroles(['1','3']);
        $request->validate([
            'nombre' => 'required|string',
            'desc' => 'required|string|',
        ]);
        $faseed = Fase::FindOrFail($fase);
        $faseed->nombre = $request->input("nombre");
        $faseed->desc = $request->input("desc");
        $faseed->save();

        $msgInsert = "Actualizado Correctamente";
        return  view('fases.edit', compact('msgInsert', 'faseed'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fase  $fase
     * @return \Illuminate\Http\Response
     */
    public function destroy($fase , Request $request)
    {
        $request->user()->controlroles(['1','3']);
        $faseEliminar = Fase::findOrFail($fase);
        $faseEliminar->estado_id = 2;
        $faseEliminar->save();
        return back()->with('msj', 'fase Eliminada Correctamente');
    }
}
