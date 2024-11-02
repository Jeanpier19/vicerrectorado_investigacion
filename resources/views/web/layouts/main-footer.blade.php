<footer class="pt-3 mt-5">
  <div class="container">
    <div class="row pb-3">
      <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12">
        <div class="logo">
          <a href="{{ route('web.index') }}">
            <img src="{{ asset('archivos/imagenes/logo-white.png') }}" class="logo-image img-fluid" alt="">
          </a>
        </div>
        <hr>
        <ul class="information-list">
          <li><i class="fe-icon-map-pin"></i>&nbsp;{{ $descripcion->direccion }}</li>
          @if($descripcion->telefono_1)<li><a href="tel:{{ $descripcion->telefono_1 }}"><i class="fe-icon-phone"></i>&nbsp;{{ $descripcion->telefono_1 }} Anexo {{ $descripcion->anexo_1 }}</a></li>@endif
          @if($descripcion->telefono_2)<li><a href="tel:{{ $descripcion->telefono_2 }}"><i class="fe-icon-phone"></i>&nbsp;{{ $descripcion->telefono_2 }}</a></li>@endif
          @if($descripcion->telefono_3)<li><a href="tel:{{ $descripcion->telefono_3 }}"><i class="fe-icon-phone"></i>&nbsp;{{ $descripcion->telefono_3 }}</a></li>@endif
          @if($descripcion->celular_1)<li><a href="tel:{{ $descripcion->celular_1 }}"><i class="fe-icon-phone"></i>&nbsp;{{ $descripcion->celular_1 }}</a></li>@endif
          @if($descripcion->celular_2)<li><a href="tel:{{ $descripcion->celular_2 }}"><i class="fe-icon-phone"></i>&nbsp;{{ $descripcion->celular_2 }}</a></li>@endif
          @if($descripcion->celular_3)<li><a href="tel:{{ $descripcion->celular_3 }}"><i class="fe-icon-phone"></i>&nbsp;{{ $descripcion->celular_3 }}</a></li>@endif
          @if($descripcion->email_1)<li><a href="mailto:{{ $descripcion->email_1 }}"><i class="fe-icon-mail"></i>&nbsp;{{ $descripcion->email_1 }}</a></li>@endif
          @if($descripcion->email_2)<li><a href="mailto:{{ $descripcion->email_2 }}"><i class="fe-icon-mail"></i>&nbsp;{{ $descripcion->email_2 }}</a></li>@endif
          @if($descripcion->email_3)<li><a href="mailto:{{ $descripcion->email_3 }}"><i class="fe-icon-mail"></i>&nbsp;{{ $descripcion->email_3 }}</a></li>@endif
        </ul>
      </div>
      <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-xs-12">
        <div class="row">
          <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
            <h6 class="text-uppercase h6 block-title">Nosotros</h6>
            <ul class="m-0">
              <li class="mb-1"><a href="{{ route('web.mision-vision') }}">Misión y Visión</a></li>
              <li class="mb-1"><a href="{{ route('web.organigrama') }}">Organigrama</a></li>
              <li class="mb-1"><a href="{{ route('web.vicerrectorado-investigacion') }}">Vicerrectorado de Investigación</a></li>
              <li class="mb-1"><a href="{{ route('web.normas') }}">Normas</a></li>
              <li class="mb-1"><a href="{{ route('web.direcciones') }}">Direcciones</a></li>
              <li class="mb-1"><a href="{{ route('web.unidades') }}">Unidades</a></li>
              <li class="mb-1"><a href="{{ route('web.centros-investigacion-experimentacion') }}">Centros de Investigación y Experimentación</a></li>
            </ul>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
            <h6 class="text-uppercase h6 block-title">Publicaciones</h6>
            <ul class="m-0">
              <li class="mb-1"><a href="http://repositorio.unasam.edu.pe/" target="_blank">Repositorio Institucioal</a></li>
              <li class="mb-1"><a href="{{ route('web.patentes') }}">Las Patentes UNASAM</a></li>
              <li class="mb-1"><a href="{{ route('web.index') }}">Proyectos de Investigación</a></li>
              <li class="mb-1"><a href="{{ route('web.publicaciones-cientificas-indizadas') }}">Publicaciones Científicas Indizadas</a></li>
              <li class="mb-1"><a href="{{ route('web.libros') }}">Libros</a></li>
              <li class="mb-1"><a  href="http://revistas.unasam.edu.pe/" target="_blank">Revistas</a></li>
              <li class="mb-1"><a href="{{ route('web.boletin-investigacion') }}">Boletín de Investigación</a></li>
            </ul>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
            <h6 class="text-uppercase h6 block-title">Emprendimiento</h6>
            <ul class="m-0">
              <li class="mb-1"><a href="{{ route('web.subvenciones') }}">Subvenciones</a></li>
              <li class="mb-1"><a href="{{ route('web.becas-pasantias-cursos') }}">Becas, Pasantías y Cursos para Alumnos</a></li>
              <li class="mb-1"><a href="{{ route('web.servicios-tecnologicos') }}">Servicios Tecnológicos UNASAM</a></li>
              <li class="mb-1"><a href="{{ route('web.convenios') }}">Convenios</a></li>
              <li class="mb-1"><a href="{{ route('web.movilidad') }}">Movilidad</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="copyright">
    <div class="container py-2">
      <div class="row">
        <div class="col-xl-8 col-lg-7 col-md-6 text-center text-xl-left text-lg-left">
          <p class="m-0 p-0">© 2020<a href="{{ $descripcion->facebook }}" target="_blank"> Vicerrectorado de Invsestigación</a> Todos los Derechos Reservados.</p>
        </div>
        <div class="col-xl-4 col-lg-5 col-md-6 text-center text-xl-right text-lg-right">
          <p class="m-0 p-0"><a href="https://www.facebook.com/UnasamOficial" target="_blank"> UNASAM</a></p>
        </div>
      </div>
    </div>
  </div>
</footer>