<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\NseLevel;

use App\Http\Requests\NseLevelRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class NseLevelController extends Controller
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
    public function store(NseLevelRequest $request)
    {
        //
        $register = new NseLevel();
        $register->name = $request->name;
        $register->min = $request->min;
        $register->max = $request->max;
        $register->save();

        return \Redirect::route('nse.level.index')->with('success','Registro creado exitosamente');
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
        $register = NseLevel::find($id);
        return $this->customIndex($register);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NseLevelRequest $request, $id)
    {
        //

        $register = NseLevel::find($id);

        $register->name = $request->name;
        $register->min = $request->min;
        $register->max = $request->max;
        $register->save();


        return \Redirect::route('nse.level.index')->with('success','Registro actualizado exitosamente');
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
        $register = NseLevel::find($id);
        if(!$register->canDelete()){
            return \Redirect::route('nse.level.index')->with('error','El registro no se puede eliminar porque tiene registros asociados');
        }
        $register->delete();
        return \Redirect::route('nse.level.index')->with('success','Registro eliminado exitosamente');
    }

    private function customIndex($register=false){
        $registers = NseLevel::orderBy('min','desc')->get();

        return view('nse.level.index')->with(compact('registers','register'));
    }


    /**
     * Change status of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        //
        $register = NseLevel::find($id);
        if($register->is_active){
            $register->is_active = false;
        }else{
            $register->is_active = true;
        }
        $register->save();
        return \Redirect::route('nse.level.index')->with('success','Registro actualizado exitosamente');
    }
}
