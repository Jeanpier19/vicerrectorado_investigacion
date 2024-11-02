@extends('layouts.web.master')
@section('title', 'Publicaciones |' . $tipo_publicacion->nombre . ' | ')
@section('content')
  <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
    <div class="container text-left align-self-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('web.index') }}">Inicio</a></li>
        </ol>
      </nav>
      <h1 class="page-title-heading mt-3">Publicaciones</h1>
      <div class="page-title-subheading h6">{{ $tipo_publicacion->nombre }}</div>
    </div>
  </div>
  <section class="container pt-3 mb-3">
    @foreach($publicaciones as $item)
    <div class="card mb-5 wow fadeInUp">
      <div class="card-header">
        <h2 class="h5">{{ $item->titulo }}</h2>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
            <figure class="text-center">
              @if ($item->image)
  <img src="{{ asset('archivos/imagenes/publicaciones') }}/{{ $item->image->path }}" class="img-fluid img-thumbnail" alt="{{ $item->titulo }}">
@else
  <span>Imagen no disponible</span>
@endif
            </figure>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
            <p class="text-muted">{{ $item->descripcion }}</p>
            @if($item->file)
    <a href="{{ asset('archivos/documentos/publicaciones') }}/{{ $item->file->path }}" class="btn btn-style-4 btn-danger" target="_blank"><i class="fe-icon-file"></i> Ver Publicación</a>
    <a href="{{ asset('archivos/documentos/publicaciones') }}/{{ $item->file->path }}" class="btn btn-style-4 btn-primary" download="{{ $item->slug }}"><i class="fe-icon-download-cloud"></i> Descargar</a>
@endif
          </div>
        </div>
      </div>
    </div>
    @endforeach
    <div class="d-flex justify-content-center">
      {{ $publicaciones->links() }}
    </div>
  </section>
@endsection
