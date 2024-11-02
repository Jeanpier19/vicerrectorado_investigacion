@extends('layouts.web.master')
@section('title', 'Videos | ')
@section('content')
  <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
    <div class="container text-left align-self-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('web.index') }}">Inicio</a></li>
        </ol>
      </nav>
      <h1 class="page-title-heading mt-3">Videos</h1>
    </div>
  </div>
  <section class="container pt-3 mb-3">
    <div class="row">
      @foreach($videos as $video)
      <div class="col-md-4">
        <div class="grid-item branding mb-30">
          <div class="card portfolio-card">
            <div class="card-header">
              <h3 class="portfolio-title text-center">{{ $video->titulo }}</h3>
            </div>
            @php
              echo $video->frame
            @endphp
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="d-flex justify-content-center">
      {{ $videos->links("pagination::bootstrap-4") }}
    </div>
  </section>
@endsection