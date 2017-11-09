<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Actividad;
use App\Persona;
use DB;
use \Crypt;
use Illuminate\Http\Request;

class ActividadController extends Controller
{

  // public function _construct()
  // {
  //   $this->middleware('login',["except" => 'show','downloadActivityFile']);
  // }


  public function index(Request $request,$cur_cont)
  {
    $user = Persona::find($request->session()->get("id"));
    $data = Actividad::where("cur_cont",$cur_cont)->get();
    $master = Curso::find($cur_cont);
    $layout = $request->session()->get("layout");
    $edit = false;
    if ($master->ac_cate()->first()->gn_doce()->first()->ter_cont == $user->ter_cont || $request->session()->get("profile") == "gn_admi") {
      $edit = true;
    }


    return view('actividad.index',["layout" => $layout, "edit"=>$edit,"user" => $user, "data" => $data, "master" => $master]);
  }
  public function create(Request $request,$cur_cont)
  {
    $user = Persona::find($request->session()->get("id"));
    $master = Curso::find($cur_cont);
    if ($master->ac_cate()->first()->gn_doce()->first()->ter_cont != $user->ter_cont && $request->session()->get("profile") != "gn_admi") {
      $request->session()->flash('alert-danger', 'No tiene permisos de edición en este módulo');
      return redirect()->back();
    }
    $layout = $request->session()->get("layout");

    return view('actividad.new',["layout" => $layout, "user" => $user , "cur_cont" => $cur_cont,"master" => $master]);

  }
  public function save(Request $request)
  {
    if($request->ismethod('post')){

      // dd(str_replace('T', ' ',$request->act_fini).":00");
      if ($request->act_cont == '' || $request->act_cont == null) {
        if (Actividad::all()->count() > 0) {
          $ultimo = Actividad::all()->max('act_cont') + 1;
        }else {
          $ultimo = 1;
        }
        $nuevo = new Actividad;
        $nuevo->act_cont = $ultimo;
        // $nuevo->act_fini = $request->act_fini;
        // $nuevo->act_fina = $request->act_fina;

      }else {
        $nuevo = Actividad::find($request->act_cont);

      }
      $nuevo->act_titu = $request->act_titu;
      $nuevo->act_desc = $request->act_desc;
      $nuevo->cur_cont = $request->cur_cont;
      $nuevo->act_fini = str_replace('T', ' ',$request->act_fini).":00";
      $nuevo->act_fina = str_replace('T', ' ',$request->act_fina).":00";
      
      if ($request->act_val) {
        $nuevo->act_vali = $request->act_vali;
      }

      if ($request->act_vid) {

        $nuevo->act_vid = sha1($nuevo->act_cont) . '.' . $request->act_vid->getClientOriginalExtension();
        $filename = sha1($nuevo->act_cont) . '.' . $request->act_vid->getClientOriginalExtension();
        $path = public_path('images/act_vide/');
        $request->act_vid->move($path, $filename);
      }

      if ($request->act_img) {
        $nuevo->act_img = sha1($nuevo->act_cont) . '.' . $request->act_img->getClientOriginalExtension();
        $filename = sha1($nuevo->act_cont) . '.' . $request->act_img->getClientOriginalExtension();
        $path = public_path('images/act_img/');
        $request->act_img->move($path, $filename);
      }

      if ($request->act_file) {
        $nuevo->act_file = sha1($nuevo->act_cont) . '.' . $request->act_file->getClientOriginalExtension();
        $filename = sha1($nuevo->act_cont) . '.' . $request->act_file->getClientOriginalExtension();
        $path = public_path('images/act_file/');
        $request->act_file->move($path, $filename);
      }


      if ($nuevo -> save()) {

        $request->session()->flash('alert-success', 'Acción realizada con éxito');
      }else {
        $request->session()->flash('alert-danger', 'ocurrió un problema, intente de nuevo mas tarde o comuníquese con el administrador');

      }
      return redirect()->route("actindex",["cur_cont" => $request->cur_cont]);
    }
  }

  public function edit(Request $request,$cur_cont,$act_cont)
  {
    $user = Persona::find($request->session()->get("id"));
    $data = Actividad::find($act_cont);
    $master = Curso::find($cur_cont);
    if (!$data || !$master) {
      $request->session()->flash('alert-danger', 'No se encontró la entrega con identificador '. $art_cont);
      return redirect()->back();
    }
    if ($master->ac_cate()->first()->gn_doce()->first()->ter_cont != $user->ter_cont && $request->session()->get("profile") != "gn_admi") {
      $request->session()->flash('alert-danger', 'No tiene permisos de edición en este módulo');
      return redirect()->back();
    }
    $layout = $request->session()->get("layout");

    return view('actividad.edit',["layout" => $layout, "user" => $user , "master" => $master,"data" => $data]);
  }

  public function show(Request $request,$cur_cont,$act_cont)
  {
    $user = Persona::find($request->session()->get("id"));
    $data = Actividad::find($act_cont);
    $master = Curso::find($cur_cont);
    if (!$data || !$master) {
      $request->session()->flash('alert-danger', 'No se encontró el artículo con identificador '. $art_cont);
      return redirect()->back();
    }
    $layout = $request->session()->get("layout");
    if (!$layout) {
      $layout = "default";
    }
    return view('actividad.show',["layout" => $layout, "user" => $user , "master" => $master,"data" => $data]);
  }




  public function downloadActivityFile($act_file)
  {
    $file=public_path("images/act_file/").$act_file;
    $titulo = Actividad::where("act_file",$act_file)->firstOrFail()->act_titu;
    return response()->download($file, $titulo.".".pathinfo($act_file)["extension"]);

  }
}
