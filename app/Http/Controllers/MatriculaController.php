<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\Matricula;
use App\Curso;
use App\Estudiante;

class MatriculaController extends Controller
{
    public function index(Request $request,$cur_cont)
    {
      $user = Persona::find($request->session()->get("id"));
      $layout = $request->session()->get("layout");
      $master = Curso::find($cur_cont);
      return view('matricula.index',["layout" => $layout, "user" => $user,"master"=>$master]);

    }

    public function save(Request $request)
    {
      if ($request->ismethod('post')) {
        $nuevo = new Matricula;
        if (Matricula::all()->count() > 0) {
          $ultimo = Matricula::all()->max('mat_cont') + 1;
        }else {
          $ultimo = 1;
        }
        $nuevo->mat_cont = $ultimo;
        $nuevo->cur_cont = $request->cur_cont;
        $nuevo->est_cont = $request->est_cont;
        $nuevo->mat_esta = 1;

        if ($nuevo->save()) {
          $array = ["mensaje" => "Matricula exitosa","tipo" => "success"];
        }else {
          $array = ["mensaje" => "Error inesperado, intente mas tarde o consulte el administrador","tipo" => "error"];
        }
        return response()->json($array);
      }
    }

    public function delete(Request $request)
    {
      if ($request->ismethod('post')) {
        
        $nuevo = Matricula::find($request->mat_cont);
        if ($nuevo->delete()) {
          $array = ["mensaje" => "Eliminación exitosa, en lo posible evite eliminar registros","tipo" => "warning"];
        }else {
          $array = ["mensaje" => "Error inesperado, intente mas tarde o consulte el administrador","tipo" => "error"];
        }
        return response()->json($array);
      }
    }

    public function status(Request $request)
    {
      if ($request->ismethod('post')) {
        if ($data->ac_curs()->first()->ac_cate()->first()->gn_doce()->first()->gn_terc()->first()->ter_cont == $request->session()->get('id') || $request->session()->get('profile') == "gn_admi") {
          $data = Matricula::find($request->mat_cont);
          if ($data->mat_esta == 0) {
            $status = 1;
          }else {
            $status = 0;
          }
          $data->mat_esta = $status;
          if ($data->save()) {
            $array = ["mensaje" => "Actualización de estado exitosa","tipo" => "success"];
          }else {
            $array = ["mensaje" => "Error inesperado, intente mas tarde o consulte el administrador","tipo" => "error"];
          }
        }else {
          $array = ["mensaje" => "No tiene permisos para esta acción","tipo" => "error"];

        }

        return response()->json($array);
      }
    }

    public function listarmatricula(Request $request,$cur_cont)
    {
      $data = Matricula::where("cur_cont",$cur_cont)->get();
      $array = array();
      // $data = Persona::all();
      foreach ($data as $data) {
        if ($data->mat_esta == 1) {
          $button = "<a onclick='status(".$data->mat_cont.")' class='btn btn-success btn-xs'> Activo</a>";

        }else {
          $button = "<a onclick='status(".$data->mat_cont.")' class='btn btn-danger btn-xs'> Inactivo</a>";

        }
        if ($request->session()->get('profile') == "gn_admi") {
          $button.= "<a onclick='del(".$data->mat_cont.")' class='btn btn-danger btn-xs'> Eliminar</a>";
        }
        $terc = $data->gn_estu()->first()->gn_terc()->first();
        $nombre = $terc->ter_pnom." ".$terc->ter_snom." ".$terc->ter_pape." ".$terc->ter_sape;
        $naca = $data->gn_estu()->first()->gn_naca()->first()->nac_desc;
        $array[] = [$terc->ter_iden,$nombre,$naca,$button];

      //   $array[] = [$data->gn_estu()->first()->gn_terc()->first()->ter_pnom,"hola"];
      }

      return response()->json(["data" => ($array)]);

    }

    public function listarestudiante(Request $request,$cur_cont)
    {
      $data = Estudiante::whereRaw("est_esta = 1 AND est_cont NOT IN (select est_cont from cu_matri where cu_matri.est_cont = gn_estu.est_cont)")->get();
      // dd($data);
      $array = array();
      // $data = Persona::all();
      foreach ($data as $data) {
        $button = "<a onclick='matricula(".$cur_cont.",".$data->est_cont.")' class='btn btn-primary btn-xs'> Matricular</a>";

        $terc = $data->gn_terc()->first();
        $nombre = $terc->ter_pnom." ".$terc->ter_snom." ".$terc->ter_pape." ".$terc->ter_sape;
        $naca = $data->gn_naca()->first()->nac_desc;
        $array[] = [$terc->ter_iden,$nombre,$naca,$button];

      //   $array[] = [$data->gn_estu()->first()->gn_terc()->first()->ter_pnom,"hola"];
      }

      return response()->json(["data" => ($array)]);

    }

}
