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
        <li class="breadcrumb-item active" aria-current="page">Publicaciones</li>
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
              <button type="button" class="btn btn-success ml-1" @click.prevent="openModalCreate()"><i class="fas fa-fw fa-plus-circle"></i>&nbsp;Registrar Publicación</button>
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
                <th>Título</th>
                <th>Descripción</th>
                <th>Imagen</th>
                <th>Archivo</th>
                <th>Prioridad</th>
                <th>Activo</th>
                <th style="min-width: 140px">Acción</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item, key in items">
                <td v-text="key + pagination.from"></td>
                <td>
		  <span v-if="item.tipo_publicacion">{{ item.tipo_publicacion.nombre }}</span>
		  <span v-else>No disponible</span>
		</td>
                <td v-text="item.titulo"></td>
                <td v-text="truncateText(item.descripcion, 100)"></td>
                <td>
                  <a :href="getItemImage(item.image)" class="fancybox" data-fancybox="Publicación">
                    <img :src="getItemImage(item.image)" width="60px" height="60px" alt="Imagen">
                  </a>
                </td>
                <td>
		  <span v-if="item.file">
		    <a :href="getItemFile(item.file)" v-text="item.file.name" target="_blank"></a>
		  </span>
		  <span v-else>No disponible</span>
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
                  <span v-if="editMode"><i class='fas fa-fw fa-edit'></i>&nbsp;Editar Publicación</span>
                  <span v-else><i class='fas fa-fw fa-plus-circle'></i>&nbsp;Registrar Publicación</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-row">
                  <div class="form-group col-md-8">
                    <label>Tipo de Publicación&nbsp;<span class="text-danger">*</span></label>
                    <select v-model="form.tipo_publicacion_id" name="tipo_publicacion_id"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('tipo_publicacion_id') }">
                      <option value="" disabled>Seleccione el Tipo de Publicación...</option>
                      <option v-for="item in tipos_publicacion" :value="item.id" v-text="item.nombre"></option>
                    </select>
                    <has-error :form="form" field="tipo_publicacion_id"></has-error>
                    <!-- udpate -->
                    <small v-show="errors.tipo_publicacion_id" v-for="error in errors.tipo_publicacion_id" class="text-danger font-weight-bold" v-text="error + '. '"></small>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Prioridad&nbsp;<span class="text-danger">*</span></label>
                    <select v-model="form.main" name="main"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('main') }">
                      <option value="0">No</option>
                      <option value="1">Si</option>
                    </select>
                    <has-error :form="form" field="main"></has-error>
                    <!-- udpate -->
                    <small v-show="errors.main" v-for="error in errors.main" class="text-danger font-weight-bold" v-text="error + '. '"></small>
                  </div>
                </div>
                <div class="form-group">
                  <label>Título&nbsp;<span class="text-danger">*</span></label>
                  <input v-model="form.titulo" type="text" name="titulo" id="titulo" 
                  class="form-control" :class="{ 'is-invalid': form.errors.has('titulo') }"
                  placeholder="Ingrese el título">
                  <has-error :form="form" field="titulo"></has-error>
                    <!-- udpate -->
                  <small v-show="errors.titulo" v-for="error in errors.titulo" class="text-danger font-weight-bold" v-text="error + '. '"></small>
                </div>
                <div class="form-group">
                  <label>Descripción</label>
                  <textarea v-model="form.descripcion" rows="5" name="descripcion" id="descripcion" 
                  class="form-control" :class="{ 'is-invalid': form.errors.has('descripcion') }"
                  placeholder="Ingrese la Descripción"></textarea>
                  <has-error :form="form" field="descripcion"></has-error>
                    <!-- udpate -->
                  <small v-show="errors.descripcion" v-for="error in errors.descripcion" class="text-danger font-weight-bold" v-text="error + '. '"></small>
                </div>
                <div class="form-group">
                  <label for="file" class="font-weight-bold">Archivo (PDF)&nbsp;<span class="text-danger">*</span></label>
                  <input type="file" id="file" @change="getFile" accept="
                  application/pdf"
                  class="form-control" :class="{'is-invalid': form.errors.has('file')}">
                  <has-error :form="form" field="file"></has-error>
                    <!-- udpate -->
                  <small v-show="errors.file" v-for="error in errors.file" class="text-danger font-weight-bold" v-text="error + '. '"></small>
                </div>
                <div class="form-group">
                  <label for="image" class="font-weight-bold">Imagen (jpg, jpeg, png)&nbsp;<span class="text-danger">*</span></label>
                  <input type="file" id="image" accept="image/jpg,image/jpeg,image/png" @change="getImage"
                  class="form-control" :class="{'is-invalid': form.errors.has('image')}">
                  <div class="text-center" v-show="showImagePreview">
                    <img src="" class="img-fluid img-thumbnail mt-1" id="imagePreview" width="200px" alt="Imagen seleccionada">
                  </div>
                  <has-error :form="form" field="image"></has-error>
                    <!-- udpate -->
                  <small v-show="errors.image" v-for="error in errors.image" class="text-danger font-weight-bold" v-text="error + '. '"></small>
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

  export default {
    data() {
      return {
        // loader
        loader: true, 
        isLoading: false,
        fullPage: true,
        //
        editMode: false,
        showImagePreview: false,
        items: {},
        tipos_publicacion: {},
        errors: {},
        form: new Form({
          'id': '',
          'tipo_publicacion_id': '',
          'titulo': '',
          'descripcion': '',
          'main': 0,
          'image': '',
          'file': '',
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
        axios.get('/api/publicacion?page=' + page + '&search=' + this.search).then(response => {
          this.items = response.data.items.data;
          this.pagination = response.data.pagination;
          this.tipos_publicacion = response.data.tipos_publicacion;
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
      truncateText: function(text, length) {
        if(text.length > length)
          return text.substring(0, length) + '...';
        else
          return text;
      },
      getFile(event) {
        let files = event.target.files;
        if(!files.length) {
          this.form.file = null;
        }else {
          this.form.file = event.target.files[0];
        }
      },
      getItemFile(file) {
        let filePath = null;
        if(file != null && file != '') {
          filePath = "/archivos/documentos/publicaciones/" + file.path;
        }else {
          filePath = '';
        }
        return filePath;
      },
      getItemImage(image) {
        let imagePath = null;
        if(image != null && image != '') {
          imagePath = "/archivos/imagenes/publicaciones/" + image.path;
        }else {
           imagePath = '';
        }
        return imagePath;
      },
      clearFilePath() {
        this.showImagePreview = false;
        let image = document.getElementById('image');
        image.value = '';
        let file = document.getElementById('file');
        file.value = '';
      },
      fileOnLoad(event) {
        let imagePreview = document.getElementById('imagePreview'),
          result = event.target.result;
        imagePreview.setAttribute('src', result);
      },
      addImage(event) {
        let imagePreview = document.getElementById('imagePreview'),
          image = document.getElementById('image'),
          file = event.target.files[0],
          imageType = /image.*/;
        if(file != null) {
          if (!file.type.match(imageType)) {
            this.showImagePreview = false
            toastr.error('Extensiones permitidas: png, jpg, jpeg, PNG, JPG, JPEG', '¡Seleccione una imagen válida!');
            image.value = '';
            this.form.image = '';
            return;
          }
          this.showImagePreview = true;
          let reader = new FileReader();
          reader.onload = this.fileOnLoad;
          reader.readAsDataURL(file);
        }
      },
      getImage(event) {
        if(!event.target.files.length) {
          this.form.image = '';
          this.showImagePreview = false;
        }else {
          this.form.image = event.target.files[0];
          this.addImage(event);
        }
      },
      openModalCreate() {
        this.editMode = false;
        this.form.reset();
        this.form.clear();
        this.clearFilePath();
        this.errors = {};
        $('#modal').modal({ show: true });
        $('#modal').on('shown.bs.modal', function() { $('#tipo_publicacion_id').focus() });
      },
      openModalUpdate(item) {
        this.editMode = true;
        let dataToFill = {
          'id': item.id,
          'tipo_publicacion_id': item.tipo_publicacion_id,
          'titulo': item.titulo,
          'descripcion': item.descripcion,
          'main': item.main,
          'image': '',
          'file': ''
        };
        this.form.reset();
        this.form.clear();
        this.clearFilePath();
        this.errors = {};
        this.form.fill(dataToFill);
        $('#modal').modal({ show: true });
        $('#modal').on('shown.bs.modal', function() { $('#tipo_publicacion_id').focus() });
      },
      create() {
        this.isLoading = true;
        this.form.submit('post', '/api/publicacion', {
          transformRequest: [function (data, headers) {
            return objectToFormData(data);
          }],
          onUploadProgress: e => {
            this.isLoading = true;
          }
        }).then(response => {
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
        let url = '/api/publicacion/' + this.form.id;
        let data = new FormData();
        data.append('id', this.form.id);
        data.append('tipo_publicacion_id', this.form.tipo_publicacion_id);
        data.append('titulo', this.form.titulo);
        data.append('descripcion', this.form.descripcion);
        data.append('main', this.form.main);
        data.append('file', this.form.file);
        data.append('image', this.form.image);
        data.append('_method', 'PUT');
        const config = {headers: {'Content-Type': 'multipart/form-data'}};
        axios.post(url, data, config).then(response => {
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
            this.errors = error.response.data.errors;
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
            axios.post('/api/publicacion/alta-baja/0/' + id).then(response => {
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
            axios.post('/api/publicacion/alta-baja/1/' + id).then(response => {
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
            this.form.delete('/api/publicacion/' + id).then(response => {
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
        return this.pagination.current_page
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
