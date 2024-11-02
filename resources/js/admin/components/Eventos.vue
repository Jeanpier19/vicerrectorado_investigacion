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
        <li class="breadcrumb-item active" aria-current="page">Eventos</li>
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
              <button type="button" class="btn btn-success ml-1" @click.prevent="openModalCreate()"><i class="fas fa-fw fa-plus-circle"></i>&nbsp;Registrar Evento</button>
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
                <th>Título</th>
                <th>Etiquetas</th>
                <th>Fecha</th>
                <th>Imágenes</th>
                <th>Docs.Anexos</th>
                <th>Prioridad</th>
                <th>Activo</th>
                <th style="min-width: 140px">Acción</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item, key in items">
                <td v-text="key + pagination.from"></td>
                <td v-text="item.titulo"></td>
                <td>
                  <ul class="list-group">
                    <li class="list-group-item" v-for="etiqueta in item.etiquetas" v-text="etiqueta.nombre"></li>
                  </ul>
                </td>
                <td>{{ item.fecha | myDate }}</td>
                <td>
                  <ul class="list-unstyled">
                    <li class="text-center mb-2">
                      <button type="button" class="btn btn-success btn-sm" @click.prevent="openModalAddGaleria(item)">
                        <i class="fas fa-fw fa-plus"></i>
                      </button>
                    </li>
                    <li v-for="galeria in item.images" class="text-center mb-2">
                      <a :href="getItemImage(galeria)" class="fancybox" :data-fancybox="'Evento' + item.id" :data-caption="item.titulo">
                        <img :src="getItemImage(galeria)" alt="Imagen" class="img mx-auto" width="80px" height="80px">
                      </a>
                      <div class="text-center mt-1">
                        <button type="button" class="btn btn-outline-danger btn-sm" @click.prevent="deleteGaleria(galeria, item)">
                          <i class="fas fa-fw fa-times"></i>
                        </button>
                      </div>
                    </li>
                  </ul>
                </td>
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
                  <span v-if="editMode"><i class='fas fa-fw fa-edit'></i>&nbsp;Editar Evento</span>
                  <span v-else><i class='fas fa-fw fa-plus-circle'></i>&nbsp;Registrar Evento</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-row">
                  <div class="form-group col-md-5">
                    <label>Etiquetas</label>
                    <v-select
                      :class="{ 'is-invalid': form.errors.has('etiquetas') }"
                      placeholder="Buscar Etiquetas..."
                      v-model="form.etiquetas"
                      multiple
                      label="nombre"
                      :options="etiquetas_options"
                      :reduce="etiqueta => etiqueta.code"
                    ><span slot="no-options">Lo siento, no hay registros coincidentes.</span></v-select>
                    <has-error :form="form" field="etiquetas"></has-error>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Fecha&nbsp;<span class="text-danger">*</span></label>
                    <input v-model="form.fecha" type="date" name="fecha" id="fecha" 
                    class="form-control" :class="{ 'is-invalid': form.errors.has('fecha') }">
                    <has-error :form="form" field="fecha"></has-error>
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
                <div class="form-group">
                  <label>Título&nbsp;<span class="text-danger">*</span></label>
                  <textarea v-model="form.titulo" type="text" name="titulo" rows="4" 
                  class="form-control" :class="{ 'is-invalid': form.errors.has('titulo') }"
                  placeholder="Ingrese el Título"></textarea>
                  <has-error :form="form" field="titulo"></has-error>
                </div>
                <div class="form-group">
                  <label>Descripción</label>
                  <ckeditor :editor="editor" v-model="form.descripcion" :config="editorConfig" :class="{ 'is-invalid': form.errors.has('descripcion') }"></ckeditor>
                  <has-error :form="form" field="descripcion"></has-error>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Lugar&nbsp;<span class="text-danger">*</span></label>
                    <input v-model="form.lugar" type="text" name="lugar" id="lugar" 
                    class="form-control" :class="{ 'is-invalid': form.errors.has('lugar') }" placeholder="Ingrese el Lugar">
                    <has-error :form="form" field="lugar"></has-error>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Dirigido a&nbsp;<span class="text-danger">*</span></label>
                    <input v-model="form.dirigido" type="text" name="dirigido" id="dirigido" 
                    class="form-control" :class="{ 'is-invalid': form.errors.has('dirigido') }" placeholder="Ingrese el Público Dirigido">
                    <has-error :form="form" field="dirigido"></has-error>
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
      <!-- Modal Galería -->
      <div class="modal fade" id="modalAddGaleria" tabindex="-1" role="dialog" aria-labelledby="createModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <form method="post" @submit.prevent="addGaleria(form.id)">
              <div class="modal-header">
                <h5 class='modal-title font-weight-bold'><i class='fas fa-fw fa-plus-circle'></i> Añadir Imágenes al Evento: {{ form.titulo }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="filesAddGaleria" class="font-weight-bold">Imagen(es)&nbsp;<span class="text-danger">*</span></label>
                  <input type="file" id="filesAddGaleria" class="form-control" @change="getFilesAddGaleria" accept=".png, .jpg, .jpeg, .PNG, .JPG, .JPEG" multiple>
                </div>
                <div class="text-center" v-show="showImagePreviewAddGaleria">
                  <ul id="imagePreviewAddGaleria" class="list-unstyled">
                  </ul>
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
      <!-- Modal Galería -->
      <!-- Modal Documentos -->
      <div class="modal fade" id="modalAddDocumento" tabindex="-1" role="dialog" aria-labelledby="createModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <form method="post" @submit.prevent="addDocumento(form.id)">
              <div class="modal-header">
                <h5 class='modal-title font-weight-bold'><i class='fas fa-fw fa-plus-circle'></i> Añadir un Documento Anexo al Evento: {{ form.titulo }}</h5>
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
        showImagePreviewAddGaleria: false,
        descripcionAddDocumento: '',
        items: {},
        etiquetas: {},
        etiquetas_options: [],
        form: new Form({
          'id': '',
          'etiquetas': [],
          'titulo': '',
          'descripcion': '',
          'fecha': '',
          'lugar': '',
          'dirigido': '',
          'main': '0',
          'images': [],
          'documento': '',
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
        axios.get('/api/evento?page=' + page + '&search=' + this.search).then(response => {
          this.items = response.data.items.data;
          this.pagination = response.data.pagination;
          this.etiquetas = response.data.etiquetas;
          this.etiquetas_options = [];
          for (var i = 0; i < this.etiquetas.length; i++) {
            this.etiquetas_options.push({
              nombre: this.etiquetas[i].nombre,
              code: this.etiquetas[i].id  
            });
          }
          this.loader = false;
        }).catch(() => {
          toastr.error('No se pudo obtener los registros, recargue la página e intente nuevamente', '¡Error!');
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
      getItemImage(file) {
        let filePath = null;
        if(file != null && file != '') {
          filePath = "/archivos/imagenes/eventos/" + file.path;
        }else{
          filePath = '';
        }
        return filePath;
      },
      getItemDocument(file) {
        let filePath = null;
        if(file != null && file != '') {
          filePath = "/archivos/documentos/eventos/" + file.path;
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
        $('#modal').modal({ focus:false, show: true });
        $('#modal').on('shown.bs.modal', function() { $('#etiquetas').focus() });
      },
      openModalUpdate(item) {
        this.editMode = true;
        const aux = [];
        for (var i = 0; i < item.etiquetas.length; i++) {
          aux[i] = item.etiquetas[i].id;
        }
        let dataToFill = {
          'id': item.id,
          'etiquetas': aux,
          'titulo': item.titulo,
          'descripcion': item.descripcion,
          'fecha': item.fecha,
          'lugar': item.lugar,
          'dirigido': item.dirigido,
          'main': item.main,
        };
        this.form.reset();
        this.form.clear();
        this.form.fill(dataToFill);
        $('#modal').modal({ focus:false, show: true });
        $('#modal').on('shown.bs.modal', function() { $('#etiquetas').focus() });
      },
      create() {
        this.isLoading = true;
        this.form.post('/api/evento').then(response => {
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
      update(id) {
        this.isLoading = true;
        this.form.put('/api/evento/' + this.form.id).then(response => {
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
            axios.post('/api/evento/alta-baja/0/' + id).then(response => {
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
            axios.post('/api/evento/alta-baja/1/' + id).then(response => {
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
            this.form.delete('/api/evento/' + id).then(response => {
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
      fileOnLoadAddGaleria(event) {
        let result = event.target.result,
          li = document.createElement('li');
        li.innerHTML = "<img src=\"" + result + "\" class='img img-responsive img-thumbnail' width='300px' style='margin-bottom: 15px'>";
        document.getElementById("imagePreviewAddGaleria").appendChild(li); 
      },
      addImageAddGaleria(event) {
        let imagePreview = document.getElementById('imagePreviewAddGaleria'),
          filesAddGaleria = document.getElementById('filesAddGaleria'),
          files = event.target.files,
          imageType = /image.*/;
        for(let i = 0; i < files.length; i++) {
          if(files[i] != null) {
            if (!files[i].type.match(imageType)) {
              this.showImagePreviewAddGaleria = false;
              toastr.error('Extensiones permitidas: png, jpg, jpeg, PNG, JPG, JPEG', '¡Seleccione imágenes válidas!');
              filesAddGaleria.value = '';
              this.form.images = [];
              return;
            }
            this.showImagePreviewAddGaleria = true;
            let reader = new FileReader();
            reader.onload = this.fileOnLoadAddGaleria;
            reader.readAsDataURL(files[i]);
          }
        }
      },
      getFilesAddGaleria(event) {
        document.getElementById("imagePreviewAddGaleria").innerHTML = "";
        let files = event.target.files;
        if(!files.length) {
          this.form.images = [];
          this.showImagePreviewAddGaleria = false;
        }else {
          this.form.images = [];
          for (let i = files.length - 1; i >= 0; i--) {
            this.form.images.push(files[i]);
          }
          this.addImageAddGaleria(event);
        }
      },
      //
      // Galeria
      openModalAddGaleria: function (item) {
        this.form.id = item.id;
        this.form.titulo = item.titulo;
        this.form.images = null;
        let path = document.getElementById('filesAddGaleria');
        path.value = '';
        this.showImagePreviewAddGaleria = false;
        document.getElementById("imagePreviewAddGaleria").innerHTML = "";
        $('#modalAddGaleria').modal({ show: true });
        $('#modalAddGaleria').on('shown.bs.modal', function() { $('#filesAddGaleria').focus() });
      },
      addGaleria: function(id) {
        if(this.form.images == null) {
          toastr.error('¡No ha seleccionado ninguna imagen!', '¡Error!');
          return;
        }
        this.isLoading = true;
        let url = '/api/evento/add-galeria';
        let data = new FormData();
        for (var i = this.form.images.length - 1; i >= 0; i--) {
          data.append('images[]', this.form.images[i]);
        }
        data.append('id', id);
        const config = {headers: { 'Content-Type': 'multipart/form-data'}};
        axios.post(url,data,config).then(response => {
          if(response.data.result) {
            Fire.$emit('transaction');
            $('#modalAddGaleria').modal('hide');
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
        });
      },
      deleteGaleria: function(item, evento) {
        let img = "/archivos/imagenes/eventos/" + item.path;
        Swal.fire({
          title: '¿Desea eliminar la siguiente imagen del Evento?',
          icon: 'warning',
          html: '<p class="d-block">¡Esta acción no podrá revertirse!</p><img src="'+ img +'" class="img-fluid">',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, Eliminar',
          cancelButtonText: 'No, Cancelar'
        }).then((result) => {
          if(result.value) {
            this.isLoading = true;
            let url = '/api/evento/delete-galeria';
            let data = new FormData();
            data.append('image_id', item.id);
            data.append('evento_id', evento.id);
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
      // End of Galeria
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
        let url = '/api/evento/add-documento';
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
      deleteDocumento: function(item, evento) {
        Swal.fire({
          title: '¿Desea eliminar el siguiente documento del Evento?',
          icon: 'warning',
          html: '<p class="d-block" style="font-weight: bold">' + item.name + '</p><p class="d-block">¡Esta acción no podrá revertirse!</p>',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, Eliminar',
          cancelButtonText: 'No, Cancelar'
        }).then((result) => {
          if (result.value) {
            let url = '/api/evento/delete-documento';
            let data = new FormData();
            data.append('file_id', item.id);
            data.append('evento_id', evento.id);
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
      });
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
