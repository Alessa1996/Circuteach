<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Persona;
use App\TipoDocumento;
use App\TipoUsuario;

class PersonaController extends Controller
{


  public function index(Request $request)
  {
    // return view('user.profile', ['user' => User::findOrFail($id)]);
    $user = Persona::find($request->session()->get("id"));
    $layout = $request->session()->get("layout");
    $data = Persona::all();
    $f_tdoc = TipoDocumento::pluck('tdo_desc', 'tdo_cont');
    $f_tusu = TipoUsuario::pluck('tus_desc', 'tus_cont');

    return view('persona.index',["data" => $data, "layout" => $layout, "user" => $user, "f_tdoc" => $f_tdoc, "f_tusu" => $f_tusu]);
  }

  public function show(Request $request)
  {
    $busq = Persona::where("ter_cont",$request->id)->firstOrFail();
    return response()->json($busq);
  }

  public function search(Request $request)
  {
    $busq = Persona::where("ter_cont",$request->id)->firstOrFail();
    return response()->json($busq);
  }

  public function delete(Request $request)
  {
    $busq = Persona::where("ter_cont",$request->id)->delete();
    $response = array("mensaje" => "Acción completada con éxito", "tipo" => "success");
    return response()->json($response);
  }

  public function save(Request $request)
  {
    if ($request->ismethod('post')) {

      if ($request->ter_cont == '' || $request->ter_cont == null) {
        if (Persona::all()->count() > 0) {
          $ultimo = Persona::all()->max('ter_cont') + 1;
        }else {
          $ultimo = 1;
        }
        $nuevo = new Persona;
        $nuevo->ter_cont = $ultimo;

      }else {
        $nuevo = Persona::find($request->ter_cont);
      }

      $nuevo->ter_iden = $request->ter_iden;
      $nuevo->ter_pnom = $request->ter_pnom;
      $nuevo->ter_snom = $request->ter_snom;
      $nuevo->ter_pape = $request->ter_pape;
      $nuevo->ter_sape = $request->ter_sape;
      $nuevo->ter_corre = $request->ter_corre;
      $nuevo->ter_tel = $request->ter_tel;
      $nuevo->tdo_cont = $request->tdo_cont;
      $nuevo->tus_cont = $request->tus_cont;

      if ($nuevo -> save()) {

        $request->session()->flash('alert-success', 'Acción realizada con éxito');
      }else {
        $request->session()->flash('alert-danger', 'ocurrió un problema, intente de nuevo mas tarde o comuníquese con el administrador');

      }
      return redirect()->action('PersonaController@index');;

    }

  }




}
