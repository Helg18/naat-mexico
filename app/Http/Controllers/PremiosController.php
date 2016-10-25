<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CrearPremiosRequest;
use App\Models\Premios;

class PremiosController extends Controller
{
    /**
     * Invocamos el middleware Auth para asegurarnos de tener un usuario logueado
     */
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
        $premios = Premios::All();
        return view('premios.index')->with('premios', $premios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('premios.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrearPremiosRequest $request)
    {
        $p = new Premios;
        $p->premios = $request->premios;
        $p->descripcion_premios= $request->descripcion_premios;
        $p->is_active = 1;
        $p->save();
        return redirect()->route('admin.premios.index')->with('success','Premio agregado exitosamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $p = Premios::findorfail($id);
        return view('premios.ver')->with('premio', $p);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $p = Premios::findorfail($id);
        return view('premios.editar')->with('premios', $p);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CrearPremiosRequest $request, $id)
    {
        $p= Premios::findorfail($id);
        $p->premios = $request->premios;
        $p->descripcion_premios= $request->descripcion_premios;
        $p->is_active = $request->is_active;
        $p->save();
        return redirect()->route('admin.premios.index')->with('success','Premio actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletar = Premios::find($id);
        $deletar->destroy($id);
        return redirect()->route('admin.premios.index')->with('success','Premio eliminado exitosamente');
    }
}
