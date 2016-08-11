<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Quiz;
use App\Models\Company;

class NseController extends Controller
{
    //
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

    public function index(){
        $register = Company::quiz_nse();
        //dd($register);
        return view('nse.quiz.index')->with(compact('register'));
    }
}
