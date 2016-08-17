<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoriasRequest;

use App\Http\Requests;
use App\Models\Categorias;
use App\Models\Subcategorias;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $c = Categorias::all();
        return view('categorias.index')->with('categorias', $c);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriasRequest $request)
    {
        $c = new Categorias;
        $c->categoria = $request->categoria;
        $c->isactive = 1;
        $c->save();
        return redirect()->route('admin.categorias.index')->with('success','Categoria agregada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $c  = Categorias::findorfail($id);
      $sc = Subcategorias::where('categoria_id', $c->id)->get();
      return view('categorias.ver')->with('categoria', $c)->with('subcategorias', $sc );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $c = Categorias::findorfail($id);
      return view('categorias.editar')->with('categoria', $c);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriasRequest $request, $id)
    {
      $c = Categorias::findorfail($id);
      $c->categoria = $request->categoria;
      $c->is_active = $request->is_active;
      $c->save();
      return redirect()->route('admin.categorias.index')->with('success','Categoria actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
    	$deletar = Categorias::find($id);
    	$comprobacion = Subcategorias::where('categoria_id',$deletar->id)->first();
    	if (is_null($comprobacion) || empty($comprobacion)) {
      	return redirect()->route('admin.categorias.index')->with('success','Premio eliminado exitosamente');
    	} else {
      	$deletar->destroy($id);
      	return redirect()->route('admin.categorias.index')->with('error','Esta categoria tiene subcategorias, para eliminarla debe eliminar las subcategorias primero.');
    	}


    }
}
