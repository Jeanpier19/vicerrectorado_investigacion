@extends('layouts.web.master')
@section('title', 'Login | ')
@section('content')
<div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
  <div class="container text-left align-self-center">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('web.index') }}">Inicio</a></li>
      </ol>
    </nav>
    <h1 class="page-title-heading mt-3">Iniciar Sesión</h1>
  </div>
</div>
<section class="container pt-3 mb-4">
  <div class="offset-lg-3 col-lg-6">
    <div class="card">
      @if(session('errorMessage'))
      <div class="card-header alert alert-danger alert-dismissible fade show" role="alert">
        <strong>¡Hubo un error!</strong> {{ session('errorMessage') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      <div class="card-body">
        <form class="needs-validation wizard" action="{{ route('login') }}" method="post" novalidate>
          @csrf
          <div class="wizard-body pt-2">
            <div class="d-sm-flex justify-content-between pb-2"><a class="btn btn-secondary btn-sm btn-block my-2 mr-3" href="#"><i class="socicon-facebook"></i>&nbsp;Login</a><a class="btn btn-secondary btn-sm btn-block my-2 mr-3" href="#"><i class="socicon-twitter"></i>&nbsp;Login</a><a class="btn btn-secondary btn-sm btn-block my-2 mr-3" href="#"><i class="socicon-linkedin"></i>&nbsp;Login</a></div>
            <hr>
            <h3 class="h6 pt-4 pb-2">O usando el formulario a continuación</h3>
            <div class="input-group form-group">
              <div class="input-group-prepend"><span class="input-group-text"><i class="fe-icon-user"></i></span></div>
              <input type="text" name="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" value="{{ old('username') }}" placeholder="Usuario" required>
              @if($errors->has('username'))
              <div class="invalid-feedback">
                {{ $errors->first('username') }}
              </div>
              @else
              <div class="invalid-feedback">¡Por favor introduzca su Usuario!</div>
              @endif
            </div>
            <div class="input-group form-group">
              <div class="input-group-prepend"><span class="input-group-text"><i class="fe-icon-lock"></i></span></div>
              <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Contraseña" required>
              @if ($errors->has('password'))
              <div class="invalid-feedback">
                {{ $errors->first('password') }}
              </div>
              @else
              <div class="invalid-feedback">¡Por favor introduzca su Contraseña!</div>
              @endif
            </div>
            <div class="d-flex flex-wrap justify-content-between">
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" name="remember" type="checkbox" id="remember-me">
                <label class="custom-control-label" for="remember-me">Recordarme</label>
              </div>
              <a class="navi-link" href="#">¿Has olvidado tu Usuario y/o Contraseña?</a>
            </div>
          </div>
          <div class="wizard-footer text-right">
            <button class="btn btn-info" type="submit">Iniciar Sesión</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection