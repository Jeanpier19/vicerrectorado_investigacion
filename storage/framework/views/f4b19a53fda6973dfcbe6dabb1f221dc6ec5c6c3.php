
<?php $__env->startSection('title', 'Galerías | '); ?>
<?php $__env->startSection('content'); ?>
  <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
    <div class="container text-left align-self-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('web.index')); ?>">Inicio</a></li>
        </ol>
      </nav>
      <h1 class="page-title-heading mt-3">Galerías</h1>
    </div>
  </div>
  <section class="container pt-3 mb-3">
    <div class="row">
      <?php $__currentLoopData = $galerias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $galeria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-md-4">
        <div class="grid-item branding mb-30">
          <div class="card portfolio-card">
            <div class="card-header">
              <h3 class="portfolio-title text-center"><?php echo e($galeria->titulo); ?></h3>
            </div>
            <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: true, &quot;dots&quot;: true, &quot;loop&quot;: true }"><?php $__currentLoopData = $galeria->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><img src="<?php echo e(asset('archivos/imagenes/galerias')); ?>/<?php echo e($image->path); ?>" alt="Galería"s/><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div>
            <div class="card-body">
            <?php
              echo limit_string($galeria->descripcion, 200, '...')
            ?>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="d-flex justify-content-center">
      <?php echo e($galerias->links("pagination::bootstrap-4")); ?>

    </div>
  </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/appVRI/resources/views/web/galerias.blade.php ENDPATH**/ ?>