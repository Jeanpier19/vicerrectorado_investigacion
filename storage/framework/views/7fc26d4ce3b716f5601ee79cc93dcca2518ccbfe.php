
<?php $__env->startSection('title'); ?><?php echo e($noticia->titulo); ?> | <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
    <div class="container text-left align-self-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('web.index')); ?>">Inicio</a></li>
          <li class="breadcrumb-item"><a href="<?php echo e(route('web.noticias')); ?>">Noticias</a></li>
        </ol>
      </nav>
      <h1 class="page-title-heading mt-3"><?php echo e($noticia->titulo); ?></h1>
    </div>
  </div>
  <section class="container pt-3 mb-3 noticia">
    <div class="card">
      <div class="card-header">
        <p class="text-muted"><i class="fe-icon-calendar"></i> <?php echo e(date('d/m/Y', strtotime($noticia->fecha))); ?></p>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12 wow fadeInUp">
            <div class="card-body p-0">
              <?php
                echo $noticia->descripcion;
              ?>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: true, &quot;dots&quot;: true, &quot;loop&quot;: true }"><?php $__currentLoopData = $noticia->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><img src="<?php echo e(asset('archivos/imagenes/noticias')); ?>/<?php echo e($image->path); ?>" alt="Galería"s/><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div>
            <?php if(count($noticia->files) > 0): ?>
              <h2 class="block-title h5 mt-3">Anexos</h2>
              <ul class="list-group">
                <?php $__currentLoopData = $noticia->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="list-group-item">
                    <a href="<?php echo e(asset('archivos/documentos/noticias')); ?>/<?php echo e($file->path); ?>" class="d-block" title="Ver documento" target="_blank">
                      <i class="fe-icon-file"></i>
                      <?php echo e($file->name); ?>

                    </a>
                    <div class="text-center mt-2">
                      <a href="<?php echo e(asset('archivos/documentos/noticias')); ?>/<?php echo e($file->path); ?>" class="btn btn-sm btn-style-6 btn-success" title="Descargar documento" download="<?php echo e($file->slug); ?>"><i class="fe-icon-download-cloud"></i> Descargar</a>
                    </div>
                  </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/appVRI/resources/views/web/noticia.blade.php ENDPATH**/ ?>