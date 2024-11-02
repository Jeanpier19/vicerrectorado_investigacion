<aside class="main-sidebar elevation-4">
  <a href="index3.html" class="brand-link">
    <img src="{{ asset('archivos/imagenes/logo-unasam-w50.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">VRI UNASAM</span>
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
            <p>Mi Perfil</p>
          </router-link>
        </li>
        @canany(['ADMINISTRAR ROLES', 'ADMINISTRAR USUARIOS', 'ADMINISTRAR INVESTIGADORES', 'ADMINISTRAR SOLICITUDES DE CREACION', 'ADMINISTRAR FACULTADES', 'ADMINISTRAR DEPARTAMENTOS ACADEMICOS', 'ADMINISTRAR AREAS DE INVESTIGACION', 'ADMINISTRAR LINEAS DE INVESTIGACION', 'ADMINISTRAR SUBLINEAS DE INVESTIGACION', 'ADMINISTRAR ETIQUETAS', 'ADMINISTRAR SEMESTRES', 'ADMINISTRAR TIPOS DE INSTITUCION', 'ADMINISTRAR INSTITUCIONES', 'ADMINISTRAR GRUPOS DE CONVENIO ESPECIFICO', 'ADMINISTRAR TIPOS DE CONVENIO ESPECIFICO', 'ADMINISTRAR TIPOS DE CONVOCATORIA', 'ADMINISTRAR TIPOS DE FINANCIACION', 'ADMINISTRAR TIPOS DE PUBLICACION', 'ADMINISTRAR DESCRIPCION', 'ADMINISTRAR BANNERS', 'ADMINISTRAR NOTICIAS', 'ADMINISTRAR EVENTOS', 'ADMINISTRAR CONVOCATORIAS', 'ADMINISTRAR GALERIAS', 'ADMINISTRAR VIDEOS', 'ADMINISTRAR PROYECTOS DE INVESTIGACION', 'ADMINISTRAR PROYECTOS DE EMPRENDIMIENTO', 'ADMINISTRAR PATENTES', 'ADMINISTRAR PUBLICACIONES', 'ADMINISTRAR CONVENIOS', 'ADMINISTRAR MOVILIDAD', 'ADMINISTRAR CIRCULOS DE INVESTIGACION'])
        <li class="nav-header">ADMINISTRADOR</li>
        @endcan
        @canany(['ADMINISTRAR ROLES', 'ADMINISTRAR USUARIOS', 'ADMINISTRAR INVESTIGADORES', 'ADMINISTRAR SOLICITUDES DE CREACION'])
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users-cog"></i>
            <p>
              Administración
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @can('ADMINISTRAR ROLES')
            <li class="nav-item">
              <router-link :to="{name: 'admin.administracion.roles'}" class="nav-link">
                <i class="fas fa-user-lock nav-icon"></i>
                <p>Roles</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR USUARIOS')
            <li class="nav-item">
              <router-link :to="{name: 'admin.administracion.users'}" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                <p>Usuarios</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR INVESTIGADORES')
            <li class="nav-item">
              <router-link :to="{name: 'admin.administracion.investigadores'}" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                <p>Investigadores</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{name: 'admin.administracion.investigador-renacyt'}" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                <p>Investigadores RENACYT</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR SOLICITUDES DE CREACION')
            <li class="nav-item">
              <router-link :to="{name: 'admin.administracion.solicitudes-creacion'}" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                <p>Solicitudes de Creación</p>
              </router-link>
            </li>
            @endcan
          </ul>
        </li>
        @endcan
        @canany(['ADMINISTRAR FACULTADES', 'ADMINISTRAR DEPARTAMENTOS ACADEMICOS', 'ADMINISTRAR AREAS DE INVESTIGACION', 'ADMINISTRAR LINEAS DE INVESTIGACION', 'ADMINISTRAR SUBLINEAS DE INVESTIGACION', 'ADMINISTRAR ETIQUETAS', 'ADMINISTRAR SEMESTRES', 'ADMINISTRAR TIPOS DE INSTITUCION', 'ADMINISTRAR INSTITUCIONES', 'ADMINISTRAR GRUPOS DE CONVENIO ESPECIFICO', 'ADMINISTRAR TIPOS DE CONVENIO ESPECIFICO', 'ADMINISTRAR TIPOS DE CONVOCATORIA', 'ADMINISTRAR TIPOS DE FINANCIACION', 'ADMINISTRAR TIPOS DE PUBLICACION','GRUPOS DE INVESTIGACION'])
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              Configuración Base
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @can('ADMINISTRAR FACULTADES')
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-base.facultades'}" class="nav-link">
                <i class="fas fa-home nav-icon"></i>
                <p>Facultades</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR DEPARTAMENTOS ACADEMICOS')
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-base.departamentos'}" class="nav-link">
                <i class="fas fa-home nav-icon"></i>
                <p>Departamentos Académicos</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR AREAS DE INVESTIGACION')
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-base.areas-investigacion'}" class="nav-link">
                <i class="fas fa-list nav-icon"></i>
                <p>Áreas de Investigación</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR LINEAS DE INVESTIGACION')
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-base.lineas-investigacion'}" class="nav-link">
                <i class="fas fa-list nav-icon"></i>
                <p>Líneas de Investigación</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR SUBLINEAS DE INVESTIGACION')
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-base.sublineas-investigacion'}" class="nav-link">
                <i class="fas fa-list nav-icon"></i>
                <p>Sublíneas de Investigación</p>
              </router-link>
            </li>

            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-base.grupos-investigacion'}" class="nav-link">
                <i class="fas fa-list nav-icon"></i>
                <p>Grupos de Investigación</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR ETIQUETAS')
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-base.etiquetas'}" class="nav-link">
                <i class="fas fa-tags nav-icon"></i>
                <p>Etiquetas</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR SEMESTRES')
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-base.semestres'}" class="nav-link">
                <i class="fas fa-tags nav-icon"></i>
                <p>Semestres</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR TIPOS DE INSTITUCION')
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-base.tipos-institucion'}" class="nav-link">
                <i class="fas fa-tags nav-icon"></i>
                <p>Tipos de Institución</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR INSTITUCIONES')
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-base.instituciones'}" class="nav-link">
                <i class="fas fa-home nav-icon"></i>
                <p>Instituciones</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR GRUPOS DE CONVENIO ESPECIFICO')
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-base.grupos-convenio-especifico'}" class="nav-link">
                <i class="fas fa-tags nav-icon"></i>
                <p>Grupos de Convenio Específico</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR TIPOS DE CONVENIO ESPECIFICO')
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-base.tipos-convenio-especifico'}" class="nav-link">
                <i class="fas fa-tags nav-icon"></i>
                <p>Tipos de Convenio Específico</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR TIPOS DE CONVOCATORIA')
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-base.tipos-convocatoria'}" class="nav-link">
                <i class="fas fa-tags nav-icon"></i>
                <p>Tipos de Convocatoria</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR TIPOS DE FINANCIACION')
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-base.tipos-financiacion'}" class="nav-link">
                <i class="fas fa-tags nav-icon"></i>
                <p>Tipos de Financiación</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR TIPOS DE PUBLICACION')
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-base.tipos-publicacion'}" class="nav-link">
                <i class="fas fa-tags nav-icon"></i>
                <p>Tipos de Publicación</p>
              </router-link>
            </li>
            @endcan
          </ul>
        </li>
        @endcan
        @canany(['ADMINISTRAR DESCRIPCION', 'ADMINISTRAR BANNERS', 'ADMINISTRAR NOTICIAS', 'ADMINISTRAR EVENTOS', 'ADMINISTRAR CONVOCATORIAS', 'ADMINISTRAR GALERIAS', 'ADMINISTRAR VIDEOS'])
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-globe"></i>
            <p>
              Configuración Página Web
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @can('ADMINISTRAR DESCRIPCION')
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-pagina-web.descripcion'}" class="nav-link">
                <i class="fas fa-file-alt nav-icon"></i>
                <p>Descripción</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR BANNERS')
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-pagina-web.banners'}" class="nav-link">
                <i class="fas fa-clone nav-icon"></i>
                <p>Banners</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR NOTICIAS')
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-pagina-web.noticias'}" class="nav-link">
                <i class="fas fa-newspaper nav-icon"></i>
                <p>Noticias</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR EVENTOS')
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-pagina-web.eventos'}" class="nav-link">
                <i class="fas fa-newspaper nav-icon"></i>
                <p>Eventos</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR CONVOCATORIAS')
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-pagina-web.convocatorias'}" class="nav-link">
                <i class="fas fa-bell nav-icon"></i>
                <p>Convocatorias</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR GALERIAS')
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-pagina-web.galerias'}" class="nav-link">
                <i class="fas fa-images nav-icon"></i>
                <p>Galerías</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR VIDEOS')
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-pagina-web.videos'}" class="nav-link">
                <i class="fas fa-video nav-icon"></i>
                <p>Videos</p>
              </router-link>
            </li>
            @endcan
          </ul>
        </li>
        @endcan
        @canany(['ADMINISTRAR PROYECTOS DE INVESTIGACION', 'ADMINISTRAR PROYECTOS DE EMPRENDIMIENTO', 'ADMINISTRAR PATENTES', 'ADMINISTRAR PUBLICACIONES', 'ADMINISTRAR CONVENIOS', 'ADMINISTRAR MOVILIDAD', 'ADMINISTRAR CIRCULOS DE INVESTIGACION'])
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-search"></i>
            <p>
              Investigación
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @can('ADMINISTRAR PROYECTOS DE INVESTIGACION')
            <li class="nav-item">
              <router-link :to="{name: 'admin.investigacion.proyectos-investigacion'}" class="nav-link">
                <i class="fas fa-project-diagram nav-icon"></i>
                <p>Proyectos de Investigación</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR PROYECTOS DE EMPRENDIMIENTO')
            <li class="nav-item">
              <router-link :to="{name: 'admin.investigacion.proyectos-emprendimiento'}" class="nav-link">
                <i class="fas fa-project-diagram nav-icon"></i>
                <p>Proyectos de Emprendimiento</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR PATENTES')
            <li class="nav-item">
              <router-link :to="{name: 'admin.investigacion.patentes'}" class="nav-link">
                <i class="fas fa-gavel nav-icon"></i>
                <p>Patentes</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR PUBLICACIONES')
            <li class="nav-item">
              <router-link :to="{name: 'admin.investigacion.publicaciones'}" class="nav-link">
                <i class="fas fa-newspaper nav-icon"></i>
                <p>Publicaciones</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR CONVENIOS')
            <li class="nav-item">
              <router-link :to="{name: 'admin.investigacion.convenios'}" class="nav-link">
                <i class="fas fa-clone nav-icon"></i>
                <p>Convenios</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR MOVILIDAD')
            <li class="nav-item">
              <router-link :to="{name: 'admin.investigacion.movilidades'}" class="nav-link">
                <i class="fas fa-clone nav-icon"></i>
                <p>Movilidad</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR CIRCULOS DE INVESTIGACION')
            <li class="nav-item">
              <router-link :to="{name: 'admin.investigacion.circulos-investigacion'}" class="nav-link">
                <i class="fas fa-user-tag nav-icon"></i>
                <p>Círculos de Investigación</p>
              </router-link>
            </li>
            @endcan
          </ul>
        </li>
        {{-- <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file-pdf"></i>
            <p>
              Reportes
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <router-link :to="{name: 'admin.not-found'}" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                <p>Investigadores</p>
              </router-link>
            </li>
          </ul>
        </li> --}}
        @endcan
        @canany(['ADMINISTRAR MIEMBROS (LIDER DE CIRCULO DE INVESTIGACION)', 'ADMINISTRAR PROYECTOS DE INVESTIGACION (LIDER DE CIRCULO DE INVESTIGACION)'])
        <li class="nav-header">LÍDER DE CÍRCULO DE INV.</li>
        @can('ADMINISTRAR MIEMBROS (LIDER DE CIRCULO DE INVESTIGACION)')
        <li class="nav-item">
          <router-link :to="{name: 'lider.miembros'}" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Miembros</p>
          </router-link>
        </li>
        @endcan
        @can('ADMINISTRAR PROYECTOS DE INVESTIGACION (LIDER DE CIRCULO DE INVESTIGACION)')
        <li class="nav-item">
          <router-link :to="{name: 'lider.proyectos-investigacion'}" class="nav-link">
            <i class="nav-icon fas fa-project-diagram"></i>
            <p>Proyectos de Investigación</p>
          </router-link>
        </li>
        @endcan
        @endcan
        @canany(['ADMINISTRAR PROYECTOS DE INVESTIGACION (INVESTIGADOR)', 'ADMINISTRAR PUBLICACIONES DE ARTICULOS (INVESTIGADOR)', 'ADMINISTRAR PUBLICACIONES DE CAPITULOS DE LIBROS (INVESTIGADOR)', 'ADMINISTRAR PUBLICACIONES DE LIBROS (INVESTIGADOR)'])
        <li class="nav-header">INVESTIGADOR</li>
        @endcan
        @can('ADMINISTRAR PROYECTOS DE INVESTIGACION (INVESTIGADOR)')
        <li class="nav-item">
          <router-link :to="{name: 'investigador.proyectos-investigacion'}" class="nav-link">
            <i class="nav-icon fas fa-project-diagram"></i>
            <p>Proyectos de Investigación</p>
          </router-link>
        </li>
        @endcan
        @canany(['ADMINISTRAR PUBLICACIONES DE ARTICULOS (INVESTIGADOR)', 'ADMINISTRAR PUBLICACIONES DE CAPITULOS DE LIBROS (INVESTIGADOR)', 'ADMINISTRAR PUBLICACIONES DE LIBROS (INVESTIGADOR)'])
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-search"></i>
            <p>
              Publicaciones
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @can('ADMINISTRAR PUBLICACIONES DE ARTICULOS (INVESTIGADOR)')
            <li class="nav-item">
              <router-link :to="{name: 'investigador.publicaciones.articulos'}" class="nav-link">
                <i class="fas fa-newspaper nav-icon"></i>
                <p>Artículos</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR PUBLICACIONES DE CAPITULOS DE LIBROS (INVESTIGADOR)')
            <li class="nav-item">
              <router-link :to="{name: 'investigador.publicaciones.capitulos-libros'}" class="nav-link">
                <i class="fas fa-book nav-icon"></i>
                <p>Capítulos de Libros</p>
              </router-link>
            </li>
            @endcan
            @can('ADMINISTRAR PUBLICACIONES DE LIBROS (INVESTIGADOR)')
            <li class="nav-item">
              <router-link :to="{name: 'investigador.publicaciones.libros'}" class="nav-link">
                <i class="fas fa-book nav-icon"></i>
                <p>Libros</p>
              </router-link>
            </li>
            @endcan
          </ul>
        </li>
        @endcan
      </ul>
    </nav>
  </div>
</aside>