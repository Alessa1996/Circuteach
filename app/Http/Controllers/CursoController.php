<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Curso;
use App\Asignatura;
use App\Docente;
use App\Catedra;
use App\Persona;
use App\Matricula;
use App\Estudiante;

class CursoController extends Controller
{
  public function index(Request $request)
  {
    $user = Persona::find($request->session()->get("id"));
    $layout = $request->session()->get("layout");
    if ($request->session()->get("profile") == "gn_admi") {
      $data = Curso::all();

      $f_doce = DB::table('gn_terc')
                       ->select(DB::raw('CONCAT(ter_iden," - ",UPPER(ter_pape)," ",UPPER(ter_sape)," ",UPPER(ter_pnom)) as full_name, ter_cont'))
                       ->whereRaw("tus_cont = 2 AND ter_cont IN (SELECT ter_cont FROM gn_doce WHERE gn_doce.ter_cont = gn_terc.ter_cont AND gn_doce.doc_cont IN (SELECT doc_cont FROM ac_cate WHERE ac_cate.doc_cont = gn_doce.doc_cont))")
                       ->get()
                       ->pluck("full_name","ter_cont");

      $f_naca = DB::table('ac_cate')
                      ->select(DB::raw('CONCAT((SELECT asi_desc FROM ac_asig WHERE ac_cate.asi_cont = ac_asig.asi_cont)," - ",(SELECT nac_desc FROM gn_naca WHERE ac_cate.nac_cont = gn_naca.nac_cont)) as cat_desc, cat_cont'))
                      // ->whereRaw("")
                      ->get()
                      ->pluck("cat_desc","cat_cont");
    }else {
      $data = Curso::where("cat_cont",Catedra::where("doc_cont",Docente::where("ter_cont",$user->ter_cont)->firstOrFail()->doc_cont)->firstOrFail()->cat_cont)->get();

      $f_doce = DB::table('gn_terc')
                       ->select(DB::raw('CONCAT(ter_iden," - ",UPPER(ter_pape)," ",UPPER(ter_sape)," ",UPPER(ter_pnom)) as full_name, ter_cont'))
                       ->whereRaw("tus_cont = 2 AND ter_cont IN (SELECT ter_cont FROM gn_doce WHERE gn_doce.ter_cont = gn_terc.ter_cont AND gn_doce.doc_cont IN (SELECT doc_cont FROM ac_cate WHERE ac_cate.doc_cont = gn_doce.doc_cont)) AND ter_cont = ?",$user->ter_cont)
                       ->get()
                       ->pluck("full_name","ter_cont");
      $f_naca = DB::table('ac_cate')
                     ->select(DB::raw('CONCAT((SELECT asi_desc FROM ac_asig WHERE ac_cate.asi_cont = ac_asig.asi_cont)," - ",(SELECT nac_desc FROM gn_naca WHERE ac_cate.nac_cont = gn_naca.nac_cont)) as cat_desc, cat_cont'))
                     ->whereRaw("doc_cont = ?",Docente::where("ter_cont",$user->ter_cont)->firstOrFail()->doc_cont)
                     ->get()
                     ->pluck("cat_desc","cat_cont");
    }




    return view('curso.index',["data" => $data, "layout" => $layout, "user" => $user, "f_doce" => $f_doce, "f_naca" => $f_naca]);
  }

  public function show(Request $request)
  {
    $busq = Curso::where("cur_cont",$request->id)->firstOrFail();
    return response()->json($busq);
  }

  public function delete(Request $request)
  {
    $busq = Curso::where("cur_cont",$request->id)->delete();
    $response = array("mensaje" => "Acción completada con éxito", "tipo" => "success");
    return response()->json($response);
  }

  public function save(Request $request)
  {
    if ($request->ismethod('post')) {

      if ($request->cur_cont == '' || $request->cur_cont == null) {
        if (Curso::all()->count() > 0) {
          $ultimo = Curso::all()->max('cur_cont') + 1;
        }else {
          $ultimo = 1;
        }
        $nuevo = new Curso;
        $nuevo->cur_cont = $ultimo;

      }else {
        $nuevo = Curso::find($request->cur_cont);
      }

      $nuevo->cat_cont = $request->cat_cont;
      $nuevo->cur_desc = $request->cur_desc;
      $nuevo->cur_fini = $request->cur_fini;
      $nuevo->cur_fina = $request->cur_fina;
      $nuevo->cur_esta = $request->cur_esta;
      $nuevo->cur_obge = $request->cur_obge;
      $nuevo->cur_obes = $request->cur_obes;

      if ($nuevo -> save()) {

        $request->session()->flash('alert-success', 'Acción realizada con éxito');
      }else {
        $request->session()->flash('alert-danger', 'ocurrió un problema, intente de nuevo mas tarde o comuníquese con el administrador');

      }
      return redirect()->action('CursoController@index');;

    }

  }

  public function my(Request $request)
  {
    $user = Persona::find($request->session()->get("id"));
    $layout = $request->session()->get("layout");
    $doce = false;
    $data = [];
    if ($request->session()->get("profile") == "gn_doce") {
      $docente = Docente::where("ter_cont",$user->ter_cont)->first()->doc_cont;
      $data = Catedra::where("doc_cont",$docente)->get();
      $doce = true;
    }

    if ($request->session()->get("profile") == "gn_estu") {
      $data = Matricula::where("est_cont",Estudiante::where("ter_cont",$user->ter_cont)->first()->est_cont)->get();
      // dd($data);
    }

    return view('curso.my',["data" => $data, "layout" => $layout, "user" => $user,"doce"=>$doce]);

  }
}
