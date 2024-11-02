<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Panel de Administración | OGTISE - UNASAM</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="{{ asset('archivos/imagenes/favicon.png') }}">
  <link rel="stylesheet" href="/css/app.css">
  <link rel="stylesheet" href="/css/all.css">
  <style type="text/css">
    * {
      font-family: 'Calibri Light';
    }
  </style>
  <script type="text/javascript">
    window.Laravel = {
        csrfToken: "{{ csrf_token() }}",
        jsPermissions: {!! auth()->check()?auth()->user()->jsPermissions():null !!}
    }
</script>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper" id="app">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('archivos/imagenes/logo-unasam.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">OGTISE</span>
    </a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if(auth()->user()->image)
            <img src="{{ asset('archivos/imagenes/usuarios') }}/{{ auth()->user()->image->path }}" class="img-circle elevation-2" alt="User Image">
          @else
            @if(auth()->user()->persona->genero == 'Masculino')
              <img src="{{ asset('archivos/imagenes/usuario-masculino.jpg') }}" class="img-circle elevation-2" alt="User Image">
            @else
              <img src="{{ asset('archivos/imagenes/usuario-femenino.jpg') }}" class="img-circle elevation-2" alt="User Image">
            @endif
          @endif
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user('api')->persona->nombres }}</a>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <router-link :to="{name: 'admin.principal'}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Principal
                <span class="right badge badge-danger">nuevo</span>
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{name: 'admin.perfil'}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Mi Perfil
              </p>
            </router-link>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                Administración
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link :to="{name: 'admin.roles'}" class="nav-link">
                  <i class="fas fa-user-lock nav-icon"></i>
                  <p>Roles</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link :to="{name: 'admin.users'}" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Usuarios</p>
                </router-link>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Configuración Base
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link :to="{name: 'admin.etiquetas'}" class="nav-link">
                  <i class="fas fa-tags nav-icon"></i>
                  <p>Etiquetas de Publicaciones</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link :to="{name: 'admin.tipos-guia'}" class="nav-link">
                  <i class="fas fa-tags nav-icon"></i>
                  <p>Tipos de Guía</p>
                </router-link>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Unidades
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link :to="{name: 'admin.unidades'}" class="nav-link">
                  <i class="fas fa-home nav-icon"></i>
                  <p>Unidades</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link :to="{name: 'admin.empleados'}" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Empleados</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link :to="{name: 'admin.funciones-servicios'}" class="nav-link">
                  <i class="fas fa-tasks nav-icon"></i>
                  <p>Funciones y Servicios</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link :to="{name: 'admin.publicaciones'}" class="nav-link">
                  <i class="fas fa-newspaper nav-icon"></i>
                  <p>Publicaciones</p>
                </router-link>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-globe"></i>
              <p>
                Configuración Página Web
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link :to="{name: 'admin.banners'}" class="nav-link">
                  <i class="fas fa-clone nav-icon"></i>
                  <p>Banners</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link :to="{name: 'admin.guias'}" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Guías</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link :to="{name: 'admin.noticias'}" class="nav-link">
                  <i class="fas fa-newspaper nav-icon"></i>
                  <p>Noticias</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link :to="{name: 'admin.normativa'}" class="nav-link">
                  <i class="fas fa-gavel nav-icon"></i>
                  <p>Normativa</p>
                </router-link>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="nav-icon fas fa-power-off"></i> Cerrar sesión</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
  <div class="content-wrapper">
    <section class="content">
      <router-view></router-view>
      <vue-progress-bar></vue-progress-bar>
    </section>
  </div>
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="http://ogtise.unasam.edu.pe" target="_blank">OGTISE - UNASAM</a> Dev. <a href="https://web.facebook.com/rickmh19/" target="_blank">Rick MH</a></strong>
    <div class="float-right d-none d-sm-inline-block">
      <b>Versión</b> 1.0
    </div>
  </footer>
  <aside class="control-sidebar control-sidebar-dark">
    
  </aside>
</div>
<script src="/js/manifest.js"></script>
<script src="/js/vendor.js"></script>
<script src="/js/app.js"></script>
<script src="/js/all.js"></script>



</body>
</html>
