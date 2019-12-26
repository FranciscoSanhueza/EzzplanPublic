<?php

namespace App\Http\Controllers;

use App\Trabajador;
use App\Cargo;
use Illuminate\Http\Request;
use Malahierba\ChileRut\ChileRut;
use Malahierba\ChileRut\Rules\ValidChileanRut;

class TrabajadorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    private function Combocargos(){
        $user = auth()->user()->id;
        return $cargos = Cargo::where([
            ['user_id', '=', $user],
            ['estado_id', '=', 1],
        ])->get();
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->controlroles(['1','3','2']); //control de roles
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
    public function create(Request $request)
    {
        $request->user()->controlroles(['1','3','2']); //control de roles
        $cargos = $this->Combocargos();
        return view('trabajador.insert', compact('cargos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->controlroles(['1','3','2']); //control de roles
        //validacion
        $request->validate([
            'run' => ['required','string','max:12', new ValidChileanRut(new ChileRut)],
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
        $cargos = $this->Combocargos();
        $msgInsert = "Ingresado Correctamente";
        return  view('trabajador.insert', compact('msgInsert' , 'cargos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trabajador  $trabajador
     * @return \Illuminate\Http\Response
     */
    public function show(Trabajador $trabajador, Request $request)
    {
        $request->user()->controlroles(['1','3','2']); //control de roles
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trabajador  $trabajador
     * @return \Illuminate\Http\Response
     */
    public function edit($trabajador, Request $request)
    {
        $request->user()->controlroles(['1','3','2']); //control de roles
        $trabajadored = Trabajador::FindOrFail($trabajador);
        if ($trabajadored->user_id == auth()->user()->id) {
            $cargos = $this->Combocargos();
            return view('trabajador.edit', compact('trabajadored' , 'cargos'));
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
        $request->user()->controlroles(['1','3','2']); //control de roles
        //validacion
        $request->validate([
            'run' => ['required','string','max:12', new ValidChileanRut(new ChileRut)],
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
        $cargos = $this->Combocargos();
        $msgInsert = "Actualizado Correctamente";
        return  view('trabajador.edit', compact('msgInsert', 'trabajadored' , 'cargos'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trabajador  $trabajador
     * @return \Illuminate\Http\Response
     */
    public function destroy($trabajador, Request $request)
    {
        $request->user()->controlroles(['1','3','2']); //control de roles
        $trabajadorel = Trabajador::findOrFail($trabajador);
        $trabajadorel->estado_id = 2;
        $trabajadorel->save();
        return back()->with('msj', 'trabajador Eliminado Correctamente');
    }
}
