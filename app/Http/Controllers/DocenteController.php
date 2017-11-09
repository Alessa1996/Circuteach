<?php

namespace App\Http\Controllers;
use DB;
use \Crypt;
use App\Persona;
use App\Docente;
use Illuminate\Http\Request;


class DocenteController extends Controller
{
  public function index(Request $request)
  {
    // return view('user.profile', ['user' => User::findOrFail($id)]);
    $data = Docente::all();
    $user = Persona::find($request->session()->get("id"));
    $layout = $request->session()->get("layout");
    $f_terc = DB::table('gn_terc')
                     ->select(DB::raw('CONCAT(ter_iden," - ",UPPER(ter_pape)," ",UPPER(ter_sape)," ",UPPER(ter_pnom)) as full_name, ter_cont'))
                     ->whereRaw("tus_cont = 2")
                     ->get()
                     ->pluck("full_name","ter_cont");

    return view('docente.index',["data" => $data, "layout" => $layout, "user" => $user, "f_terc" => $f_terc]);
  }

  public function show(Request $request)
  {
    $busq = Docente::where("doc_cont",$request->id)->firstOrFail();
    return response()->json($busq);
  }

  public function delete(Request $request)
  {
    $busq = Docente::where("doc_cont",$request->id)->delete();
    $response = array("mensaje" => "Acción completada con éxito", "tipo" => "success");
    return response()->json($response);
  }

  public function save(Request $request)
  {
    if ($request->ismethod('post')) {

      if ($request->doc_cont == '' || $request->doc_cont == null) {
        if (Docente::all()->count() > 0) {
          $ultimo = Docente::all()->max('doc_cont') + 1;
        }else {
          $ultimo = 1;
        }
        $nuevo = new Docente;
        $nuevo->doc_cont = $ultimo;

      }else {
        $nuevo = Docente::find($request->doc_cont);
      }

      $nuevo->doc_usu = Persona::where("ter_cont",$request->ter_cont)->firstOrFail()->ter_iden;
      $nuevo->doc_pass = sha1($request->doc_pass);
      $nuevo->doc_esta = $request->doc_esta;
      $nuevo->ter_cont = $request->ter_cont;
      $nuevo->doc_oln = 0;

      if ($nuevo -> save()) {

        $request->session()->flash('alert-success', 'Acción realizada con éxito');
      }else {
        $request->session()->flash('alert-danger', 'ocurrió un problema, intente de nuevo mas tarde o comuníquese con el administrador');

      }
      return redirect()->action('DocenteController@index');;

    }

  }
}
