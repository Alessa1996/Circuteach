<?php

namespace App\Http\Middleware;
use Session;
use Closure;

class Login
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
      $data = Session::has('id');
      if (!$data) {

          session(['layout' => "default"]);
          Session::flash('alert-danger', 'Inicie sesión para continuar');
          return redirect()->route('login');

      }
      return $next($request);
    }
}
