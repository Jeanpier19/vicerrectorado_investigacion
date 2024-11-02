<template>
  <div class="container-fluid pt-3">
    <div class="vld-parent">
      <loading :active.sync="isLoading" 
      :can-cancel="true"
      :is-full-page="fullPage"></loading>
    </div>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <router-link :to="{name: 'admin.principal'}">Menú Principal</router-link>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Proyectos de Emprendimiento</li>
      </ol>
    </nav>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4 col-sm-12">
            <div>
              <p>Registros por página: {{ pagination.per_page }}</p>
            </div>
          </div>
          <div class="col-lg-8 col-sm-12">
            <div class="input-group mb-2">
              <input type="text" class="form-control" placeholder="Buscar" v-model="search" @keyup.enter="searchItems()">
              <div class="input-group-append">
                <button type="submit" class="btn btn-primary" @click.prevent="searchItems()">
                  <i class="fa fa-search"></i>
                </button>
              </div>
              <button type="button" class="btn btn-success ml-1" @click.prevent="openModalCreate()"><i class="fas fa-fw fa-plus-circle"></i>&nbsp;Registrar Proyecto de Emprendimiento</button>
            </div>
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
        <div class="table-responsive" v-show="!loader">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Financiación</th>
                <th>Título</th>
                <th>Facultad</th>
                <th>Responsable</th>
                <th>Corresponsables</th>
                <th>Año</th>
                <th>Presupuesto</th>
                <th>Estado</th>
                <th>Prioridad</th>
                <th>Activo</th>
                <th style="min-width: 140px">Acción</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item, key in items">
                <td v-text="key + pagination.from"></td>
                <td v-text="item.tipo_financiacion.nombre + ' / ' + item.clase"></td>
                <td>
                  <a :href="item.link" target="_blank" v-if="item.link" v-text="item.titulo"></a>
                  <span v-else v-text="item.titulo"></span>
                </td>
                <td v-text="item.facultad.abreviatura"></td>
                <td v-text="item.responsable"></td>
                <td v-text="item.corresponsables"></td>
                <td v-text="item.anio"></td>
                <td v-text="item.presupuesto"></td>
                <td v-text="item.estado"></td>
                <td>
                  <span class="badge p-2" :class="item.main ? 'badge-success' : 'badge-danger'" v-text="item.main ? 'Si' : 'No'"></span>
                </td>
                <td>
                  <span class="badge p-2" :class="item.active ? 'badge-success' : 'badge-warning text-white'" v-text="item.active ? 'Activo' : 'Inactivo'"></span>
                </td>
                <td>
                  <button type="button" class="btn btn-sm" :class="item.active ? 'btn-dark' : 'btn-success'" @click.prevent="item.active ? disableItem(item.id) : enableItem(item.id)" v-tooltip:top="item.active ? 'Desactivar' : 'Activar'">
                    <i class="fas fa-fw fa-arrow-circle-down" :class="item.active ? 'fa-arrow-circle-down' : 'fa-arrow-circle-up'"></i>
                  </button> 
                  <button type="button" class="btn btn-warning btn-sm text-white" @click.prevent="openModalUpdate(item)" v-tooltip:top="'Editar'">
                    <i class="fas fa-fw fa-edit"></i>
                  </button>
                  <button type="button" class="btn btn-danger btn-sm" @click.prevent="deleteItem(item.id)" v-tooltip:top="'Eliminar'">
                    <i class="fas fa-fw fa-trash"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="row">
          <div class="col-lg-4 text-center text-lg-left col-sm-12">
            <p v-if="pagination.from">Mostrando de {{ pagination.from }} a {{ pagination.to }} de {{ pagination.total }} registros</p>
          </div>
          <div class="col-lg-8 col-sm-12">
            <nav>
              <ul class="pagination justify-content-center justify-content-lg-end">
                <li class="page-item" v-if="pagination.current_page > 1">
                  <a class="page-link" href="javascript:void(0)" @click.prevent="changePage(1)">Inicio</a>
                </li>
                <li class="page-item" v-if="pagination.current_page > 1">
                  <a class="page-link" href="javascript:void(0)" tabindex="-1" @click.prevent="changePage(pagination.current_page - 1)">Anterior</a>
                </li>
                <li class="page-item" v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']">
                  <a class="page-link" href="javascript:void(0)" @click.prevent="changePage(page)">{{ page }}</a>
                </li>
                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                  <a class="page-link" href="javascript:void(0)" @click.prevent="changePage(pagination.current_page + 1)">Siguiente</a>
                </li>
                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                  <a class="page-link" href="javascript:void(0)" @click.prevent="changePage(pagination.last_page)">Último</a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <form @submit.prevent="editMode ? update() : create()">
              <div class="modal-header">
                <h5 class='modal-title font-weight-bold'>
                  <span v-if="editMode"><i class='fas fa-fw fa-edit'></i>&nbsp;Editar Proyecto de Emprendimiento</span>
                  <span v-else><i class='fas fa-fw fa-plus-circle'></i>&nbsp;Registrar Proyecto de Emprendimiento</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-row">
                  <div class="form-group col-md-8">
                    <label>Facultad&nbsp;<span class="text-danger">*</span></label>
                    <select v-model="form.facultad_id" type="text" name="facultad_id" id="facultad_id"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('facultad_id') }">
                      <option value="" disabled selected>Selecione la Facultad...</option>
                      <option v-for="item in facultades" :value="item.id" v-text="item.nombre"></option>
                    </select>
                    <has-error :form="form" field="facultad_id"></has-error>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Tipo de Financiación&nbsp;<span class="text-danger">*</span></label>
                    <select v-model="form.tipo_financiacion_id" type="text" name="tipo_financiacion_id" id="tipo_financiacion_id"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('tipo_financiacion_id') }">
                      <option value="" disabled selected>Selecione el Tipo de Financiación...</option>
                      <option v-for="(item in tipos_financiacion" :value="item.id" v-text="item.nombre"></option>
                    </select>
                    <has-error :form="form" field="tipo_financiacion_id"></has-error>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label>Área de Investigación&nbsp;<span class="text-danger">*</span></label>
                    <select v-model="form.area_id" type="text" name="area_id" id="area_id"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('area_id') }"
                    @change="getLineas()">
                      <option value="" disabled selected>Selecione el Área de Investigación...</option>
                      <option v-for="item in areas" :value="item.id" v-text="item.nombre"></option>
                    </select>
                    <has-error :form="form" field="area_id"></has-error>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Línea de Investigación&nbsp;<span class="text-danger">*</span></label>
                    <select v-model="form.linea_id" type="text" name="linea_id" id="linea_id"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('linea_id') }"
                    @change="getSublineas()">
                      <option value="" disabled selected>Selecione la Línea de Investigación...</option>
                      <option v-for="item in lineas" :value="item.id" v-text="item.nombre"></option>
                    </select>
                    <has-error :form="form" field="linea_id"></has-error>
                  </div>
                  <div class="form-group col-md-5">
                    <label>Sublínea de Investigación&nbsp;<span class="text-danger">*</span></label>
                    <select v-model="form.sublinea_id" type="text" name="sublinea_id" id="sublinea_id"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('sublinea_id') }">
                      <option value="" disabled selected>Selecione la Subínea de Investigación...</option>
                      <option v-for="item in sublineas" :value="item.id" v-text="item.nombre"></option>
                    </select>
                    <has-error :form="form" field="sublinea_id"></has-error>
                  </div>
                </div>
                <div class="form-group">
                  <label>Instituciones</label>
                  <v-select
                    :class="{ 'is-invalid': form.errors.has('instituciones') }"
                    placeholder="Buscar Instituciones..."
                    v-model="form.instituciones"
                    multiple
                    label="nombre"
                    :options="instituciones_options"
                    :reduce="institucion => institucion.code"
                  ><span slot="no-options">Lo siento, no hay registros coincidentes.</span></v-select>
                  <has-error :form="form" field="instituciones"></has-error>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label>Clase&nbsp;<span class="text-danger">*</span></label>
                    <select v-model="form.clase" name="clase"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('clase') }">
                      <option value="" disabled>Seleccione la Clase...</option>
                      <option value="DOCENTE">DOCENTE</option>
                      <option value="ESTUDIANTE">ESTUDIANTE</option>
                    </select>
                    <has-error :form="form" field="clase"></has-error>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Año&nbsp;<span class="text-danger">*</span></label>
                    <input v-model="form.anio" type="number" name="anio" id="anio" 
                    class="form-control" :class="{ 'is-invalid': form.errors.has('anio') }"
                    placeholder="Ingrese el Año">
                    <has-error :form="form" field="anio"></has-error>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Estado&nbsp;<span class="text-danger">*</span></label>
                    <select v-model="form.estado" name="estado"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('estado') }">
                      <option value="" disabled>Seleccione el Estado...</option>
                      <option value="En ejecución">En ejecución</option>
                      <option value="Concluido">Concluido</option>
                      <option value="Denegado">Denegado</option>
                    </select>
                    <has-error :form="form" field="estado"></has-error>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Presupuesto&nbsp;<span class="text-danger">*</span></label>
                    <input v-model="form.presupuesto" type="text" name="presupuesto" id="presupuesto" 
                    class="form-control" :class="{ 'is-invalid': form.errors.has('presupuesto') }"
                    placeholder="Ingrese el Presupuesto">
                    <has-error :form="form" field="presupuesto"></has-error>
                  </div>
                </div>
                <div class="form-group">
                  <label>Título&nbsp;<span class="text-danger">*</span></label>
                  <textarea v-model="form.titulo" rows="4" name="titulo" id="titulo" 
                  class="form-control" :class="{ 'is-invalid': form.errors.has('titulo') }"
                  placeholder="Ingrese el Título"></textarea>
                  <has-error :form="form" field="titulo"></has-error>
                </div>
                <div class="form-group">
                  <label>Resúmen</label>
                  <textarea v-model="form.resumen" rows="4" name="resumen" id="resumen" 
                  class="form-control" :class="{ 'is-invalid': form.errors.has('resumen') }"
                  placeholder="Ingrese el Resúmen"></textarea>
                  <has-error :form="form" field="resumen"></has-error>
                </div>
                <div class="form-group">
                  <label>Abstract</label>
                  <textarea v-model="form.abstract" rows="4" name="abstract" id="abstract" 
                  class="form-control" :class="{ 'is-invalid': form.errors.has('abstract') }"
                  placeholder="Ingrese el Abstract"></textarea>
                  <has-error :form="form" field="abstract"></has-error>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Objetivos</label>
                    <textarea v-model="form.objetivos" rows="4" name="objetivos" id="objetivos" 
                    class="form-control" :class="{ 'is-invalid': form.errors.has('objetivos') }"
                    placeholder="Ingrese los Objetivos"></textarea>
                    <has-error :form="form" field="objetivos"></has-error>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Palabras Clave</label>
                    <textarea v-model="form.palabras_clave" rows="4" name="palabras_clave" id="palabras_clave" 
                    class="form-control" :class="{ 'is-invalid': form.errors.has('palabras_clave') }"
                    placeholder="Ingrese las Palabras Clave"></textarea>
                    <has-error :form="form" field="palabras_clave"></has-error>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label>Responsable&nbsp;<span class="text-danger">*</span></label>
                    <textarea v-model="form.responsable" rows="4" name="responsable" id="responsable" 
                    class="form-control" :class="{ 'is-invalid': form.errors.has('responsable') }"
                    placeholder="Ingrese el Responsable"></textarea>
                    <has-error :form="form" field="responsable"></has-error>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Corresponsables</label>
                    <textarea v-model="form.corresponsables" rows="4" name="corresponsables" id="corresponsables" 
                    class="form-control" :class="{ 'is-invalid': form.errors.has('corresponsables') }"
                    placeholder="Ingrese los Corresponsables"></textarea>
                    <has-error :form="form" field="corresponsables"></has-error>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Colaboradores</label>
                    <textarea v-model="form.colaboradores" rows="4" name="colaboradores" id="colaboradores" 
                    class="form-control" :class="{ 'is-invalid': form.errors.has('colaboradores') }"
                    placeholder="Ingrese los Colaboradores"></textarea>
                    <has-error :form="form" field="colaboradores"></has-error>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label>Prioridad&nbsp;<span class="text-danger">*</span></label>
                    <select v-model="form.main" name="main"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('main') }">
                      <option value="0">No</option>
                      <option value="1">Si</option>
                    </select>
                    <has-error :form="form" field="main"></has-error>
                  </div>
                  <div class="form-group col-md-9">
                    <label>Enlace</label>
                    <input v-model="form.link" type="text" name="link" id="link" 
                    class="form-control" :class="{ 'is-invalid': form.errors.has('link') }"
                    placeholder="Ingrese el Enlace del Proyecto">
                    <has-error :form="form" field="link"></has-error>
                  </div>
                </div>
                <div class="form-group">
                  <label>Entregable</label>
                  <textarea v-model="form.entregable" rows="4" name="entregable" id="entregable" 
                  class="form-control" :class="{ 'is-invalid': form.errors.has('entregable') }"
                  placeholder="Ingrese el Entregable"></textarea>
                  <has-error :form="form" field="entregable"></has-error>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i>Cerrar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Modal -->
    </div>
  </div>
