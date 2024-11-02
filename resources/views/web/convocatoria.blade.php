@extends('layouts.web.master')
@section('title'){{ $convocatoria->titulo }} | @endsection
@section('content')
  <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
    <div class="container text-left align-self-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('web.index') }}">Inicio</a></li>
          <li class="breadcrumb-item"><a href="{{ route('web.convocatorias') }}">Convocatorias</a></li>
        </ol>
      </nav>
      <h1 class="page-title-heading mt-3">{{ $convocatoria->titulo }}</h1>
    </div>
  </div>
  <section class="container pt-3 mb-3 convocatoria">
    <div class="card">
      <div class="card-header">
        <p class="text-muted"><i class="fe-icon-tag"></i> {{ $convocatoria->tipo_convocatoria->nombre }}</p>
        <p class="text-muted"><i class="fe-icon-calendar"></i> Desde {{ date('d/m/Y', strtotime($convocatoria->desde)) }}</p>
        <p class="text-muted"><i class="fe-icon-calendar"></i> Hasta @if($convocatoria->hasta) {{ date('d/m/Y', strtotime($convocatoria->hasta )) }} @else --- @endif</p>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="card-body p-0">
              @php
                echo $convocatoria->descripcion;
              @endphp
              <h2 class="block-title h5 my-3">Agenda</h2>
              @php
                echo $convocatoria->agenda;
              @endphp
            </div>
          </div>
          <div class="col-md-6">
            <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: true, &quot;dots&quot;: true, &quot;loop&quot;: true }">@foreach($convocatoria->images as $image) <img src="{{ asset('archivos/imagenes/convocatorias') }}/{{ $image->path }}" alt="{{ $convocatoria->titulo }}"/> @endforeach</div>
            @if(count($convocatoria->files) > 0)
              <h2 class="block-title h5 mt-3">Anexos</h2>
              <ul class="list-group">
                @foreach($convocatoria->files as $file)
                  <li class="list-group-item">
                    <a href="{{ asset('archivos/documentos/convocatorias') }}/{{ $file->path }}" class="d-block" title="Ver documento" target="_blank">
                      <i class="fe-icon-file"></i>
                      {{ $file->name }}
                    </a>
                    <div class="text-center mt-2">
                      <a href="{{ asset('archivos/documentos/convocatorias') }}/{{ $file->path }}" class="btn btn-sm btn-style-6 btn-success" title="Descargar documento" download="{{ $file->slug }}"><i class="fe-icon-download-cloud"></i> Descargar</a>
                    </div>
                  </li>
                @endforeach
              </ul>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection