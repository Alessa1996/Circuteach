<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\Actividad;
use App\Entrega;
use App\Matricula;
use App\Estudiante;
use App\Docente;
use DB;

class EntregaController extends Controller
{
  public function index(Request $request,$act_cont)
  {
    $user = Persona::find($request->session()->get("id"));
    $master = Actividad::find($act_cont);
    $estudiante = Estudiante::where("ter_cont",$user->ter_cont)->first();
    $layout = $request->session()->get("layout");
    $edit = false;
    $data = Entrega::where("act_cont",$act_cont)->get();
    $doce = false;


    if (!$master) {
      $request->session()->flash('alert-danger', 'No se encontró actividad');
      return redirect()->back();
    }

    if ($estudiante) {
      $matricula = Matricula::whereRaw("cur_cont = ? AND est_cont = ?",[$master->ac_curs()->first()->cur_cont,$estudiante->est_cont])->first();
      if (!$matricula) {
        $request->session()->flash('alert-danger', 'Lo sentimos, usted no se encuentra matriculado en este curso');
        return redirect()->back();
      }
      $edit = true;
      $data = Entrega::whereRaw("act_cont = ? AND mat_cont = ?",[$act_cont,$matricula->mat_cont])->get();
      // dd($data);
    }

    // dd($data);
    if ($master->ac_curs()->first()->ac_cate()->first()->gn_doce() != null) {
      if ($master->ac_curs()->first()->ac_cate()->first()->gn_doce()->first()->ter_cont == $user->ter_cont || $request->session()->get("profile") == "gn_admi") {
        $doce = true;
      }
    }

    return view('entrega.index',["layout" => $layout, "edit" => $edit, "doce" => $doce,"user" => $user, "data" => $data, "master" => $master]);
  }

  public function create(Request $request, $act_cont)
  {
    $user = Persona::find($request->session()->get("id"));
    $master = Actividad::whereRaw("act_cont = ?",$act_cont)->first(); // AND NOW() BETWEEN act_fini AND act_fina
    $estudiante = Estudiante::where("ter_cont",$user->ter_cont)->first();

    if (!$master) {
      $request->session()->flash('alert-danger', 'No se encontró la actividad o se encuentra vencida por tiempo');
      return redirect()->back();
    }
    $matricula = Matricula::whereRaw("est_cont = ? AND cur_cont = ?",[$estudiante->est_cont,$master->ac_curs()->first()->cur_cont])->first();
    $entrega = Entrega::whereRaw("act_cont = ? AND mat_cont = ?",[$act_cont,$matricula->mat_cont])->first();
    // dd($entrega);
    if ($entrega) {
      $request->session()->flash('alert-danger', 'Ya tiene registrada una entrega, si lo desea puede editarla');
      return redirect()->route('entedit',['act_cont' => $act_cont,'ent_cont' => $entrega->ent_cont]);
    }
    if (!$estudiante) {
      $request->session()->flash('alert-danger', 'No tiene permisos de edición en este módulo');
      return redirect()->back();
    }

    $matricula = Matricula::whereRaw("cur_cont = ? AND est_cont = ?",[$master->ac_curs()->first()->cur_cont,$estudiante->est_cont])->first();

    if (!$matricula) {
      $request->session()->flash('alert-danger', 'Lo sentimos, usted no se encuentra matriculado en este curso');
      return redirect()->back();
    }

    $layout = $request->session()->get("layout");

    return view('entrega.new',["layout" => $layout, "user" => $user , "act_cont" => $act_cont,"master" => $master]);
  }

  public function show(Request $request,$act_cont,$ent_cont)
  {
    $user = Persona::find($request->session()->get("id"));
    // dd($user);
    $data = Entrega::find($ent_cont);
    $master = Actividad::find($act_cont);
    $layout = $request->session()->get("layout");
    if (!$data || !$master) {
      $request->session()->flash('alert-danger', 'No se encontró la entrega');
      return redirect()->back();
    }
    if (!$layout) {
      $layout = "default";
    }
    $doce = false;
    if ($user != null) {
      if ($master->ac_curs()->first()->ac_cate()->first()->gn_doce()->first()->ter_cont == $user->ter_cont) {
        $doce = true;
      }
    }

    // $estudiante = Estudiante::where("ter_cont",$user->ter_cont)->first();
    // dd($estudiante);
    // $estudiante = Matricula::whereRaw("est_cont = ? AND cur_cont = ?",[$estudiante->est_cont,$master->cur_cont])->first();
    // $estu = false;
    // if ($estudiante) {
    //   $estu = true;
    // }

    return view('entrega.show',["layout" => $layout,"user" => $user,"doce" => $doce ,"data" => $data, "master" => $master]);

  }

  public function edit(Request $request,$act_cont,$ent_cont)
  {
    $user = Persona::find($request->session()->get("id"));
    $data = Entrega::find($ent_cont);
    $master = Actividad::find($act_cont);
    if (!$data || !$master) {
      $request->session()->flash('alert-danger', 'No se encontró la entrega');
      return redirect()->back();
    }
    if ($data->cu_matri()->first()->gn_estu()->first()->ter_cont != $user->ter_cont) {
      $request->session()->flash('alert-danger', 'No tiene permisos de edición en este módulo');
      return redirect()->back();
    }
    $layout = $request->session()->get("layout");

    return view('entrega.edit',["layout" => $layout, "user" => $user , "master" => $master,"data" => $data]);
  }

