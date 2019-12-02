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
        $insumos = auth()->user()->insumos;
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
        //variables para validar que no existan en la base de datos
        $validarN = Insumo::where([
            ['nombre', '=', $nombre],
            ['desc', '=', $desc],
        ])->doesntExist();
        $validarD = Insumo::where('desc', $desc)->doesntExist();
        //valida de que los campos a ingresar no existen
        if ($validarN and $validarD) {
            //si no existen prepara el ingreso 
            $insumo = new Insumo();
            $insumo->nombre = $request->input("txt_nombre");
            $insumo->desc = $request->input("txt_descripcion");
            $insumo->estado_id = 1;
            //ingresa los datos a bd del nuevo insumo
            $insumo->save();
            //busca el insumo nuevo ingresado
            $relacion = Insumo::max('id');
            //genera la relacion en la tabla pibote
            auth()->user()->insumos()->attach($relacion);
            //mensaje y redireccion
            $msgInsert = "Ingresado Correctamente";
            return  view('insumos.insert', compact('msgInsert'));
        } else {
            //si existen los registros, relaciona el existente con el usuario que lo solicita
            //busca el insumo a relacionar
            $relacion = Insumo::where([
                ['nombre', '=', $nombre],
                ['desc', '=', $desc],
            ])->first();
            //relaciona el inusmo existente con el usuario en la tabla pibote
            auth()->user()->insumos()->attach($relacion->id);
            //mensaje y redireccion
            $msgInsert = "Asignado Correctamente";
            return  view('insumos.insert', compact('msgInsert'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Insumo  $insumo
     * @return \Illuminate\Http\Response
     */
    public function show(Insumo $insumo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Insumo  $insumo
     * @return \Illuminate\Http\Response
     */
    public function edit(Insumo $insumo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Insumo  $insumo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Insumo $insumo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Insumo  $insumo
     * @return \Illuminate\Http\Response
     */
    public function destroy($insumo)
    {
        $insumoEliminar = Insumo::findOrFail($insumo);
        $insumoEliminar->estado_id = 2;
        $insumoEliminar->save();
        return back()->with('msj', 'Insumo Eliminado Correctamente');
    }
}
