
<?php $__env->startSection('title', 'Convocatorias | '); ?>
<?php $__env->startSection('content'); ?>
  <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
    <div class="container text-left align-self-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('web.index')); ?>">Inicio</a></li>
        </ol>
      </nav>
      <h1 class="page-title-heading mt-3">Convocatorias</h1>
    </div>
  </div>
  <section class="container pt-3 mb-3">
    <div class="row">
      <?php $__currentLoopData = $convocatorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $convocatoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-xl-4 col-lg-4 col-md-6">
        <div class="grid-item branding mb-30">
          <div class="card portfolio-card">
            <?php if(count($convocatoria->images) > 0): ?> <img src="<?php echo e(asset('archivos/imagenes/convocatorias')); ?>/<?php echo e($convocatoria->images[0]->path); ?>" alt="<?php echo e($convocatoria->titulo); ?>"/> <?php else: ?> <img src="<?php echo e(asset('archivos/imagenes/convocatorias/default.jpg')); ?>" alt="<?php echo e($convocatoria->titulo); ?>"/> <?php endif; ?>
            <div class="card-body">
              <div class="portfolio-meta">
                <span class="mr-3">
                  <i class="fe-icon-tag"></i> <?php echo e($convocatoria->tipo_convocatoria->nombre); ?>

                </span>
              </div>
              <div class="portfolio-meta">
                <span class="mr-3">
                  <i class="fe-icon-calendar"></i> Desde <?php echo e(date('d/m/Y', strtotime($convocatoria->desde ))); ?>

                </span>
              </div>
              <div class="portfolio-meta">
                <span class="mr-3">
                  <i class="fe-icon-calendar"></i> Hasta <?php if($convocatoria->hasta): ?> <?php echo e(date('d/m/Y', strtotime($convocatoria->hasta ))); ?> <?php else: ?> --- <?php endif; ?>
                </span>
              </div>
              <h3 class="portfolio-title text-center">
                <a href="<?php echo e(route('web.convocatoria', $convocatoria->slug)); ?>"><?php echo e(limit_string($convocatoria->titulo, 200, '...')); ?></a>
              </h3>
              <a class="btn btn-style-6 btn-primary btn-sm btn-block mt-3" href="<?php echo e(route('web.convocatoria', $convocatoria->slug)); ?>">Informarse</a>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="d-flex justify-content-center">
      <?php echo e($convocatorias->links("pagination::bootstrap-4")); ?>

    </div>
  </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/appVRI/resources/views/web/convocatorias.blade.php ENDPATH**/ ?>