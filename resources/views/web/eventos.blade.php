@extends('layouts.web.master')
@section('title', 'Eventos | ')
@section('content')
  <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
    <div class="container text-left align-self-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('web.index') }}">Inicio</a></li>
        </ol>
      </nav>
      <h1 class="page-title-heading mt-3">Eventos</h1>
    </div>
  </div>
  <section class="container pt-3 mb-3">
    <div class="row">
      @foreach($eventos as $evento)
      <div class="col-xl-4 col-lg-4 col-md-6">
        <div class="grid-item branding mb-30">
          <div class="card portfolio-card">
            @if(count($evento->images) > 0) <img src="{{ asset('archivos/imagenes/eventos') }}/{{ $evento->images[0]->path }}" alt="{{ $evento->titulo }}"/> @else <img src="{{ asset('archivos/imagenes/eventos/default.jpg') }}" alt="{{ $evento->titulo }}"/> @endif
            <div class="card-body">
              <div class="portfolio-meta">
                <span class="mr-3">
                  <i class="fe-icon-calendar"></i> {{ date('d/m/Y', strtotime($evento->fecha)) }}
                </span>
                <span class="mr-3">
                  <i class="fe-icon-tag"></i> @foreach($evento->etiquetas as $etiqueta) {{ $etiqueta->nombre }} @endforeach
                </span>
              </div>
              <div class="portfolio-meta text-left">
                <span class="mr-3">
                  <i class="fe-icon-map-pin"></i> {{ $evento->lugar }}
                </span>
              </div>
              <div class="portfolio-meta text-left">
                <span class="mr-3">
                  <i class="fe-icon-users"></i> {{ $evento->dirigido }}
                </span>
              </div>
              <h3 class="portfolio-title text-center">
                <a href="{{ route('web.evento', $evento->slug) }}">{{ limit_string($evento->titulo, 200, '...') }}</a>
              </h3>
              <a class="btn btn-style-6 btn-primary btn-sm btn-block mt-3" href="{{ route('web.evento', $evento->slug) }}">Informarse</a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="d-flex justify-content-center">
      {{ $eventos->links("pagination::bootstrap-4") }}
    </div>
  </section>
@endsection