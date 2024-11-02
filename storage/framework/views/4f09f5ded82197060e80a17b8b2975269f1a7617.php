<aside class="main-sidebar elevation-4">
  <a href="index3.html" class="brand-link">
    <img src="<?php echo e(asset('archivos/imagenes/logo-unasam-w50.png')); ?>" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">VRI UNASAM</span>
  </a>
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <?php if(auth()->user()->image): ?>
          <img src="<?php echo e(asset('archivos/imagenes/usuarios')); ?>/<?php echo e(auth()->user()->image->path); ?>" class="img-circle elevation-2" alt="User Image">
        <?php else: ?>
          <?php if(auth()->user()->persona->genero == 'Masculino'): ?>
            <img src="<?php echo e(asset('archivos/imagenes/usuario-masculino.jpg')); ?>" class="img-circle elevation-2" alt="User Image">
          <?php else: ?>
            <img src="<?php echo e(asset('archivos/imagenes/usuario-femenino.jpg')); ?>" class="img-circle elevation-2" alt="User Image">
          <?php endif; ?>
        <?php endif; ?>
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo e(auth()->user('api')->persona->nombres); ?></a>
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
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['ADMINISTRAR ROLES', 'ADMINISTRAR USUARIOS', 'ADMINISTRAR INVESTIGADORES', 'ADMINISTRAR SOLICITUDES DE CREACION', 'ADMINISTRAR FACULTADES', 'ADMINISTRAR DEPARTAMENTOS ACADEMICOS', 'ADMINISTRAR AREAS DE INVESTIGACION', 'ADMINISTRAR LINEAS DE INVESTIGACION', 'ADMINISTRAR SUBLINEAS DE INVESTIGACION', 'ADMINISTRAR ETIQUETAS', 'ADMINISTRAR SEMESTRES', 'ADMINISTRAR TIPOS DE INSTITUCION', 'ADMINISTRAR INSTITUCIONES', 'ADMINISTRAR GRUPOS DE CONVENIO ESPECIFICO', 'ADMINISTRAR TIPOS DE CONVENIO ESPECIFICO', 'ADMINISTRAR TIPOS DE CONVOCATORIA', 'ADMINISTRAR TIPOS DE FINANCIACION', 'ADMINISTRAR TIPOS DE PUBLICACION', 'ADMINISTRAR DESCRIPCION', 'ADMINISTRAR BANNERS', 'ADMINISTRAR NOTICIAS', 'ADMINISTRAR EVENTOS', 'ADMINISTRAR CONVOCATORIAS', 'ADMINISTRAR GALERIAS', 'ADMINISTRAR VIDEOS', 'ADMINISTRAR PROYECTOS DE INVESTIGACION', 'ADMINISTRAR PROYECTOS DE EMPRENDIMIENTO', 'ADMINISTRAR PATENTES', 'ADMINISTRAR PUBLICACIONES', 'ADMINISTRAR CONVENIOS', 'ADMINISTRAR MOVILIDAD', 'ADMINISTRAR CIRCULOS DE INVESTIGACION'])): ?>
        <li class="nav-header">ADMINISTRADOR</li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['ADMINISTRAR ROLES', 'ADMINISTRAR USUARIOS', 'ADMINISTRAR INVESTIGADORES', 'ADMINISTRAR SOLICITUDES DE CREACION'])): ?>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users-cog"></i>
            <p>
              Administración
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR ROLES')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.administracion.roles'}" class="nav-link">
                <i class="fas fa-user-lock nav-icon"></i>
                <p>Roles</p>
              </router-link>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR USUARIOS')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.administracion.users'}" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                <p>Usuarios</p>
              </router-link>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR INVESTIGADORES')): ?>
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
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR SOLICITUDES DE CREACION')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.administracion.solicitudes-creacion'}" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                <p>Solicitudes de Creación</p>
              </router-link>
            </li>
            <?php endif; ?>
          </ul>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['ADMINISTRAR FACULTADES', 'ADMINISTRAR DEPARTAMENTOS ACADEMICOS', 'ADMINISTRAR AREAS DE INVESTIGACION', 'ADMINISTRAR LINEAS DE INVESTIGACION', 'ADMINISTRAR SUBLINEAS DE INVESTIGACION', 'ADMINISTRAR ETIQUETAS', 'ADMINISTRAR SEMESTRES', 'ADMINISTRAR TIPOS DE INSTITUCION', 'ADMINISTRAR INSTITUCIONES', 'ADMINISTRAR GRUPOS DE CONVENIO ESPECIFICO', 'ADMINISTRAR TIPOS DE CONVENIO ESPECIFICO', 'ADMINISTRAR TIPOS DE CONVOCATORIA', 'ADMINISTRAR TIPOS DE FINANCIACION', 'ADMINISTRAR TIPOS DE PUBLICACION','GRUPOS DE INVESTIGACION'])): ?>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              Configuración Base
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR FACULTADES')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-base.facultades'}" class="nav-link">
                <i class="fas fa-home nav-icon"></i>
                <p>Facultades</p>
              </router-link>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR DEPARTAMENTOS ACADEMICOS')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-base.departamentos'}" class="nav-link">
                <i class="fas fa-home nav-icon"></i>
                <p>Departamentos Académicos</p>
              </router-link>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR AREAS DE INVESTIGACION')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-base.areas-investigacion'}" class="nav-link">
                <i class="fas fa-list nav-icon"></i>
                <p>Áreas de Investigación</p>
              </router-link>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR LINEAS DE INVESTIGACION')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-base.lineas-investigacion'}" class="nav-link">
                <i class="fas fa-list nav-icon"></i>
                <p>Líneas de Investigación</p>
              </router-link>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR SUBLINEAS DE INVESTIGACION')): ?>
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
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR ETIQUETAS')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-base.etiquetas'}" class="nav-link">
                <i class="fas fa-tags nav-icon"></i>
                <p>Etiquetas</p>
              </router-link>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR SEMESTRES')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-base.semestres'}" class="nav-link">
                <i class="fas fa-tags nav-icon"></i>
                <p>Semestres</p>
              </router-link>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR TIPOS DE INSTITUCION')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-base.tipos-institucion'}" class="nav-link">
                <i class="fas fa-tags nav-icon"></i>
                <p>Tipos de Institución</p>
              </router-link>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR INSTITUCIONES')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-base.instituciones'}" class="nav-link">
                <i class="fas fa-home nav-icon"></i>
                <p>Instituciones</p>
              </router-link>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR GRUPOS DE CONVENIO ESPECIFICO')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-base.grupos-convenio-especifico'}" class="nav-link">
                <i class="fas fa-tags nav-icon"></i>
                <p>Grupos de Convenio Específico</p>
              </router-link>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR TIPOS DE CONVENIO ESPECIFICO')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-base.tipos-convenio-especifico'}" class="nav-link">
                <i class="fas fa-tags nav-icon"></i>
                <p>Tipos de Convenio Específico</p>
              </router-link>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR TIPOS DE CONVOCATORIA')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-base.tipos-convocatoria'}" class="nav-link">
                <i class="fas fa-tags nav-icon"></i>
                <p>Tipos de Convocatoria</p>
              </router-link>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR TIPOS DE FINANCIACION')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-base.tipos-financiacion'}" class="nav-link">
                <i class="fas fa-tags nav-icon"></i>
                <p>Tipos de Financiación</p>
              </router-link>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR TIPOS DE PUBLICACION')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-base.tipos-publicacion'}" class="nav-link">
                <i class="fas fa-tags nav-icon"></i>
                <p>Tipos de Publicación</p>
              </router-link>
            </li>
            <?php endif; ?>
          </ul>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['ADMINISTRAR DESCRIPCION', 'ADMINISTRAR BANNERS', 'ADMINISTRAR NOTICIAS', 'ADMINISTRAR EVENTOS', 'ADMINISTRAR CONVOCATORIAS', 'ADMINISTRAR GALERIAS', 'ADMINISTRAR VIDEOS'])): ?>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-globe"></i>
            <p>
              Configuración Página Web
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR DESCRIPCION')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-pagina-web.descripcion'}" class="nav-link">
                <i class="fas fa-file-alt nav-icon"></i>
                <p>Descripción</p>
              </router-link>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR BANNERS')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-pagina-web.banners'}" class="nav-link">
                <i class="fas fa-clone nav-icon"></i>
                <p>Banners</p>
              </router-link>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR NOTICIAS')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-pagina-web.noticias'}" class="nav-link">
                <i class="fas fa-newspaper nav-icon"></i>
                <p>Noticias</p>
              </router-link>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR EVENTOS')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-pagina-web.eventos'}" class="nav-link">
                <i class="fas fa-newspaper nav-icon"></i>
                <p>Eventos</p>
              </router-link>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR CONVOCATORIAS')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-pagina-web.convocatorias'}" class="nav-link">
                <i class="fas fa-bell nav-icon"></i>
                <p>Convocatorias</p>
              </router-link>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR GALERIAS')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-pagina-web.galerias'}" class="nav-link">
                <i class="fas fa-images nav-icon"></i>
                <p>Galerías</p>
              </router-link>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR VIDEOS')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.configuracion-pagina-web.videos'}" class="nav-link">
                <i class="fas fa-video nav-icon"></i>
                <p>Videos</p>
              </router-link>
            </li>
            <?php endif; ?>
          </ul>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['ADMINISTRAR PROYECTOS DE INVESTIGACION', 'ADMINISTRAR PROYECTOS DE EMPRENDIMIENTO', 'ADMINISTRAR PATENTES', 'ADMINISTRAR PUBLICACIONES', 'ADMINISTRAR CONVENIOS', 'ADMINISTRAR MOVILIDAD', 'ADMINISTRAR CIRCULOS DE INVESTIGACION'])): ?>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-search"></i>
            <p>
              Investigación
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR PROYECTOS DE INVESTIGACION')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.investigacion.proyectos-investigacion'}" class="nav-link">
                <i class="fas fa-project-diagram nav-icon"></i>
                <p>Proyectos de Investigación</p>
              </router-link>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR PROYECTOS DE EMPRENDIMIENTO')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.investigacion.proyectos-emprendimiento'}" class="nav-link">
                <i class="fas fa-project-diagram nav-icon"></i>
                <p>Proyectos de Emprendimiento</p>
              </router-link>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR PATENTES')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.investigacion.patentes'}" class="nav-link">
                <i class="fas fa-gavel nav-icon"></i>
                <p>Patentes</p>
              </router-link>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR PUBLICACIONES')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.investigacion.publicaciones'}" class="nav-link">
                <i class="fas fa-newspaper nav-icon"></i>
                <p>Publicaciones</p>
              </router-link>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR CONVENIOS')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.investigacion.convenios'}" class="nav-link">
                <i class="fas fa-clone nav-icon"></i>
                <p>Convenios</p>
              </router-link>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR MOVILIDAD')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.investigacion.movilidades'}" class="nav-link">
                <i class="fas fa-clone nav-icon"></i>
                <p>Movilidad</p>
              </router-link>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR CIRCULOS DE INVESTIGACION')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'admin.investigacion.circulos-investigacion'}" class="nav-link">
                <i class="fas fa-user-tag nav-icon"></i>
                <p>Círculos de Investigación</p>
              </router-link>
            </li>
            <?php endif; ?>
          </ul>
        </li>
        
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['ADMINISTRAR MIEMBROS (LIDER DE CIRCULO DE INVESTIGACION)', 'ADMINISTRAR PROYECTOS DE INVESTIGACION (LIDER DE CIRCULO DE INVESTIGACION)'])): ?>
        <li class="nav-header">LÍDER DE CÍRCULO DE INV.</li>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR MIEMBROS (LIDER DE CIRCULO DE INVESTIGACION)')): ?>
        <li class="nav-item">
          <router-link :to="{name: 'lider.miembros'}" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Miembros</p>
          </router-link>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR PROYECTOS DE INVESTIGACION (LIDER DE CIRCULO DE INVESTIGACION)')): ?>
        <li class="nav-item">
          <router-link :to="{name: 'lider.proyectos-investigacion'}" class="nav-link">
            <i class="nav-icon fas fa-project-diagram"></i>
            <p>Proyectos de Investigación</p>
          </router-link>
        </li>
        <?php endif; ?>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['ADMINISTRAR PROYECTOS DE INVESTIGACION (INVESTIGADOR)', 'ADMINISTRAR PUBLICACIONES DE ARTICULOS (INVESTIGADOR)', 'ADMINISTRAR PUBLICACIONES DE CAPITULOS DE LIBROS (INVESTIGADOR)', 'ADMINISTRAR PUBLICACIONES DE LIBROS (INVESTIGADOR)'])): ?>
        <li class="nav-header">INVESTIGADOR</li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR PROYECTOS DE INVESTIGACION (INVESTIGADOR)')): ?>
        <li class="nav-item">
          <router-link :to="{name: 'investigador.proyectos-investigacion'}" class="nav-link">
            <i class="nav-icon fas fa-project-diagram"></i>
            <p>Proyectos de Investigación</p>
          </router-link>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['ADMINISTRAR PUBLICACIONES DE ARTICULOS (INVESTIGADOR)', 'ADMINISTRAR PUBLICACIONES DE CAPITULOS DE LIBROS (INVESTIGADOR)', 'ADMINISTRAR PUBLICACIONES DE LIBROS (INVESTIGADOR)'])): ?>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-search"></i>
            <p>
              Publicaciones
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR PUBLICACIONES DE ARTICULOS (INVESTIGADOR)')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'investigador.publicaciones.articulos'}" class="nav-link">
                <i class="fas fa-newspaper nav-icon"></i>
                <p>Artículos</p>
              </router-link>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR PUBLICACIONES DE CAPITULOS DE LIBROS (INVESTIGADOR)')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'investigador.publicaciones.capitulos-libros'}" class="nav-link">
                <i class="fas fa-book nav-icon"></i>
                <p>Capítulos de Libros</p>
              </router-link>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ADMINISTRAR PUBLICACIONES DE LIBROS (INVESTIGADOR)')): ?>
            <li class="nav-item">
              <router-link :to="{name: 'investigador.publicaciones.libros'}" class="nav-link">
                <i class="fas fa-book nav-icon"></i>
                <p>Libros</p>
              </router-link>
            </li>
            <?php endif; ?>
          </ul>
        </li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
</aside><?php /**PATH /var/www/appVRI/resources/views/layouts/admin/main-sidebar.blade.php ENDPATH**/ ?>