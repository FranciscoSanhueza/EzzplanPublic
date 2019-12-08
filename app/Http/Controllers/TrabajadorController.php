<?php

namespace App\Http\Controllers;

use App\Trabajador;
use Illuminate\Http\Request;

class TrabajadorController extends Controller
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
        $trabajador = Trabajador::where([
            ['user_id', '=', $user],
            ['estado_id', '=', 1],
        ])->get();
        return view('trabajador.list', compact('trabajador'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trabajador.insert');
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
            'run' => 'required|string|max:12',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'telefono' => 'nullable|digits_between: 8 , 9|starts_with:9',
            'cargo' => 'required|numeric|exists:cargos,id',
        ]);
        //obtenemos datos del request
        $trabajador = new Trabajador();
        $trabajador->run = $request->input("run");
        $trabajador->nombre = $request->input("nombre");
        $trabajador->apellido = $request->input("apellido");
        $trabajador->telefono = $request->input("telefono");
        $trabajador->cargo_id = $request->input("cargo");
        $trabajador->estado_id = 1;
        $trabajador->user_id = auth()->user()->id;
        $trabajador->save();

        $msgInsert = "Ingresado Correctamente";
        return  view('trabajador.insert', compact('msgInsert'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trabajador  $trabajador
     * @return \Illuminate\Http\Response
     */
    public function show(Trabajador $trabajador)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trabajador  $trabajador
     * @return \Illuminate\Http\Response
     */
    public function edit($trabajador)
    {
        $trabajadored = Trabajador::FindOrFail($trabajador);
        if ($trabajadored->user_id == auth()->user()->id) {
            return view('trabajador.edit', compact('trabajadored'));
        } else {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trabajador  $trabajador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $trabajador)
    {
        //validacion
        $request->validate([
            'run' => 'required|string|max:12',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'telefono' => 'nullable|digits_between: 8 , 9|starts_with:9',
            'cargo' => 'required|numeric|exists:cargos,id',
        ]);
        //obtenemos datos del request
        $trabajadored = Trabajador::FindOrFail($trabajador);
        $trabajadored->run = $request->input("run");
        $trabajadored->nombre = $request->input("nombre");
        $trabajadored->apellido = $request->input("apellido");
        $trabajadored->telefono = $request->input("telefono");
        $trabajadored->cargo_id = $request->input("cargo");
        $trabajadored->save();

        $msgInsert = "Actualizado Correctamente";
        return  view('trabajador.edit', compact('msgInsert', 'trabajadored'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trabajador  $trabajador
     * @return \Illuminate\Http\Response
     */
    public function destroy($trabajador)
    {
        $trabajadorel = Trabajador::findOrFail($trabajador);
        $trabajadorel->estado_id = 2;
        $trabajadorel->save();
        return back()->with('msj', 'trabajador Eliminado Correctamente');
    }
}