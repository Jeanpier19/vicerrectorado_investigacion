@extends('layouts.web.master')
@section('title'){{ $noticia->titulo }} | @endsection
@section('content')
  <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
    <div class="container text-left align-self-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('web.index') }}">Inicio</a></li>
          <li class="breadcrumb-item"><a href="{{ route('web.noticias') }}">Noticias</a></li>
        </ol>
      </nav>
      <h1 class="page-title-heading mt-3">{{ $noticia->titulo }}</h1>
    </div>
  </div>
  <section class="container pt-3 mb-3 noticia">
    <div class="card">
      <div class="card-header">
        <p class="text-muted"><i class="fe-icon-calendar"></i> {{ date('d/m/Y', strtotime($noticia->fecha)) }}</p>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12 wow fadeInUp">
            <div class="card-body p-0">
              @php
                echo $noticia->descripcion;
              @endphp
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: true, &quot;dots&quot;: true, &quot;loop&quot;: true }">@foreach($noticia->images as $image)<img src="{{ asset('archivos/imagenes/noticias') }}/{{ $image->path }}" alt="Galería"s/>@endforeach</div>
            @if(count($noticia->files) > 0)
              <h2 class="block-title h5 mt-3">Anexos</h2>
              <ul class="list-group">
                @foreach($noticia->files as $file)
                  <li class="list-group-item">
                    <a href="{{ asset('archivos/documentos/noticias') }}/{{ $file->path }}" class="d-block" title="Ver documento" target="_blank">
                      <i class="fe-icon-file"></i>
                      {{ $file->name }}
                    </a>
                    <div class="text-center mt-2">
                      <a href="{{ asset('archivos/documentos/noticias') }}/{{ $file->path }}" class="btn btn-sm btn-style-6 btn-success" title="Descargar documento" download="{{ $file->slug }}"><i class="fe-icon-download-cloud"></i> Descargar</a>
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