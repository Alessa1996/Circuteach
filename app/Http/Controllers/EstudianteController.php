<?php

namespace App\Http\Controllers;
use DB;
use \Crypt;
use App\Persona;
use App\Estudiante;
use App\NivelAcademico;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
  public function index(Request $request)
  {
    // return view('user.profile', ['user' => User::findOrFail($id)]);
    $data = Estudiante::all();
    $user = Persona::find($request->session()->get("id"));
    $layout = $request->session()->get("layout");
    $f_terc = DB::table('gn_terc')
                     ->select(DB::raw('CONCAT(ter_iden," - ",UPPER(ter_pape)," ",UPPER(ter_sape)," ",UPPER(ter_pnom)) as full_name, ter_cont'))
                     ->whereRaw("tus_cont = 3")
                     ->get()
                     ->pluck("full_name","ter_cont");
    $f_naca = NivelAcademico::all()->pluck("nac_desc","nac_cont");

    return view('estudiante.index',["data" => $data, "layout" => $layout,"user" => $user, "f_terc" => $f_terc, "f_naca" => $f_naca]);
  }

  public function show(Request $request)
  {
    $busq = Estudiante::where("est_cont",$request->id)->firstOrFail();
    return response()->json($busq);
  }

  public function delete(Request $request)
  {
    $busq = Estudiante::where("est_cont",$request->id)->delete();
    $response = array("mensaje" => "Acción completada con éxito", "tipo" => "success");
    return response()->json($response);
  }

  public function save(Request $request)
  {
    if ($request->ismethod('post')) {

      if ($request->est_cont == '' || $request->est_cont == null) {
        if (Estudiante::all()->count() > 0) {
          $ultimo = Estudiante::all()->max('est_cont') + 1;
        }else {
          $ultimo = 1;
        }
        $nuevo = new Estudiante;
        $nuevo->est_cont = $ultimo;

      }else {
        $nuevo = Estudiante::find($request->est_cont);
      }

      $nuevo->est_usu = Persona::where("ter_cont",$request->ter_cont)->firstOrFail()->ter_iden;
      $nuevo->est_pass = sha1($request->est_pass);
      $nuevo->est_esta = $request->est_esta;
      $nuevo->ter_cont = $request->ter_cont;
      $nuevo->nac_cont = $request->nac_cont;
      $nuevo->est_oln = 0;

      if ($nuevo -> save()) {

        $request->session()->flash('alert-success', 'Acción realizada con éxito');
      }else {
        $request->session()->flash('alert-danger', 'ocurrió un problema, intente de nuevo mas tarde o comuníquese con el administrador');

      }
      return redirect()->action('EstudianteController@index');;

    }

  }
}
