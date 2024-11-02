
<?php $__env->startSection('title', 'Patentes | '); ?>
<?php $__env->startSection('content'); ?>
  <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
    <div class="container text-left align-self-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('web.index')); ?>">Inicio</a></li>
        </ol>
      </nav>
      <h1 class="page-title-heading mt-3">Patentes</h1>
    </div>
  </div>
  <section class="container pt-3 mb-3">
    
    <h2 class="h2 block-title text-center mb-3">Buscador de Patentes</h2>
    <iframe src="https://servicio.indecopi.gob.pe/portalSAE/Personas/tituloOIN.jsp" style="height: 80vh; width: 100%"></iframe>
    <p class="mb-5"><strong>Fuente:</strong> <a href="https://servicio.indecopi.gob.pe/portalSAE/Personas/tituloOIN.jsp" target="_blank">Buscador de patentes de INDECOPI</a></p>
    <h2 class="h2 block-title text-center mb-3">Buscador de Resoluciones</h2>
    <iframe src="https://servicio.indecopi.gob.pe/buscadorResoluciones/propiedad-intelectual.seam" style="height: 80vh; width: 100%"></iframe>
    <p class="mb-5"><strong>Fuente:</strong> <a href="https://servicio.indecopi.gob.pe/buscadorResoluciones/propiedad-intelectual.seam" target="_blank">Buscador de resoluciones de INDECOPI</a></p>

    <h2 class="h2 block-title text-center mb-5">Enlaces de interés</h2>
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12 mb-5 wow fadeInUp">
        <div class="card">
          <a href="https://patentscope.wipo.int/search/es/search.jsf" target="_blank">
            <div class="row">
              <div class="col-4">
                <figure class="m-0">
                  <img src="<?php echo e(asset('archivos/imagenes/ompi.png')); ?>" class="img-fluid" alt="">
                </figure>
              </div>
              <div class="col-8">
                <h2 class="h6 text-dark">OMPI - Organización Mundial de la Propiedad Intelectual</h2>
                <p class="text-muted">PATENTSCOPE. Registro y colecciones nacionales e internacionales de patentes.</p>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 mb-5 wow fadeInUp">
        <div class="card">
          <a href="https://worldwide.espacenet.com/advancedSearch?locale=en_EP" target="_blank">
            <div class="row">
              <div class="col-4">
                <figure class="m-0">
                  <img src="<?php echo e(asset('archivos/imagenes/europa.png')); ?>" class="img-fluid" alt="">
                </figure>
              </div>
              <div class="col-8">
                <h2 class="h6 text-dark">Oficina Europea de Patentes</h2>
                <p class="text-muted">Búsqueda de patentes en Europa y en todo el mundo. Colecciones publicadas de más de 100 países.</p>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 mb-5 wow fadeInUp">
        <div class="card">
          <a href="http://patft.uspto.gov/" target="_blank">
            <div class="row">
              <div class="col-4">
                <figure class="m-0">
                  <img src="<?php echo e(asset('archivos/imagenes/eeuu.png')); ?>" class="img-fluid" alt="">
                </figure>
              </div>
              <div class="col-8">
                <h2 class="h6 text-dark">Oficina de Patentes y Marcas de Estado Unidos</h2>
                <p class="text-muted">Búsqueda de patentes en Estados Unidos. Contenido de la base de datos de las patentes</p>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/appVRI/resources/views/web/patentes.blade.php ENDPATH**/ ?>