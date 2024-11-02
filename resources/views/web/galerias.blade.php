@extends('layouts.web.master')
@section('title', 'Galerías | ')
@section('content')
  <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
    <div class="container text-left align-self-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('web.index') }}">Inicio</a></li>
        </ol>
      </nav>
      <h1 class="page-title-heading mt-3">Galerías</h1>
    </div>
  </div>
  <section class="container pt-3 mb-3">
    <div class="row">
      @foreach($galerias as $galeria)
      <div class="col-md-4">
        <div class="grid-item branding mb-30">
          <div class="card portfolio-card">
            <div class="card-header">
              <h3 class="portfolio-title text-center">{{ $galeria->titulo }}</h3>
            </div>
            <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: true, &quot;dots&quot;: true, &quot;loop&quot;: true }">@foreach($galeria->images as $image)<img src="{{ asset('archivos/imagenes/galerias') }}/{{ $image->path }}" alt="Galería"s/>@endforeach</div>
            <div class="card-body">
            @php
              echo limit_string($galeria->descripcion, 200, '...')
            @endphp
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="d-flex justify-content-center">
      {{ $galerias->links("pagination::bootstrap-4") }}
    </div>
  </section>
@endsection