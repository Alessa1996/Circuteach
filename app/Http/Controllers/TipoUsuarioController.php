<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoUsuario;
use App\Persona;
class TipoUsuarioController extends Controller
{
    //
    public function index(Request $request)
    {
      // return view('user.profile', ['user' => User::findOrFail($id)]);
      $user = Persona::find($request->session()->get("id"));
      $layout = $request->session()->get("layout");
      $data = TipoUsuario::all();
      return view('tipousuario.index',["data" => $data, "layout" => $layout,"user" => $user]);
    }

    public function show(Request $request)
    {

      $busq = TipoUsuario::where("tus_cont",$request->id)->firstOrFail();
      return response()->json($busq);
    }

    public function delete(Request $request)
    {
      $busq = TipoUsuario::where("tus_cont",$request->id)->delete();
      $response = array("mensaje" => "Acción completada con éxito", "tipo" => "success");
      return response()->json($response);
    }

    public function save(Request $request)
    {
      if ($request->ismethod('post')) {
        if ($request->tus_cont == '' || $request->tus_cont == null) {
          if (TipoUsuario::all()->count() > 0) {
            $ultimo = TipoUsuario::all()->max('tus_cont') + 1;
          }else {
            $ultimo = 1;
          }
          $nuevo = new TipoUsuario;
          $nuevo->tus_cont = $ultimo ;

        }else {
          $nuevo = TipoUsuario::where("tus_cont",$request->tus_cont)->firstOrFail();
        }
        $nuevo->tus_desc = $request->tus_desc;
        if ($nuevo -> save()) {
           $request->session()->flash('alert-success', 'Acción realizada con éxito');
        }else {
          $request->session()->flash('alert-danger', 'ocurrió un problema, intente de nuevo mas tarde o comuníquese con el administrador');

        }
        return redirect()->action('TipoUsuarioController@index');;

      }

    }
}
