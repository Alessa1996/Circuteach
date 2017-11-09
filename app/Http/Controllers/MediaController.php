<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\Actividad;
use App\Articulo;
use App\Entrega;

class MediaController extends Controller
{
    public function index(Request $request)
    {
      $user = Persona::find($request->session()->get("id"));
      $layout = $request->session()->get("layout");
      $is_search = false;

      if ($request->search && $request->search != null && $request->search != "") {
        // dd($request->search);
        $articulo = Articulo::whereRaw("art_vid IS NOT NULL AND (art_titu LIKE '%".$request->search."%' OR art_desc LIKE '%".$request->search."%')")->get()->take(4);
        $actividad = Actividad::whereRaw("act_vid IS NOT NULL AND (act_titu LIKE '%".$request->search."%' OR act_desc LIKE '%".$request->search."%')")->get()->take(4);
        $entrega = Entrega::whereRaw("ent_vid IS NOT NULL AND (ent_titu LIKE '%".$request->search."%' OR ent_desc LIKE '%".$request->search."%')")->get()->take(4);
        // dd($data);
        $is_search = true;

      }else {

      $articulo = Articulo::whereNotNull("art_vid")->get()->take(4);
      $actividad = Actividad::whereNotNull("act_vid")->get()->take(4);
      $entrega = Entrega::whereNotNull("ent_vid")->get()->take(4);
      }

      if (!$layout) {
        $layout = "default";
      }


      return view('media.index',["layout" => $layout, "user" => $user, "actividad" => $actividad, "articulo" => $articulo, "entrega" => $entrega, "is_search" => $is_search, "search" => $request->search]);

    }

    public function player(Request $request,$env,$id)
    {
      if ($env == 'articulo') {
        $data = Articulo::whereRaw("sha1(art_cont) = ? AND art_vid is not null",$id)->first();
        // dd($data);
        $terc = $data->gn_terc()->first();
        $nombre = $terc->ter_pnom." ".$terc->ter_snom." ".$terc->ter_pape." ".$terc->ter_sape;
        $data = [$data->art_cont,$data->art_titu,$data->art_desc,$nombre,$terc->ter_corre,"images/art_vide/".$data->art_vid,route('artshow',['art_cont'=>$data->art_cont])];
      }elseif ($env == 'actividad') {
        $data = Actividad::whereRaw("sha1(act_cont) = ? and act_vid is not null",$id)->firstOrFail();
        $terc = $data->ac_curs()->first()->ac_cate()->first()->gn_doce()->first()->gn_terc()->first();
        $nombre = $terc->ter_pnom." ".$terc->ter_snom." ".$terc->ter_pape." ".$terc->ter_sape;
        $data = [$data->act_cont,$data->act_titu,$data->act_desc,$nombre,$terc->ter_corre,"images/act_vide/".$data->act_vid,route('actshow',['cur_cont'=>$data->cur_cont,'act_cont'=>$data->act_cont])];

      }elseif ($env == 'entrega') {
        $data = Entrega::whereRaw("sha1(ent_cont) = ? and ent_vid is not null",$id)->first();
        $terc = $data->cu_matri()->first()->gn_estu()->first()->gn_terc()->first();
        $nombre = $terc->ter_pnom." ".$terc->ter_snom." ".$terc->ter_pape." ".$terc->ter_sape;
        $data = [$data->ent_cont,$data->ent_titu,$data->ent_desc,$nombre,$terc->ter_corre,"images/ent_vide/".$data->ent_vid,route('entshow',['act_cont'=>$data->act_cont,'ent_cont'=>$data->ent_cont])];

      }else {
        $request->session()->flash('alert-danger','Error en el entorno del reproductor de video');
        return redirect()->route('mediaprincipal');
      }

      if (!$data) {
        $request->session()->flash('alert-danger','No se encontraron resultados');
        return redirect()->back();
      }
      $user = Persona::find($request->session()->get("id"));
      $layout = $request->session()->get("layout");
      if (!$layout) {
        $layout = "default";
      }
      return view('media.player',["layout" => $layout, "user" => $user,"data" => $data]);



    }

    public function articulo(Request $request)
    {
      $user = Persona::find($request->session()->get("id"));
      if ($request->search && $request->search != null && $request->search != "") {
        // dd($request->search);
        $data = Articulo::whereRaw("art_vid IS NOT NULL AND (art_titu LIKE '%".$request->search."%' OR art_desc LIKE '%".$request->search."%')")->paginate(3);
        // dd($data);
        $data->appends(['search' => $request->search]);
      }else {
        $data = Articulo::whereNotNull("art_vid")->paginate(3);
      }
      $layout = $request->session()->get("layout");
      if (!$layout) {
        $layout = "default";
      }
      // dd($data->lastPage());
      return view('media.articulo',["layout" => $layout, "user" => $user,"data"=>$data]);
    }

    public function actividad(Request $request)
    {

      $user = Persona::find($request->session()->get("id"));
      if ($request->search && $request->search != null && $request->search != "") {
        $data = Actividad::whereRaw("act_vid IS NOT NULL AND (act_titu LIKE '%".$request->search."%' OR act_desc LIKE '%".$request->search."%')")->paginate(3);
        // dd($data);
        $data->appends(['search' => $request->search]);
      }else {
        $data = Actividad::whereNotNull("act_vid")->paginate(3);
      }

      $layout = $request->session()->get("layout");
      if (!$layout) {
        $layout = "default";
      }
      return view('media.actividad',["layout" => $layout, "user" => $user,"data" => $data]);
    }

    public function entrega(Request $request)
    {

      $user = Persona::find($request->session()->get("id"));
      if ($request->search && $request->search != null && $request->search != "") {
        $data = Entrega::whereRaw("ent_vid IS NOT NULL AND (ent_titu LIKE '%".$request->search."%' OR ent_desc LIKE '%".$request->search."%')")->paginate(3);
        // dd($data);
        $data->appends(['search' => $request->search]);
      }else {
        $data = Entrega::whereNotNull("ent_vid")->paginate(3);
      }
      $layout = $request->session()->get("layout");
      if (!$layout) {
        $layout = "default";
      }
      return view('media.entrega',["layout" => $layout, "user" => $user,"data" => $data]);
    }

    public function search(Request $request)
    {
      if ($request->ismethod('post')) {
        return redirect('/media/'.$request->env.'?search='.$request->search);
      }
    }


}