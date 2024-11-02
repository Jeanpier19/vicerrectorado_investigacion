@extends('layouts.web.master')
@section('title', 'Convocatorias | ')
@section('content')
  <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
    <div class="container text-left align-self-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('web.index') }}">Inicio</a></li>
        </ol>
      </nav>
      <h1 class="page-title-heading mt-3">Convocatorias</h1>
    </div>
  </div>
  <section class="container pt-3 mb-3">
    <div class="row">
      @foreach($convocatorias as $convocatoria)
      <div class="col-xl-4 col-lg-4 col-md-6">
        <div class="grid-item branding mb-30">
          <div class="card portfolio-card">
            @if(count($convocatoria->images) > 0) <img src="{{ asset('archivos/imagenes/convocatorias') }}/{{ $convocatoria->images[0]->path }}" alt="{{ $convocatoria->titulo }}"/> @else <img src="{{ asset('archivos/imagenes/convocatorias/default.jpg') }}" alt="{{ $convocatoria->titulo }}"/> @endif
            <div class="card-body">
              <div class="portfolio-meta">
                <span class="mr-3">
                  <i class="fe-icon-tag"></i> {{ $convocatoria->tipo_convocatoria->nombre }}
                </span>
              </div>
              <div class="portfolio-meta">
                <span class="mr-3">
                  <i class="fe-icon-calendar"></i> Desde {{ date('d/m/Y', strtotime($convocatoria->desde )) }}
                </span>
              </div>
              <div class="portfolio-meta">
                <span class="mr-3">
                  <i class="fe-icon-calendar"></i> Hasta @if($convocatoria->hasta) {{ date('d/m/Y', strtotime($convocatoria->hasta )) }} @else --- @endif
                </span>
              </div>
              <h3 class="portfolio-title text-center">
                <a href="{{ route('web.convocatoria', $convocatoria->slug) }}">{{ limit_string($convocatoria->titulo, 200, '...') }}</a>
              </h3>
              <a class="btn btn-style-6 btn-primary btn-sm btn-block mt-3" href="{{ route('web.convocatoria', $convocatoria->slug) }}">Informarse</a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="d-flex justify-content-center">
      {{ $convocatorias->links("pagination::bootstrap-4") }}
    </div>
  </section>
@endsection