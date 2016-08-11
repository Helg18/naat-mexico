<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\SendGroup;

use App\Http\Requests\GroupRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('module');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return $this->customIndex();
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupRequest $request)
    {
        //
        $register = new SendGroup();
        $register->name = $request->name;
        $register->company_id = \Auth::user()->company()->id;

        $register->save();
        $register->from_xls($request);

        return \Redirect::route('company.group.index')->with('success','Registro creado exitosamente');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $register = SendGroup::find($id);
        return $this->customIndex($register);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GroupRequest $request, $id)
    {
        //

        $register = SendGroup::find($id);
        $register->name = $request->name;
        $register->save();
        $register->from_xls($request);


        return \Redirect::route('company.group.index')->with('success','Registro actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $register = SendGroup::find($id);
        /*if(!$register->canDelete()){
            return \Redirect::route('config.plan.index')->with('error','El registro no se puede eliminar porque tiene registros asociados');
        }*/
        $register->delete();
        return \Redirect::route('company.group.index')->with('success','Registro eliminado exitosamente');
    }

    private function customIndex($register=false){
        $registers = SendGroup::allWithSecurity();

        return view('company.group.index')->with(compact('registers','register'));
    }



}
