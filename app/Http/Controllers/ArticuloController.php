<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\Articulo;
use DB;

class ArticuloController extends Controller
{
  public function index(Request $request)
  {
    $user = Persona::find($request->session()->get("id"));
    $data = Articulo::where("ter_cont",$user->ter_cont)->get();
    $layout = $request->session()->get("layout");
    // dd($request->session()->all());
    return view('articulo.index',["data" => $data, "layout" => $layout,"data" => $data, "user" => $user]);
  }
  public function create(Request $request)
  {
    $layout = $request->session()->get("layout");

    $user = Persona::find($request->session()->get("id"));
    return view('articulo.new',["layout" => $layout,"user" => $user]);

  }

  public function edit(Request $request,$art_cont)
  {
    $user = Persona::find($request->session()->get("id"));
    $data = Articulo::find($art_cont);
    if (!$data) {
      $request->session()->flash('alert-danger', 'No se encontró el artículo con identificador '. $art_cont);
      return redirect()->back();
    }
    $layout = $request->session()->get("layout");
    // dd($request->session()->all());
    return view('articulo.edit',["data" => $data, "layout" => $layout,"data" => $data, "user" => $user]);
  }

  public function show(Request $request,$art_cont)
  {
    $user = Persona::find($request->session()->get("id"));
    $data = Articulo::find($art_cont);
    if (!$data) {
      $request->session()->flash('alert-danger', 'No se encontró el artículo con identificador '. $art_cont);
      return redirect()->back();
    }

    $layout = $request->session()->get("layout");
    // dd($request->session()->all());
    if (!$layout) {
      $layout = "default";
    }
    return view('articulo.show',["data" => $data, "layout" => $layout,"data" => $data, "user" => $user]);
  }

  public function save(Request $request)
  {

      if($request->ismethod('post')){

        // dd(str_replace('T', ' ',$request->art_fini).":00");
        if ($request->art_cont == '' || $request->art_cont == null) {
          if (Articulo::all()->count() > 0) {
            $ultimo = Articulo::all()->max('art_cont') + 1;
          }else {
            $ultimo = 1;
          }
          $nuevo = new Articulo;
          $nuevo->art_cont = $ultimo;
          // $nuevo->art_fini = $request->art_fini;
          // $nuevo->art_fina = $request->art_fina;

        }else {
          $nuevo = Articulo::find($request->art_cont);

        }
        $nuevo->art_titu = $request->art_titu;
        $nuevo->art_desc = $request->art_desc;
        $nuevo->ter_cont = $request->session()->get("id");

        if ($request->art_vid) {

          $nuevo->art_vid = sha1($nuevo->art_cont) . '.' . $request->art_vid->getClientOriginalExtension();
          $filename = sha1($nuevo->art_cont) . '.' . $request->art_vid->getClientOriginalExtension();
          $path = public_path('images/art_vide/');
          $request->art_vid->move($path, $filename);
        }

        if ($request->art_img) {
          $nuevo->art_img = sha1($nuevo->art_cont) . '.' . $request->art_img->getClientOriginalExtension();
          $filename = sha1($nuevo->art_cont) . '.' . $request->art_img->getClientOriginalExtension();
          $path = public_path('images/art_img/');
          $request->art_img->move($path, $filename);
        }

        if ($request->art_file) {
          $nuevo->art_file = sha1($nuevo->art_cont) . '.' . $request->art_file->getClientOriginalExtension();
          $filename = sha1($nuevo->art_cont) . '.' . $request->art_file->getClientOriginalExtension();
          $path = public_path('images/art_file/');
          $request->art_file->move($path, $filename);
        }


        if ($nuevo -> save()) {

          $request->session()->flash('alert-success', 'Acción realizada con éxito');
          return redirect()->route("artindex");

        }else {
          $request->session()->flash('alert-danger', 'ocurrió un problema, intente de nuevo mas tarde o comuníquese con el administrador');
          return redirect()->back();

        }
      }
  }
  public function downloadArticleFile($art_file)
  {
    $file=public_path("images/art_file/").$art_file;
    $titulo = Articulo::where("art_file",$art_file)->firstOrFail()->art_titu;
    return response()->download($file, $titulo.".".pathinfo($art_file)["extension"]);

  }
}
