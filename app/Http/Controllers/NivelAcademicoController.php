<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NivelAcademico;
use App\Persona;

class NivelAcademicoController extends Controller
{
  public function index(Request $request)
  {
    // return view('user.profile', ['user' => User::findOrFail($id)]);
    $user = Persona::find($request->session()->get("id"));
    $layout = $request->session()->get("layout");
    $data = NivelAcademico::all();
    return view('nivelacademico.index',["data" => $data, "layout" => $layout, "user" => $user]);
  }

  public function show(Request $request)
  {

    $busq = NivelAcademico::where("nac_cont",$request->id)->firstOrFail();;
    return response()->json($busq);
  }

  public function delete(Request $request)
  {
    $busq = NivelAcademico::where("nac_cont",$request->id)->delete();
    $response = array("mensaje" => "Acción completada con éxito", "tipo" => "success");
    return response()->json($response);
  }



  public function save(Request $request)
  {
    if ($request->ismethod('post')) {
      if ($request->nac_cont == '' || $request->nac_cont == null) {
        if (NivelAcademico::all()->count() > 0) {
          $ultimo = NivelAcademico::all()->max('nac_cont') + 1;
        }else {
          $ultimo = 1;
        }
        $nuevo = new NivelAcademico;
        $nuevo->nac_cont = $ultimo;

      }else {
        $nuevo = NivelAcademico::find($request->nac_cont);
      }
      $nuevo->nac_desc = $request->nac_desc;

      if ($nuevo -> save()) {
         $request->session()->flash('alert-success', 'Acción realizada con éxito');
      }else {
        $request->session()->flash('alert-danger', 'ocurrió un problema, intente de nuevo mas tarde o comuníquese con el administrador');

      }
      return redirect()->action('NivelAcademicoController@index');;

    }

  }
}
