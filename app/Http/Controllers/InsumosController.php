<?php

namespace App\Http\Controllers;

use App\Insumo;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInsumoRequest;

class InsumosController extends Controller
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
        $user = auth()->user()->id;
        $insumos = Insumo::where([
            ['user_id', '=', $user],
            ['estado_id', '=', 1],
        ])->get();

        return  view('insumos.list', compact('insumos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('insumos.insert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInsumoRequest $request)
    {
        //obtenemos datos del request
        $nombre = $request->input("txt_nombre");
        $desc = $request->input("txt_descripcion");
        $insumo = new Insumo();
        $insumo->nombre = $request->input("txt_nombre");
        $insumo->desc = $request->input("txt_descripcion");
        $insumo->estado_id = 1;
        $insumo->user_id = auth()->user()->id;
        $insumo->save();

        $msgInsert = "Ingresado Correctamente";
        return  view('insumos.insert', compact('msgInsert'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Insumo  $insumo
     * @return \Illuminate\Http\Response
     */
    public function show(Insumo $insumo)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Insumo  $insumo
     * @return \Illuminate\Http\Response
     */
    public function edit($insumo)
    {
        $insumoed = Insumo::FindOrFail($insumo);
        if ($insumoed->user_id == auth()->user()->id) {
            return view('insumos.edit', compact('insumoed'));
        } else {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Insumo  $insumo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $insumo)
    {
        $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'required|string|',
            'estado' => 'required|numeric|between:1,2',
        ]);
        $insumoed = Insumo::FindOrFail($insumo);
        $insumoed->nombre = $request->input("nombre");
        $insumoed->desc = $request->input("descripcion");
        $insumoed->estado_id = $request->input("estado");
        $insumoed->save();

        $msgInsert = "Actualizado Correctamente";
        return  view('insumos.edit', compact('msgInsert', 'insumoed'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Insumo  $insumo
     * @return \Illuminate\Http\Response
     */
    public function destroy($insumo)
    {
        return $insumo;
        $insumoEliminar = Insumo::findOrFail($insumo);
        $insumoEliminar->estado_id = 2;
        $insumoEliminar->save();
        //return back()->with('msj', 'Insumo Eliminado Correctamente');
    }
}
