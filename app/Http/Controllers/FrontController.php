<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
class FrontController extends Controller
{
    public function home(Request $request)
    {
      if ($request->session()->has('id')) {
        $user = Persona::find($request->session()->get("id"));

        $layout = $request->session()->get("layout");
        return view('home.index',["layout" => $layout,"user"=>$user]);

      }else {
        $request->session()->flash('alert-danger', 'Inicie sesión para continuar');
        return redirect()->route("login");

      }
    }
    public function profile(Request $request,$profile)
    {
      if ($request->session()->has('id')) {
        $layout = "default";
        if (($request->session()->get("profile") == "gn_doce" || $request->session()->get("profile") == "gn_admi") && $profile == "docente") {
          $layout = "docente";
        }
        if ($request->session()->get("profile") == "gn_estu" && $profile == "estudiante") {
          $layout = "estudiante";
        }
        if ($request->session()->get("profile") == "gn_admi" && $profile == "administrador") {
          $layout = "admin";
        }
        if ($layout == "default") {
          $request->session()->flash('alert-warning', 'No tienes permiso para este módulo, acción automática: Reasignar modulo de vista anterior: '.$request->session()->get("layout"));
          $request->session()->put('layout', $request->session()->get("layout"));

        }else {
          $request->session()->flash('alert-success', 'Has cambiado tu modulo de vista a '.$layout);
          $request->session()->put('layout', $layout);

        }
        return redirect()->back();
      }else {
        $request->session()->flash('alert-danger', 'Inicie sesión para continuar');
        return redirect()->route("login");
      }

    }
}
