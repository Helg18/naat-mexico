<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Plan;

use App\Http\Requests\PlanRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
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
    public function store(PlanRequest $request)
    {
        //
        $register = new Plan();
        $register->name = $request->name;
        $register->limit_user = $request->limit_user;
        $register->limit_quiz = $request->limit_quiz;
        $register->days_expiration = $request->days_expiration;
        $register->price = $request->price;
        $register->is_active = (bool)$request->is_active;
        $register->save();

        return \Redirect::route('config.plan.index')->with('success','Registro creado exitosamente');
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
        $register = Plan::find($id);
        return $this->customIndex($register);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlanRequest $request, $id)
    {
        //

        $register = Plan::find($id);
        $register->name = $request->name;
        $register->limit_user = $request->limit_user;
        $register->limit_quiz = $request->limit_quiz;
        $register->days_expiration = $request->days_expiration;
        $register->price = $request->price;
        $register->is_active = (bool)$request->is_active;
        $register->save();


        return \Redirect::route('config.plan.index')->with('success','Registro actualizado exitosamente');
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
        $register = Plan::find($id);
        if(!$register->canDelete()){
            return \Redirect::route('config.plan.index')->with('error','El registro no se puede eliminar porque tiene registros asociados');
        }
        $register->delete();
        return \Redirect::route('config.plan.index')->with('success','Registro eliminado exitosamente');
    }

    private function customIndex($register=false){
        $registers = Plan::all();

        return view('config.plan.index')->with(compact('registers','register'));
    }


    /**
     * Change status of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        //
        $register = Plan::find($id);
        if($register->is_active){
            $register->is_active = false;
        }else{
            $register->is_active = true;
        }
        $register->save();
        return \Redirect::route('config.plan.index')->with('success','Registro actualizado exitosamente');
    }
}
