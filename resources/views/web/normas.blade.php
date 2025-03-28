@extends('layouts.web.master')
@section('title', 'Normas | ')
@section('content')
  <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
    <div class="container text-left align-self-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('web.index') }}">Inicio</a></li>
        </ol>
      </nav>
      <h1 class="page-title-heading mt-3">Normas</h1>
    </div>
  </div>
  <section class="container pt-3 mb-3">
    @foreach($normas as $norma)
    <div class="card mb-5 wow fadeInUp">
      <div class="card-header">
        <h2 class="h5">{{ $norma->titulo }}</h2>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
            <figure class="text-center">
            <img src="{{ asset('archivos/imagenes/normas') }}/{{ $norma->image->path }}" class="img-fluid img-thumbnail" alt="{{ $norma->titulo }}">
            </figure>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
            <p class="text-muted">{{ $norma->descripcion }}</p>
           <a href="{{ asset('archivos/documentos/normas') }}/{{ $norma->file->path }}" class="btn btn-style-4 btn-danger" target="_blank"><i class="fe-icon-file"></i> Ver Norma</a>
            <a href="{{ asset('archivos/documentos/normas') }}/{{ $norma->file->path }}" class="btn btn-style-4 btn-primary" download="{{ $norma->slug }}"><i class="fe-icon-download-cloud"></i> Descargar</a>
          </div>
        </div>
      </div>
    </div>
    @endforeach
    <div class="d-flex justify-content-center">
      {{ $normas->links() }}
    </div>
  </section>
@endsection
