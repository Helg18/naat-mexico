<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Decalogo;
use App\Http\Requests\CrearDecalogoRequest;
use App\Http\Requests\EditarDecalogoRequest;

class DecalogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $d = Decalogo::all();

        return view('decalogos.index')->with('decalogos', $d);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('decalogos.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrearDecalogoRequest $request)
    {
        $d = new Decalogo;
        $d->decalogo = $request->decalogo;
        $d->is_active = 1;
        $d->save();
        return redirect()->route('admin.decalogos.index')->with('success','Decalogo agregado exitosamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $d = Decalogo::findorfail($id);
        return view('decalogos.ver')->with('decalogo', $d);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $d = Decalogo::findorfail($id);
        return view('decalogos.editar')->with('decalogo', $d);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {    
        $r= Decalogo::findorfail($id);
        $r->decalogo = $request->decalogo;
        $r->is_active = $request->is_active;
        $r->save();
        return redirect()->route('admin.decalogos.index')->with('success','Decalogo actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletar = Decalogo::find($id);
        $deletar->destroy($id);
        return redirect()->route('admin.decalogos.index')->with('success','Decalogo eliminado exitosamente');
    }
}
