<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Docente;
use App\Estudiante;
use App\Admin;
use Session;


class LoginController extends Controller
{
  public function index(Request $request)
  {
    return view('login.index',["layout" => 'forlogin']);

  }

  public function login(Request $request)
  {
    if ($request->ismethod('post')) {
      $docente = Docente::where([
        ['doc_usu', '=', $request->user],
        ['doc_pass', '=', sha1($request->pass)],
        ['doc_esta', '=', '1']
        ])->first();

      $estudiante = Estudiante::where([
        ['est_usu', '=', $request->user],
        ['est_pass', '=', sha1($request->pass)],
        ['est_esta', '=', '1']
        ])->first();

      $admin = Admin::where([
        ['adm_usu', '=', $request->user],
        ['adm_pass', '=', sha1($request->pass)],
        ['adm_esta', '=', '1']
        ])->first();
        if ($docente) {
          session(['id' => $docente->ter_cont,'user' => $docente->doc_usu,'profile' => "gn_doce",'layout' => "docente"]);
          // dd(Session::all());
          return redirect()->route("mediaprincipal");
        }else{
          if ($estudiante){
            session(['id' => $estudiante->ter_cont,'user' => $estudiante->est_usu,'profile' => "gn_estu",'layout' => "estudiante"]);
            // dd(Session::all());
            return redirect()->route("mediaprincipal");

          }else{
            if ($admin) {
              session(['id' => $admin->ter_cont,'user' => $admin->adm_usu,'profile' => "gn_admi",'layout' => "admin"]);
              // dd(Session::all());
              return redirect()->route("mediaprincipal");

            }else {
              session(['layout' => "default"]);
              $request->session()->flash('alert-danger','Usuario y/o Contraseña no coinciden');
              return redirect()->route('login');

            }

          }
        }

    }
  }

  public function logout()
  {
    Session::flush();
    return redirect()->route("mediaprincipal");
  }
}
