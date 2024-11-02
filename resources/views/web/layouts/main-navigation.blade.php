<header class="header navbar-wrapper navbar-sticky">
  <div class="d-table-cell header-logo align-middle pr-md-3">
    <a class="navbar-brand mr-1" href="{{ route('web.index') }}">
      <img src="{{ asset('archivos/imagenes/logo.png') }}" alt="VRI UNASAM"/>
    </a>
  </div>
  <div class="d-table-cell header-content w-100 align-middle">
    <div class="navbar-top d-none d-lg-flex justify-content-between align-items-center">
      <div>
        @if($descripcion->telefono_1)
        <a class="navbar-link text-dark mr-3" href="tel:{{ $descripcion->telefono_1 }}">
          <i class="fe-icon-phone"></i> {{ $descripcion->telefono_1 }} anexo {{ $descripcion->anexo_1 }}
        </a>
        @endif
        @if($descripcion->celular_1)
        <a class="navbar-link text-dark mr-3" href="tel:{{ $descripcion->celular_1 }}">
          <i class="fe-icon-phone"></i> {{ $descripcion->celular_1 }}
        </a>
        @endif
        @if($descripcion->email_1)
        <a class="navbar-link text-dark mr-3" href="mailto:{{ $descripcion->email_1 }}">
          <i class="fe-icon-mail"></i> {{ $descripcion->email_1 }}
        </a>
        @endif
      </div>
      <div>
        <ul class="navbar-nav list-inline mb-0">
          <li class="nav-item {{ active('/') }} {{ active('inicio') }}">
            <a class="nav-link" href="{{ route('web.index') }}">Inicio2</a>
          </li>
          <li class="nav-item dropdown-toggle {{ active('nosotros') }} {{ active('nosotros/*') }}">
            <a class="nav-link" href="javascript:void(0)">Nosotros <i class="fe-icon-chevron-down"></i></a>
            <ul class="dropdown-menu right-aligned">
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
          </li>
          {{-- <li class="nav-item dropdown-toggle {{ active('comunicados') }} {{ active('comunicados/*') }}">
            <a class="nav-link" href="javascript:void(0)">Comunicados <i class="fe-icon-chevron-down"></i></a>
            <ul class="dropdown-menu right-aligned">
              @foreach($tipos_comunicado as $tipos_comunicado)
              <li class="dropdown-item {{ active('comunicados/' . $tipos_comunicado->slug) }}">
                <a href="{{ route('web.comunicados', $tipos_comunicado->slug) }}">{{ $tipos_comunicado->nombre }}</a>
              </li>
              @endforeach
            </ul>
          </li> --}}
          <li class="nav-item {{ active('noticias') }}">
            <a class="nav-link" href="{{ route('web.noticias') }}">Noticias</a>
          </li>
          <li class="nav-item {{ active('eventos') }}">
            <a class="nav-link" href="{{ route('web.eventos') }}">Eventos</a>
          </li>
          <li class="nav-item {{ active('convocatorias') }}">
            <a class="nav-link" href="{{ route('web.convocatorias') }}">Convocatorias</a>
          </li>
          @if(auth()->guest())
          <li class="nav-item dropdown-toggle mr-2">
            <a class="nav-link" href="{{ route('login') }}">
              <i class="fe-icon-user"></i> Iniciar Sesión
            </a>
            <div class="dropdown-menu right-aligned p-3 text-center" style="min-width: 200px;">
              <p class="text-sm opacity-70">Inicie sesión en su cuenta o solicite la creación de una nueva.</p>
              <a class="btn btn-success btn-sm btn-block" href="{{ route('login') }}">Ingresar</a>
              <p class="text-sm text-muted mt-3 mb-0">
                ¿No tiene cuenta? <a href="{{ route('web.requisitos-deberes-derechos') }}">Registrarse</a>
              </p>
            </div>
          </li>
          @else
          <li class="nav-item dropdown-toggle mr-2">
            <a class="nav-link" href="{{ route('login') }}"><i class="fe-icon-user"></i> Perfil</a>
            <div class="dropdown-menu right-aligned p-3 text-center" style="min-width: 200px;">
              <a class="btn btn-success btn-sm btn-block" href="{{ route('login') }}">Perfil</a>
              <a class="btn btn-danger btn-sm btn-block" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </li>
          @endif
        </ul>
      </div>
    </div>
    <div class="navbar justify-content-end justify-content-lg-end">
      <form class="search-box" method="get">
        <input type="text" id="site-search" placeholder="Escriba algún criterio de búsqueda">
        <span class="search-close">
          <i class="fe-icon-x"></i>
        </span>
      </form>
      <ul class="navbar-nav d-none d-lg-block">
        <li class="nav-item dropdown-toggle {{ active('investigacion') }} {{ active('investigacion/*') }}">
          <a class="nav-link" href="#">Investigación <i class="fe-icon-chevron-down"></i></a>
          <ul class="dropdown-menu">
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
        </li>
        <li class="nav-item dropdown-toggle {{ active('publicaciones') }} {{ active('publicaciones/*') }}">
          <a class="nav-link" href="#">Publicaciones <i class="fe-icon-chevron-down"></i></a>
          <ul class="dropdown-menu">
            {{-- <li class="dropdown-item">
              <a href="http://revistas.unasam.edu.pe/">Revistas</a>
            </li> --}}
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
            {{-- <li class="dropdown-item has-children">
              <a href="javascript:void(0);">Libros</a>
              <ul class="dropdown-menu">
                <li class="dropdown-item">
                  <a href="{{ route('web.selasi') }}">SELASI</a>
                </li>
                <li class="dropdown-item">
                  <a href="#">Libros de Docentes</a>
                </li>
              </ul>
            </li> --}}
            {{-- <li class="dropdown-item {{ active('publicaciones/boletin-investigacion') }}">
              <a href="{{ route('web.boletin-investigacion') }}">Boletín de Investigación</a>
            </li> --}}
          </ul>
        </li>
        <li class="nav-item dropdown-toggle {{ active('emprendimiento') }} {{ active('emprendimiento/*') }}">
          <a class="nav-link" href="#">Emprendimiento <i class="fe-icon-chevron-down"></i></a>
          <ul class="dropdown-menu">
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
        </li>
        <li class="nav-item dropdown-toggle {{ active('cooperacion') }} {{ active('cooperacion/*') }}">
          <a class="nav-link" href="#">Cooperación <i class="fe-icon-chevron-down"></i></a>
          <ul class="dropdown-menu">
            <li class="dropdown-item {{ active('cooperacion/convenios') }}">
              <a href="{{ route('web.convenios') }}">Convenios</a>
            </li>
            <li class="dropdown-item {{ active('cooperacion/movilidad') }}">
              <a href="{{ route('web.movilidad') }}">Movilidad</a>
            </li>
          </ul>
        </li>
        {{-- <li class="nav-item {{ active('contacto') }}"><a class="nav-link" href="{{ route('web.contacto') }}">Contacto</a></li> --}}
      </ul>
      <div>
        <ul class="navbar-buttons d-inline-block align-middle mr-lg-2">
          <li class="d-block d-lg-none">
            <a href="#mobile-menu" data-toggle="offcanvas">
              <i class="fe-icon-menu"></i>
            </a>
          </li>
          <li>
            <a href="#" data-toggle="search">
              <i class="fe-icon-search"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</header>