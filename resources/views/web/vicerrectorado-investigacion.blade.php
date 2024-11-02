@extends('layouts.web.master')
@section('title', 'Vicerrectorado de Investigación | ')
@section('content')
  <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
    <div class="container text-left align-self-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('web.index') }}">Inicio</a></li>
        </ol>
      </nav>
      <h1 class="page-title-heading mt-3">Vicerrectorado de Investigación</h1>
    </div>
  </div>
  <section class="container pt-3 mb-3">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-12 text-center wow fadeInUp">
        <div class="card">
          <div class="card-body">
            <figure>
              <a href="{{ asset('archivos/imagenes/vicerector-investigacion.png') }}" class="fancybox" data-fancybox="VicerrectorInvestigacion" data-caption="Dr. José Ramiréz Maldonado">
                <img src="{{ asset('archivos/imagenes/vicerector-investigacion.png') }}" class="img-fluid" alt="Vicerrectorado de Investigación">
              </a>
            </figure>
          </div>
          <div class="card-footer">
            <h2 class="h6">Dra. Consuelo Teresa Valencia Vera</h2>
          </div>
        </div>
      </div>
      <div class="col-lg-8 col-md-8 col-sm-12 mt-3 wow fadeInUp">
        <h4>RESUMEN</h4>
        <ul>
          <li>Licenciada en Obstetricia.</li>
          <li>Maestría en Salud Publica, con mención en Servicios de Salud.</li>
          <li>Doctorado en Salud Pública.</li>
        </ul>
        <br>
        <h4>LABOR UNIVERSITARIA</h4>
        <ul>
          <li>Catedrático en la UNASAM desde el 2000.</li>
          <li>Jefe de Departamento Académico de Ciencias de la Salud.</li>
          <li>Directora de la Escuela de Obstetricia.</li>
          <li>Decana de la FCM.</li>
          <li>Secretaria General de la FCM.</li>
          <li>Directora de la Unidad de Postgrado de la FCM.</li>
          <li>Miembro del comité Autoevaluación y Acreditación de la Escuela de Obstetricia.</li>
        </ul>
        <br>
        <h4>TRABAJOS DE INVESTIGACIÓN:</h4>

        <p class="text-muted">9 trabajos de investigación.</p>
        <br>
        <p class="text-muted">Reconocimiento por la FENDUP, por sus acciones sindicales por la reivindicación de los derechos de los Docentes.</p>
      </div>
    </div>
  </section>       
@endsection