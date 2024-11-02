@extends('layouts.web.master')
@section('title', 'SELASI | ')
@section('content')
  <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
    <div class="container text-left align-self-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('web.index') }}">Inicio</a></li>
        </ol>
      </nav>
      <h1 class="page-title-heading mt-3">SELASI</h1>
    </div>
  </div>
  <section class="container pt-3 mb-4 wow fadeInUp">
    <div class="row">
      <div class="col-lg-7">
        <div class="row">
          <div class="col-lg-8 col-md-8 col-sm-12 text-center text-lg-right text-md-right">
            <figure>
              <img src="{{ asset('archivos/imagenes/libros/selasi/selasi.png') }}" class="img-fluid" style="max-width: 100%">
            </figure>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12 text-center text-lg-left text-md-left">
            <h2 class="h5">XI SELASI</h2>
            <p class="text-muted">Aporte Santiaguino XI SELASI - XI Seminario Euro Latinoamericano de Sistemas de ingenieria</p>
            <a href="{{ asset('archivos/documentos/libros/selasi/completo.pdf') }}" target="_blank" class="btn btn-sm btn-block btn-style-4 btn-info"><i class="fe-icon-file"></i> Ver Completo</a>
            <a href="{{ asset('archivos/documentos/libros/selasi/completo.pdf') }}" download="Aporte Santiaguino XI SELASI" class="btn btn-sm btn-block btn-style-4 btn-success"><i class="fe-icon-download-cloud"></i> Descargar (370Mb)</a>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <ul class="list-group">
          <li class="list-group-item p-0">
            <h2 class="h6 block-title text-center py-3 m-0">Ver por partes</2>
          </li>
          <li class="list-group-item p-0">
            <a href="{{ asset('archivos/documentos/libros/selasi/Selasi2015-indice.pdf') }}" target="_blank" class="btn btn-block btn-style-6 btn-primary">Parte N° 01: Índice</a>
          </li>
          <li class="list-group-item p-0">
            <a href="{{ asset('archivos/documentos/libros/selasi/Selasi2015-Pags19-76.pdf') }}" target="_blank" class="btn btn-block btn-style-6 btn-primary">Parte N° 02: Págs. 19 - 76</a>
          </li>
          <li class="list-group-item p-0">
            <a href="{{ asset('archivos/documentos/libros/selasi/Selasi2015-Pags77-130.pdf') }}" target="_blank" class="btn btn-block btn-style-6 btn-primary">Parte N° 03: Págs. 77 - 130</a>
          </li>
          <li class="list-group-item p-0">
            <a href="{{ asset('archivos/documentos/libros/selasi/Selasi2015-Pags131-180.pdf') }}" target="_blank" class="btn btn-block btn-style-6 btn-primary">Parte N° 02: Págs. 131 - 180</a>
          </li>
          <li class="list-group-item p-0">
            <a href="{{ asset('archivos/documentos/libros/selasi/Selasi2015-Pags181-228.pdf') }}" target="_blank" class="btn btn-block btn-style-6 btn-primary">Parte N° 02: Págs. 181 - 228</a>
          </li>
          <li class="list-group-item p-0">
            <a href="{{ asset('archivos/documentos/libros/selasi/Selasi2015-Pags229-290.pdf') }}" target="_blank" class="btn btn-block btn-style-6 btn-primary">Parte N° 02: Págs. 229 - 290</a>
          </li>
          <li class="list-group-item p-0">
            <a href="{{ asset('archivos/documentos/libros/selasi/Selasi2015-Pags291-346.pdf') }}" target="_blank" class="btn btn-block btn-style-6 btn-primary">Parte N° 02: Págs. 291 - 346</a>
          </li>
          <li class="list-group-item p-0">
            <a href="{{ asset('archivos/documentos/libros/selasi/Selasi2015-Pags347-388.pdf') }}" target="_blank" class="btn btn-block btn-style-6 btn-primary">Parte N° 02: Págs. 347 - 388</a>
          </li>
          <li class="list-group-item p-0">
            <a href="{{ asset('archivos/documentos/libros/selasi/Selasi2015-Pags389-432.pdf') }}" target="_blank" class="btn btn-block btn-style-6 btn-primary">Parte N° 02: Págs. 389 - 432</a>
          </li>
          <li class="list-group-item p-0">
            <a href="{{ asset('archivos/documentos/libros/selasi/Selasi2015-Pags433-488.pdf') }}" target="_blank" class="btn btn-block btn-style-6 btn-primary">Parte N° 02: Págs. 433 - 488</a>
          </li>
          <li class="list-group-item p-0">
            <a href="{{ asset('archivos/documentos/libros/selasi/Selasi2015-Pags489-540.pdf') }}" target="_blank" class="btn btn-block btn-style-6 btn-primary">Parte N° 02: Págs. 489 - 540</a>
          </li>
          <li class="list-group-item p-0">
            <a href="{{ asset('archivos/documentos/libros/selasi/Selasi2015-Pags541-582.pdf') }}" target="_blank" class="btn btn-block btn-style-6 btn-primary">Parte N° 02: Págs. 541 - 582</a>
          </li>
        </ul>
      </div>
    </div>
  </section>
@endsection