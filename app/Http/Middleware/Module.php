<?php

namespace App\Http\Middleware;

use Closure;
use Caffeinated\Shinobi\Facades\Shinobi;
use App\Models\User;

class Module
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $controller = $request->segment(1);


        if (!Shinobi::can("{$controller}.access")) {
            // Do whatever
            //dd("hola");
            $request->session()->flash('error', 'No tiene permisos para accesar a este modulo');
            return redirect('/');
        }


        return $next($request);
    }
}
