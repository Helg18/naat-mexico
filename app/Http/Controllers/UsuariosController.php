<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use App\Models\Role_User;

class UsuariosController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
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
        $users = User::get();
        return view('usuarios.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Guardando el usuario
        $u = new User;
        $u->nombre = $request->nombre;
        $u->apellido= $request->apellido;
        $u->name = $request->nombre .' '. $request->apellido;
        $u->email = $request->email;
        $u->password = $request->pass;
        $u->fecha_nac = $request->fecha_nac;
        $u->fecha_ingreso_uvm = $request->fecha_ingreso;
        $u->celular = $request->celular;
        $u->puesto = $request->puesto;
        $u->campus = $request->campus;
        $u->metas_ni = $request->metas_ni;
        $u->metas_pno = $request->metas_pno;
        $u->is_active = 1;
        $u->save();

        //Creando el permiso
        $ru = new Role_User;
        $ru->role_id = 1;
        $ru->user_id = $u->id;
        $ru->save();

        return redirect()->route('admin.usuarios.index')->with('success','Usuario agregado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $u = User::find($id);
        return view('usuarios.ver')->with('usuario', $u);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $u = User::find($id);
        return view('usuarios.editar')->with('usuario', $u);
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
        $u = User::find($id);
        $u->nombre = $request->nombre;
        $u->apellido= $request->apellido;
        $u->name = $request->nombre .' '. $request->apellido;
        $u->email = $request->email;
        $u->password = $request->pass;
        $u->fecha_nac = $request->fecha_nac;
        $u->fecha_ingreso_uvm = $request->fecha_ingreso;
        $u->celular = $request->celular;
        $u->puesto = $request->puesto;
        $u->campus = $request->campus;
        $u->metas_ni = $request->metas_ni;
        $u->metas_pno = $request->metas_pno;
        $u->id_rol = 1;
        $u->is_active = 1;
        $u->save();
        return redirect()->route('admin.usuarios.index')->with('success','Registro actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletar = User::find($id);
        $deletar->destroy($id);
        return redirect()->route('admin.usuarios.index')->with('success','Registro eliminado exitosamente');
    }
}
