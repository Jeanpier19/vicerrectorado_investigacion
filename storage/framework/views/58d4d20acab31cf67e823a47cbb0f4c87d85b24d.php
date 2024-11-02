
<?php $__env->startSection('title', 'Eventos | '); ?>
<?php $__env->startSection('content'); ?>
  <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
    <div class="container text-left align-self-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('web.index')); ?>">Inicio</a></li>
        </ol>
      </nav>
      <h1 class="page-title-heading mt-3">Eventos</h1>
    </div>
  </div>
  <section class="container pt-3 mb-3">
    <div class="row">
      <?php $__currentLoopData = $eventos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-xl-4 col-lg-4 col-md-6">
        <div class="grid-item branding mb-30">
          <div class="card portfolio-card">
            <?php if(count($evento->images) > 0): ?> <img src="<?php echo e(asset('archivos/imagenes/eventos')); ?>/<?php echo e($evento->images[0]->path); ?>" alt="<?php echo e($evento->titulo); ?>"/> <?php else: ?> <img src="<?php echo e(asset('archivos/imagenes/eventos/default.jpg')); ?>" alt="<?php echo e($evento->titulo); ?>"/> <?php endif; ?>
            <div class="card-body">
              <div class="portfolio-meta">
                <span class="mr-3">
                  <i class="fe-icon-calendar"></i> <?php echo e(date('d/m/Y', strtotime($evento->fecha))); ?>

                </span>
                <span class="mr-3">
                  <i class="fe-icon-tag"></i> <?php $__currentLoopData = $evento->etiquetas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $etiqueta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($etiqueta->nombre); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </span>
              </div>
              <div class="portfolio-meta text-left">
                <span class="mr-3">
                  <i class="fe-icon-map-pin"></i> <?php echo e($evento->lugar); ?>

                </span>
              </div>
              <div class="portfolio-meta text-left">
                <span class="mr-3">
                  <i class="fe-icon-users"></i> <?php echo e($evento->dirigido); ?>

                </span>
              </div>
              <h3 class="portfolio-title text-center">
                <a href="<?php echo e(route('web.evento', $evento->slug)); ?>"><?php echo e(limit_string($evento->titulo, 200, '...')); ?></a>
              </h3>
              <a class="btn btn-style-6 btn-primary btn-sm btn-block mt-3" href="<?php echo e(route('web.evento', $evento->slug)); ?>">Informarse</a>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="d-flex justify-content-center">
      <?php echo e($eventos->links("pagination::bootstrap-4")); ?>

    </div>
  </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/appVRI/resources/views/web/eventos.blade.php ENDPATH**/ ?>