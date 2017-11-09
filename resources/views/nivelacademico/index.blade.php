<title>Nivel Académico (Curso)</title>

@extends('layouts.'.$layout)
@section('content')


<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Nivel Académico (Curso)</h3>
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
          {{Form::open(array('url' => 'nacademico/save'))}}
          <input type="hidden" name="nac_cont" id="nac_cont" value="">

          <div class="form-group col-md-6 col-sm-12">
            <label for="nac_desc"> Descripción</label>
            <input type="text" name="nac_desc" id="nac_desc" value="" class="form-control">
          </div>
            <div class="form-group col-md-12 col-sm-12">
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
                <th><center>Descripción</center></th>
                <th><center>Opciones</center></th>
              </tr>
            </thead>
            <tbody>
              @forelse ($data as $data)
              <tr>
                <td>{{ $data->nac_desc }}</td>
                <td>
                  <center>
                    <a onclick="show({{ $data->nac_cont}})" class="btn btn-warning btn-xs"> Ver/Actualizar</a>
                    <a onclick="del({{ $data->nac_cont}})" class="btn btn-danger btn-xs"> Eliminar</a>
                  </center>
                </td>
              </tr>
              @empty
                  <tr>
                    <td colspan="4"><center>No hay Registros</center></td>
                  </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</div>


<script src="{{asset('js/app/nacademico/index.js')}}" charset="utf-8"></script>
@stop
