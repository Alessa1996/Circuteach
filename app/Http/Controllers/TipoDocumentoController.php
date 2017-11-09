<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoDocumento;
use App\Persona;
class TipoDocumentoController extends Controller
{
    //
    public function index(Request $request)
    {
      // return view('user.profile', ['user' => User::findOrFail($id)]);
      $user = Persona::find($request->session()->get("id"));
      $layout = $request->session()->get("layout");
      $data = TipoDocumento::all();
      return view('tipodocumento.index',["data" => $data, "layout" => $layout, "user" => $user]);
    }

    public function show(Request $request)
    {

      $busq = TipoDocumento::where("tdo_cont",$request->id)->firstOrFail();;
      return response()->json($busq);
    }

    public function delete(Request $request)
    {
      $busq = TipoDocumento::where("tdo_cont",$request->id)->delete();
      $response = array("mensaje" => "Acción completada con éxito", "tipo" => "success");
      return response()->json($response);
    }



    public function save(Request $request)
    {
      if ($request->ismethod('post')) {
        if ($request->tdo_cont == '' || $request->tdo_cont == null) {
          if (TipoDocumento::all()->count() > 0) {
            $ultimo = TipoDocumento::all()->max('tdo_cont') + 1;
          }else {
            $ultimo = 1;
          }
          $nuevo = new TipoDocumento;
          $nuevo->tdo_cont = $ultimo;

        }else {
          $nuevo = TipoDocumento::find($request->tdo_cont);
        }
        $nuevo->tdo_desc = $request->tdo_desc;

        if ($nuevo -> save()) {
           $request->session()->flash('alert-success', 'Acción realizada con éxito');
        }else {
          $request->session()->flash('alert-danger', 'ocurrió un problema, intente de nuevo mas tarde o comuníquese con el administrador');

        }
        return redirect()->action('TipoDocumentoController@index');;

      }

    }
}
