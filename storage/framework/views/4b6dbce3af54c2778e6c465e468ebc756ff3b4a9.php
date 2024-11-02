<div class="offcanvas-container is-triggered offcanvas-container-reverse" id="mobile-menu"><span class="offcanvas-close"><i class="fe-icon-x"></i></span>
  <div class="px-4 pb-4">
    <h6>Menú</h6>
    <div class="d-flex justify-content-between pt-2">
      <?php if(auth()->guest()): ?>
      <a class="btn btn-info btn-sm btn-block" href="<?php echo e(route('login')); ?>"><i class="fe-icon-user"></i>&nbsp;Iniciar Sesión</a>
      <?php else: ?>
      <a class="btn btn-success btn-sm btn-block" href="<?php echo e(route('login')); ?>"><i class="fe-icon-user"></i>&nbsp;Perfil</a>
      <?php endif; ?>
    </div>
  </div>
  <div class="offcanvas-scrollable-area border-top" style="height:calc(100% - 235px); top: 144px;">
    <div class="accordion mobile-menu" id="accordion-menu">
      <div class="card">
        <div class="card-header"><a class="mobile-menu-link <?php echo e(active('/')); ?> <?php echo e(active('inicio')); ?>" href="<?php echo e(route('web.index')); ?>">Inicio</a></div>
      </div>
      <div class="card">
        <div class="card-header"><a class="mobile-menu-link <?php echo e(active('nosotros')); ?> <?php echo e(active('nosotros/*')); ?>" href="javascript:void(0)">Nosotros</a><a class="collapsed" href="#nosotros-submenu" data-toggle="collapse"></a></div>
        <div class="collapse" id="nosotros-submenu" data-parent="#accordion-menu">
          <div class="card-body">
            <ul>
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
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header"><a class="mobile-menu-link <?php echo e(active('noticias')); ?>" href="<?php echo e(route('web.noticias')); ?>">Noticias</a></div>
      </div>
      <div class="card">
        <div class="card-header"><a class="mobile-menu-link <?php echo e(active('eventos')); ?>" href="<?php echo e(route('web.eventos')); ?>">Eventos</a></div>
      </div>
      <div class="card">
        <div class="card-header"><a class="mobile-menu-link <?php echo e(active('convocatorias')); ?>" href="<?php echo e(route('web.convocatorias')); ?>">Convocatorias</a></div>
      </div>
      <div class="card">
        <div class="card-header"><a class="mobile-menu-link <?php echo e(active('investigacion')); ?> <?php echo e(active('investigacion/*')); ?>" href="javascript:void(0)">Investigación</a><a class="collapsed" href="#investigacion-submenu" data-toggle="collapse"></a></div>
        <div class="collapse" id="investigacion-submenu" data-parent="#accordion-menu">
          <div class="card-body">
            <ul>
              <li class="dropdown-item <?php echo e(active('investigacion/investigadores')); ?>">
                <a href="<?php echo e(route('web.investigadores')); ?>">Investigadores</a>
              </li>
              <li class="dropdown-item <?php echo e(active('investigacion/areas-investigacion')); ?>">
                <a href="<?php echo e(route('web.areas-investigacion')); ?>">Áreas de Investigación</a>
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
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header"><a class="mobile-menu-link <?php echo e(active('publicaciones')); ?> <?php echo e(active('publicaciones/*')); ?>" href="javascript:void(0)">Publicaciones</a><a class="collapsed" href="#publicaciones-submenu" data-toggle="collapse"></a></div>
        <div class="collapse" id="publicaciones-submenu" data-parent="#accordion-menu">
          <div class="card-body">
            <ul>
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
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header"><a class="mobile-menu-link <?php echo e(active('emprendimiento')); ?> <?php echo e(active('emprendimiento/*')); ?>" href="javascript:void(0)">Emprendimiento</a><a class="collapsed" href="#emprendimiento-submenu" data-toggle="collapse"></a></div>
        <div class="collapse" id="emprendimiento-submenu" data-parent="#accordion-menu">
          <div class="card-body">
            <ul>
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
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header"><a class="mobile-menu-link <?php echo e(active('cooperacion')); ?> <?php echo e(active('cooperacion/*')); ?>" href="javascript:void(0)">Cooperación</a><a class="collapsed" href="#cooperacion-submenu" data-toggle="collapse"></a></div>
        <div class="collapse" id="cooperacion-submenu" data-parent="#accordion-menu">
          <div class="card-body">
            <ul>
              <li class="dropdown-item <?php echo e(active('cooperacion/convenios')); ?>">
                <a href="<?php echo e(route('web.convenios')); ?>">Convenios</a>
              </li>
              <li class="dropdown-item <?php echo e(active('cooperacion/movilidad')); ?>">
                <a href="<?php echo e(route('web.movilidad')); ?>">Movilidad</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="offcanvas-footer px-4 pt-3 pb-2 text-center"><a class="social-btn sb-style-3 sb-facebook" href="<?php echo e($descripcion->facebook); ?>" target="_blank"><i class="socicon-facebook"></i></a><a class="social-btn sb-style-3 sb-twitter" href="<?php echo e($descripcion->twitter); ?>" target="_blank"><i class="socicon-twitter"></i></a><a class="social-btn sb-style-3 sb-instagram" href="<?php echo e($descripcion->instagram); ?>" target="_blank"><i class="socicon-instagram"></i></a><a class="social-btn sb-style-3 sb-youtube" href="<?php echo e($descripcion->youtube); ?>" target="_blank"><i class="socicon-youtube"></i></a><a class="social-btn sb-style-3 sb-whatsapp" href="https://api.whatsapp.com/send?phone=+51<?php echo e($descripcion->whatsapp); ?>&text=¡Hola! Necesito información sobre los servicios que brindan.&source=&data=" target="_blank"><i class="socicon-whatsapp"></i></a></div>
</div><?php /**PATH /var/www/appVRI/resources/views/layouts/web/mobile-navigation.blade.php ENDPATH**/ ?>