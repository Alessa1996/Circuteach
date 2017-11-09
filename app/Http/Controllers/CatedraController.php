<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\NivelAcademico;
use App\Catedra;
use App\Asignatura;
use App\Docente;
use App\Persona;

class CatedraController extends Controller
{
  public function index(Request $request)
  {
    $user = Persona::find($request->session()->get("id"));
    $layout = $request->session()->get("layout");
    if ($request->session()->get("profile") == "gn_admi") {
      $data = Catedra::all();
      $f_doce = DB::table('gn_terc')
                       ->select(DB::raw('CONCAT(ter_iden," - ",UPPER(ter_pape)," ",UPPER(ter_sape)," ",UPPER(ter_pnom)) as full_name, ter_cont'))
                       ->whereRaw("tus_cont = 2 AND ter_cont IN (SELECT ter_cont FROM gn_doce where gn_doce.ter_cont = gn_terc.ter_cont)")
                       ->get()
                       ->pluck("full_name","ter_cont");
    }else {
      $data = Catedra::where("doc_cont",Docente::where("ter_cont",$user->ter_cont)->firstOrFail()->doc_cont)->get();
      $f_doce = DB::table('gn_terc')
                       ->select(DB::raw('CONCAT(ter_iden," - ",UPPER(ter_pape)," ",UPPER(ter_sape)," ",UPPER(ter_pnom)) as full_name, ter_cont'))
                       ->whereRaw("tus_cont = 2 AND ter_cont IN (SELECT ter_cont FROM gn_doce where gn_doce.ter_cont = gn_terc.ter_cont) AND ter_cont = ?",$user->ter_cont)
                       ->get()
                       ->pluck("full_name","ter_cont");
    }
    $f_naca = NivelAcademico::all()->pluck("nac_desc","nac_cont");
    $f_asig = Asignatura::all()->pluck("asi_desc","asi_cont");



    return view('catedra.index',["data" => $data, "layout" => $layout,"user" => $user, "f_doce" => $f_doce, "f_asig" => $f_asig, "f_naca" => $f_naca]);
  }

  public function show(Request $request)
  {
    $busq = Catedra::where("cat_cont",$request->id)->firstOrFail();
    $busq->doc_cont = Docente::where("doc_cont",$busq->doc_cont)->firstOrFail()->ter_cont;
    return response()->json($busq);
  }

  public function delete(Request $request)
  {
    $busq = Catedra::where("cat_cont",$request->id)->delete();
    $response = array("mensaje" => "Acción completada con éxito", "tipo" => "success");
    return response()->json($response);
  }

  public function search(Request $request)
  {
    $busq = DB::table('ac_cate')
                     ->select(DB::raw('(SELECT ter_cont FROM gn_doce WHERE gn_doce.doc_cont = ac_cate.doc_cont) as ter_cont'))
                     ->whereRaw("cat_cont = ?",$request->id)
                     ->get()->first();
    return response()->json($busq);
  }

  public function save(Request $request)
  {
    if ($request->ismethod('post')) {

      if ($request->cat_cont == '' || $request->cat_cont == null) {
        if (Catedra::all()->count() > 0) {
          $ultimo = Catedra::all()->max('cat_cont') + 1;
        }else {
          $ultimo = 1;
        }
        $nuevo = new Catedra;
        $nuevo->cat_cont = $ultimo;

      }else {
        $nuevo = Catedra::find($request->cat_cont);
      }

      $nuevo->asi_cont = $request->asi_cont;
      $nuevo->doc_cont = Docente::where("ter_cont",$request->doc_cont)->firstOrFail()->doc_cont;
      $nuevo->cat_esta = $request->cat_esta;
      $nuevo->nac_cont = $request->nac_cont;

      if ($nuevo -> save()) {

        $request->session()->flash('alert-success', 'Acción realizada con éxito');
      }else {
        $request->session()->flash('alert-danger', 'ocurrió un problema, intente de nuevo mas tarde o comuníquese con el administrador');

      }
      return redirect()->action('CatedraController@index');;

    }

  }
}
