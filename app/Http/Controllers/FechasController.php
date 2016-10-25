<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fecha;

use App\Http\Requests;
use App\Http\Requests\CreateFechaRequest;

class FechasController extends Controller
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
        $fechas = Fecha::All();
        return view('fechas.index')->with('fechas', $fechas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fechas.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFechaRequest $request)
    {
        $f = new Fecha;
        $f->fecha = $request->fecha;
        $f->descripcion_fecha= $request->descripcion_fecha;
        $f->is_active = 1;
        $f->save();
        return redirect()->route('admin.fechas.index')->with('success','Fecha agregada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $f = Fecha::findorfail($id);
        return view('fechas.ver')->with('fecha', $f);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $f = Fecha::findorfail($id);
        return view('fechas.editar')->with('fecha', $f);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateFechaRequest $request, $id)
    {
        $f= Fecha::findorfail($id);
        $f->fecha = $request->fecha;
        $f->descripcion_fecha= $request->descripcion_fecha;
        $f->is_active = $request->is_active;
        $f->save();
        return redirect()->route('admin.fechas.index')->with('success','Fecha actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletar = Fecha::find($id);
        $deletar->destroy($id);
        return redirect()->route('admin.fechas.index')->with('success','Fecha eliminada exitosamente');

    }
}
