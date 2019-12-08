<?php

namespace App\Http\Controllers;

use App\Equipo;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\BinaryOp\Equal;

class EquipoController extends Controller
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
        $equipo = Equipo::where([
            ['user_id', '=', $user],
            ['estado_id', '=', 1],
        ])->get();
        return view('equipo.list', compact('equipo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('equipo.insert');
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
            'desc' => 'required|string',
            'tipo' => 'required|numeric|not_in: 1, 2|exists:tipos,id',
            'departamento' => 'required|numeric|exists:departamentos,id',
            'fabricante' => 'required|numeric|exists:fabricantes,id',
            'fecha_Ingreso' => 'required|date|after:1930-12-31',
        ]);
        //genera numeros al azar y los mescla con el nombre para generar un qr unico
        $numero = rand(1000, 10000);
        $cadena = "" . $request->input("nombre") . $request->input("desc") . $numero;

        //obtenemos datos del request

        $equipo = new Equipo();
        $equipo->nombre = $request->input("nombre");
        $equipo->desc = $request->input("desc");
        $equipo->qr = str_shuffle($cadena);
        $equipo->tipo_id = $request->input("tipo");
        $equipo->departamento_id = $request->input("departamento");
        $equipo->fabricante_id = $request->input("fabricante");
        $equipo->fechaIngreso = $request->input("fecha_Ingreso");
        $equipo->estado_id = 1;
        $equipo->user_id = auth()->user()->id;
        $equipo->save();

        $msgInsert = "Ingresado Correctamente";
        return  view('equipo.insert', compact('msgInsert'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function show(Equipo $equipo)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function edit($equipo)
    {
        $equipoed = Equipo::FindOrFail($equipo);
        if ($equipoed->user_id == auth()->user()->id) {
            return view('equipo.edit', compact('equipoed'));
        } else {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $equipo)
    {
        //validacion
        $request->validate([
            'nombre' => 'required|string',
            'desc' => 'required|string',
            'tipo' => 'required|numeric|not_in: 1, 2|exists:tipos,id',
            'departamento' => 'required|numeric|exists:departamentos,id',
            'fabricante' => 'required|numeric|exists:fabricantes,id',
            'fecha_Ingreso' => 'required|date|after:1930-12-31',
        ]);
        //obtenemos datos del request

        $equipoed = Equipo::FindOrFail($equipo);
        $equipoed->nombre = $request->input("nombre");
        $equipoed->desc = $request->input("desc");
        $equipoed->tipo_id = $request->input("tipo");
        $equipoed->departamento_id = $request->input("departamento");
        $equipoed->fabricante_id = $request->input("fabricante");
        $equipoed->fechaIngreso = $request->input("fecha_Ingreso");
        $equipoed->save();

        $msgInsert = "Actualizado Correctamente";
        return  view('equipo.edit', compact('msgInsert', 'equipoed'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function destroy($equipo)
    {
        $equipoel = Equipo::findOrFail($equipo);
        $equipoel->estado_id = 2;
        $equipoel->save();
        return back()->with('msj', 'Eqiopo Eliminado Correctamente');
    }
}