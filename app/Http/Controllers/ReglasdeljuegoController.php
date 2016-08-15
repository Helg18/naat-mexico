<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Regla;

class ReglasdeljuegoController extends Controller
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
    $reglas = Regla::All();
    return view('reglasdeljuego.index')->with('reglas', $reglas);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('reglasdeljuego.crear');
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    $r = new Regla;
    $r->regla = $request->regla;
    $r->descripcion_regla= $request->descripcion_regla;
    $r->is_active = 1;
    $r->save();
    return redirect()->route('admin.reglas.index')->with('success','Regla agregada exitosamente');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $r = Regla::findorfail($id);
    return view('reglasdeljuego.ver')->with('regla', $r);
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $r = Regla::findorfail($id);
    return view('reglasdeljuego.editar')->with('regla', $r);
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
    $r= Regla::findorfail($id);
    $r->regla = $request->regla;
    $r->descripcion_regla= $request->descripcion_regla;
    $r->is_active = $request->is_active;
    $r->save();
    return redirect()->route('admin.reglas.index')->with('success','Regla actualizada exitosamente');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $deletar = Regla::find($id);
    $deletar->destroy($id);
    return redirect()->route('admin.reglas.index')->with('success','Registro eliminado exitosamente');
  }
}
