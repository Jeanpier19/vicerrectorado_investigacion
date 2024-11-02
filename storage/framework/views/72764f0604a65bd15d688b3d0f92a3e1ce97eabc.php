
<?php $__env->startSection('title', 'Organigrama | '); ?>
<?php $__env->startSection('content'); ?>
  <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
    <div class="container text-left align-self-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('web.index')); ?>">Inicio</a></li>
        </ol>
      </nav>
      <h1 class="page-title-heading mt-3">Estructura Orgánica</h1>
    </div>
  </div>
  <section class="container pt-3 mb-3">
    <embed src="<?php echo e(asset('archivos/documentos/descripcion')); ?>/<?php echo e($descripcion->file->path); ?>" type="application/pdf" width="100%" height="600px"/>
  </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/appVRI/resources/views/web/organigrama.blade.php ENDPATH**/ ?>