@extends('layouts.web.master')
@section('title', 'Patentes | ')
@section('content')
  <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
    <div class="container text-left align-self-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('web.index') }}">Inicio</a></li>
        </ol>
      </nav>
      <h1 class="page-title-heading mt-3">Patentes</h1>
    </div>
  </div>
  <section class="container pt-3 mb-3">
    {{-- <div class="form-row">
      <div class="form-group col-lg-4">
        <label for="" class="font-weight-bold">Año</label>
        <select class="form-control" name="">
          <option value="2019">Todos...</option>
          <option value="2019">2020</option>
          <option value="2019">2019</option>
          <option value="2018">2018</option>
          <option value="2017">2017</option>
          <option value="2016">2016</option>
        </select>
      </div>
      <div class="form-group col-lg-4">
        <label for="" class="font-weight-bold">Tipo de patente</label>
        <select class="form-control" name="">
          <option value="invencion">Todos...</option>
          <option value="invencion">Invención</option>
          <option value="modelo">Modelo de utilidad</option>
        </select>
      </div>
      <div class="form-group col-lg-4">
        <label for="" class="font-weight-bold">Estado</label>
        <select class="form-control" name="">
          <option value="">Todos...</option>
          <option value="invencion">Solicitado</option>
          <option value="modelo">Otorgado</option>
        </select>
      </div>
    </div>
    <div class="text-center text-lg-right wow fadeInDown">
      <a href="#" class="btn btn-outline-primary-dii">
        <i class="fas fa-fw fa-search"></i>
        Buscar
      </a>
    </div>
    <div class="table-responsive mt-3 wow fadeInUp">
      <table class="table table-primary-dii table-striped table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Resolución</th>
            <th>Fecha</th>
            <th>Expediente</th>
            <th>Patente</th>
            <th>Invento</th>
            <th>Inventores</th>
            <th>Estado</th>
            <th style="min-width: 70px">Archivo</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>2233-2019/DIN</td>
            <td>26/07/2019</td>
            <td>002214-2017/OIN</td>
            <td>Modelo de Utilidad</td>
            <td>Concedida</td>
            <td>ESCALERA DE PELDAÑOS ABATIBLES MEDIANTE BARANDA DESLIZANTE</td>
            <td>
              <ul class="list-group">
                <li class="list-group-item border-dark">Walter Héctor GONZÁLES ARNAO</li>
                <li class="list-group-item border-dark">Rosmery Martha GÓMEZ MINAYA</li>
              </ul>
            </td>
            <td>
              <a href="#" class="btn btn-outline-danger-dii" title="PDF">
                <i class="fas fa-fw fa-file-pdf"></i>
              </a>
            </td>
          </tr>
        </tbody>
      </table>
    </div> --}}
    <h2 class="h2 block-title text-center mb-3">Buscador de Patentes</h2>
    <iframe src="https://servicio.indecopi.gob.pe/portalSAE/Personas/tituloOIN.jsp" style="height: 80vh; width: 100%"></iframe>
    <p class="mb-5"><strong>Fuente:</strong> <a href="https://servicio.indecopi.gob.pe/portalSAE/Personas/tituloOIN.jsp" target="_blank">Buscador de patentes de INDECOPI</a></p>
    <h2 class="h2 block-title text-center mb-3">Buscador de Resoluciones</h2>
    <iframe src="https://servicio.indecopi.gob.pe/buscadorResoluciones/propiedad-intelectual.seam" style="height: 80vh; width: 100%"></iframe>
    <p class="mb-5"><strong>Fuente:</strong> <a href="https://servicio.indecopi.gob.pe/buscadorResoluciones/propiedad-intelectual.seam" target="_blank">Buscador de resoluciones de INDECOPI</a></p>

    <h2 class="h2 block-title text-center mb-5">Enlaces de interés</h2>
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12 mb-5 wow fadeInUp">
        <div class="card">
          <a href="https://patentscope.wipo.int/search/es/search.jsf" target="_blank">
            <div class="row">
              <div class="col-4">
                <figure class="m-0">
                  <img src="{{ asset('archivos/imagenes/ompi.png') }}" class="img-fluid" alt="">
                </figure>
              </div>
              <div class="col-8">
                <h2 class="h6 text-dark">OMPI - Organización Mundial de la Propiedad Intelectual</h2>
                <p class="text-muted">PATENTSCOPE. Registro y colecciones nacionales e internacionales de patentes.</p>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 mb-5 wow fadeInUp">
        <div class="card">
          <a href="https://worldwide.espacenet.com/advancedSearch?locale=en_EP" target="_blank">
            <div class="row">
              <div class="col-4">
                <figure class="m-0">
                  <img src="{{ asset('archivos/imagenes/europa.png') }}" class="img-fluid" alt="">
                </figure>
              </div>
              <div class="col-8">
                <h2 class="h6 text-dark">Oficina Europea de Patentes</h2>
                <p class="text-muted">Búsqueda de patentes en Europa y en todo el mundo. Colecciones publicadas de más de 100 países.</p>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 mb-5 wow fadeInUp">
        <div class="card">
          <a href="http://patft.uspto.gov/" target="_blank">
            <div class="row">
              <div class="col-4">
                <figure class="m-0">
                  <img src="{{ asset('archivos/imagenes/eeuu.png') }}" class="img-fluid" alt="">
                </figure>
              </div>
              <div class="col-8">
                <h2 class="h6 text-dark">Oficina de Patentes y Marcas de Estado Unidos</h2>
                <p class="text-muted">Búsqueda de patentes en Estados Unidos. Contenido de la base de datos de las patentes</p>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>
@stop