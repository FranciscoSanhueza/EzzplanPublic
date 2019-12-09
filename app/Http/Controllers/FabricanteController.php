<?php

namespace App\Http\Controllers;

use App\Fabricante;
use Illuminate\Http\Request;

class FabricanteController extends Controller
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
        $fabricante = Fabricante::where([
            ['user_id', '=', $user],
            ['estado_id', '=', 1],
        ])->get();

        return  view('fabricante.list', compact('fabricante'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fabricante.insert');
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
            'origen' => 'nullable|string',
            'telefono' => 'nullable|digits_between: 8 , 9|starts_with:9',
            'correo' => 'nullable|email',
            'web' => 'nullable|string',
        ]);
        //obtenemos datos del request
        $fabricante = new Fabricante();
        $fabricante->nombre = $request->input("nombre");
        $fabricante->desc = $request->input("desc");
        $fabricante->Origen = $request->input("origen");
        $fabricante->telefono = $request->input("telefono");
        $fabricante->Correo = $request->input("correo");
        $fabricante->Web = $request->input("web");
        $fabricante->estado_id = 1;
        $fabricante->user_id = auth()->user()->id;
        $fabricante->save();

        $msgInsert = "Ingresado Correctamente";
        return  view('fabricante.insert', compact('msgInsert'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fabricante  $fabricante
     * @return \Illuminate\Http\Response
     */
    public function show(Fabricante $fabricante)
    {
        //
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fabricante  $fabricante
     * @return \Illuminate\Http\Response
     */
    public function edit($fabricante)
    {
        $fabricanteed = Fabricante::FindOrFail($fabricante);
        if ($fabricanteed->user_id == auth()->user()->id) {
            return view('fabricante.edit', compact('fabricanteed'));
        } else {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fabricante  $fabricante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $fabricante)
    {
        //validacion
        $request->validate([
            'nombre' => 'required|string',
            'desc' => 'required|string',
            'origen' => 'nullable|string',
            'telefono' => 'nullable|digits_between: 8 , 9|starts_with:9',
            'correo' => 'nullable|email',
            'web' => 'nullable|string',
        ]);
        //obtenemos datos del request
        $fabricanteed = Fabricante::FindOrFail($fabricante);
        $fabricanteed->nombre = $request->input("nombre");
        $fabricanteed->desc = $request->input("desc");
        $fabricanteed->Origen = $request->input("origen");
        $fabricanteed->telefono = $request->input("telefono");
        $fabricanteed->Correo = $request->input("correo");
        $fabricanteed->Web = $request->input("web");
        $fabricanteed->save();

        $msgInsert = "Actualizado Correctamente";
        return  view('fabricante.edit', compact('msgInsert', 'fabricanteed'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fabricante  $fabricante
     * @return \Illuminate\Http\Response
     */
    public function destroy($fabricante)
    {
        $fabricanteel = Fabricante::findOrFail($fabricante);
        $fabricanteel->estado_id = 2;
        $fabricanteel->save();
        return back()->with('msj', 'Fabricante Eliminado Correctamente');
    }
}
