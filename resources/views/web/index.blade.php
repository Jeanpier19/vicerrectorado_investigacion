@extends('layouts.web.master')
@section('content')
  <section class="container-fluid p-0 slider">
    @if(count($banners) > 0)
    <div id="banner" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        @foreach($banners as $key => $banner)
        <li data-target="#banner" data-slide-to="{{ $key == 0 ? '0' : $key++ }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
        @endforeach
      </ol>
      <div class="carousel-inner">
        @foreach($banners as $key => $banner)
        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
          <figure>
            @if($banner->link)
            <a href="{{ $banner->link }}" target="_blank">
              <img src="{{ asset('archivos/imagenes/banners')}}/{{ $banner->image->path }}" class="d-block w-100 img-fluid wow fadeIn" data-wow-duration="1s" alt="Banner">
            </a>
            @else
              <img src="{{ asset('archivos/imagenes/banners')}}/{{ $banner->image->path }}" class="d-block w-100 img-fluid wow fadeIn" data-wow-duration="1s" alt="Banner">
            @endif
          </figure>
        </div>
        @endforeach
      </div>
      <a class="carousel-control-prev" href="#banner" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
      </a>
      <a class="carousel-control-next" href="#banner" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Siguiente</span>
      </a>
    </div>
    @else
    <img src="{{ asset('archivos/imagenes/default.png') }}" class="d-block w-100 img-fluid wow fadeIn" data-wow-duration="1s" alt="Imagen">
    @endif
  </section>
  <section class="container pt-3 mb-3 links">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 wow fadeInUp">
        <div class="card mb-5">
          <div class="card-header text-center">
            <a href="{{ route('web.convocatorias') }}" class="h6">Convocatorias</a>
          </div>
          <div class="card-body text-center">
            <a href="{{ route('web.convocatorias') }}" class="btn btn-style-4 btn-style-6 btn-primary" data-toggle="tooltip" data-placement="bottom" title="Convocatorias">
              <i class="fe-icon-bell"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 wow fadeInUp">
        <div class="card mb-5">
          <div class="card-header text-center">
            <a href="{{ route('web.investigadores') }}" class="h6">Investigadores</a>
          </div>
          <div class="card-body text-center">
            <a href="{{ route('web.investigadores') }}" class="btn btn-style-4 btn-style-6 btn-primary" data-toggle="tooltip" data-placement="bottom" title="Investigadores">
              <i class="fe-icon-users"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 wow fadeInUp">
        <div class="card mb-5">
          <div class="card-header text-center">
            <a href="#" class="h6">Plataforma Única de Investigación</a>
          </div>
          <div class="card-body text-center">
            <a href="#" class="btn btn-style-4 btn-style-6 btn-primary" data-toggle="tooltip" data-placement="bottom" title="Plataforma Única de Investigación">
              <i class="fe-icon-search"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 wow fadeInUp">
        <div class="card mb-5">
          <div class="card-header text-center">
            <a href="{{ route('web.proyectos-investigacion') }}" class="h6">Proyectos</a>
          </div>
          <div class="card-body text-center">
            <a href="{{ route('web.proyectos-investigacion') }}" class="btn btn-style-4 btn-style-6 btn-primary" data-toggle="tooltip" data-placement="bottom" title="Proyectos">
              <i class="fe-icon-copy"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="container pt-3 mb-3">
    <div class="row">
      <div class="col-md-4">
        <h1 class="h1 block-title">Dirección del Instituto de Investigación</h1>
      </div>
      <div class="col-md-8">
        @php
        echo $descripcion->descripcion
        @endphp
        <a href="{{ route('web.organigrama') }}" class="btn btn-style-6 btn-primary">
          Organigrama
          <i class="fe-icon-arrow-right"></i>
        </a>
      </div>
    </div>
  </section>
  <section class="container text-center pt-3 mb-3">
    <h2 class="h2 block-title text-center mb-4">Noticias</h2>
    <a href="{{ route('web.noticias') }}" class="btn btn-style-4 btn-danger">Ver todas las Noticias <i class="fe-icon-arrow-right"></i></a>
    <div class="row mt-5">
      @foreach($noticias as $noticia)
      <div class="col-xl-4 col-lg-4 col-md-6">
        <div class="grid-item branding mb-30">
          <div class="card portfolio-card">
            @if(count($noticia->images) > 0) <img src="{{ asset('archivos/imagenes/noticias') }}/{{ $noticia->images[0]->path }}" alt="{{ $noticia->titulo }}"/> @else <img src="{{ asset('archivos/imagenes/noticias/default.jpg') }}" alt="{{ $noticia->titulo }}"/> @endif
            <div class="card-body">
              <div class="portfolio-meta">
                <span class="mr-3">
                  <i class="fe-icon-calendar"></i> {{ date('d/m/Y', strtotime($noticia->fecha)) }}
                </span>
                <span class="mr-3">
                  <i class="fe-icon-tag"></i> @foreach($noticia->etiquetas as $etiqueta) {{ $etiqueta->nombre }} @endforeach
                </span>
              </div>
              <h3 class="portfolio-title text-center">
                <a href="{{ route('web.noticia', $noticia->slug) }}">{{ limit_string($noticia->titulo, 200, '...') }}</a>
              </h3>
              <a class="btn btn-style-6 btn-primary btn-sm btn-block mt-3" href="{{ route('web.noticia', $noticia->slug) }}">Informarse</a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </section>
  <section class="container text-center pt-3 mb-3">
    <h2 class="h2 block-title text-center mb-4">Eventos</h2>
    <a href="{{ route('web.eventos') }}" class="btn btn-style-4 btn-danger">Ver todos los Eventos <i class="fe-icon-arrow-right"></i></a>
    <div class="row mt-5">
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
  </section>
  <section class="container text-center pt-3 mb-3">
    <h2 class="h2 block-title text-center mb-4">Galerías</h2>
    <a href="{{ route('web.galerias') }}" class="btn btn-style-4 btn-danger">Ver todas las Galerías <i class="fe-icon-arrow-right"></i></a>
    <div class="row mt-5">
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
  </section>
  <section class="container text-center pt-3 mb-3">
    <h2 class="h2 block-title text-center mb-4">Videos</h2>
    <a href="{{ route('web.videos') }}" class="btn btn-style-4 btn-danger">Ver todos los Videos <i class="fe-icon-arrow-right"></i></a>
    <div class="row mt-5">
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
  </section>
  <section class="container pt-3 mb-3 wow fadeInUp">
    <h2 class="h2 block-title text-center mb-4">Buzón Institucional</h2>
    <p>Bienvenidos a la página web de la Universidad Nacional Santiago Antúnez de Mayolo (Unasam). Con el ánimo de prestar el mejor servicio público, la institución quiere establecer vías de comunicación eficaces entre los servicios universitarios y las personas usuarias, a la vez obtener las sugerencias formuladas por la ciudadanía sobre materias de competencia universitaria y sobre el funcionamiento de los servicios de la Unasam con el fin de que esta institución supervise su propia actividad y lleve a cabo acciones de mejora.</p>
    <form>
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="fe-icon-user"></i>
              </span>
            </div>
            <input type="text" class="form-control" placeholder="Apellidos y nombres" required>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="fe-icon-mail"></i>
              </span>
            </div>
            <input type="text" class="form-control" placeholder="Correo electrónico" required>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="fe-icon-message-circle"></i>
              </span>
            </div>
            <input type="text" class="form-control" placeholder="Asunto" required>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
          <textarea class="form-control" rows="4" placeholder="Mensaje"></textarea>
          <button type="submit" class="btn btn-primary btn-style-4 btn-block">Enviar</button>
        </div>
      </div>
    <form>
  </section>
  <section class="container pt-3 mb-4 wow fadeInUp">
    <h2 class="h2 block-title text-center mb-4">Síguenos en Nuestras Redes Sociales</h2>
    <div class="form-row">
      <div class="col-lg-4 col-md-4 col-sm-4">
        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FVRIUNASAM&amp;tabs=timeline&amp;width=340&amp;height=500&amp;small_header=false&amp;adapt_container_width=true&amp;hide_cover=false&amp;show_facepile=true&amp;appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>      
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4">
        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FUnasamOficial&amp;tabs=timeline&amp;width=340&amp;height=500&amp;small_header=false&amp;adapt_container_width=true&amp;hide_cover=false&amp;show_facepile=true&amp;appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4">
        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FRIU.UNASAM&amp;tabs=timeline&amp;width=340&amp;height=500&amp;small_header=false&amp;adapt_container_width=true&amp;hide_cover=false&amp;show_facepile=true&amp;appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>      
      </div>
    </div>
  </section>
@endsection