@extends('layouts.web.master')
@section('title', 'Servicios Tecnológicos | ')
@section('content')
  <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
    <div class="container text-left align-self-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('web.index') }}">Inicio</a></li>
        </ol>
      </nav>
      <h1 class="page-title-heading mt-3">Servicios Tecnológicos</h1>
    </div>
  </div>
  <section class="container pt-3 mb-3">
    <p>La Universidad Nacional Santiago Antúnez de Mayolo frente a las necesidades tecnológicas en los sectores público y privado del país, pone a su disposición el catálogo de Laboratorios, para el servicio tecnológico que requieran.</p>
  </section>
@endsection