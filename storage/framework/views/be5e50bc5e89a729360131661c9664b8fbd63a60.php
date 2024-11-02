
<?php $__env->startSection('content'); ?>
  <section class="container-fluid p-0 slider">
    <?php if(count($banners) > 0): ?>
    <div id="banner" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li data-target="#banner" data-slide-to="<?php echo e($key == 0 ? '0' : $key++); ?>" class="<?php echo e($key == 0 ? 'active' : ''); ?>"></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ol>
      <div class="carousel-inner">
        <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
          <figure>
            <?php if($banner->link): ?>
            <a href="<?php echo e($banner->link); ?>" target="_blank">
              <img src="<?php echo e(asset('archivos/imagenes/banners')); ?>/<?php echo e($banner->image->path); ?>" class="d-block w-100 img-fluid wow fadeIn" data-wow-duration="1s" alt="Banner">
            </a>
            <?php else: ?>
              <img src="<?php echo e(asset('archivos/imagenes/banners')); ?>/<?php echo e($banner->image->path); ?>" class="d-block w-100 img-fluid wow fadeIn" data-wow-duration="1s" alt="Banner">
            <?php endif; ?>
          </figure>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <a class="carousel-control-prev" href="#banner" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
      </a>
      <a class="carousel-control-next" href="#banner" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Siguiente</span>
      </a>
    </div>
    <?php else: ?>
    <img src="<?php echo e(asset('archivos/imagenes/default.png')); ?>" class="d-block w-100 img-fluid wow fadeIn" data-wow-duration="1s" alt="Imagen">
    <?php endif; ?>
  </section>
  <section class="container pt-3 mb-3 links">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 wow fadeInUp">
        <div class="card mb-5">
          <div class="card-header text-center">
            <a href="<?php echo e(route('web.convocatorias')); ?>" class="h6">Convocatorias</a>
          </div>
          <div class="card-body text-center">
            <a href="<?php echo e(route('web.convocatorias')); ?>" class="btn btn-style-4 btn-style-6 btn-primary" data-toggle="tooltip" data-placement="bottom" title="Convocatorias">
              <i class="fe-icon-bell"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 wow fadeInUp">
        <div class="card mb-5">
          <div class="card-header text-center">
            <a href="<?php echo e(route('web.investigadores')); ?>" class="h6">Investigadores</a>
          </div>
          <div class="card-body text-center">
            <a href="<?php echo e(route('web.investigadores')); ?>" class="btn btn-style-4 btn-style-6 btn-primary" data-toggle="tooltip" data-placement="bottom" title="Investigadores">
              <i class="fe-icon-users"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 wow fadeInUp">
        <div class="card mb-5">
          <div class="card-header text-center">
            <a href="#" class="h6">Plataforma Única de Investigación</a>
          </div>
          <div class="card-body text-center">
            <a href="#" class="btn btn-style-4 btn-style-6 btn-primary" data-toggle="tooltip" data-placement="bottom" title="Plataforma Única de Investigación">
              <i class="fe-icon-search"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 wow fadeInUp">
        <div class="card mb-5">
          <div class="card-header text-center">
            <a href="<?php echo e(route('web.proyectos-investigacion')); ?>" class="h6">Proyectos</a>
          </div>
          <div class="card-body text-center">
            <a href="<?php echo e(route('web.proyectos-investigacion')); ?>" class="btn btn-style-4 btn-style-6 btn-primary" data-toggle="tooltip" data-placement="bottom" title="Proyectos">
              <i class="fe-icon-copy"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="container pt-3 mb-3">
    <div class="row">
      <div class="col-md-4">
        <h1 class="h1 block-title">Dirección del Instituto de Investigación</h1>
      </div>
      <div class="col-md-8">
        <?php
        echo $descripcion->descripcion
        ?>
        <a href="<?php echo e(route('web.organigrama')); ?>" class="btn btn-style-6 btn-primary">
          Organigrama
          <i class="fe-icon-arrow-right"></i>
        </a>
      </div>
    </div>
  </section>
  <section class="container text-center pt-3 mb-3">
    <h2 class="h2 block-title text-center mb-4">Noticias</h2>
    <a href="<?php echo e(route('web.noticias')); ?>" class="btn btn-style-4 btn-danger">Ver todas las Noticias <i class="fe-icon-arrow-right"></i></a>
    <div class="row mt-5">
      <?php $__currentLoopData = $noticias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $noticia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-xl-4 col-lg-4 col-md-6">
        <div class="grid-item branding mb-30">
          <div class="card portfolio-card">
            <?php if(count($noticia->images) > 0): ?> <img src="<?php echo e(asset('archivos/imagenes/noticias')); ?>/<?php echo e($noticia->images[0]->path); ?>" alt="<?php echo e($noticia->titulo); ?>"/> <?php else: ?> <img src="<?php echo e(asset('archivos/imagenes/noticias/default.jpg')); ?>" alt="<?php echo e($noticia->titulo); ?>"/> <?php endif; ?>
            <div class="card-body">
              <div class="portfolio-meta">
                <span class="mr-3">
                  <i class="fe-icon-calendar"></i> <?php echo e(date('d/m/Y', strtotime($noticia->fecha))); ?>

                </span>
                <span class="mr-3">
                  <i class="fe-icon-tag"></i> <?php $__currentLoopData = $noticia->etiquetas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $etiqueta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($etiqueta->nombre); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </span>
              </div>
              <h3 class="portfolio-title text-center">
                <a href="<?php echo e(route('web.noticia', $noticia->slug)); ?>"><?php echo e(limit_string($noticia->titulo, 200, '...')); ?></a>
              </h3>
              <a class="btn btn-style-6 btn-primary btn-sm btn-block mt-3" href="<?php echo e(route('web.noticia', $noticia->slug)); ?>">Informarse</a>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </section>
  <section class="container text-center pt-3 mb-3">
    <h2 class="h2 block-title text-center mb-4">Eventos</h2>
    <a href="<?php echo e(route('web.eventos')); ?>" class="btn btn-style-4 btn-danger">Ver todos los Eventos <i class="fe-icon-arrow-right"></i></a>
    <div class="row mt-5">
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
  </section>
  <section class="container text-center pt-3 mb-3">
    <h2 class="h2 block-title text-center mb-4">Galerías</h2>
    <a href="<?php echo e(route('web.galerias')); ?>" class="btn btn-style-4 btn-danger">Ver todas las Galerías <i class="fe-icon-arrow-right"></i></a>
    <div class="row mt-5">
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
  </section>
  <section class="container text-center pt-3 mb-3">
    <h2 class="h2 block-title text-center mb-4">Videos</h2>
    <a href="<?php echo e(route('web.videos')); ?>" class="btn btn-style-4 btn-danger">Ver todos los Videos <i class="fe-icon-arrow-right"></i></a>
    <div class="row mt-5">
      <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-md-4">
        <div class="grid-item branding mb-30">
          <div class="card portfolio-card">
            <div class="card-header">
              <h3 class="portfolio-title text-center"><?php echo e($video->titulo); ?></h3>
            </div>
            <?php
              echo $video->frame
            ?>
          </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </section>
  <section class="container pt-3 mb-3 wow fadeInUp">
    <h2 class="h2 block-title text-center mb-4">Buzón Institucional</h2>
    <p>Bienvenidos a la página web de la Universidad Nacional Santiago Antúnez de Mayolo (Unasam). Con el ánimo de prestar el mejor servicio público, la institución quiere establecer vías de comunicación eficaces entre los servicios universitarios y las personas usuarias, a la vez obtener las sugerencias formuladas por la ciudadanía sobre materias de competencia universitaria y sobre el funcionamiento de los servicios de la Unasam con el fin de que esta institución supervise su propia actividad y lleve a cabo acciones de mejora.</p>
    <form>
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="fe-icon-user"></i>
              </span>
            </div>
            <input type="text" class="form-control" placeholder="Apellidos y nombres" required>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="fe-icon-mail"></i>
              </span>
            </div>
            <input type="text" class="form-control" placeholder="Correo electrónico" required>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="fe-icon-message-circle"></i>
              </span>
            </div>
            <input type="text" class="form-control" placeholder="Asunto" required>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
          <textarea class="form-control" rows="4" placeholder="Mensaje"></textarea>
          <button type="submit" class="btn btn-primary btn-style-4 btn-block">Enviar</button>
        </div>
      </div>
    <form>
  </section>
  <section class="container pt-3 mb-4 wow fadeInUp">
    <h2 class="h2 block-title text-center mb-4">Síguenos en Nuestras Redes Sociales</h2>
    <div class="form-row">
      <div class="col-lg-4 col-md-4 col-sm-4">
        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FVRIUNASAM&amp;tabs=timeline&amp;width=340&amp;height=500&amp;small_header=false&amp;adapt_container_width=true&amp;hide_cover=false&amp;show_facepile=true&amp;appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>      
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4">
        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FUnasamOficial&amp;tabs=timeline&amp;width=340&amp;height=500&amp;small_header=false&amp;adapt_container_width=true&amp;hide_cover=false&amp;show_facepile=true&amp;appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4">
        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FRIU.UNASAM&amp;tabs=timeline&amp;width=340&amp;height=500&amp;small_header=false&amp;adapt_container_width=true&amp;hide_cover=false&amp;show_facepile=true&amp;appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>      
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/appVRI/resources/views/web/index.blade.php ENDPATH**/ ?>