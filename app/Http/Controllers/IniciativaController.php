<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Iniciativa;
use App\Http\Requests;
use App\Http\Requests\CrearIniciativaRequest;
use App\Http\Requests\EditariniciativaRequest;

class IniciativaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $i = Iniciativa::all();
        return view('iniciativas.index')->with('iniciativas',$i);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('iniciativas.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrearIniciativaRequest $request)
    {
        $i = new Iniciativa();
        $i->titulo = $request->iniciativa;
        $i->is_active = 1;
        $i->save();
        return redirect()->route('admin.iniciativas.index')->with('success','Iniciativa agregada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $i  = Iniciativa::findorfail($id);
        return view('iniciativas.ver')->with('iniciativa', $i);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $i  = Iniciativa::findorfail($id);
        return view('iniciativas.editar')->with('iniciativa', $i);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditariniciativaRequest $request, $id)
    {
        $i = Iniciativa::find($id);
        $i->titulo = $request->iniciativa;
        $i->is_active = $request->is_active;
        $i->save();
        return redirect()->route('admin.iniciativas.index')->with('success','Iniciativa actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletar = Iniciativa::find($id);
        $deletar->destroy($id);
        return redirect()->route('admin.iniciativas.index')->with('success','Iniciativa eliminada exitosamente');
    }
}
