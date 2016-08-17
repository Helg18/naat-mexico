<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SubcategoriasRequest;
use App\Http\Requests\EditarsubcategoriasRequest;
use App\Models\Subcategorias;
use App\Models\Categorias;
use Illuminate\Routing\Route;

class SubcategoriasController extends Controller
{
    public function __construct(Route $route){
        $this->route = $route;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoria_padre = $this->route->getparameter('categoria');
        $c = Categorias::findorfail($categoria_padre);

        return view('subcategorias.crear')->with('categoria',$c);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubcategoriasRequest $request)
    {
        $sc = new Subcategorias();
        $sc->subcategoria=$request->subcategoria;
        $sc->is_active=1;
        $sc->categoria_id=$request->id_categoria;

        $sc->save();
        return redirect()->route('admin.categorias.show', $request->id_categoria)->with('success','Subcategoria agregada exitosamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subcategoria     = Subcategorias::findorfail($id);
        $categoria_actual = Categorias::where('id',$subcategoria->categoria_id)->first();
        $categorias       = Categorias::lists('categoria', 'id')->all(); 

        return view('subcategorias.editar')
                    ->with('categoria_actual', $categoria_actual)
                    ->with('subcategoria', $subcategoria)
                    ->with('categorias', $categorias);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //busco la subcategoria por el id
        $subcategoria     = Subcategorias::findorfail($id);

        //busco la categoria actual
        $categoria_actual = Categorias::where('id',$subcategoria->categoria_id)->first();

        //Listo todas las categorias
        $categorias       = Categorias::lists('categoria', 'id')->all(); 


        //retornamos todo a la vista
        return view('subcategorias.editar')
                    ->with('categoria_actual', $categoria_actual)
                    ->with('subcategoria', $subcategoria)
                    ->with('categorias', $categorias);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditarsubcategoriasRequest $request, $id)
    {
        $sc = Subcategorias::findorfail($id);
        $viejo = $sc->categoria_id;
        $sc->categoria_id = $request->categoria;
        $sc->subcategoria = $request->subcategoria;
        $sc->is_active    = $request->is_active;
        $sc->save();
        return redirect()->route('admin.categorias.show', $viejo)->with('success','Subcategoria agregada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletar = Subcategorias::findorfail($id);
        $deletar->destroy($id);
        return redirect()->route('admin.categorias.show', $deletar->categoria_id )->with('success','Subcategoria eliminada exitosamente');
    }
}
