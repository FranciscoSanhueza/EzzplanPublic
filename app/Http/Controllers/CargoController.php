<?php

namespace App\Http\Controllers;

use App\Cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
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
        $cargo = Cargo::where([
            ['user_id', '=', $user],
            ['estado_id', '=', 1],
        ])->get();
        return view('cargo.list', compact('cargo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cargo.insert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validacion
        $request->validate([
            'nombre' => 'required|string',
            'funcion' => 'required|string',
        ]);
        //obtenemos datos del request
        $cargo = new Cargo();
        $cargo->nombre = $request->input("nombre");
        $cargo->funcion = $request->input("funcion");
        $cargo->estado_id = 1;
        $cargo->user_id = auth()->user()->id;
        $cargo->save();

        $msgInsert = "Ingresado Correctamente";
        return  view('cargo.insert', compact('msgInsert'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function show(Cargo $cargo)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function edit($cargo)
    {
        $cargoed = Cargo::FindOrFail($cargo);
        if ($cargoed->user_id == auth()->user()->id) {
            return view('cargo.edit', compact('cargoed'));
        } else {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cargo)
    {
        //validacion
        $request->validate([
            'nombre' => 'required|string',
            'funcion' => 'required|string',
        ]);
        //obtenemos datos del request
        $cargoed = Cargo::FindOrFail($cargo);
        $cargoed->nombre = $request->input("nombre");
        $cargoed->funcion = $request->input("funcion");
        $cargoed->save();

        $msgInsert = "Actualizado Correctamente";
        return  view('cargo.edit', compact('msgInsert', 'cargoed'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function destroy($cargo)
    {
        $cargoel = Cargo::findOrFail($cargo);
        $cargoel->estado_id = 2;
        $cargoel->save();
        return back()->with('msj', 'Cargo Eliminado Correctamente');
    }
}
