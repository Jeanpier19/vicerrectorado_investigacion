<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Panel de Administración | Soporte UNASAM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="shortcut icon" href="<?php echo e(asset('archivos/imagenes/favicon.png')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/admin/app.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/admin/main.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/admin/toastr.css')); ?>">
    <style type="text/css">
      * {
        font-family: 'Calibri Light';
      }
    </style>
    <script type="text/javascript">
      window.Laravel = {
          csrfToken: "<?php echo e(csrf_token()); ?>",
          jsPermissions: <?php echo auth()->check()?auth()->user()->jsPermissions():null; ?>

      }
  </script>
  </head>
  <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed" id="body">
    <div class="wrapper" id="app">
      <?php echo $__env->make('layouts.admin.main-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php echo $__env->make('layouts.admin.main-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <div class="content-wrapper">
        <section class="content">
          <div id="loading">
            <p class="p-2">Si este contenido no se muestra en los próximos 15 segundos, verifique su conexión a internet y recargue la página.</p>
            <div class="sk-cube-grid">
              <div class="sk-cube sk-cube1"></div>
              <div class="sk-cube sk-cube2"></div>
              <div class="sk-cube sk-cube3"></div>
              <div class="sk-cube sk-cube4"></div>
              <div class="sk-cube sk-cube5"></div>
              <div class="sk-cube sk-cube6"></div>
              <div class="sk-cube sk-cube7"></div>
              <div class="sk-cube sk-cube8"></div>
              <div class="sk-cube sk-cube9"></div>
            </div>
          </div>
          <router-view></router-view>
        </section>
      </div>
      <?php echo $__env->make('layouts.admin.main-footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <aside class="control-sidebar control-sidebar-light">
        <p class="text-center font-weight-bold">MIS PREFERENCIAS</p>
        <div class="ml-1">
          <label class="switch">
            <input type="checkbox" id="toggleTheme">
            <span class="switch-slider round"></span>
          </label>
          <span>Tema Oscuro</span>
        </div>
      </aside>
    </div>
    <script src="<?php echo e(asset('js/admin/manifest.js')); ?>"></script>
    <script src="<?php echo e(asset('js/admin/vendor.js')); ?>"></script>
    <script src="<?php echo e(asset('js/admin/app.js')); ?>"></script>
    <script src="<?php echo e(asset('js/admin/main.js')); ?>"></script>
    <script>
      setTimeout(function() {
        $('#loading').fadeOut('slow');
      }, 0);
    </script>
  </body>
</html>
<?php /**PATH /var/www/appVRI/resources/views/layouts/admin/master.blade.php ENDPATH**/ ?>