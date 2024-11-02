
<?php $__env->startSection('title', 'Publicaciones |' . $tipo_publicacion->nombre . ' | '); ?>
<?php $__env->startSection('content'); ?>
  <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
    <div class="container text-left align-self-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('web.index')); ?>">Inicio</a></li>
        </ol>
      </nav>
      <h1 class="page-title-heading mt-3">Publicaciones</h1>
      <div class="page-title-subheading h6"><?php echo e($tipo_publicacion->nombre); ?></div>
    </div>
  </div>
  <section class="container pt-3 mb-3">
    <?php $__currentLoopData = $publicaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="card mb-5 wow fadeInUp">
      <div class="card-header">
        <h2 class="h5"><?php echo e($item->titulo); ?></h2>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
            <figure class="text-center">
              <?php if($item->image): ?>
  <img src="<?php echo e(asset('archivos/imagenes/publicaciones')); ?>/<?php echo e($item->image->path); ?>" class="img-fluid img-thumbnail" alt="<?php echo e($item->titulo); ?>">
<?php else: ?>
  <span>Imagen no disponible</span>
<?php endif; ?>
            </figure>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
            <p class="text-muted"><?php echo e($item->descripcion); ?></p>
            <?php if($item->file): ?>
    <a href="<?php echo e(asset('archivos/documentos/publicaciones')); ?>/<?php echo e($item->file->path); ?>" class="btn btn-style-4 btn-danger" target="_blank"><i class="fe-icon-file"></i> Ver Publicación</a>
    <a href="<?php echo e(asset('archivos/documentos/publicaciones')); ?>/<?php echo e($item->file->path); ?>" class="btn btn-style-4 btn-primary" download="<?php echo e($item->slug); ?>"><i class="fe-icon-download-cloud"></i> Descargar</a>
<?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div class="d-flex justify-content-center">
      <?php echo e($publicaciones->links()); ?>

    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/appVRI/resources/views/web/publicaciones.blade.php ENDPATH**/ ?>