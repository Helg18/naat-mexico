<?php

namespace App\Http\Controllers;

use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Plan;
use App\Models\User;

use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ResetsPasswords;

class CompanyController extends Controller
{
    use ResetsPasswords;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('module');
        $this->subject = 'Bienvenido a Genius';
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
    public function store(CompanyRequest $request)
    {
        //

        $register = new Company();
        $register->user_id = \Auth::user()->id;
        $register->name = $request->name;
        $register->information = $request->information;
        $register->is_active = (bool)$request->is_active;
        $register->save();
        $register->makePurchase($request->plan_id);


        //Default User
        $role = Role::where('slug','customer')->first();
        $user = new User();
        $user->name = $request->user_name;
        $user->email = $request->email;
        $user->password = time();
        $user->is_active = 1;
        $user->save();
        $user->assignRole($role->id);

        $register->users()->sync([$user->id]);

        $this->sendResetLinkEmail($request);


        return \Redirect::route('companies.index')->with('success','Registro creado exitosamente');
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
        $register = Company::find($id);
        return $this->customIndex($register);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, $id)
    {
        //

        $register = Company::find($id);
        $register->name = $request->name;
        $register->information = $request->information;
        $register->is_active = (bool)$request->is_active;
        $register->save();


        return \Redirect::route('companies.index')->with('success','Registro actualizado exitosamente');
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
        $register = Company::find($id);
        if(!$register->canDelete()){
            return \Redirect::route('companies.index')->with('error','El registro no se puede eliminar porque tiene registros asociados');
        }

        foreach($register->users() as $u){
            $u->delete();
        }
        $register->delete();
        return \Redirect::route('companies.index')->with('success','Registro eliminado exitosamente');
    }

    private function customIndex($register=false){


        $registers = Company::allByRole();
        $plans = Plan::actives();

        return view('companies.index')->with(compact('registers','register','plans'));
    }


    /**
     * Change status of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        //
        $register = Company::find($id);
        if($register->is_active){
            $register->is_active = false;
        }else{
            $register->is_active = true;
        }
        $register->save();
        return \Redirect::route('companies.index')->with('success','Registro actualizado exitosamente');
    }


    public function plan($id)
    {
        $plan = Plan::find($id);
        return view('companies.plan_info')->with(compact('plan'));
    }
}
