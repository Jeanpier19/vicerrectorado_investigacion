<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Vicerectorado de Investigación VRI UNASAM, Dirección del Instituto de Investigación DII UNASAM, Universidad Nacional Santiago Antúnez de Mayolo UNASAM, Investigación UNASAM, Oficina General de Tecnologías de Información, Sistemas y Estadística OGTISE UNASAM">
    <meta name="description" content="Vicerectorado de Investigación VRI UNASAM, Dirección del Instituto de Investigación DII UNASAM, Universidad Nacional Santiago Antúnez de Mayolo UNASAM, Investigación UNASAM">
    <?php echo $__env->yieldContent('custom_meta'); ?>
    <title><?php echo $__env->yieldContent('title_prefix'); ?><?php echo $__env->yieldContent('title'); ?><?php echo $__env->yieldContent('title_postfix', 'Vicerectorado de Investigación VRI UNASAM | Dirección del Instituto de Investigación DII UNASAM | Universidad Nacional Santiago Antúnez de Mayolo UNASAM | Investigación UNASAM'); ?></title>
    <link rel="icon" type="images/png" href="<?php echo e(asset('archivos/imagenes/favicon.png')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/web/app_4.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/web/main_4.css')); ?>">
    <script src="<?php echo e(asset('js/web/app_4.js')); ?>"></script>
    <script src="<?php echo e(asset('js/web/main_4.js')); ?>"></script>
    <?php echo $__env->yieldContent('custom_css'); ?>
  </head>
  <body>
    <div class="social-bar d-none d-lg-block">
      <ul>
        <li class="facebook" data-toggle="tooltip" data-placement="right" title="Síguenos en Facebook"><a href="<?php echo e($descripcion->facebook); ?>" target="_blank"><i class="socicon-facebook"></i></a></li>
        <li class="twitter" data-toggle="tooltip" data-placement="right" title="Síguenos en Twitter"><a href="<?php echo e($descripcion->twitter); ?>" target="_blank"><i class="socicon-twitter"></i></a></li>
        <li class="instagram" data-toggle="tooltip" data-placement="right" title="Síguenos en Instagram"><a href="<?php echo e($descripcion->instagram); ?>" target="_blank"><i class="socicon-instagram"></i></a></li>
        <li class="youtube" data-toggle="tooltip" data-placement="right" title="Síguenos en Youtube"><a href="<?php echo e($descripcion->youtube); ?>" target="_blank"><i class="socicon-youtube"></i></a></li>
      </ul>
    </div>
    <!-- Back To Top Button--><a class="scroll-to-top-btn" href="#"><i class="fe-icon-chevron-up"></i></a>
    <?php echo $__env->make('layouts.web.mobile-navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts.web.main-navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <main class="m-0 p-0 border-0" role="main" id="main">
      <?php echo $__env->yieldContent('content'); ?>
    </main>
    <?php echo $__env->make('layouts.web.main-footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <?php echo $__env->yieldContent('custom_js'); ?>
  </body>
</html><?php /**PATH D:\1. Tecnología Web\Proyecto\SEMANA IX\AppVRI\appVRI\resources\views/layouts/web/master.blade.php ENDPATH**/ ?>