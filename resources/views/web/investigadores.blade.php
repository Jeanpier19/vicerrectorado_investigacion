@extends('layouts.web.master')
@section('title', 'Investigadores de la UNASAM | ')
@section('content')
  <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
    <div class="container text-left align-self-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('web.index') }}">Inicio</a></li>
        </ol>
      </nav>
      <h1 class="page-title-heading mt-3">Investigadores de la UNASAM</h1>
      <div><a href="{{ route('web.requisitos-deberes-derechos') }}" class="btn btn-sm btn-style-4 btn-info"><i class="fe-icon-user-plus"></i> Solicitud para creación de cuenta</a></div>
    </div>
  </div>
  <section class="container pt-3 mb-3">
    <div class="sk-cube-grid" v-show="preLoader">
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
    <template v-if="!preLoader">
      <div class="row">
        <div class="form-group col-lg-9 col-md-9 col-sm-12">
          <label class="font-weight-bold p-0" for="search">Buscar</label>
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Buscar..." v-model="search" @keyup.enter="searchItems()">
            <div class="input-group-append">
              <button type="submit" class="btn btn-primary" @click.prevent="searchItems()">
                <i class="fe-icon-search"></i>
              </button>
            </div>
          </div>
        </div>
        <div class="form-group col-lg-3 col-md-3 col-sm-12">
          <label class="font-weight-bold p-0" for="qty_toshow">Mostrar</label>
          <select class="form-control" id="qty_toshow" v-model="qty_toshow" @change="searchItems()">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="40">40</option>
            <option value="60">60</option>
            <option value="80">80</option>
            <option value="100">100</option>
            <option :value="pagination.total">Todo</option>
          </select>
        </div>
      </div>
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
      <div class="row" v-show="!loader">
        <div class="col-12">
          <p v-if="pagination.from">Mostrando de @{{ pagination.from }} a @{{ pagination.to }} de @{{ pagination.total }} registros</p>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 mb-5" v-for="item, key in items">
          <div class="card">
            <div class="card-header m-auto">
              <a :href="getItemImage(item.user)" class="fancybox" data-fancybox="Usuario"><img :src="getItemImage(item.user)" class="img-fluid p-2 img-200" :alt="item.user.persona.nombres + ' ' + item.user.persona.apellidos"></a>
            </div>
            <div class="card-body">
              <h2 class="h6 text-dark text-center text-uppercase">@{{ item.user.persona.nombres + ' ' + item.user.persona.apellidos }}</h2>
              <div class="row no-gutters">
                <div class="col-lg-5 col-md-12 text-center text-lg-left">
                  <strong>Correo:</strong>  
                </div>
                <div class="col-lg-7 col-md-12 text-center text-lg-left">
                  <span>@{{ item.user.persona.email }}</span> 
                </div>
              </div>
              <div class="row no-gutters">
                <div class="col-lg-5 col-md-12 text-center text-lg-left">
                  <strong>Grado:</strong> 
                </div>
                <div class="col-lg-7 col-md-12 text-center text-lg-left">
                  <span>@{{ item.grado }}</span>
                </div>
              </div>
              <div class="row no-gutters">
                <div class="col-lg-5 col-md-12 text-center text-lg-left">
                  <strong>Categoría:</strong> 
                </div>
                <div class="col-lg-7 col-md-12 text-center text-lg-left">
                  <span v-if="item.categoria == 1">Auxiliar</span>
                  <span v-if="item.categoria == 2">Asociado</span>
                  <span v-if="item.categoria == 3">Principal</span>
                </div>
              </div>
              <div class="row no-gutters">
                <div class="col-lg-5 col-md-12 text-center text-lg-left">
                  <strong>Facultad:</strong>  
                </div>
                <div class="col-lg-7 col-md-12 text-center text-lg-left">
                  <span>@{{ item.departamento.facultad.nombre }}</span>
                </div>
              </div>
              <div class="row no-gutters">
                <div class="col-lg-5 col-md-12 text-center text-lg-left">
                  <strong>Departamento académico:</strong>  
                </div>
                <div class="col-lg-7 col-md-12 text-center text-lg-left">
                  <span>@{{ item.departamento.nombre }}</span>
                </div>
              </div>
              <div class="row no-gutters">
                <div class="col-lg-5 col-md-12 text-center text-lg-left">
                  <strong>Sitio web:</strong> 
                </div>
                <div class="col-lg-7 col-md-12 text-center text-lg-left">
                  <span>@{{ item.user.persona.sitio_web }}</span>
                </div>
              </div>
              <div class="d-flex justify-content-between mt-3">
                <a v-if="item.cti" v-bind:href="item.cti" target="_blank" class="btn btn-sm btn-style-6 btn-info">CTI vitae</a>
                <a v-else href="javascript:void(0)" class="btn btn-sm btn-style-6 btn-info">CTI vitae</a>
                <a v-if="item.orcid" v-bind:href="'https://orcid.org/' + item.orcid" target="_blank" class="btn btn-sm btn-style-6 btn-success">ORCID</a>
                <a v-else href="javascript:void(0)" class="btn btn-sm btn-style-6 btn-success">ORCID</a>
              </div>
              <hr class="my-2">
              <a href="javascript:void(0)" class="btn btn-sm btn-block btn-style-4 btn-success" data-toggle="modal" data-target="#modalCoursess" title="Buscar">Círculos de investigación</a>
              <div class="d-flex justify-content-between my-2">
                <a href="javascript:void(0)" class="btn btn-sm btn-style-4 btn-primary" @click.prevent="openProjectsModal(item)" title="Buscar">Proyectos</a>
                <a href="javascript:void(0)" class="btn btn-sm btn-style-4 btn-primary" @click.prevent="openPublicationsModal(item)" title="Buscar">Publicaciones</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--================================
      =            Pagination            =
      =================================-->
      <div class="row pt-3" v-show="!loader">
        <div class="col-12">
          <p v-if="pagination.from">Mostrando de @{{ pagination.from }} a @{{ pagination.to }} de @{{ pagination.total }} registros</p>
        </div>
        <div class="col-12">
          <nav class="pagination">
            <a class="btn btn-sm btn-style-6 btn-primary" href="javascript:void(0)" v-if="pagination.current_page > 1" tabindex="-1" @click.prevent="changePage(pagination.current_page - 1)"><i class="fe-icon-chevron-left"></i>Anterior</a>
            <ul class="pages">
              <li class="d-block d-sm-none w-100">@{{ pagination.current_page }} / @{{ pagination.last_page }}</li>
              <li class="d-none d-sm-inline-block" v-for="page in pagesNumber" :class="page == isActived ? 'active' : ''">
                <a href="javascript:void(0)" @click.prevent="changePage(page)">@{{ page }}</a>
              </li>
            </ul>
            <a class="btn btn-sm btn-style-6 btn-primary" href="javascript:void(0)" v-if="pagination.current_page < pagination.last_page" @click.prevent="changePage(pagination.current_page + 1)">Siguiente<i class="fe-icon-chevron-right"></i></a>
          </nav>
        </div>
      </div>
      <!--====  End of Pagination  ====-->
    </template>
  </section>
  <!-- Modal -->
  <div class="modal fade" id="modalProjects" tabindex="-1" role="dialog" aria-labelledby="Proyectos" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title h6" id="exampleModalLongTitle">Lista de Proyectos</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" v-if="investigador != null">
          <div class="form-row">
            <div class="col-md-4">
              <a :href="getItemImage(investigador.user)" class="fancybox" data-fancybox="Usuario"><img :src="getItemImage(investigador.user)" class="img-fluid p-2 img-200" :alt="investigador.user.persona.apellidos + ' ' + investigador.user.persona.nombres"></a>
            </div>
            <div class="col-md-8">
              <ul class="list-group">
                <li class="list-group-item">
                  <strong>Docente: <span v-text="investigador.user.persona.nombres + ' ' + investigador.user.persona.apellidos"></span></strong>
                </li>
                <li class="list-group-item">
                  <strong>Correo: <span v-text="investigador.user.persona.email"></span></strong>
                </li>
                <li class="list-group-item">
                  <strong>Facultad: <span v-text="investigador.departamento.facultad.nombre"></span></strong>
                </li>
                <li class="list-group-item">
                  <strong>Departamento: <span v-text="investigador.departamento.nombre"></span></strong>
                </li>
                <li class="list-group-item">
                  <strong>Categoría: <span v-if="investigador.categoria == 1" v-text="'Auxiliar'"></span><span v-if="investigador.categoria == 2" v-text="'Asociado'"></span><span v-if="investigador.categoria == 3" v-text="'Principal'"></span></strong>
                </li>
              </ul>
            </div>
          </div>
          <div class="table-responsive mt-3">
            <table class="table table-striped">
              <thead class="table-dark">
                <tr>
                  <th>Título</th>
                  <th style="min-width: 200px">Tipo de financiación</th>
                  <th style="min-width: 160px">Corresponsables</th>
                  <th>Estado</th>
                  <th>Entregable</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="proyecto, key in investigador.proyectos">
                  <td v-text="proyecto.titulo"></td>
                  <td v-text="proyecto.tipo_financiacion.nombre"></td>
                  <td v-text="proyecto.corresponsables"></td>
                  <td v-text="proyecto.estado"></td>
                  <td v-text="proyecto.entregable"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-success btn-style-4"><i class="fe-icon-download-cloud"></i> Excel</button>
          <button type="button" class="btn btn-sm btn-danger btn-style-4"><i class="fe-icon-download-cloud"></i> PDF</button>
          <button type="button" class="btn btn-sm btn-warning btn-style-4" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modalPublications" tabindex="-1" role="dialog" aria-labelledby="Proyectos" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title h6" id="exampleModalLongTitle">Lista de Publicaciones</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" v-if="investigador != null">
          <div class="form-row">
            <div class="col-md-4">
              <a :href="getItemImage(investigador.user)" class="fancybox" data-fancybox="Usuario"><img :src="getItemImage(investigador.user)" class="img-fluid p-2 img-200" :alt="investigador.user.persona.apellidos + ' ' + investigador.user.persona.nombres"></a>
            </div>
            <div class="col-md-8">
              <ul class="list-group">
                <li class="list-group-item">
                  <strong>Docente: <span v-text="investigador.user.persona.nombres + ' ' + investigador.user.persona.apellidos"></span></strong>
                </li>
                <li class="list-group-item">
                  <strong>Correo: <span v-text="investigador.user.persona.email"></span></strong>
                </li>
                <li class="list-group-item">
                  <strong>Facultad: <span v-text="investigador.departamento.facultad.nombre"></span></strong>
                </li>
                <li class="list-group-item">
                  <strong>Departamento: <span v-text="investigador.departamento.nombre"></span></strong>
                </li>
                <li class="list-group-item">
                  <strong>Categoría: <span v-if="investigador.categoria == 1" v-text="'Auxiliar'"></span><span v-if="investigador.categoria == 2" v-text="'Asociado'"></span><span v-if="investigador.categoria == 3" v-text="'Principal'"></span></strong>
                </li>
              </ul>
            </div>
          </div>
          <h3 class="h6 block-title mt-3">Publicación de Artículos Científicos</h3>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead class="table-dark">
                <tr>
                  <th>Título</th>
                  <th>Revista Indizada</th>
                  <th>Año</th>
                  <th>Volúmen</th>
                  <th>Páginas</th>
                  <th>Número</th>
                  <th>Ciudad</th>
                  <th>País</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="publicacion, key in investigador.publicacion_articulos">
                  <td v-text="publicacion.titulo"></td>
                  <td v-text="publicacion.revista_indizada"></td>
                  <td v-text="publicacion.anio"></td>
                  <td v-text="publicacion.volumen"></td>
                  <td v-text="publicacion.paginas"></td>
                  <td v-text="publicacion.numeros"></td>
                  <td v-text="publicacion.ciudad"></td>
                  <td v-text="publicacion.pais"></td>
                </tr>
              </tbody>
            </table>
          </div>
          <hr>
          <h3 class="h6 block-title mt-3">Publicación de Capítulos de Libros</h3>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead class="table-dark">
                <tr>
                  <th>Título del Capítulo</th>
                  <th>Libro</th>
                  <th>Editor</th>
                  <th>Ciudad</th>
                  <th>País</th>
                  <th>Año</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="publicacion, key in investigador.publicacion_capitulos">
                  <td v-text="publicacion.titulo"></td>
                  <td v-text="publicacion.libro"></td>
                  <td v-text="publicacion.editor"></td>
                  <td v-text="publicacion.ciudad"></td>
                  <td v-text="publicacion.pais"></td>
                  <td v-text="publicacion.anio"></td>
                </tr>
              </tbody>
            </table>
          </div>
          <hr>
          <h3 class="h6 block-title mt-3">Publicación de Libros</h3>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead class="table-dark">
                <tr>
                  <th>Título</th>
                  <th>Editor</th>
                  <th>Ciudad</th>
                  <th>País</th>
                  <th>Año</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="publicacion, key in investigador.publicacion_libros">
                  <td v-text="publicacion.titulo"></td>
                  <td v-text="publicacion.editor"></td>
                  <td v-text="publicacion.ciudad"></td>
                  <td v-text="publicacion.pais"></td>
                  <td v-text="publicacion.anio"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-success btn-style-4"><i class="fe-icon-download-cloud"></i> Excel</button>
          <button type="button" class="btn btn-sm btn-danger btn-style-4"><i class="fe-icon-download-cloud"></i> PDF</button>
          <button type="button" class="btn btn-sm btn-warning btn-style-4" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Cerrar</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('custom_js')
  @include('web.vue.investigadores')
@endsection