<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use \Crypt;
use App\Persona;
use App\Admin;

class AdminController extends Controller
{
  public function index(Request $request)
  {
    // return view('user.profile', ['user' => User::findOrFail($id)]);
    $data = Admin::all();
    $user = Persona::find($request->session()->get("id"));
    $layout = $request->session()->get("layout");
    $f_terc = DB::table('gn_terc')
                     ->select(DB::raw('CONCAT(ter_iden," - ",UPPER(ter_pape)," ",UPPER(ter_sape)," ",UPPER(ter_pnom)) as full_name, ter_cont'))
                     ->whereRaw("tus_cont = 1")
                     ->get()
                     ->pluck("full_name","ter_cont");

    return view('admin.index',["data" => $data, "layout" => $layout,"user" => $user, "f_terc" => $f_terc]);
  }

  public function show(Request $request)
  {
    $busq = Admin::where("adm_cont",$request->id)->firstOrFail();
    return response()->json($busq);
  }


  public function delete(Request $request)
  {
    $busq = Admin::where("adm_cont",$request->id)->delete();
    $response = array("mensaje" => "Acción completada con éxito", "tipo" => "success");
    return response()->json($response);
  }

  public function save(Request $request)
  {
    if ($request->ismethod('post')) {

      if ($request->adm_cont == '' || $request->adm_cont == null) {
        if (Admin::all()->count() > 0) {
          $ultimo = Admin::all()->max('adm_cont') + 1;
        }else {
          $ultimo = 1;
        }
        $nuevo = new Admin;
        $nuevo->adm_cont = $ultimo;

      }else {
        $nuevo = Admin::find($request->adm_cont);
      }

      $nuevo->adm_usu = Persona::where("ter_cont",$request->ter_cont)->firstOrFail()->ter_iden;
      $nuevo->adm_pass = sha1($request->adm_pass);
      $nuevo->adm_esta = $request->adm_esta;
      $nuevo->ter_cont = $request->ter_cont;
      $nuevo->adm_oln = 0;

      if ($nuevo -> save()) {

        $request->session()->flash('alert-success', 'Acción realizada con éxito');
      }else {
        $request->session()->flash('alert-danger', 'ocurrió un problema, intente de nuevo mas tarde o comuníquese con el administrador');

      }
      return redirect()->action('AdminController@index');;

    }

  }
}
