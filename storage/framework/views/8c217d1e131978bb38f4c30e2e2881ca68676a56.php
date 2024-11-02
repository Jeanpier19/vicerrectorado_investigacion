<header class="header navbar-wrapper navbar-sticky">
  <div class="d-table-cell header-logo align-middle pr-md-3">
    <a class="navbar-brand mr-1" href="<?php echo e(route('web.index')); ?>">
      <img src="<?php echo e(asset('archivos/imagenes/logo.png')); ?>" alt="VRI UNASAM"/>
    </a>
  </div>
  <div class="d-table-cell header-content w-100 align-middle">
    <div class="navbar-top d-none d-lg-flex justify-content-between align-items-center">
      <div>
        <?php if($descripcion->telefono_1): ?>
        <a class="navbar-link text-dark mr-3" href="tel:<?php echo e($descripcion->telefono_1); ?>">
          <i class="fe-icon-phone"></i> <?php echo e($descripcion->telefono_1); ?> anexo <?php echo e($descripcion->anexo_1); ?>

        </a>
        <?php endif; ?>
        <?php if($descripcion->celular_1): ?>
        <a class="navbar-link text-dark mr-3" href="tel:<?php echo e($descripcion->celular_1); ?>">
          <i class="fe-icon-phone"></i> <?php echo e($descripcion->celular_1); ?>

        </a>
        <?php endif; ?>
        <?php if($descripcion->email_1): ?>
        <a class="navbar-link text-dark mr-3" href="mailto:<?php echo e($descripcion->email_1); ?>">
          <i class="fe-icon-mail"></i> <?php echo e($descripcion->email_1); ?>

        </a>
        <?php endif; ?>
      </div>
      <div>
        <ul class="navbar-nav list-inline mb-0">
          <li class="nav-item <?php echo e(active('/')); ?> <?php echo e(active('inicio')); ?>">
            <a class="nav-link" href="<?php echo e(route('web.index')); ?>">Inicio</a>
          </li>
          <li class="nav-item dropdown-toggle <?php echo e(active('nosotros')); ?> <?php echo e(active('nosotros/*')); ?>">
            <a class="nav-link" href="javascript:void(0)">Nosotros <i class="fe-icon-chevron-down"></i></a>
            <ul class="dropdown-menu right-aligned">
              <li class="dropdown-item <?php echo e(active('nosotros/mision-vision')); ?>">
                <a href="<?php echo e(route('web.mision-vision')); ?>">Misión y Visión</a>
              </li>
              <li class="dropdown-item <?php echo e(active('nosotros/organigrama')); ?>">
                <a href="<?php echo e(route('web.organigrama')); ?>">Organigrama</a>
              </li>
              <li class="dropdown-item <?php echo e(active('nosotros/vicerrectorado-investigacion')); ?>">
                <a href="<?php echo e(route('web.vicerrectorado-investigacion')); ?>">Vicerrectorado de Investigación</a>
              </li>
              <li class="dropdown-item <?php echo e(active('nosotros/direcciones')); ?>">
                <a href="<?php echo e(route('web.direcciones')); ?>">Direcciones</a>
              </li>
              <li class="dropdown-item <?php echo e(active('nosotros/unidades')); ?>">
                <a href="<?php echo e(route('web.unidades')); ?>">Unidades</a>
              </li>
              <li class="dropdown-item <?php echo e(active('nosotros/centros-investigacion-experimentacion')); ?>">
                <a href="<?php echo e(route('web.centros-investigacion-experimentacion')); ?>">Centros de Investigación y Experimentación</a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item <?php echo e(active('noticias')); ?>">
            <a class="nav-link" href="<?php echo e(route('web.noticias')); ?>">Noticias</a>
          </li>
          <li class="nav-item <?php echo e(active('eventos')); ?>">
            <a class="nav-link" href="<?php echo e(route('web.eventos')); ?>">Eventos</a>
          </li>
          <li class="nav-item <?php echo e(active('convocatorias')); ?>">
            <a class="nav-link" href="<?php echo e(route('web.convocatorias')); ?>">Convocatorias</a>
          </li>
          <?php if(auth()->guest()): ?>
          <li class="nav-item dropdown-toggle mr-2">
            <a class="nav-link" href="<?php echo e(route('login')); ?>">
              <i class="fe-icon-user"></i> Iniciar Sesión
            </a>
            <div class="dropdown-menu right-aligned p-3 text-center" style="min-width: 200px;">
              <p class="text-sm opacity-70">Inicie sesión en su cuenta o solicite la creación de una nueva.</p>
              <a class="btn btn-success btn-sm btn-block" href="<?php echo e(route('login')); ?>">Ingresar</a>
              <p class="text-sm text-muted mt-3 mb-0">
                ¿No tiene cuenta? <a href="<?php echo e(route('web.requisitos-deberes-derechos')); ?>">Registrarse</a>
              </p>
            </div>
          </li>
          <?php else: ?>
          <li class="nav-item dropdown-toggle mr-2">
            <a class="nav-link" href="<?php echo e(route('login')); ?>"><i class="fe-icon-user"></i> Perfil</a>
            <div class="dropdown-menu right-aligned p-3 text-center" style="min-width: 200px;">
              <a class="btn btn-success btn-sm btn-block" href="<?php echo e(route('login')); ?>">Perfil</a>
              <a class="btn btn-danger btn-sm btn-block" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
              <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                <?php echo csrf_field(); ?>
              </form>
            </div>
          </li>
          <?php endif; ?>
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
        <li class="nav-item dropdown-toggle <?php echo e(active('investigacion')); ?> <?php echo e(active('investigacion/*')); ?>">
          <a class="nav-link" href="#">Investigación <i class="fe-icon-chevron-down"></i></a>
          <ul class="dropdown-menu">
            <li class="dropdown-item <?php echo e(active('investigacion/investigadores')); ?>">
              <a href="<?php echo e(route('web.investigadores')); ?>">Investigadores</a>
            </li>
            <li class="dropdown-item <?php echo e(active('investigacion/areas-investigacion')); ?>">
              <a href="<?php echo e(route('web.areas-investigacion')); ?>">Áreas de Investigación</a>
            </li>
            <li class="dropdown-item <?php echo e(active('investigacion/grupos-investigacion')); ?>">
              <a href="<?php echo e(route('web.grupos-investigacion')); ?>">Grupos de Investigación</a>
            </li>

            <li class="dropdown-item <?php echo e(active('investigacion/semilleros-investigacion')); ?>">
              <a href="<?php echo e(route('web.semilleros-investigacion')); ?>">Semilleros de Investigacion</a>
            </li>

            <li class="dropdown-item <?php echo e(active('investigacion/circulos-investigacion')); ?>">
              <a href="<?php echo e(route('web.circulos-investigacion')); ?>">Círculos de Investigación</a>
            </li>
            <li class="dropdown-item <?php echo e(active('investigacion/proyectos-investigacion')); ?>">
              <a href="<?php echo e(route('web.proyectos-investigacion')); ?>">Proyectos de Investigación</a>
            </li>
            <li class="dropdown-item  <?php echo e(active('investigacion/requisitos-deberes-derechos')); ?>">
              <a href="<?php echo e(route('web.requisitos-deberes-derechos')); ?>">Registro de Investigadores</a>
            </li>
            <li class="dropdown-item <?php echo e(active('investigacion/plataforma-unica-investigacion')); ?>">
              <a href="<?php echo e(route('web.plataforma-unica-investigacion')); ?>">Plataforma Única de Investigación</a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown-toggle <?php echo e(active('publicaciones')); ?> <?php echo e(active('publicaciones/*')); ?>">
          <a class="nav-link" href="#">Publicaciones <i class="fe-icon-chevron-down"></i></a>
          <ul class="dropdown-menu">
            
            <li class="dropdown-item">
              <a href="http://repositorio.unasam.edu.pe/" target="_blank">Repositorio Institucional</a>
            </li>
            <li class="dropdown-item <?php echo e(active('publicaciones/patentes')); ?>">
              <a href="<?php echo e(route('web.patentes')); ?>">Las Patentes UNASAM</a>
            </li>
            
            <li class="dropdown-item <?php echo e(active('publicaciones/selasi')); ?>">
              <a href="<?php echo e(route('web.selasi')); ?>">SELASI</a>
            </li>
            <?php $__currentLoopData = $tipos_publicacion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo_publicacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="dropdown-item <?php echo e(active('publicaciones/' . $tipo_publicacion->slug)); ?>">
              <a href="<?php echo e(route('web.publicaciones', $tipo_publicacion->slug)); ?>"><?php echo e($tipo_publicacion->nombre); ?></a>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
            
          </ul>
        </li>
        <li class="nav-item dropdown-toggle <?php echo e(active('emprendimiento')); ?> <?php echo e(active('emprendimiento/*')); ?>">
          <a class="nav-link" href="#">Emprendimiento <i class="fe-icon-chevron-down"></i></a>
          <ul class="dropdown-menu">
            <li class="dropdown-item <?php echo e(active('emprendimiento/subvenciones')); ?>">
              <a href="<?php echo e(route('web.subvenciones')); ?>">Subvenciones</a>
            </li>
            <li class="dropdown-item <?php echo e(active('emprendimiento/emprendimientos')); ?>">
              <a href="<?php echo e(route('web.proyectos-emprendimiento')); ?>">Emprendimientos UNASAM</a>
            </li>
            <li class="dropdown-item  <?php echo e(active('emprendimiento/becas-pasantias-cursos')); ?>">
              <a href="<?php echo e(route('web.becas-pasantias-cursos')); ?>">Becas, Pasantías y Cursos para Alumnos</a>
            </li>
            <li class="dropdown-item <?php echo e(active('emprendimiento/servicios-tecnologicos')); ?>">
              <a href="<?php echo e(route('web.servicios-tecnologicos')); ?>">Servicios Tecnológicos UNASAM</a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown-toggle <?php echo e(active('cooperacion')); ?> <?php echo e(active('cooperacion/*')); ?>">
          <a class="nav-link" href="#">Cooperación <i class="fe-icon-chevron-down"></i></a>
          <ul class="dropdown-menu">
            <li class="dropdown-item <?php echo e(active('cooperacion/convenios')); ?>">
              <a href="<?php echo e(route('web.convenios')); ?>">Convenios</a>
            </li>
            <li class="dropdown-item <?php echo e(active('cooperacion/movilidad')); ?>">
              <a href="<?php echo e(route('web.movilidad')); ?>">Movilidad</a>
            </li>
          </ul>
        </li>
        
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
</header><?php /**PATH C:\Users\flitp\OneDrive\Desktop\appVRI\resources\views/layouts/web/main-navigation.blade.php ENDPATH**/ ?>