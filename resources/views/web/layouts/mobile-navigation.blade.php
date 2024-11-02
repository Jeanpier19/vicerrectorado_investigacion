<div class="offcanvas-container is-triggered offcanvas-container-reverse" id="mobile-menu"><span class="offcanvas-close"><i class="fe-icon-x"></i></span>
  <div class="px-4 pb-4">
    <h6>Menú</h6>
    <div class="d-flex justify-content-between pt-2">
      @if(auth()->guest())
      <a class="btn btn-info btn-sm btn-block" href="{{ route('login') }}"><i class="fe-icon-user"></i>&nbsp;Iniciar Sesión</a>
      @else
      <a class="btn btn-success btn-sm btn-block" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fe-icon-user"></i>{{ auth()->user()->persona->nombres }} (Salir)</a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
      @endif
    </div>
  </div>
  <div class="offcanvas-scrollable-area border-top" style="height:calc(100% - 235px); top: 144px;">
    <div class="accordion mobile-menu" id="accordion-menu">
      <div class="card">
        <div class="card-header"><a class="mobile-menu-link {{ active('/') }} {{ active('inicio') }}" href="{{ route('web.index') }}">Inicio</a></div>
      </div>
      <div class="card">
        <div class="card-header"><a class="mobile-menu-link {{ active('nosotros') }}" href="{{ route('web.nosotros') }}">Nosotros</a></div>
      </div>
      <div class="card">
        <div class="card-header"><a class="mobile-menu-link {{ active('historia') }}" href="{{ route('web.historia') }}">Historia</a></div>
      </div>
      <div class="card">
        <div class="card-header"><a class="mobile-menu-link {{ active('servicios') }} {{ active('servicios/*') }}" href="{{ route('web.servicios') }}">Nuestros Servicios</a><a class="collapsed" href="#services-submenu" data-toggle="collapse"></a></div>
        <div class="collapse" id="services-submenu" data-parent="#accordion-menu">
          <div class="card-body">
            <ul>
              <li class="dropdown-item {{ active('servicios/utiles-oficina') }} {{ active('servicios/utiles-oficina/*') }}"><a href="{{ route('web.utiles-oficina') }}">Útiles de Oficina</a></li>
              <li class="dropdown-item {{ active('servicios/agricola') }} {{ active('servicios/agricola/*') }}"><a href="{{ route('web.agricola') }}">Agrícola</a></li>
              <li class="dropdown-item {{ active('servicios/transporte') }} {{ active('servicios/transporte/*') }}"><a href="{{ route('web.transporte') }}">Transporte</a></li>
              <li class="dropdown-item {{ active('servicios/equipos-computo') }} {{ active('servicios/equipos-computo/*') }}"><a href="{{ route('web.equipos-computo') }}">Equipos de Cómputo</a></li>
              <li class="dropdown-item {{ active('servicios/consumibles') }} {{ active('servicios/consumibles/*') }}"><a href="{{ route('web.consumibles') }}">Consumibles</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header"><a class="mobile-menu-link {{ active('servicios/utiles-oficina') }} {{ active('servicios/utiles-oficina/*') }}" href="{{ route('web.utiles-oficina') }}">Útiles de Oficina</a></div>
      </div>
      <div class="card">
        <div class="card-header"><a class="mobile-menu-link {{ active('servicios/equipos-computo') }} {{ active('servicios/equipos-computo/*') }}" href="{{ route('web.equipos-computo') }}">Equipos de Cómputo</a></div>
      </div>
      <div class="card">
        <div class="card-header"><a class="mobile-menu-link {{ active('contacto') }}" href="{{ route('web.contacto') }}">Contacto</a></div>
      </div>
    </div>
  </div>
  <div class="offcanvas-footer px-4 pt-3 pb-2 text-center"><a class="social-btn sb-style-3 sb-facebook" href="{{ $descripcion->facebook }}" target="_blank"><i class="socicon-facebook"></i></a><a class="social-btn sb-style-3 sb-twitter" href="{{ $descripcion->twitter }}" target="_blank"><i class="socicon-twitter"></i></a><a class="social-btn sb-style-3 sb-instagram" href="{{ $descripcion->instagram }}" target="_blank"><i class="socicon-instagram"></i></a><a class="social-btn sb-style-3 sb-youtube" href="{{ $descripcion->youtube }}" target="_blank"><i class="socicon-youtube"></i></a><a class="social-btn sb-style-3 sb-whatsapp" href="https://api.whatsapp.com/send?phone=+51{{ $descripcion->whatsapp }}&text=¡Hola! Necesito información sobre los servicios que brindan.&source=&data=" target="_blank"><i class="socicon-whatsapp"></i></a></div>
</div>