<div class="offcanvas-container is-triggered offcanvas-container-reverse" id="mobile-menu"><span class="offcanvas-close"><i class="fe-icon-x"></i></span>
  <div class="px-4 pb-4">
    <h6>Menú</h6>
    <div class="d-flex justify-content-between pt-2">
      @if(auth()->guest())
      <a class="btn btn-info btn-sm btn-block" href="{{ route('login') }}"><i class="fe-icon-user"></i>&nbsp;Iniciar Sesión</a>
      @else
      <a class="btn btn-success btn-sm btn-block" href="{{ route('login') }}"><i class="fe-icon-user"></i>&nbsp;Perfil</a>
      @endif
    </div>
  </div>
  <div class="offcanvas-scrollable-area border-top" style="height:calc(100% - 235px); top: 144px;">
    <div class="accordion mobile-menu" id="accordion-menu">
      <div class="card">
        <div class="card-header"><a class="mobile-menu-link {{ active('/') }} {{ active('inicio') }}" href="{{ route('web.index') }}">Inicio</a></div>
      </div>
      <div class="card">
        <div class="card-header"><a class="mobile-menu-link {{ active('nosotros') }} {{ active('nosotros/*') }}" href="javascript:void(0)">Nosotros</a><a class="collapsed" href="#nosotros-submenu" data-toggle="collapse"></a></div>
        <div class="collapse" id="nosotros-submenu" data-parent="#accordion-menu">
          <div class="card-body">
            <ul>
              <li class="dropdown-item {{ active('nosotros/mision-vision') }}">
                <a href="{{ route('web.mision-vision') }}">Misión y Visión</a>
              </li>
              <li class="dropdown-item {{ active('nosotros/organigrama') }}">
                <a href="{{ route('web.organigrama') }}">Organigrama</a>
              </li>
              <li class="dropdown-item {{ active('nosotros/vicerrectorado-investigacion') }}">
                <a href="{{ route('web.vicerrectorado-investigacion') }}">Vicerrectorado de Investigación</a>
              </li>
              <li class="dropdown-item {{ active('nosotros/direcciones') }}">
                <a href="{{ route('web.direcciones') }}">Direcciones</a>
              </li>
              <li class="dropdown-item {{ active('nosotros/unidades') }}">
                <a href="{{ route('web.unidades') }}">Unidades</a>
              </li>
              <li class="dropdown-item {{ active('nosotros/centros-investigacion-experimentacion') }}">
                <a href="{{ route('web.centros-investigacion-experimentacion') }}">Centros de Investigación y Experimentación</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header"><a class="mobile-menu-link {{ active('noticias') }}" href="{{ route('web.noticias') }}">Noticias</a></div>
      </div>
      <div class="card">
        <div class="card-header"><a class="mobile-menu-link {{ active('eventos') }}" href="{{ route('web.eventos') }}">Eventos</a></div>
      </div>
      <div class="card">
        <div class="card-header"><a class="mobile-menu-link {{ active('convocatorias') }}" href="{{ route('web.convocatorias') }}">Convocatorias</a></div>
      </div>
      <div class="card">
        <div class="card-header"><a class="mobile-menu-link {{ active('investigacion') }} {{ active('investigacion/*') }}" href="javascript:void(0)">Investigación</a><a class="collapsed" href="#investigacion-submenu" data-toggle="collapse"></a></div>
        <div class="collapse" id="investigacion-submenu" data-parent="#accordion-menu">
          <div class="card-body">
            <ul>
              <li class="dropdown-item {{ active('investigacion/investigadores') }}">
                <a href="{{ route('web.investigadores') }}">Investigadores</a>
              </li>
              <li class="dropdown-item {{ active('investigacion/areas-investigacion') }}">
                <a href="{{ route('web.areas-investigacion') }}">Áreas de Investigación</a>
              </li>
              <li class="dropdown-item {{ active('investigacion/circulos-investigacion') }}">
                <a href="{{ route('web.circulos-investigacion') }}">Círculos de Investigación</a>
              </li>
              <li class="dropdown-item {{ active('investigacion/proyectos-investigacion') }}">
                <a href="{{ route('web.proyectos-investigacion') }}">Proyectos de Investigación</a>
              </li>
              <li class="dropdown-item  {{ active('investigacion/requisitos-deberes-derechos') }}">
                <a href="{{ route('web.requisitos-deberes-derechos') }}">Registro de Investigadores</a>
              </li>
              <li class="dropdown-item {{ active('investigacion/plataforma-unica-investigacion') }}">
                <a href="{{ route('web.plataforma-unica-investigacion') }}">Plataforma Única de Investigación</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header"><a class="mobile-menu-link {{ active('publicaciones') }} {{ active('publicaciones/*') }}" href="javascript:void(0)">Publicaciones</a><a class="collapsed" href="#publicaciones-submenu" data-toggle="collapse"></a></div>
        <div class="collapse" id="publicaciones-submenu" data-parent="#accordion-menu">
          <div class="card-body">
            <ul>
              <li class="dropdown-item">
                <a href="http://repositorio.unasam.edu.pe/" target="_blank">Repositorio Institucional</a>
              </li>
              <li class="dropdown-item {{ active('publicaciones/patentes') }}">
                <a href="{{ route('web.patentes') }}">Las Patentes UNASAM</a>
              </li>
              {{-- <li class="dropdown-item {{ active('publicaciones/publicaciones-cientificas-indizadas') }}">
                <a href="{{ route('web.publicaciones-cientificas-indizadas') }}">Publicaciones Científicas Indizadas</a>
              </li> --}}
              <li class="dropdown-item {{ active('publicaciones/selasi') }}">
                <a href="{{ route('web.selasi') }}">SELASI</a>
              </li>
              @foreach($tipos_publicacion as $tipo_publicacion)
              <li class="dropdown-item {{ active('publicaciones/' . $tipo_publicacion->slug) }}">
                <a href="{{ route('web.publicaciones', $tipo_publicacion->slug) }}">{{ $tipo_publicacion->nombre }}</a>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header"><a class="mobile-menu-link {{ active('emprendimiento') }} {{ active('emprendimiento/*') }}" href="javascript:void(0)">Emprendimiento</a><a class="collapsed" href="#emprendimiento-submenu" data-toggle="collapse"></a></div>
        <div class="collapse" id="emprendimiento-submenu" data-parent="#accordion-menu">
          <div class="card-body">
            <ul>
              <li class="dropdown-item {{ active('emprendimiento/subvenciones') }}">
                <a href="{{ route('web.subvenciones') }}">Subvenciones</a>
              </li>
              <li class="dropdown-item {{ active('emprendimiento/emprendimientos') }}">
                <a href="{{ route('web.proyectos-emprendimiento') }}">Emprendimientos UNASAM</a>
              </li>
              <li class="dropdown-item  {{ active('emprendimiento/becas-pasantias-cursos') }}">
                <a href="{{ route('web.becas-pasantias-cursos') }}">Becas, Pasantías y Cursos para Alumnos</a>
              </li>
              <li class="dropdown-item {{ active('emprendimiento/servicios-tecnologicos') }}">
                <a href="{{ route('web.servicios-tecnologicos') }}">Servicios Tecnológicos UNASAM</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header"><a class="mobile-menu-link {{ active('cooperacion') }} {{ active('cooperacion/*') }}" href="javascript:void(0)">Cooperación</a><a class="collapsed" href="#cooperacion-submenu" data-toggle="collapse"></a></div>
        <div class="collapse" id="cooperacion-submenu" data-parent="#accordion-menu">
          <div class="card-body">
            <ul>
              <li class="dropdown-item {{ active('cooperacion/convenios') }}">
                <a href="{{ route('web.convenios') }}">Convenios</a>
              </li>
              <li class="dropdown-item {{ active('cooperacion/movilidad') }}">
                <a href="{{ route('web.movilidad') }}">Movilidad</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="offcanvas-footer px-4 pt-3 pb-2 text-center"><a class="social-btn sb-style-3 sb-facebook" href="{{ $descripcion->facebook }}" target="_blank"><i class="socicon-facebook"></i></a><a class="social-btn sb-style-3 sb-twitter" href="{{ $descripcion->twitter }}" target="_blank"><i class="socicon-twitter"></i></a><a class="social-btn sb-style-3 sb-instagram" href="{{ $descripcion->instagram }}" target="_blank"><i class="socicon-instagram"></i></a><a class="social-btn sb-style-3 sb-youtube" href="{{ $descripcion->youtube }}" target="_blank"><i class="socicon-youtube"></i></a><a class="social-btn sb-style-3 sb-whatsapp" href="https://api.whatsapp.com/send?phone=+51{{ $descripcion->whatsapp }}&text=¡Hola! Necesito información sobre los servicios que brindan.&source=&data=" target="_blank"><i class="socicon-whatsapp"></i></a></div>
</div>