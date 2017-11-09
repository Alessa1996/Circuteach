<title>Creación de Asignaturas</title>

@extends('layouts.'.$layout)
@section('content')
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Creación de Asignaturas</h3>
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
            {{Form::open(array('url' => 'asignatura/save',"class" => "form-horizontal"))}}
            <input type="hidden" name="asi_cont" id="asi_cont" value="">

            <div class="form-group col-md-4 col-sm-12">
              <label for="asi_code"> Código de Asignatura (*)</label>
              <input type="text" name="asi_code" id="asi_code" value="" class="form-control">
            </div>
              <div class="form-group col-md-4 col-sm-12">
                <label for="asi_desc"> Nombre de Asignatura (Opcional)</label>
                <input type="text" name="asi_desc" id="asi_desc" value="" class="form-control">
              </div>
              <div class="form-group col-md-4 col-sm-12">
                <label for="asi_esta">Estado de Asignatura (*)</label>
                {{Form::select('asi_esta', ["0" => "Inactivo","1" => "Activo"], null, ['class' => 'form-control','placeholder' => 'Seleccione un estado', 'id' => 'asi_esta'])}}
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
                  <th><center>Código</center></th>
                  <th><center>Nombre o Descrición</center></th>
                  <th><center>Opciones</center></th>
                </tr>
              </thead>
              <tbody>
                @forelse ($data as $data)
                <tr>
                  <td>{{ $data->asi_cont }}</td>
                  <td>{{ $data->asi_code }}</td>
                  <td>{{ strtoupper($data->asi_desc) }}</td>
                  <td>
                    <center>
                      <a onclick="show({{ $data->asi_cont}})" class="btn btn-warning btn-xs"> Ver/Actualizar</a>
                      <a onclick="del({{ $data->asi_cont}})" class="btn btn-danger btn-xs"> Eliminar</a>
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


      <script src="{{asset('js/app/asignatura/index.js')}}" charset="utf-8"></script>
@stop
