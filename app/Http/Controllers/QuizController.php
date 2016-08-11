<?php

namespace App\Http\Controllers;

use App\Models\NseLevel;
use App\Models\SendGroup;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Quiz;


use App\Http\Requests\QuizRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
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
    public function store(QuizRequest $request)
    {

        //dd(\Auth::user()->company());
        if(\Auth::user()->company()->limit_quiz >0 && (\Auth::user()->company()->quizzes()->count() >= \Auth::user()->company()->limit_quiz)){
            return \Redirect::route('company.quiz.index')->with('error','El limite de encuestas de su plan no permite crear mas encuestas');
        }

        if( strtotime(\Auth::user()->company()->expiration) < time()){
            return \Redirect::route('company.quiz.index')->with('error','Su plan ha expirado');
        }

        //
        $register = new Quiz();
        $register->name = $request->name;
        $register->is_active = (bool)$request->is_active;
        $register->company_id = \Auth::user()->company()->id;
        $register->nse_level_id = $request->nse_level_id=="" ? null : $request->nse_level_id;
        $register->points = $request->points;
        $register->is_private = (bool)$request->is_private;
        if($register->is_private){
            $register->send_group_id = $request->send_group_id ? $request->send_group_id  : NULL;
        }else{
            $register->send_group_id = NULL;
        }
        $register->state = $request->state ? $request->state : NULL;
        $register->last_active = date('Y-m-d H:i:s');

        $register->save();

        return \Redirect::route('company.quiz.index')->with('success','Registro creado exitosamente');
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
        $register = Quiz::find($id);
        return $this->customIndex($register);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuizRequest $request, $id)
    {
        //
//dd($request->nse_level_id);
        $register = Quiz::find($id);
        $register->name = $request->name;
        $register->is_active = (bool)$request->is_active;
        $register->nse_level_id = $request->nse_level_id=="" ? null : $request->nse_level_id;
        $register->points = $request->points;
        $register->state = $request->state ? $request->state : NULL;
        if($request->reactivate){
            $register->last_active = date('Y-m-d H:i:s');
        }
        $register->is_private = (bool)$request->is_private;
        if($register->is_private){
            $register->send_group_id = $request->send_group_id ? $request->send_group_id  : NULL;
        }else{
            $register->send_group_id = NULL;
        }
        $register->save();


        return \Redirect::route('company.quiz.index')->with('success','Registro actualizado exitosamente');
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
        $register = Quiz::find($id);
        if(!$register->canDelete()){
            return \Redirect::route('company.quiz.index')->with('error','El registro no se puede eliminar porque tiene registros asociados');
        }
        $register->delete();
        return \Redirect::route('company.quiz.index')->with('success','Registro eliminado exitosamente');
    }

    private function customIndex($register=false){
        $registers = Quiz::own();
        $nse_levels = NseLevel::ordered();
        $groups = SendGroup::allWithSecurity();

        return view('company.quiz.index')->with(compact('registers','register','nse_levels','groups'));
    }


    /**
     * Change status of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        //
        $register = Quiz::find($id);
        if($register->is_active){
            $register->is_active = false;
        }else{
            $register->is_active = true;
        }
        $register->save();
        return \Redirect::route('company.quiz.index')->with('success','Registro actualizado exitosamente');
    }



}
