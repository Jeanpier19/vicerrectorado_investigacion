<template>
  <div class="container-fluid pt-3">
    <div class="sk-cube-grid" v-show="loader">
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
    <div v-show="!loader">
      <div class="row">
        <div class="col-sm-3">
          <router-link :to="{name: 'admin.perfil'}">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>1</h3>
                <p>Mi Perfil</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-user"></i>
              </div>
            </div>
          </router-link>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3" v-if="can('ADMINISTRAR ROLES')">
          <router-link :to="{name: 'admin.administracion.roles'}">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3 v-text="quantities.roles_count"></h3>
                <p>Roles</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-user-lock"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR USUARIOS')">
          <router-link :to="{name: 'admin.administracion.users'}">
            <div class="small-box bg-success">
              <div class="inner">
                <h3 v-text="quantities.users_count"></h3>
                <p>Usuarios</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-users"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR INVESTIGADORES')">
          <router-link :to="{name: 'admin.administracion.investigadores'}">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 v-text="quantities.investigadores_count"></h3>
                <p>Investigadores</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-users"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR SOLICITUDES DE CREACION')">
          <router-link :to="{name: 'admin.administracion.solicitudes-creacion'}">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 v-text="quantities.solicitudes_creacion_count"></h3>
                <p>Solicitudes de Creación</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-users"></i>
              </div>
            </div>
          </router-link>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3" v-if="can('ADMINISTRAR FACULTADES')">
          <router-link :to="{name: 'admin.configuracion-base.facultades'}">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3 v-text="quantities.facultades_count"></h3>
                <p>Facultades</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-home"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR DEPARTAMENTOS ACADEMICOS')">
          <router-link :to="{name: 'admin.configuracion-base.departamentos'}">
            <div class="small-box bg-success">
              <div class="inner">
                <h3 v-text="quantities.departamentos_count"></h3>
                <p>Departamentos Académicos</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-home"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR AREAS DE INVESTIGACION')">
          <router-link :to="{name: 'admin.configuracion-base.areas-investigacion'}">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 v-text="quantities.areas_investigacion_count"></h3>
                <p>Áreas de Investigación</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-list"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR LINEAS DE INVESTIGACION')">
          <router-link :to="{name: 'admin.configuracion-base.lineas-investigacion'}">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 v-text="quantities.lineas_investigacion_count"></h3>
                <p>Líneas de Investigación</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-list"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR SUBLINEAS DE INVESTIGACION')">
          <router-link :to="{name: 'admin.configuracion-base.sublineas-investigacion'}">
            <div class="small-box bg-info">
              <div class="inner">
                <h3 v-text="quantities.sublineas_investigacion_count"></h3>
                <p>Subíneas de Investigación</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-list"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR ETIQUETAS')">
          <router-link :to="{name: 'admin.configuracion-base.etiquetas'}">
            <div class="small-box bg-dark">
              <div class="inner">
                <h3 v-text="quantities.etiquetas_count"></h3>
                <p>Etiquetas</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-tags"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR SEMESTRES')">
          <router-link :to="{name: 'admin.configuracion-base.semestres'}">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3 v-text="quantities.semestres_count"></h3>
                <p>Semestres</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-tags"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR TIPOS DE INSTITUCION')">
          <router-link :to="{name: 'admin.configuracion-base.tipos-institucion'}">
            <div class="small-box bg-success">
              <div class="inner">
                <h3 v-text="quantities.tipos_institucion_count"></h3>
                <p>Tipos de Institución</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-tags"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR INSTITUCIONES')">
          <router-link :to="{name: 'admin.configuracion-base.instituciones'}">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 v-text="quantities.instituciones_count"></h3>
                <p>Instituciones</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-home"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR GRUPOS DE CONVENIO ESPECIFICO')">
          <router-link :to="{name: 'admin.configuracion-base.grupos-convenio-especifico'}">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 v-text="quantities.grupos_convenio_especifico_count"></h3>
                <p>Grupos de Convenio Específico</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-list"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR TIPOS DE CONVENIO ESPECIFICO')">
          <router-link :to="{name: 'admin.configuracion-base.tipos-convenio-especifico'}">
            <div class="small-box bg-info">
              <div class="inner">
                <h3 v-text="quantities.tipos_convenio_especifico_count"></h3>
                <p>Tipos de Convenio Específico</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-tags"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR TIPOS DE CONVOCATORIA')">
          <router-link :to="{name: 'admin.configuracion-base.tipos-convocatoria'}">
            <div class="small-box bg-dark">
              <div class="inner">
                <h3 v-text="quantities.tipos_convocatoria_count"></h3>
                <p>Tipos de Convocatoria</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-tags"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR TIPOS DE FINANCIACION')">
          <router-link :to="{name: 'admin.configuracion-base.tipos-financiacion'}">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3 v-text="quantities.tipos_financiacion_count"></h3>
                <p>Tipos de Financiación</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-tags"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR TIPOS DE PUBLICACION')">
          <router-link :to="{name: 'admin.configuracion-base.tipos-publicacion'}">
            <div class="small-box bg-success">
              <div class="inner">
                <h3 v-text="quantities.tipos_publicacion_count"></h3>
                <p>Tipos de Publicación</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-tags"></i>
              </div>
            </div>
          </router-link>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3" v-if="can('ADMINISTRAR DESCRIPCION')">
          <router-link :to="{name: 'admin.configuracion-pagina-web.descripcion'}">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3 v-text="quantities.descripcion_count"></h3>
                <p>Descripción</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-file-alt"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR BANNERS')">
          <router-link :to="{name: 'admin.configuracion-pagina-web.banners'}">
            <div class="small-box bg-success">
              <div class="inner">
                <h3 v-text="quantities.banners_count"></h3>
                <p>Banners</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-clone"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR NOTICIAS')">
          <router-link :to="{name: 'admin.configuracion-pagina-web.noticias'}">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 v-text="quantities.noticias_count"></h3>
                <p>Noticias</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-newspaper"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR EVENTOS')">
          <router-link :to="{name: 'admin.configuracion-pagina-web.eventos'}">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 v-text="quantities.eventos_count"></h3>
                <p>Eventos</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-newspaper"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR CONVOCATORIAS')">
          <router-link :to="{name: 'admin.configuracion-pagina-web.convocatorias'}">
            <div class="small-box bg-info">
              <div class="inner">
                <h3 v-text="quantities.convocatorias_count"></h3>
                <p>Convocatorias</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-bell"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR GALERIAS')">
          <router-link :to="{name: 'admin.configuracion-pagina-web.galerias'}">
            <div class="small-box bg-dark">
              <div class="inner">
                <h3 v-text="quantities.galerias_count"></h3>
                <p>Galerías</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-images"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR VIDEOS')">
          <router-link :to="{name: 'admin.configuracion-pagina-web.videos'}">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3 v-text="quantities.videos_count"></h3>
                <p>Videos</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-video"></i>
              </div>
            </div>
          </router-link>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3" v-if="can('ADMINISTRAR PROYECTOS DE INVESTIGACION')">
          <router-link :to="{name: 'admin.investigacion.proyectos-investigacion'}">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3 v-text="quantities.proyectos_investigacion_count"></h3>
                <p>Proyectos de Investigación</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-project-diagram"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR PROYECTOS DE EMPRENDIMIENTO')">
          <router-link :to="{name: 'admin.investigacion.proyectos-emprendimiento'}">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>1</h3>
                <p>Proyectos de Emprendimiento</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-project-diagram"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR PATENTES')">
          <router-link :to="{name: 'admin.investigacion.patentes'}">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>1</h3>
                <p>Patentes</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-gavel"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR PUBLICACIONES')">
          <router-link :to="{name: 'admin.investigacion.publicaciones'}">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 v-text="quantities.publicaciones_count"></h3>
                <p>Publicaciones</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-newspaper"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR CONVENIOS')">
          <router-link :to="{name: 'admin.investigacion.convenios'}">
            <div class="small-box bg-info">
              <div class="inner">
                <h3 v-text="quantities.convenios_count"></h3>
                <p>Convenios</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-clone"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR MOVILIDAD')">
          <router-link :to="{name: 'admin.investigacion.movilidades'}">
            <div class="small-box bg-dark">
              <div class="inner">
                <h3 v-text="quantities.movilidad_count"></h3>
                <p>Movilidad</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-clone"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR CIRCULOS DE INVESTIGACION')">
          <router-link :to="{name: 'admin.investigacion.circulos-investigacion'}">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3 v-text="quantities.circulos_investigacion_count"></h3>
                <p>Círculos de Investigación</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-user-tag"></i>
              </div>
            </div>
          </router-link>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3" v-if="can('ADMINISTRAR MIEMBROS (LIDER DE CIRCULO DE INVESTIGACION)')">
          <router-link :to="{name: 'admin.not-found'}">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>1</h3>
                <p>(Líder C.I.) Miembros</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-users"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR PROYECTOS DE INVESTIGACION (LIDER DE CIRCULO DE INVESTIGACION)')">
          <router-link :to="{name: 'admin.not-found'}">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>1</h3>
                <p>(Líder C.I.) Proyectos de Investigación</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-project-diagram"></i>
              </div>
            </div>
          </router-link>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3" v-if="can('ADMINISTRAR PROYECTOS DE INVESTIGACION (INVESTIGADOR)')">
          <router-link :to="{name: 'admin.not-found'}">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>1</h3>
                <p>(Investigador) Proyectos de Investigación</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-project-diagram"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR PUBLICACIONES DE ARTICULOS (INVESTIGADOR)')">
          <router-link :to="{name: 'admin.not-found'}">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>1</h3>
                <p>(Investigador) Publicación de Artículos</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-newspaper"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR PUBLICACIONES DE CAPITULOS DE LIBROS (INVESTIGADOR)')">
          <router-link :to="{name: 'admin.not-found'}">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>1</h3>
                <p>(Investigador) Publicación de Capítulos de Libros</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-book"></i>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-sm-3" v-if="can('ADMINISTRAR PUBLICACIONES DE LIBROS (INVESTIGADOR)')">
          <router-link :to="{name: 'admin.not-found'}">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>1</h3>
                <p>(Investigador) Publicación de Libros</p>
              </div>
              <div class="icon text-white">
                <i class="fas fa-fw fa-book"></i>
              </div>
            </div>
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import Form from 'vform';
  import { objectToFormData } from 'object-to-formdata';

  export default {
    data() {
      return {
        // loader
        loader: true, 
        //
        quantities: {},
      }
    },
    methods: {
      getQuantities(page) {
        this.loader = true;
        axios.get('/api/principal').then(response => {
          this.quantities = response.data;
          this.loader = false;
        }).catch(() => {
          toastr.error('No se pudo obtener los registros, recargue la página e intente nuevamente', '¡Error!');
        })
      },
    },
    created() {
      this.getQuantities();
    },
  }
</script>