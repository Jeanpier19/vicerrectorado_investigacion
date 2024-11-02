
<?php $__env->startSection('title', 'Misión y visión | '); ?>
<?php $__env->startSection('content'); ?>
  <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
    <div class="container text-left align-self-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('web.index')); ?>">Inicio</a></li>
        </ol>
      </nav>
      <h1 class="page-title-heading mt-3">Misión y Visión</h1>
    </div>
  </div>
  <section class="container pt-3 mb-4">
    <h2 class="h3 block-title text-dark mt-2 wow fadeInUp">Misión</h2>
    <?php
      echo $descripcion->mision
    ?>
    <h2 class="h3 block-title text-dark mt-2 wow fadeInUp">Visión</h2>
    <?php
      echo $descripcion->vision
    ?>
  </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/appVRI/resources/views/web/mision-vision.blade.php ENDPATH**/ ?>