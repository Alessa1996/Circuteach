<?php

namespace App\Http\Middleware;
use Session;
use Closure;

class Admin
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
      $data = Session::get('profile');
      if ($data != "gn_admi") {

          Session::flash('alert-danger', 'No tienes permiso para esta acción');
          
          return redirect()->back();


      }
      return $next($request);
    }
}
