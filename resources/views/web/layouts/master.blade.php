<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Vicerectorado de Investigación VRI UNASAM, Dirección del Instituto de Investigación DII UNASAM, Universidad Nacional Santiago Antúnez de Mayolo UNASAM, Investigación UNASAM, Oficina General de Tecnologías de Información, Sistemas y Estadística OGTISE UNASAM">
    <meta name="description" content="Vicerectorado de Investigación VRI UNASAM, Dirección del Instituto de Investigación DII UNASAM, Universidad Nacional Santiago Antúnez de Mayolo UNASAM, Investigación UNASAM">
    @yield('custom_meta')
    <title>@yield('title_prefix')@yield('title')@yield('title_postfix', 'Vicerectorado de Investigación VRI UNASAM | Dirección del Instituto de Investigación DII UNASAM | Universidad Nacional Santiago Antúnez de Mayolo UNASAM | Investigación UNASAM')</title>
    <link rel="icon" type="images/png" href="{{ asset('archivos/imagenes/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/web/app_4.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/main_4.css') }}">
    <script src="{{ asset('js/web/app_4.js') }}"></script>
    <script src="{{ asset('js/web/main_4.js') }}"></script>
    @yield('custom_css')
  </head>
  <body>
    <div class="social-bar d-none d-lg-block">
      <ul>
        <li class="facebook" data-toggle="tooltip" data-placement="right" title="Síguenos en Facebook"><a href="{{ $descripcion->facebook }}" target="_blank"><i class="socicon-facebook"></i></a></li>
        <li class="twitter" data-toggle="tooltip" data-placement="right" title="Síguenos en Twitter"><a href="{{ $descripcion->twitter }}" target="_blank"><i class="socicon-twitter"></i></a></li>
        <li class="instagram" data-toggle="tooltip" data-placement="right" title="Síguenos en Instagram"><a href="{{ $descripcion->instagram }}" target="_blank"><i class="socicon-instagram"></i></a></li>
        <li class="youtube" data-toggle="tooltip" data-placement="right" title="Síguenos en Youtube"><a href="{{ $descripcion->youtube }}" target="_blank"><i class="socicon-youtube"></i></a></li>
      </ul>
    </div>
    <!-- Back To Top Button--><a class="scroll-to-top-btn" href="#"><i class="fe-icon-chevron-up"></i></a>
    @include('layouts.web.mobile-navigation')
    @include('layouts.web.main-navigation')
    <main class="m-0 p-0 border-0" role="main" id="main">
      @yield('content')
    </main>
    @include('layouts.web.main-footer')
    </div>
    @yield('custom_js')
  </body>
</html>