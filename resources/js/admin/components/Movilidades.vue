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
        <li class="breadcrumb-item active" aria-current="page">Movilidad</li>
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
              <button type="button" class="btn btn-success ml-1" @click.prevent="openModalCreate()"><i class="fas fa-fw fa-plus-circle"></i>&nbsp;Registrar Movilidad</button>
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
                <th>Tipo</th>
                <th>Apellidos y Nombres</th>
                <th>Facultad</th>
                <th>Institución</th>
                <th>Semestre</th>
                <th>Modalidad</th>
                <th>Pais</th>
                <th>Docs.Anexos</th>
                <th>Prioridad</th>
                <th>Activo</th>
                <th style="min-width: 140px">Acción</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item, key in items">
                <td v-text="key + pagination.from"></td>
                <td v-text="item.tipo == 1 ? 'Estudiante' : 'Docente'"></td>
                <td v-text="item.nombres + ' ' + item.apellidos"></td>
                <td v-text="item.facultad.abreviatura"></td>
                <td v-text="item.institucion.nombre"></td>
                <td v-text="item.semestre.anio + '-' + item.semestre.periodo"></td>
                <td v-text="item.modalidad"></td>
                <td v-text="item.pais"></td>
                <td>
                  <ul class="list-unstyled">
                    <li class="text-center mb-2">
                      <button type="button" class="btn btn-success btn-sm" @click.prevent="openModalAddDocumento(item)">
                        <i class="fas fa-fw fa-plus"></i>
                      </button>
                    </li>
                    <li v-for="documento, key in item.files">
                      <a :href="getItemDocument(documento)" class="text-center font-weight-bold" target="_blank">{{ key + 1 }}. <i class="fas fa-fw fa-file-pdf"></i> {{ truncateText(documento.name, 20) }}</a>
                      <div class="text-center mb-3">
                        <button type="button" class="btn btn-outline-danger btn-sm" @click.prevent="deleteDocumento(documento, item)">
                          <i class="fas fa-fw fa-times"></i>
                        </button>
                      </div>
                    </li>
                  </ul>
                </td>
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
                  <span v-if="editMode"><i class='fas fa-fw fa-edit'></i>&nbsp;Editar Movilidad</span>
                  <span v-else><i class='fas fa-fw fa-plus-circle'></i>&nbsp;Registrar Movilidad</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label>Tipo de Movilidad&nbsp;<span class="text-danger">*</span></label>
                    <select v-model="form.tipo" name="tipo"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('tipo') }">
                      <option value="" disabled>Seleccione el Tipo de Movilidad...</option>
                      <option value="1">Estudiante</option>
                      <option value="2">Docente</option>
                    </select>
                    <has-error :form="form" field="tipo"></has-error>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Institución&nbsp;<span class="text-danger">*</span></label>
                    <select v-model="form.institucion_id" type="text" name="institucion_id" id="institucion_id"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('institucion_id') }">
                      <option value="" disabled selected>Selecione la Institución...</option>
                      <option v-for="item in instituciones" :value="item.id" v-text="item.nombre"></option>
                    </select>
                    <has-error :form="form" field="institucion_id"></has-error>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Prioridad&nbsp;<span class="text-danger">*</span></label>
                    <select v-model="form.main" name="main"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('main') }">
                      <option value="0">No</option>
                      <option value="1">Si</option>
                    </select>
                    <has-error :form="form" field="main"></has-error>
                  </div>
                </div>
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
                    <label>Semestre&nbsp;<span class="text-danger">*</span></label>
                    <select v-model="form.semestre_id" type="text" name="semestre_id" id="semestre_id"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('semestre_id') }">
                      <option value="" disabled selected>Selecione el Semestre...</option>
                      <option v-for="item in semestres" :value="item.id" v-text="item.anio + '-' + item.periodo"></option>
                    </select>
                    <has-error :form="form" field="semestre_id"></has-error>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Nombres&nbsp;<span class="text-danger">*</span></label>
                    <input v-model="form.nombres" type="text" name="nombres" id="nombres" 
                    class="form-control" :class="{ 'is-invalid': form.errors.has('nombres') }"
                    placeholder="Ingrese los Nombres">
                    <has-error :form="form" field="nombres"></has-error>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Apellidos&nbsp;<span class="text-danger">*</span></label>
                    <input v-model="form.apellidos" type="text" name="apellidos" id="apellidos" 
                    class="form-control" :class="{ 'is-invalid': form.errors.has('apellidos') }"
                    placeholder="Ingrese los Apellidos">
                    <has-error :form="form" field="apellidos"></has-error>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Modalidad&nbsp;<span class="text-danger">*</span></label>
                    <select v-model="form.modalidad" name="modalidad"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('modalidad') }">
                      <option value="" disabled>Seleccione la Modalidad...</option>
                      <option value="RPU">RPU 2</option>
                      <option value="Convenios">Convenios</option>
                      <option value="Otros">Otros</option>

                    </select>
                    <has-error :form="form" field="modalidad"></has-error>
                  </div>
                  <div class="form-group col-md-6">
                    <label>País&nbsp;<span class="text-danger">*</span></label>
                    <input v-model="form.pais" type="text" name="pais" id="pais" 
                    class="form-control" :class="{ 'is-invalid': form.errors.has('pais') }"
                    placeholder="Ingrese el País">
                    <has-error :form="form" field="pais"></has-error>
                  </div>
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
      <!-- Modal Documentos -->
      <div class="modal fade" id="modalAddDocumento" tabindex="-1" role="dialog" aria-labelledby="createModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <form method="post" @submit.prevent="addDocumento(form.id)">
              <div class="modal-header">
                <h5 class='modal-title font-weight-bold'><i class='fas fa-fw fa-plus-circle'></i> Añadir un Documento Anexo a la Movilidad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="descripcionAddDocumento" class="font-weight-bold">Descripción&nbsp;<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="descripcionAddDocumento" placeholder="Ingrese el nombre o descripción del documento" v-model="descripcionAddDocumento">
                </div>
                <div class="form-group">
                  <label for="filesAddDocumento" class="font-weight-bold">Documento&nbsp;<span class="text-danger">*</span>
                  </label>
                  <input type="file" id="fileAddDocumento" class="form-control" @change="getFileAddDocumento" accept="application/pdf">
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
      <!-- Modal Documentos -->
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
        instituciones: {},
        facultades: {},
        tipos_movilidad_especifico: {},
        form: new Form({
          'id': '',
          'facultad_id': '',
          'institucion_id': '',
          'semestre_id': '',
          'tipo': '',
          'nombres': '',
          'apellidos': '',
          'pais': '',
          'modalidad': '',
          'main': 0,
          'documento': ''
        }),
        pagination: {
          'total': 0,
          'per_page': 0,
          'current_page': 0,
          'last_page': 0,
          'from': 0,
          'to': 0
        },
        offset: 9,
        thisPage: 1,
        search: '',
      }
    },
    methods: {
      getItems(page) {
        this.loader = true;
        axios.get('/api/movilidad?page=' + page + '&search=' + this.search).then(response => {
          this.items = response.data.items.data;
          this.pagination = response.data.pagination;
          this.instituciones = response.data.instituciones;
          this.facultades = response.data.facultades;
          this.semestres = response.data.semestres;
          this.loader = false;
          console.log(this.semestres);
        }).catch(() => {
          toastr.error('No se pudo obtener los registros, recargue la página e intente nuevamente', '¡Error!');
        })
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
          filePath = "/archivos/documentos/movilidads/" + file.path;
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
        $('#modal').modal({ show: true });
        $('#modal').on('shown.bs.modal', function() { $('#tipo').focus() });
      },
      openModalUpdate(item) {
        this.editMode = true;
        let dataToFill = {
          'id': item.id,
          'facultad_id': item.facultad_id,
          'institucion_id': item.institucion_id,
          'semestre_id': item.semestre_id,
          'tipo': item.tipo,
          'nombres': item.nombres,
          'apellidos': item.apellidos,
          'pais': item.pais,
          'modalidad': item.modalidad,
          'main': item.main
        };
        this.form.reset();
        this.form.clear();
        this.form.fill(dataToFill);
        $('#modal').modal({ show: true });
        $('#modal').on('shown.bs.modal', function() { $('#tipo').focus() });
      },
      create() {
        this.isLoading = true;
        this.form.post('/api/movilidad').then(response => {
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
        this.form.put('/api/movilidad/' + this.form.id).then(response => {
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
            axios.post('/api/movilidad/alta-baja/0/' + id).then(response => {
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
            axios.post('/api/movilidad/alta-baja/1/' + id).then(response => {
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
            this.form.delete('/api/movilidad/' + id).then(response => {
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
      //
      getFileAddDocumento(event) {
        let files = event.target.files;
        if(!files.length) {
          this.form.documento = null;
        }else {
          this.form.documento = event.target.files[0];
        }
      },
      //
      // Documentos
      openModalAddDocumento: function (item) {
        this.form.id = item.id;
        this.form.documento = null;
        this.descripcionAddDocumento = '';
        let path = document.getElementById('fileAddDocumento');
        path.value = '';
        $('#modalAddDocumento').modal({ show: true });
        $('#modalAddDocumento').on('shown.bs.modal', function() { $('#descripcionAddDocumento').focus() });
      },
      addDocumento: function(id) {
        if(this.descripcionAddDocumento == null || this.descripcionAddDocumento == '') {
          toastr.error('¡Falta ingresar el nombre o descripción del documento!', '¡Error!');
          return;
        }
        if(this.form.documento == null) {
          toastr.error('¡No ha seleccionado ningun documento!', '¡Error!');
          return;
        }
        this.isLoading = true;
        let url = '/api/movilidad/add-documento';
        let data = new FormData();
        data.append('descripcion', this.descripcionAddDocumento);
        data.append('documento', this.form.documento);
        data.append('id', id);
        const config = {headers: { 'Content-Type': 'multipart/form-data'}};
        axios.post(url,data,config).then(response => {
          if(response.data.result) {
            Fire.$emit('transaction');
            $('#modalAddDocumento').modal('hide');
            toastr.success(response.data.message, '¡Completado!');
          }else {
            toastr.error(response.data.message, '¡Error!');
          }
          this.isLoading = false;
        }).catch(() => {
          if(error.response.status == 422) {
            toastr.error('Por favor verifique los campos obligatorios antes de guardar', '¡Error!');
          }else {
            toastr.error('Hubo un error inesperado, recargue la página e intente nuevamente', '¡Error!');
          }
          this.isLoading = false;
        })
      },
      deleteDocumento: function(item, movilidad) {
        Swal.fire({
          title: '¿Desea eliminar el siguiente documento del Movilidad?',
          icon: 'warning',
          html: '<p class="d-block" style="font-weight: bold">' + item.name + '</p><p class="d-block">¡Esta acción no podrá revertirse!</p>',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, Eliminar',
          cancelButtonText: 'No, Cancelar'
        }).then((result) => {
          if (result.value) {
            let url = '/api/movilidad/delete-documento';
            let data = new FormData();
            data.append('file_id', item.id);
            data.append('movilidad_id', movilidad.id);
            axios.post(url, data).then(response => {
              if(response.data.result) {
                Fire.$emit('transaction');
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
      // End of Documentos
      //
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
