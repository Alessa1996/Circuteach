<title>Bienvenido | Inicie sesión para continuar</title>

@extends('layouts.'.$layout)
@section('content')

<div class="login_wrapper">
  <div class="animate form login_form">
          <section class="login_content">
            {{Form::open(array('url' => 'auth'))}}
              <h1>Bienvenid@ </h1>

              <div class="flash-message" id="messages">
              @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
              @endforeach
              </div> <!-- end .flash-message -->

              <div>

                <input type="text" class="form-control" placeholder="Usuario" required="" name="user" id="user" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Contraseña" required="" name="pass" id="pass"/>
              </div>
              <div>
                <button type="submit" class="btn btn-default submit" name="button">Iniciar Sesión</button>
                <a class="reset_pass" href="#">Olvidaste tu contraseña?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-graduation-cap"></i> Circuteach</h1>
                  <p>©2017 Todos los derechos reservados</p>
                </div>
              </div>
            {{Form::close()}}
          </section>
        </div>
      </div>


@stop
