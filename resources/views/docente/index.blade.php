<title>Creación de Docentes</title>

@extends('layouts.'.$layout)
@section('content')
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Creación de Docentes</h3>
      </div>

    </div>

    <div class="clearfix"></div>


    <div class="row">
        <div class="flash-message" id="messages">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))

          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
        @endforeach
      </div> <!-- end .flash-message -->


      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Formulario de Registro</h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            {{Form::open(array('url' => 'docente/save',"class" => "form-horizontal"))}}
            <input type="hidden" name="doc_cont" id="doc_cont" value="">
            <div class="form-group col-md-4 col-sm-12 col-xs-12">
              <label for="ter_cont">Persona Usuario</label>
              {{Form::select('ter_cont', $f_terc, null, ['class' => 'form-control','placeholder' => 'Seleccione una persona', 'id' => 'ter_cont'])}}
            </div>
            <div class="clearfix"></div>

            <div class="form-group col-md-4 col-sm-12 col-xs-12">
              <label for="doc_usu"> Usuario (Este Campo se diligenciará automáticamente)</label>
              <div id="doc_usu" class="form-control">Espacio para usuario</div>
              <div class="clearfix"></div>

            </div>

              <div class="form-group col-md-4 col-sm-12 col-xs-12">
                <label for="doc_pass"> Contraseña (*)</label>
                <input type="password" name="doc_pass" id="doc_pass" value="" class="form-control">
              </div>
              <div class="form-group col-md-4 col-sm-12 col-xs-12">
                <label for="doc_conf"> Confirmar Contraseña (*)</label>
                <input type="password" name="doc_conf" id="doc_conf" value="" class="form-control">
              </div>

              <div class="clearfix"></div>
              <div class="form-group col-md-4 col-sm-12 col-xs-12">
                <label for="doc_esta"> Estado</label>
                {{Form::select('doc_esta', ["0" => "Inactivo", "1" => "Activo"], null, ['class' => 'form-control','placeholder' => 'Seleccione un estado', 'id' => 'doc_esta'])}}
              </div>
              <div class="form-group col-md-12 col-sm-12">
                <div class="ln_solid"></div>

                <center>
                  <button type="submit" name="submit" class="btn btn-success"> Guardar</button>
                  <button type="reset" name="reset" class="btn btn-danger"> Limpiar</button>
                </center>
              </div>
            {{Form::close()}}
          </div>
        </div>
      </div>


      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Registros en sistema</h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <table class="datatable table table-striped" id="datatable">
              <thead>
                <tr>
                  <th><center>Nº</center></th>
                  <th><center>Nombre</center></th>
                  <th><center>Usuario</center></th>
                  <th><center>Opciones</center></th>
                </tr>
              </thead>
              <tbody>
                @forelse ($data as $data)
                <tr>
                  <td><center>{{ $data->doc_cont }}</center></td>
                  <td><center>{{ strtoupper($data->gn_terc()->first()->ter_pnom) }} {{ strtoupper($data->gn_terc()->first()->ter_snom)}} {{ strtoupper($data->gn_terc()->first()->ter_pape) }}</center></td>
                  <td><center>{{ $data->doc_usu }}</center></td>
                  <td>
                    <center>
                      <a onclick="show({{ $data->doc_cont}})" class="btn btn-warning btn-xs"> Ver/Actualizar</a>
                      <a onclick="del({{ $data->doc_cont}})" class="btn btn-danger btn-xs"> Eliminar</a>
                    </center>
                  </td>
                </tr>
                @empty

                @endforelse
              </tbody>
            </table>

          </div>
        </div>
      </div>
      </div>

      </div>


      <script src="{{asset('js/app/docente/index.js')}}" charset="utf-8"></script>
@stop
