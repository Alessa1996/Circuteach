<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('mediaprincipal');
});


  # Rutas de Login

  Route::get('login',['uses' =>'LoginController@index', 'as' => "login"]);
  Route::post('auth',['uses' =>'LoginController@login', 'as' => "auth"]);
  Route::get('logout',['uses' =>'LoginController@logout', 'as' => "logout"]);
  Route::get('home',['uses' =>'FrontController@home', 'as' => "home"])->middleware('login','admin');
  Route::get('profile/{profile}',['uses' =>'FrontController@profile', 'as' => "profile"])->middleware('login');


  # Ruta para dashboard de videos

  Route::get('media/principal',['uses' =>'MediaController@index', 'as' => "mediaprincipal"]);
  Route::get('media/articulo',['uses' =>'MediaController@articulo', 'as' => "artmedia"]);
  // Route::get('media/articulo/search/{params}',['uses' =>'MediaController@articulo', 'as' => "artmedia"]);
  Route::get('media/actividad',['uses' =>'MediaController@actividad', 'as' => "actmedia"]);
  // Route::get('media/actividad/search/{params}',['uses' =>'MediaController@articulo', 'as' => "artmedia"]);
  Route::get('media/entrega',['uses' =>'MediaController@entrega', 'as' => "entmedia"]);
  Route::post('media/search',['uses' =>'MediaController@search', 'as' => "searchmedia"]);
  Route::get('media/{env}/v/{id}',['uses' =>'MediaController@player', 'as' => "player"]);


  # Ruta Personas

  Route::get('persona',['uses' =>'PersonaController@index', 'as' => "terindex"])->middleware('login','admin');
  Route::post('persona/save',['uses' =>'PersonaController@save', 'as' => "tersave"])->middleware('login','admin');
  Route::post('persona/show',['uses' =>'PersonaController@show', 'as' => "tershow"])->middleware('login','admin');
  Route::post('persona/delete',['uses' =>'PersonaController@delete', 'as' => "terdelete"])->middleware('login','admin');
  Route::post('persona/search',['uses' =>'PersonaController@search', 'as' => "tersearch"])->middleware('login');

  # Ruta Administradores

  Route::get('admin',['uses' =>'AdminController@index', 'as' => "admindex"])->middleware('login','admin');
  Route::post('admin/save',['uses' =>'AdminController@save', 'as' => "admsave"])->middleware('login','admin');
  Route::post('admin/show',['uses' =>'AdminController@show', 'as' => "admshow"])->middleware('login','admin');
  Route::post('admin/delete',['uses' =>'AdminController@delete', 'as' => "admdelete"])->middleware('login','admin');

  # Ruta Docentes

  Route::get('docente',['uses' =>'DocenteController@index', 'as' => "docindex"])->middleware('login','admin');
  Route::post('docente/save',['uses' =>'DocenteController@save', 'as' => "docsave"])->middleware('login','admin');
  Route::post('docente/show',['uses' =>'DocenteController@show', 'as' => "docshow"])->middleware('login','admin');
  Route::post('docente/delete',['uses' =>'DocenteController@delete', 'as' => "docdelete"])->middleware('login','admin');

  # Ruta Estudiante

  Route::get('estudiante',['uses' =>'EstudianteController@index', 'as' => "estindex"])->middleware('login','admin');
  Route::post('estudiante/save',['uses' =>'EstudianteController@save', 'as' => "estsave"])->middleware('login','admin');
  Route::post('estudiante/show',['uses' =>'EstudianteController@show', 'as' => "estshow"])->middleware('login','admin');
  Route::post('estudiante/delete',['uses' =>'EstudianteController@delete', 'as' => "estdelete"])->middleware('login','admin');

  # Ruta Asignatura

  Route::get('asignatura',['uses' =>'AsignaturaController@index', 'as' => "asiindex"])->middleware('login','admin');
  Route::post('asignatura/save',['uses' =>'AsignaturaController@save', 'as' => "asisave"])->middleware('login','admin');
  Route::post('asignatura/show',['uses' =>'AsignaturaController@show', 'as' => "asishow"])->middleware('login','admin');
  Route::post('asignatura/delete',['uses' =>'AsignaturaController@delete', 'as' => "asidelete"])->middleware('login','admin');

  # Ruta Catedra

  Route::get('catedra',['uses' =>'CatedraController@index', 'as' => "catindex"])->middleware('login','docente');
  Route::post('catedra/save',['uses' =>'CatedraController@save', 'as' => "catsave"])->middleware('login','docente');
  Route::post('catedra/show',['uses' =>'CatedraController@show', 'as' => "catshow"])->middleware('login','docente');
  Route::post('catedra/search',['uses' =>'CatedraController@search', 'as' => "catsearch"])->middleware('login','docente');
  Route::post('catedra/delete',['uses' =>'CatedraController@delete', 'as' => "catdelete"])->middleware('login','docente');

  # Ruta Curso

  Route::get('curso',['uses' =>'CursoController@index', 'as' => "curindex"])->middleware('login','docente');
  Route::post('curso/save',['uses' =>'CursoController@save', 'as' => "cursave"])->middleware('login','docente');
  Route::post('curso/show',['uses' =>'CursoController@show', 'as' => "curshow"])->middleware('login','docente');
  Route::post('curso/search',['uses' =>'CursoController@search', 'as' => "cursearch"])->middleware('login','docente');
  Route::post('curso/delete',['uses' =>'CursoController@delete', 'as' => "curdelete"])->middleware('login','docente');



  # Ruta de "Mis Cursos"

  Route::get('curso/personal',['uses'=> 'CursoController@my', 'as' => "curmy"])->middleware('login');


  # Ruta Actividad para Docentes

  Route::get('curso/{cur_cont}/actividad',['uses' =>'ActividadController@index', 'as' => "actindex"])->middleware('login');
  Route::get('curso/{cur_cont}/actividad/create',['uses' =>'ActividadController@create', 'as' => "actnew"])->middleware('login','docente');
  Route::get('curso/{cur_cont}/actividad/{act_cont}',['uses' =>'ActividadController@show', 'as' => "actshow"]);
  Route::get('curso/{cur_cont}/actividad/{act_cont}/edit',['uses' =>'ActividadController@edit', 'as' => "actedit"])->middleware('login','docente');
  Route::post('actividad/delete',['uses' =>'ActividadController@delete', 'as' => "actdelete"])->middleware('login','docente');
  Route::post('actividad/save',['uses' =>'ActividadController@save', 'as' => "actsave"])->middleware('login','docente');
  Route::get('actividad/downloadActivity/{act_file}',['uses' =>'ActividadController@downloadActivityFile', 'as' => "actdownload"]);

  # Ruta Entrega de Actividades

  Route::get('actividad/{act_cont}/entrega',['uses' =>'EntregaController@index', 'as' => "entindex"])->middleware('login','entrega');
  Route::get('actividad/{act_cont}/entrega/create',['uses' =>'EntregaController@create', 'as' => "entnew"])->middleware('login','estudiante');
  Route::get('actividad/{act_cont}/entrega/{ent_cont}',['uses' =>'EntregaController@show', 'as' => "entshow"]);
  Route::get('actividad/{act_cont}/entrega/{ent_cont}/edit',['uses' =>'EntregaController@edit', 'as' => "entedit"])->middleware('login','estudiante');
  Route::post('entrega/delete',['uses' =>'EntregaController@delete', 'as' => "entdelete"])->middleware('login','estudiante');
  Route::post('entrega/save',['uses' =>'EntregaController@save', 'as' => "entsave"])->middleware('login','estudiante');
  Route::post('entrega/calificar',['uses' =>'EntregaController@calificar', 'as' => "entcalificar"])->middleware('login','docente');
  Route::get('entrega/downloadEntrega/{ent_file}',['uses' =>'EntregaController@downloadEntregaFile', 'as' => "entdownload"]);


  # Ruta Articulo

  Route::get('articulo',['uses' =>'ArticuloController@index', 'as' => "artindex"])->middleware('login');
  Route::get('articulo/create',['uses' =>'ArticuloController@create', 'as' => "artnew"])->middleware('login');
  Route::get('articulo/{art_cont}/show',['uses' =>'ArticuloController@show', 'as' => "artshow"]);
  Route::get('articulo/{art_cont}/edit',['uses' =>'ArticuloController@edit', 'as' => "artedit"])->middleware('login');
  Route::post('articulo/save',['uses' =>'ArticuloController@save', 'as' => "artsave"])->middleware('login');
  Route::post('articulo/delete',['uses' =>'ArticuloController@save', 'as' => "artdelete"])->middleware('login');
  Route::get('articulo/downloadArticulo/{art_file}',['uses' =>'ArticuloController@downloadArticleFile', 'as' => "artdownload"])->middleware('login');


  # Ruta Matricula

  Route::get('curso/{cur_cont}/matricula',['uses' =>'MatriculaController@index', 'as' => "matindex"])->middleware('login','docente');
  Route::get('curso/{cur_cont}/listmatricula',['uses' =>'MatriculaController@listarmatricula', 'as' => "matlistmat"])->middleware('login','docente');
  Route::get('curso/{cur_cont}/listestudiante',['uses' =>'MatriculaController@listarestudiante', 'as' => "matlistest"])->middleware('login','docente');
  Route::post('matricula/save',['uses' =>'MatriculaController@save', 'as' => "matsave"])->middleware('login','docente');
  Route::post('matricula/status',['uses' =>'MatriculaController@status', 'as' => "matstatus"])->middleware('login','docente');
  Route::post('matricula/delete',['uses' =>'MatriculaController@delete', 'as' => "matdelete"])->middleware('login','admin');


  # Ruta Tipos de documento

  Route::get('tdocumento',['uses' =>'TipoDocumentoController@index', 'as' => "tdoindex"])->middleware('login','admin');
  Route::post('tdocumento/save',['uses' =>'TipoDocumentoController@save', 'as' => "tdosave"])->middleware('login','admin');
  Route::post('tdocumento/show',['uses' =>'TipoDocumentoController@show', 'as' => "tdoshow"])->middleware('login','admin');
  Route::post('tdocumento/delete',['uses' =>'TipoDocumentoController@delete', 'as' => "tdodelete"])->middleware('login','admin');

  # Ruta Tipos de documento

  Route::get('tusuario',['uses' =>'TipoUsuarioController@index', 'as' => "tusindex"])->middleware('login','admin');
  Route::post('tusuario/save',['uses' =>'TipoUsuarioController@save', 'as' => "tussave"])->middleware('login','admin');
  Route::post('tusuario/show',['uses' =>'TipoUsuarioController@show', 'as' => "tusshow"])->middleware('login','admin');
  Route::post('tusuario/delete',['uses' =>'TipoUsuarioController@delete', 'as' => "tusdelete"])->middleware('login','admin');

  # Ruta Nivel academico

  Route::get('nacademico',['uses' =>'NivelAcademicoController@index', 'as' => "nacindex"])->middleware('login','admin');
  Route::post('nacademico/save',['uses' =>'NivelAcademicoController@save', 'as' => "nacsave"])->middleware('login','admin');
  Route::post('nacademico/show',['uses' =>'NivelAcademicoController@show', 'as' => "nacshow"])->middleware('login','admin');
  Route::post('nacademico/delete',['uses' =>'NivelAcademicoController@delete', 'as' => "nacdelete"])->middleware('login','admin');
