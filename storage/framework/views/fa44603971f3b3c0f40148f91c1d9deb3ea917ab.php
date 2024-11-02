<?php $__env->startSection('title', 'Login | '); ?>
<?php $__env->startSection('content'); ?>
<div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
  <div class="container text-left align-self-center">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('web.index')); ?>">Inicio</a></li>
      </ol>
    </nav>
    <h1 class="page-title-heading mt-3">Iniciar Sesión</h1>
  </div>
</div>
<section class="container pt-3 mb-4">
  <div class="offset-lg-3 col-lg-6">
    <div class="card">
      <?php if(session('errorMessage')): ?>
      <div class="card-header alert alert-danger alert-dismissible fade show" role="alert">
        <strong>¡Hubo un error!</strong> <?php echo e(session('errorMessage')); ?>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php endif; ?>
      <div class="card-body">
        <form class="needs-validation wizard" action="<?php echo e(route('login')); ?>" method="post" novalidate>
          <?php echo csrf_field(); ?>
          <div class="wizard-body pt-2">
            <div class="d-sm-flex justify-content-between pb-2"><a class="btn btn-secondary btn-sm btn-block my-2 mr-3" href="#"><i class="socicon-facebook"></i>&nbsp;Login</a><a class="btn btn-secondary btn-sm btn-block my-2 mr-3" href="#"><i class="socicon-twitter"></i>&nbsp;Login</a><a class="btn btn-secondary btn-sm btn-block my-2 mr-3" href="#"><i class="socicon-linkedin"></i>&nbsp;Login</a></div>
            <hr>
            <h3 class="h6 pt-4 pb-2">O usando el formulario a continuación</h3>
            <div class="input-group form-group">
              <div class="input-group-prepend"><span class="input-group-text"><i class="fe-icon-user"></i></span></div>
              <input type="text" name="username" class="form-control <?php echo e($errors->has('username') ? 'is-invalid' : ''); ?>" value="<?php echo e(old('username')); ?>" placeholder="Usuario" required>
              <?php if($errors->has('username')): ?>
              <div class="invalid-feedback">
                <?php echo e($errors->first('username')); ?>

              </div>
              <?php else: ?>
              <div class="invalid-feedback">¡Por favor introduzca su Usuario!</div>
              <?php endif; ?>
            </div>
            <div class="input-group form-group">
              <div class="input-group-prepend"><span class="input-group-text"><i class="fe-icon-lock"></i></span></div>
              <input type="password" name="password" class="form-control <?php echo e($errors->has('password') ? 'is-invalid' : ''); ?>" placeholder="Contraseña" required>
              <?php if($errors->has('password')): ?>
              <div class="invalid-feedback">
                <?php echo e($errors->first('password')); ?>

              </div>
              <?php else: ?>
              <div class="invalid-feedback">¡Por favor introduzca su Contraseña!</div>
              <?php endif; ?>
            </div>
            <div class="d-flex flex-wrap justify-content-between">
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" name="remember" type="checkbox" id="remember-me">
                <label class="custom-control-label" for="remember-me">Recordarme</label>
              </div>
              <a class="navi-link" href="#">¿Has olvidado tu Usuario y/o Contraseña?</a>
            </div>
          </div>
          <div class="wizard-footer text-right">
            <button class="btn btn-info" type="submit">Iniciar Sesión</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/appVRI/resources/views/auth/login.blade.php ENDPATH**/ ?>