</template>

<script>
  import Form from 'vform';
  import { objectToFormData } from 'object-to-formdata';
  import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
  import '@ckeditor/ckeditor5-build-classic/build/translations/es';

  export default {
    data() {
      return {
        // loader
        loader: true, 
        isLoading: false,
        fullPage: true,
        //
        // ckeditor5
        editor: ClassicEditor,
        editorData: '',
        editorConfig: {
          language: 'es',
          link: {
            decorators: {
              toggleDownloadable: {
                mode: 'manual',
                label: 'Downloadable',
                attributes: {
                  download: 'file'
                }
              },
              openInNewTab: {
                mode: 'manual',
                label: 'Open in a new tab',
                defaultValue: true,
                attributes: {
                  target: '_blank',
                  rel: 'noopener noreferrer'
                }
              }
            }
          }
        },
        // 
        editMode: false,
        descripcionAddDocumento: '',
        items: {},
        facultades: {},
        tipos_financiacion: {},
        areas: {},
        lineas: {},
        sublineas: {},
        instituciones: {},
        instituciones_options: [],
        form: new Form({
          'id': '',
          'facultad_id': '',
          'area_id': '',
          'linea_id': '',
          'sublinea_id': '',
          'tipo_financiacion_id': '',
          'instituciones': [],
          'clase': '',
          'titulo': '',
          'resumen': '',
          'abstract': '',
          'objetivos': '',
          'palabras_clave': '',
          'responsable': '',
          'corresponsables': '',
          'colaboradores': '',
          'anio': '',
          'presupuesto': '',
          'estado': '',
          'entregable': '',
          'link': '',
          'main': 0,
        }),
        pagination: {
          'total': 0,
          'per_page': 0,
          'current_page': 0,
          'last_page': 0,
          'from': 0,
          'to': 0
        },
        offset: 6,
        thisPage: 1,
        search: '',
      }
    },
    methods: {
      getItems(page) {
        this.loader = true;
        axios.get('/api/proyecto-emprendimiento?page=' + page + '&search=' + this.search).then(response => {
          this.items = response.data.items.data;
          this.pagination = response.data.pagination;
          this.facultades = response.data.facultades;
          this.tipos_financiacion = response.data.tipos_financiacion;
          this.areas = response.data.areas;
          this.instituciones = response.data.instituciones;
          this.instituciones_options = [];
          for (var i = 0; i < this.instituciones.length; i++) {
            this.instituciones_options.push({
              nombre: this.instituciones[i].nombre,
              code: this.instituciones[i].id  
            });
          }
          this.loader = false;
        }).catch(() => {
          toastr.error('No se pudo obtener los registros, recargue la página e intente nuevamente', '¡Error!');
        })
      },
      getLineas() {
        this.lineas = {};
        this.form.linea_id = '';
        this.sublineas = {};
        this.form.sublinea_id = '';
        this.isLoading = true;
        let url = '/api/proyecto-emprendimiento/get-lineas?area_id=' + this.form.area_id;
        axios.post(url).then(response => {
          this.lineas = response.data.lineas;
          this.isLoading = false;
        });
      },
      getSublineas() {
        this.sublineas = {};
        this.form.sublinea_id = '';
        this.isLoading = true;
        let url = '/api/proyecto-emprendimiento/get-sublineas?linea_id=' + this.form.linea_id;
        axios.post(url).then(response => {
          this.sublineas = response.data.sublineas;
          this.isLoading = false;
        });
      },
      changePage: function(page) {
        this.pagination.current_page = page;
        this.getItems(page);
        this.thisPage = page;
      },
      searchItems: function() {
        this.thisPage = 1;
        this.getItems(this.thisPage);
      },
      getItemDocument(file) {
        let filePath = null;
        if(file != null && file != '') {
          filePath = "/archivos/documentos/proyecto-empre/" + file.path;
        }else{
          filePath = '';
        }
        return filePath;
      },
      truncateText: function(text, length) {
        if(text.length > length)
          return text.substring(0, length) + '...';
        else
          return text;
      },
      openModalCreate() {
        this.editMode = false;
        this.form.reset();
        this.form.clear();
        $('#modal').modal({ show: true, backdrop: false });
        $('#modal').on('shown.bs.modal', function() { $('#facultad_id').focus() });
      },
      openModalUpdate(item) {
        this.editMode = true;
        const aux = [];
        for (var i = 0; i < item.instituciones.length; i++) {
          aux[i] = item.instituciones[i].id;
        }
        this.form.area_id = item.sublinea.linea.area_id;
        this.getLineas();
        this.form.linea_id = item.sublinea.linea_id;
        this.getSublineas();
        let dataToFill = {
          'id': item.id,
          'facultad_id': item.facultad_id,
          'area_id': item.sublinea.linea.area_id,
          'linea_id': item.sublinea.linea_id,
          'sublinea_id': item.sublinea_id,
          'tipo_financiacion_id': item.tipo_financiacion_id,
          'instituciones': aux,
          'clase': item.clase,
          'titulo': item.titulo,
          'resumen': item.resumen,
          'abstract': item.abstract,
          'objetivos': item.objetivos,
          'palabras_clave': item.palabras_clave,
          'responsable': item.responsable,
          'corresponsables': item.corresponsables,
          'colaboradores': item.colaboradores,
          'anio': item.anio,
          'presupuesto': item.presupuesto,
          'estado': item.estado,
          'entregable': item.entregable,
          'link': item.link,
          'main': item.main
        };
        this.form.reset();
        this.form.clear();
        this.form.fill(dataToFill);
        $('#modal').modal({ show: true });
        $('#modal').on('shown.bs.modal', function() { $('#facultad_id').focus() });
      },
      create() {
        this.isLoading = true;
        this.form.post('/api/proyecto-emprendimiento').then(response => {
          if(response.data.result) {
            Fire.$emit('transaction');
            $('#modal').modal('hide');
            toastr.success(response.data.message, '¡Completado!');
          }else {
            toastr.error(response.data.message, '¡Error!');
          }
          this.isLoading = false;
        }).catch(error => {
          if(error.response.status == 422) {
            toastr.error('Por favor verifique los campos obligatorios antes de guardar', '¡Error!');
          }else {
            toastr.error('Hubo un error inesperado, recargue la página e intente nuevamente', '¡Error!');
          }
          this.isLoading = false;
        });
      },
      update() {
        this.isLoading = true;
        this.form.put('/api/proyecto-emprendimiento/' + this.form.id).then(response => {
          if(response.data.result) {
            Fire.$emit('transaction');
            $('#modal').modal('hide');
            toastr.success(response.data.message, '¡Completado!');
          }else {
            toastr.error(response.data.message, '¡Error!');
          }
          this.isLoading = false;
        }).catch(error => {
          if(error.response.status == 422) {
            toastr.error('Por favor verifique los campos obligatorios antes de guardar', '¡Error!');
          }else {
            toastr.error('Hubo un error inesperado, recargue la página e intente nuevamente', '¡Error!');
          }
          this.isLoading = false;
        });
      },
      disableItem: function(id) {
        Swal.fire({
          icon: 'warning',
          title: '¿Estás seguro?',
          text: '¡Se desactivará el registro seleccionado!',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, desactivar',
          cancelButtonText: 'No, cancelar'
        }).then((result) => {
          if(result.value) {
            this.isLoading = true;
            axios.post('/api/proyecto-emprendimiento/alta-baja/0/' + id).then(response => {
              if(response.data.result) {
                Fire.$emit('transaction');
                $('#modal').modal('hide');
                toastr.success(response.data.message, '¡Completado!');
              }else {
                toastr.error(response.data.message, '¡Error!');
              }
              this.isLoading = false;
            }).catch(() => {
              toastr.error('Hubo un error inesperado, recargue la página e intente nuevamente', '¡Error!');
              this.isLoading = false;
            });
          }
        });
      },
      enableItem: function(id) {
        Swal.fire({
          icon: 'warning',
          title: '¿Estás seguro?',
          text: '¡Se activará el registro seleccionado!',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, activar',
          cancelButtonText: 'No, cancelar'
        }).then((result) => {
          if(result.value) {
            this.isLoading = true;
            axios.post('/api/proyecto-emprendimiento/alta-baja/1/' + id).then(response => {
              if(response.data.result) {
                Fire.$emit('transaction');
                $('#modal').modal('hide');
                toastr.success(response.data.message, '¡Completado!');
              }else {
                toastr.error(response.data.message, '¡Error!');
              }
              this.isLoading = false;
            }).catch(() => {
              toastr.error('Hubo un error inesperado, recargue la página e intente nuevamente', '¡Error!');
              this.isLoading = false;
            });
          }
        });
      },
      deleteItem(id) {
        Swal.fire({
          icon: 'warning',
          title: '¿Estás seguro?',
          text: '¡Se eliminará el registro seleccionado!',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, eliminar',
          cancelButtonText: 'No, cancelar'
        }).then((result) => {
          if(result.value) {
            this.isLoading = true;
            this.form.delete('/api/proyecto-emprendimiento/' + id).then(response => {
              if(response.data.result) {
                Fire.$emit('transaction');
                $('#modal').modal('hide');
                toastr.success(response.data.message, '¡Completado!');
              }else {
                toastr.error(response.data.message, '¡Error!');
              }
              this.isLoading = false;
            }).catch(() => {
              toastr.error('Hubo un error inesperado, recargue la página e intente nuevamente', '¡Error!');
              this.isLoading = false;
            });
          }
        });
      },
    },
    created() {
      this.getItems(this.thisPage);
      Fire.$on('transaction', () => {
        this.getItems(this.thisPage);
      })
    },
    computed: {
      isActived: function() {
        return this.pagination.current_page;
      },
      pagesNumber: function () {
        if(!this.pagination.to){
          return [];
        }
        let from = this.pagination.current_page - this.offset;
        let from2 = this.pagination.current_page - this.offset;
        if(from < 1) {
          from = 1;
        }
        let to = from2 + (this.offset * 2);
        if(to >= this.pagination.last_page) {
          to = this.pagination.last_page;
        }
        let pagesArray = [];
        while(from <= to) {
          pagesArray.push(from);
          from++;
        }
        return pagesArray;
      }
    },
  }
</script>
