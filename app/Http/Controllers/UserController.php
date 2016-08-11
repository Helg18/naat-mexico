<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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


        $this->ownRoute = \Auth::user() ? \Auth::user()->is('customer') ? 'company.user' : 'config.user' : false;
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
    public function store(UserRequest $request)
    {
        if(\Auth::user()->is('customer')){
            $request->role_id = 3;
        }
        //
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->is_active = (bool)$request->is_active;
        $user->save();
        $user->assignRole($request->role_id);

        if(\Auth::user()->is('customer')){
            \Auth::user()->company()->users()->attach([$user->id]);
        }

        return \Redirect::route($this->ownRoute .'.index')->with('success','Usuario registrado exitosamente');
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
        $user = User::find($id);
        return $this->customIndex($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        //

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->is_active = (bool)$request->is_active;
        $user->save();

        if(!\Auth::user()->is('customer')) {

            $user->revokeAllRoles();
            $user->assignRole($request->role_id);
        }

        return \Redirect::route($this->ownRoute .'.index')->with('success','Usuario actualizado exitosamente');
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
        $user = User::find($id);
        if(!$user->canDelete()){
            return \Redirect::route($this->ownRoute .'.index')->with('error','El usuario no se puede eliminar porque tiene registros asociados');
        }
        $user->delete();
        return \Redirect::route($this->ownRoute .'.index')->with('success','Usuario eliminado exitosamente');
    }

    private function customIndex($user=false){
        $module = Auth::user()->is('customer') ? 'company/user' : 'config/user';
        $users = User::allWithSecurity();
        $roles = Auth::user()->canRoles();
        return view('config.user.index')->with(compact('users','user','roles','module'));
    }


    /**
     * Change status of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        //
        $user = User::find($id);
        if($user->is_active){
            $user->is_active = false;
        }else{
            $user->is_active = true;
        }
        $user->save();
        return \Redirect::route($this->ownRoute .'.index')->with('success','Usuario actualizado exitosamente');
    }
}
