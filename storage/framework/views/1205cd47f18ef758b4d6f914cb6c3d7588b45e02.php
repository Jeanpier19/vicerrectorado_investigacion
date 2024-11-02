<footer class="pt-3 mt-5">
  <div class="container">
    <div class="row pb-3">
      <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12">
        <div class="logo">
          <a href="<?php echo e(route('web.index')); ?>">
            <img src="<?php echo e(asset('archivos/imagenes/logo-white.png')); ?>" class="logo-image img-fluid" alt="">
          </a>
        </div>
        <hr>
        <ul class="information-list">
          <li><i class="fe-icon-map-pin"></i>&nbsp;<?php echo e($descripcion->direccion); ?></li>
          <?php if($descripcion->telefono_1): ?><li><a href="tel:<?php echo e($descripcion->telefono_1); ?>"><i class="fe-icon-phone"></i>&nbsp;<?php echo e($descripcion->telefono_1); ?> Anexo <?php echo e($descripcion->anexo_1); ?></a></li><?php endif; ?>
          <?php if($descripcion->telefono_2): ?><li><a href="tel:<?php echo e($descripcion->telefono_2); ?>"><i class="fe-icon-phone"></i>&nbsp;<?php echo e($descripcion->telefono_2); ?> Anexo <?php echo e($descripcion->anexo_2); ?></a></li><?php endif; ?>
          <?php if($descripcion->telefono_3): ?><li><a href="tel:<?php echo e($descripcion->telefono_3); ?>"><i class="fe-icon-phone"></i>&nbsp;<?php echo e($descripcion->telefono_3); ?> Anexo <?php echo e($descripcion->anexo_3); ?></a></li><?php endif; ?>
          <?php if($descripcion->celular_1): ?><li><a href="tel:<?php echo e($descripcion->celular_1); ?>"><i class="fe-icon-phone"></i>&nbsp;<?php echo e($descripcion->celular_1); ?></a></li><?php endif; ?>
          <?php if($descripcion->celular_2): ?><li><a href="tel:<?php echo e($descripcion->celular_2); ?>"><i class="fe-icon-phone"></i>&nbsp;<?php echo e($descripcion->celular_2); ?></a></li><?php endif; ?>
          <?php if($descripcion->celular_3): ?><li><a href="tel:<?php echo e($descripcion->celular_3); ?>"><i class="fe-icon-phone"></i>&nbsp;<?php echo e($descripcion->celular_3); ?></a></li><?php endif; ?>
          <?php if($descripcion->email_1): ?><li><a href="mailto:<?php echo e($descripcion->email_1); ?>"><i class="fe-icon-mail"></i>&nbsp;<?php echo e($descripcion->email_1); ?></a></li><?php endif; ?>
          <?php if($descripcion->email_2): ?><li><a href="mailto:<?php echo e($descripcion->email_2); ?>"><i class="fe-icon-mail"></i>&nbsp;<?php echo e($descripcion->email_2); ?></a></li><?php endif; ?>
          <?php if($descripcion->email_3): ?><li><a href="mailto:<?php echo e($descripcion->email_3); ?>"><i class="fe-icon-mail"></i>&nbsp;<?php echo e($descripcion->email_3); ?></a></li><?php endif; ?>
        </ul>
      </div>
      <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-xs-12">
        <div class="row">
          <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
            <h6 class="text-uppercase h6 block-title">Nosotros</h6>
            <ul class="m-0">
              <li class="mb-1"><a href="<?php echo e(route('web.mision-vision')); ?>">Misión y Visión</a></li>
              <li class="mb-1"><a href="<?php echo e(route('web.organigrama')); ?>">Organigrama</a></li>
              <li class="mb-1"><a href="<?php echo e(route('web.vicerrectorado-investigacion')); ?>">Vicerrectorado de Investigación</a></li>
              <li class="mb-1"><a href="<?php echo e(route('web.direcciones')); ?>">Direcciones</a></li>
              <li class="mb-1"><a href="<?php echo e(route('web.unidades')); ?>">Unidades</a></li>
              <li class="mb-1"><a href="<?php echo e(route('web.centros-investigacion-experimentacion')); ?>">Centros de Investigación y Experimentación</a></li>
              <li class="mb-1"><a href="<?php echo e(route('web.plataforma-unica-investigacion')); ?>">Plataforma Única de Investigación</a></li>
            </ul>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
            <h6 class="text-uppercase h6 block-title">Investigación</h6>
            <ul class="m-0">
              <li class="mb-1"><a href="http://repositorio.unasam.edu.pe/" target="_blank">Repositorio Institucioal</a></li>
              <li class="mb-1"><a href="<?php echo e(route('web.patentes')); ?>">Las Patentes UNASAM</a></li>
              <li class="mb-1"><a href="<?php echo e(route('web.proyectos-investigacion')); ?>">Proyectos de Investigación</a></li>
              
              <li class="mb-1"><a href="<?php echo e(route('web.selasi')); ?>">SELASI</a></li>
              <?php $__currentLoopData = $tipos_publicacion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo_publicacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li class="mb-1"><a href="<?php echo e(route('web.publicaciones', $tipo_publicacion->slug)); ?>"><?php echo e($tipo_publicacion->nombre); ?></a></li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
            <h6 class="text-uppercase h6 block-title">Emprendimiento</h6>
            <ul class="m-0">
              <li class="mb-1"><a href="<?php echo e(route('web.subvenciones')); ?>">Subvenciones</a></li>
              <li class="mb-1"><a href="<?php echo e(route('web.proyectos-emprendimiento')); ?>">Emprendimientos UNASAM</a></li>
              <li class="mb-1"><a href="<?php echo e(route('web.becas-pasantias-cursos')); ?>">Becas, Pasantías y Cursos para Alumnos</a></li>
              <li class="mb-1"><a href="<?php echo e(route('web.servicios-tecnologicos')); ?>">Servicios Tecnológicos UNASAM</a></li>
              <li class="mb-1"><a href="<?php echo e(route('web.convenios')); ?>">Convenios</a></li>
              <li class="mb-1"><a href="<?php echo e(route('web.movilidad')); ?>">Movilidad</a></li>
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
          <p class="m-0 p-0">© 2020<a href="<?php echo e($descripcion->facebook); ?>" target="_blank"> Vicerrectorado de Invsestigación</a> Todos los Derechos Reservados.</p>
        </div>
        <div class="col-xl-4 col-lg-5 col-md-6 text-center text-xl-right text-lg-right">
          <p class="m-0 p-0"><a href="https://www.facebook.com/UnasamOficial" target="_blank"> UNASAM</a></p>
        </div>
      </div>
    </div>
  </div>
</footer><?php /**PATH D:\1. Tecnología Web\Proyecto\SEMANA IX\AppVRI\appVRI\resources\views/layouts/web/main-footer.blade.php ENDPATH**/ ?>