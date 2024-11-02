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
        <li class="breadcrumb-item active" aria-current="page">Convenios</li>
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
              <button type="button" class="btn btn-success ml-1" @click.prevent="openModalCreate()"><i class="fas fa-fw fa-plus-circle"></i>&nbsp;Registrar Convenio</button>
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
                <th>Institución</th>
                <th>Ámbito</th>
                <th>Inicio</th>
                <th>Finalización</th>
                <th>Estado</th>
                <th>Docs.Anexos</th>
                <th>Prioridad</th>
                <th>Activo</th>
                <th style="min-width: 140px">Acción</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item, key in items">
                <td v-text="key + pagination.from"></td>
                <td v-text="item.tipo == 1 ? 'Específico' : 'Marco'"></td>
                <td v-text="item.institucion.nombre"></td>
                <td v-text="item.ambito"></td>
                <td>{{ item.inicio | myDate }}</td>
                <td v-if="item.finalizacion">{{ item.finalizacion | myDate }}</td>
                <td v-else>Indefinido</td>
                <td v-text="item.estado"></td>
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
                  <span v-if="editMode"><i class='fas fa-fw fa-edit'></i>&nbsp;Editar Convenio</span>
                  <span v-else><i class='fas fa-fw fa-plus-circle'></i>&nbsp;Registrar Convenio</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label>Tipo de Convenio&nbsp;<span class="text-danger">*</span></label>
                    <select v-model="form.tipo" name="tipo"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('tipo') }">
                      <option value="" disabled>Seleccione el Tipo de Convenio...</option>
                      <option value="1">Específico</option>
                      <option value="2">Marco</option>
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
                  <div class="form-group col-md-6" v-if="form.tipo == '1'">
                    <label>Facultad&nbsp;<span class="text-danger">*</span></label>
                    <select v-model="form.facultad_id" type="text" name="facultad_id" id="facultad_id"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('facultad_id') }">
                      <option value="" disabled selected>Selecione la Facultad...</option>
                      <option v-for="item in facultades" :value="item.id" v-text="item.nombre"></option>
                    </select>
                    <has-error :form="form" field="facultad_id"></has-error>
                  </div>
                  <div class="form-group col-md-6" v-if="form.tipo == '1'">
                    <label>Tipo de Convenio Específico&nbsp;<span class="text-danger">*</span></label>
                    <select v-model="form.tipo_convenio_especifico_id" type="text" name="tipo_convenio_especifico_id" id="tipo_convenio_especifico_id"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('tipo_convenio_especifico_id') }">
                      <option value="" disabled selected>Selecione el Tipo de Convenio Específico...</option>
                      <option v-for="item in tipos_convenio_especifico" :value="item.id" v-text="item.nombre"></option>
                    </select>
                    <has-error :form="form" field="tipo_convenio_especifico_id"></has-error>
                  </div>
                </div>
                <div class="form-group">
                  <label>Resolución&nbsp;<span class="text-danger">*</span></label>
                  <input v-model="form.resolucion" type="text" name="resolucion" id="resolucion" 
                  class="form-control" :class="{ 'is-invalid': form.errors.has('resolucion') }"
                  placeholder="Ingrese la Resolución">
                  <has-error :form="form" field="resolucion"></has-error>
                </div>
                <div class="form-group">
                  <label>Palabras Clave</label>
                  <textarea v-model="form.palabras_clave" type="text" name="palabras_clave" rows="4" 
                  class="form-control" :class="{ 'is-invalid': form.errors.has('palabras_clave') }"
                  placeholder="Ingrese las Palabras Clave"></textarea>
                  <has-error :form="form" field="palabras_clave"></has-error>
                </div>
                <div class="form-group">
                  <label>Objetivo&nbsp;<span class="text-danger">*</span></label>
                  <textarea v-model="form.objetivo" type="text" name="objetivo" rows="4" 
                  class="form-control" :class="{ 'is-invalid': form.errors.has('objetivo') }"
                  placeholder="Ingrese el Objetivo"></textarea>
                  <has-error :form="form" field="objetivo"></has-error>
                </div>
                <div class="form-group">
                  <label>Obligaciones&nbsp;<span class="text-danger">*</span></label>
                  <textarea v-model="form.obligaciones" type="text" name="obligaciones" rows="4" 
                  class="form-control" :class="{ 'is-invalid': form.errors.has('obligaciones') }"
                  placeholder="Ingrese las Obligaciones"></textarea>
                  <has-error :form="form" field="obligaciones"></has-error>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label>Teléfono</label>
                    <input v-model="form.telefono" type="text" name="telefono" id="telefono" 
                    class="form-control" :class="{ 'is-invalid': form.errors.has('telefono') }"
                    placeholder="Ingrese el Teléfono">
                    <has-error :form="form" field="telefono"></has-error>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Ámbito&nbsp;<span class="text-danger">*</span></label>
                    <select v-model="form.ambito" name="ambito"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('ambito') }"
                    @change="form.ambito == 'Nacional' ? form.pais = 'Perú' : form.pais = ''">
                      <option value="" disabled>Seleccione el Ámbito...</option>
                      <option value="Nacional">Nacional</option>
                      <option value="Internacional">Internacional</option>
                    </select>
                    <has-error :form="form" field="ambito"></has-error>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Pais&nbsp;<span class="text-danger">*</span></label>
                    <input v-model="form.pais" type="text" name="pais" id="pais" 
                    class="form-control" :class="{ 'is-invalid': form.errors.has('pais') }"
                    placeholder="Ingrese el País">
                    <has-error :form="form" field="pais"></has-error>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label>Inicio&nbsp;<span class="text-danger">*</span></label>
                    <input v-model="form.inicio" type="date" name="inicio" id="inicio" 
                    class="form-control" :class="{ 'is-invalid': form.errors.has('inicio') }">
                    <has-error :form="form" field="inicio"></has-error>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Finalización</label>
                    <input v-model="form.finalizacion" type="date" name="finalizacion" id="finalizacion" 
                    class="form-control" :class="{ 'is-invalid': form.errors.has('finalizacion') }">
                    <has-error :form="form" field="finalizacion"></has-error>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Estado&nbsp;<span class="text-danger">*</span></label>
                    <select v-model="form.estado" name="estado"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('estado') }">
                      <option value="" disabled>Seleccione el Estado...</option>
                      <option value="Histórico">Histórico</option>
                      <option value="Vigente">Vigente</option>
                      <option value="Finalizado">Finalizado</option>
                    </select>
                    <has-error :form="form" field="estado"></has-error>
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
                <h5 class='modal-title font-weight-bold'><i class='fas fa-fw fa-plus-circle'></i> Añadir un Documento Anexo al Convenio</h5>
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
        tipos_convenio_especifico: {},
        form: new Form({
          'id': '',
          'tipo': '',
          'institucion_id': '',
          'facultad_id': '',
          'tipo_convenio_especifico_id': '',
          'resolucion': '',
          'palabras_clave': '',
          'objetivo': '',
          'obligaciones': '',
          'telefono': '',
          'ambito': '',
          'pais': '',
          'inicio': '',
          'finalizacion': '',
          'estado': '',
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
        axios.get('/api/convenio?page=' + page + '&search=' + this.search).then(response => {
          this.items = response.data.items.data;
          this.pagination = response.data.pagination;
          this.instituciones = response.data.instituciones;
          this.facultades = response.data.facultades;
          this.tipos_convenio_especifico = response.data.tipos_convenio_especifico;
          this.loader = false;
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
          filePath = "/archivos/documentos/convenios/" + file.path;
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
          'tipo': item.tipo,
          'institucion_id': item.institucion_id,
          'facultad_id': item.facultad_id,
          'tipo_convenio_especifico_id': item.tipo_convenio_especifico_id,
          'resolucion': item.resolucion,
          'palabras_clave': item.palabras_clave,
          'objetivo': item.objetivo,
          'obligaciones': item.obligaciones,
          'telefono': item.telefono,
          'ambito': item.ambito,
          'pais': item.pais,
          'inicio': item.inicio,
          'finalizacion': item.finalizacion,
          'estado': item.estado,
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
        this.form.post('/api/convenio').then(response => {
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
        this.form.put('/api/convenio/' + this.form.id).then(response => {
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
            axios.post('/api/convenio/alta-baja/0/' + id).then(response => {
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
            axios.post('/api/convenio/alta-baja/1/' + id).then(response => {
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
            this.form.delete('/api/convenio/' + id).then(response => {
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
        let url = '/api/convenio/add-documento';
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
      deleteDocumento: function(item, convenio) {
        Swal.fire({
          title: '¿Desea eliminar el siguiente documento del Convenio?',
          icon: 'warning',
          html: '<p class="d-block" style="font-weight: bold">' + item.name + '</p><p class="d-block">¡Esta acción no podrá revertirse!</p>',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, Eliminar',
          cancelButtonText: 'No, Cancelar'
        }).then((result) => {
          if (result.value) {
            let url = '/api/convenio/delete-documento';
            let data = new FormData();
            data.append('file_id', item.id);
            data.append('convenio_id', convenio.id);
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
