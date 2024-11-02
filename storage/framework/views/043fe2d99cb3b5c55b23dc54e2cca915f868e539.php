
<?php $__env->startSection('title', 'Unidades | '); ?>
<?php $__env->startSection('content'); ?>
  <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
    <div class="container text-left align-self-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('web.index')); ?>">Inicio</a></li>
        </ol>
      </nav>
      <h1 class="page-title-heading mt-3">Unidades</h1>
    </div>
  </div>
  <section class="container pt-3 mb-3">
    <div class="row">
      <div class="col-lg-6 col-sm-12 mb-5 wow fadeInUp">
        <div class="card">
          <div class="card-header">
            <h2 class="h4 block-title">Unidad de Investigación e Innovación UII</h2>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-12 text-center">
                <a href="<?php echo e(asset('archivos/imagenes/usuario-masculino.jpg')); ?>" class="fancybox" data-fancybox="Direccion" data-caption="HUGO WALTER MALDONADO LEYVA (Unidad de Investigación e Innovación UII)">
                  <img src="<?php echo e(asset('archivos/imagenes/uii.jpg')); ?>" class="img-fluid" alt="">
                </a>
              </div>
              <div class="col-lg-8 col-md-8 col-sm-12 text-center text-lg-left text-md-left">
                <h3 class="h6 text-dark mt-1">HUGO WALTER MALDONADO LEYVA</h3>
                <!-- <p class="text-muted mb-1">Ingeniero Sanitario de la Universidad Nacional Santiago Antúnez de Mayolo.</p> -->
                <p class="text-muted mb-1"><a href="mailto:hmaldonadol@unasam.edu.pe"><i class="fe-icon-mail"></i> hmaldonadol@unasam.edu.pe</a></p>
                <p class="text-muted mb-1"><a href="tel:043 640020"><i class="fe-icon-phone"></i> 043 640020</a></p>
                <a href="javascript:void(0);" target="_blank" class="btn btn-sm btn-style-6 btn-primary my-1">CTI vitae <i class="fe-icon-arrow-right"></i></a>
                <a href="javascript:void(0);" target="_blank" class="btn btn-sm btn-style-6 btn-success my-1">ORCID <i class="fe-icon-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-sm-12 mb-5 wow fadeInUp">
        <div class="card">
          <div class="card-header">
            <h2 class="h4 block-title">Unidad de Cooperación Técnica UCT</h2>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-12 text-center">
                <a href="<?php echo e(asset('archivos/imagenes/uct.jpg')); ?>" class="fancybox" data-fancybox="Direccion" data-caption="EDWIN JULIO PALOMINO CADENAS (Unidad de Cooperación Técnica UCT)">
                  <img src="<?php echo e(asset('archivos/imagenes/uct.jpg')); ?>" class="img-fluid" alt="">
                </a>
              </div>
              <div class="col-lg-8 col-md-8 col-sm-12 text-center text-lg-left text-md-left">
                <h3 class="h6 text-dark mt-1">EDWIN JULIO PALOMINO CADENAS</h3>
                <!-- <p class="text-muted mb-1">Docente de matemática y computación adscrito al Departamento Académico de Matemática de la Universidad Nacional Santiago Antúnez de Mayolo. Doctor en Ciencia e Ingeniería de la Computación.</p> -->
                <p class="text-muted mb-1"><a href="mailto:revistaaportesantiaguino@unasam.edu.pe"><i class="fe-icon-mail"></i> revistaaportesantiaguino@unasam.edu.pe</a></p>
                <p class="text-muted mb-1"><a href="mailto:epalominoc@unasam.edu.pe"><i class="fe-icon-mail"></i> epalominoc@unasam.edu.pe</a></p>
                <p class="text-muted mb-1"><a href="tel:043 640020"><i class="fe-icon-phone"></i> 043 640020 Anexo 3612</a></p>
                <a href="javascript:void(0);" target="_blank" class="btn btn-sm btn-style-6 btn-primary my-1">CTI vitae <i class="fe-icon-arrow-right"></i></a>
                <a href="javascript:void(0);" target="_blank" class="btn btn-sm btn-style-6 btn-success my-1">ORCID <i class="fe-icon-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/appVRI/resources/views/web/unidades.blade.php ENDPATH**/ ?>