  public function save(Request $request)
  {
    if($request->ismethod('post')){

      // dd(str_replace('T', ' ',$request->act_fini).":00");
      if ($request->ent_cont == '' || $request->ent_cont == null) {
        if (Actividad::all()->count() > 0) {
          $ultimo = Actividad::all()->max('ent_cont') + 1;
        }else {
          $ultimo = 1;
        }
        $nuevo = new Entrega;
        $nuevo->ent_cont = $ultimo;
        // $nuevo->act_fini = $request->act_fini;
        // $nuevo->act_fina = $request->act_fina;

      }else {
        $nuevo = Entrega::find($request->ent_cont);

      }
      $nuevo->ent_titu = $request->ent_titu;
      $nuevo->ent_desc = $request->ent_desc;
      $estudiante = Estudiante::where("ter_cont",$request->session()->get("id"))->first();
      $actividad = Actividad::where("act_cont",$request->act_cont)->first();
      $matricula = Matricula::whereRaw("est_cont = ? AND cur_cont = ?",[$estudiante->est_cont,$actividad->ac_curs()->first()->cur_cont])->first();


      if (!$matricula) {
        $request->session()->flash('alert-danger', 'No se encuentra matriculado para realizar esta acción');
        return redirect()->back();
      }

      if ($nuevo->ent_cali != null) {
        $request->session()->flash('alert-danger', 'No puede realizar esta acción debido a que la actividad ya le ha sido calificada');
        return redirect()->back();
      }
      $nuevo->mat_cont = $matricula->mat_cont;
      $nuevo->act_cont = $request->act_cont;


      if ($request->ent_vid) {

        $nuevo->ent_vid = sha1($nuevo->ent_cont) . '.' . $request->ent_vid->getClientOriginalExtension();
        $filename = sha1($nuevo->ent_cont) . '.' . $request->ent_vid->getClientOriginalExtension();
        $path = public_path('images/ent_vide/');
        $request->ent_vid->move($path, $filename);
      }

      if ($request->ent_img) {
        $nuevo->ent_img = sha1($nuevo->ent_cont) . '.' . $request->ent_img->getClientOriginalExtension();
        $filename = sha1($nuevo->ent_cont) . '.' . $request->ent_img->getClientOriginalExtension();
        $path = public_path('images/ent_img/');
        $request->ent_img->move($path, $filename);
      }

      if ($request->ent_file) {
        $nuevo->ent_file = sha1($nuevo->ent_cont) . '.' . $request->ent_file->getClientOriginalExtension();
        $filename = sha1($nuevo->ent_cont) . '.' . $request->ent_file->getClientOriginalExtension();
        $path = public_path('images/ent_file/');
        $request->ent_file->move($path, $filename);
      }

      if ($nuevo->ent_entr != null && $nuevo->ent_entr > 0 && $actividad->act_vali > 0) {
        if ($nuevo->ent_entr < $actividad->act_vali) {
          $nuevo->ent_entr = $nuevo->ent_entr + 1;
          $nuevo->ent_ult = date('Y-m-d H:i:s');
        }
      }


      if ($nuevo -> save()) {

        $request->session()->flash('alert-success', 'Acción realizada con éxito');
      }else {
        $request->session()->flash('alert-danger', 'ocurrió un problema, intente de nuevo mas tarde o comuníquese con el administrador');

      }
      return redirect()->route("entindex",["act_cont" => $nuevo->act_cont]);
    }
  }

  public function calificar(Request $request)
  {

    $nuevo = Entrega::find($request->ent_cont);
    if (!$nuevo) {
      $request->session()->flash('alert-danger', 'No se encuentra la actividad');
    }
    $docente = Docente::where("ter_cont",$request->session()->get("id"))->first();
    if (!$docente) {
      $request->session()->flash('alert-danger', 'No tiene permisos para calificar');
    }
    if ($nuevo->ac_acti()->first()->ac_curs()->first()->ac_cate()->first()->doc_cont != $docente->doc_cont) {
      $request->session()->flash('alert-danger', 'No tiene permisos para calificar');
    }
    $nuevo->ent_cali = $request->ent_cali;
    $nuevo->ent_feca = date('Y-m-d H:i:s');
    $nuevo->ent_obser = $request->ent_obser;

    if ($nuevo -> save()) {

      $request->session()->flash('alert-success', 'Acción realizada con éxito');
    }else {
      $request->session()->flash('alert-danger', 'ocurrió un problema, intente de nuevo mas tarde o comuníquese con el administrador');

    }
    return redirect()->back();
  }


  public function downloadEntregaFile(Request $request,$ent_file)
  {
    $file=public_path("images/ent_file/").$ent_file;
    $titulo = Entrega::where("ent_file",$ent_file)->firstOrFail()->ent_titu;
    return response()->download($file, $titulo.".".pathinfo($ent_file)["extension"]);
  }
}
