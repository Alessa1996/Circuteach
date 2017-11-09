<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asignatura;
use App\Persona;

class AsignaturaController extends Controller
{
  public function index(Request $request)
  {
    $user = Persona::find($request->session()->get("id"));
    $layout = $request->session()->get("layout");
    $data = Asignatura::all();
    return view('asignatura.index',["data" => $data, "layout" => $layout,"user" => $user]);
  }

  public function show(Request $request)
  {
    $busq = Asignatura::where("asi_cont",$request->id)->firstOrFail();
    return response()->json($busq);
  }

  public function delete(Request $request)
  {
    $busq = Asignatura::where("asi_cont",$request->id)->delete();
    $response = array("mensaje" => "Acción completada con éxito", "tipo" => "success");
    return response()->json($response);
  }

  public function save(Request $request)
  {
    if ($request->ismethod('post')) {

      if ($request->asi_cont == '' || $request->asi_cont == null) {
        if (Asignatura::all()->count() > 0) {
          $ultimo = Asignatura::all()->max('asi_cont') + 1;
        }else {
          $ultimo = 1;
        }
        $nuevo = new Asignatura;
        $nuevo->asi_cont = $ultimo;

      }else {
        $nuevo = Asignatura::find($request->asi_cont);
      }

      $nuevo->asi_code = $request->asi_code;
      $nuevo->asi_desc = $request->asi_desc;
      $nuevo->asi_esta = $request->asi_esta;

      if ($nuevo -> save()) {

        $request->session()->flash('alert-success', 'Acción realizada con éxito');
      }else {
        $request->session()->flash('alert-danger', 'ocurrió un problema, intente de nuevo mas tarde o comuníquese con el administrador');

      }
      return redirect()->action('AsignaturaController@index');;

    }

  }
}
