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
        <li class="breadcrumb-item active" aria-current="page">Investigadores</li>
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
              <button type="button" class="btn btn-success ml-1" @click.prevent="openModalCreate()">
                <i class="fas fa-fw fa-plus-circle"></i>
                Registrar Investigador
              </button>
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
                <th>DNI</th>
                <th>Nombre</th>
                <th>Departamento</th>
                <th>Grado</th>
                <th>Categoría</th>
                <th>CTI</th>
                <th>ORCID</th>
                <th>Foto</th>
                <th>Prioridad</th>
                <th>Activo</th>
                <th style="min-width: 180px">Acción</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item, key in items">
                <td v-text="key + pagination.from"></td>
                <td v-text="item.user.persona.dni"></td>
                <td v-text="item.user.persona.nombres + ' ' + item.user.persona.apellidos"></td>
                <td v-text="item.departamento.nombre + ' ' + item.departamento.facultad.abreviatura"></td>
                <td v-text="item.grado"></td>
                <td v-if="item.categoria==1" v-text="'Auxiliar'"></td>
                <td v-if="item.categoria==2" v-text="'Asociado'"></td>
                <td v-if="item.categoria==3" v-text="'Principal'"></td>
                <td>
                  <a v-if="item.cti" :href="item.cti" target="_blank">Enlace</a>
                  <span v-else>---</span>
                </td>
                <td>
                  <a v-if="item.orcid" :href="'https://orcid.org/' + item.orcid" target="_blank">Enlace</a>
                  <span v-else>---</span>
                </td>
                <td>
                  <a :href="getItemImage(item.user)" class="fancybox" data-fancybox="Investigador"><img :src="getItemImage(item.user)" width="60px" height="60px" :alt="item.user.persona.apellidos + ' ' + item.user.persona.nombres"></a>
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
                  <span v-if="editMode"><i class='fas fa-fw fa-edit'></i>&nbsp;Editar Investigador</span>
                  <span v-else><i class='fas fa-fw fa-plus-circle'></i>&nbsp;Registrar Investigador</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-row">
                  <div class="form-group col-md-8" v-if="!editMode">
                    <label>Usuario&nbsp;<span class="text-danger">*</span></label>
                    <v-select
                      :class="{ 'is-invalid': form.errors.has('user_id') }"
                      placeholder="Buscar por Usuario/DNI/Nombres/Apellidos..."
                      v-model="form.user_id"
                      label="user"
                      :options="users"
                      :reduce="user => user.id"
                      @search="searchUser"
                    ><span slot="no-options">Lo siento, no hay registros coincidentes.</span></v-select>
                    <has-error :form="form" field="user_id"></has-error>
                    <!-- udpate -->
                    <small v-show="errors.user_id" v-for="error in errors.user_id" class="text-danger font-weight-bold" v-text="error + '. '"></small>
                  </div>
                  <div class="form-group col-md-8" v-if="editMode">
                    <label>Usuario&nbsp;<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" disabled :value="fillUser">
                  </div>
                  <div class="form-group col-md-4">
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
                  <div class="form-group col-md-4">
                    <label>Fecha de Inicio (Investigación)</label>
                    <input v-model="form.fecha_inicio" type="date" name="fecha_inicio" id="fecha_inicio" 
                    class="form-control" :class="{ 'is-invalid': form.errors.has('fecha_inicio') }"
                    placeholder="Ingrese el N° de DNI">
                    <has-error :form="form" field="fecha_inicio"></has-error>
                    <!-- udpate -->
                    <small v-show="errors.fecha_inicio" v-for="error in errors.fecha_inicio" class="text-danger font-weight-bold" v-text="error + '. '"></small>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Grado</label>
                    <input v-model="form.grado" type="text" name="grado" id="grado" 
                    class="form-control" :class="{ 'is-invalid': form.errors.has('grado') }"
                    placeholder="Ingrese el Grado">
                    <has-error :form="form" field="grado"></has-error>
                    <!-- udpate -->
                    <small v-show="errors.grado" v-for="error in errors.grado" class="text-danger font-weight-bold" v-text="error + '. '"></small>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Categoría&nbsp;<span class="text-danger">*</span></label>
                    <select v-model="form.categoria" name="categoria"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('categoria') }">
                      <option value="" disabled>Seleccione la Categoría...</option>
                      <option value="1">Auxiliar</option>
                      <option value="2">Asociado</option>
                      <option value="3">Principal</option>
                    </select>
                    <has-error :form="form" field="categoria"></has-error>
                    <!-- udpate -->
                    <small v-show="errors.categoria" v-for="error in errors.categoria" class="text-danger font-weight-bold" v-text="error + '. '"></small>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>CTI</label>
                    <input v-model="form.cti" type="text" name="cti" id="cti" 
                    class="form-control" :class="{ 'is-invalid': form.errors.has('cti') }"
                    placeholder="Ingrese el link de su CTI">
                    <has-error :form="form" field="cti"></has-error>
                    <!-- udpate -->
                    <small v-show="errors.cti" v-for="error in errors.cti" class="text-danger font-weight-bold" v-text="error + '. '"></small>
                  </div>
                  <div class="form-group col-md-6">
                    <label>ORCID</label>
                    <input v-model="form.orcid" type="text" name="orcid" id="orcid" 
                    class="form-control" :class="{ 'is-invalid': form.errors.has('orcid') }"
                    v-mask="'####-####-####-####'"
                    placeholder="####-####-####-####">
                    <has-error :form="form" field="orcid"></has-error>
                    <!-- udpate -->
                    <small v-show="errors.orcid" v-for="error in errors.orcid" class="text-danger font-weight-bold" v-text="error + '. '"></small>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-5">
                    <label>Facultad&nbsp;<span class="text-danger">*</span></label>
                    <select v-model="form.facultad_id" type="text" name="facultad_id" id="facultad_id"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('facultad_id') }"
                    @change="getDepartamentos(form.facultad_id)">
                      <option value="" disabled>Seleccione la Facultad...</option>
                      <option v-for="item in facultades" :value="item.id">{{ item.nombre }}</option>
                    </select>
                    <has-error :form="form" field="facultad_id"></has-error>
                    <!-- udpate -->
                    <small v-show="errors.facultad_id" v-for="error in errors.facultad_id" class="text-danger font-weight-bold" v-text="error + '. '"></small>
                  </div>
                  <div class="form-group col-md-7">
                    <label>Departamento Académico&nbsp;<span class="text-danger">*</span></label>
                    <select v-model="form.departamento_id" type="text" name="departamento_id" id="departamento_id"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('departamento_id') }">
                      <option value="" disabled>Seleccione el Departamento Académico...</option>
                      <option v-for="item in departamentos" :value="item.id">{{ item.nombre }}</option>
                    </select>
                    <has-error :form="form" field="departamento_id"></has-error>
                    <!-- udpate -->
                    <small v-show="errors.departamento_id" v-for="error in errors.departamento_id" class="text-danger font-weight-bold" v-text="error + '. '"></small>
                  </div>
                </div>
                <div class="form-group">
                  <label for="image" class="font-weight-bold">Foto (jpg, jpeg, png)</label>
                  <input type="file" id="image" accept="image/jpg,image/jpeg,image/png" @change="getImage"
                  class="form-control" :class="{'is-invalid': form.errors.has('image')}" >
                  <div class="text-center" v-show="showImagePreview">
                  <img src="" class="img-fluid img-thumbnail mt-1" id="imagePreview" width="200px" alt="Imagen seleccionada">
                  </div>
                  <has-error :form="form" field="image" class="d-block"></has-error>
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
        errors: {},
        users: [],
        items: {},
        facultades: {},
        departamentos: {},
        fillUser: '',
        form: new Form({
          'id': '',
          'user_id': '',
          'fecha_inicio': '',
          'grado': '',
          'categoria': '',
          'cti': '',
          'orcid': '',
          'facultad_id': '',
          'departamento_id': '',
          'main': 0,
          'image': ''
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
      getFacultades() {
        var url = '/api/get-facultades';
        axios.get(url).then(response => {
          this.facultades = response.data.facultades;
        });
      },
      getDepartamentos() {
        this.departamentos = {};
        this.form.departamento_id = '';
        var url = '/api/get-departamentos?facultad_id=' + this.form.facultad_id;
        axios.get(url).then(response => {
          this.departamentos = response.data.departamentos;
        });
      },
      getItems(page) {
        this.loader = true;
        axios.get('/api/investigador?page=' + page + '&search=' + this.search).then(response => {
          this.items = response.data.items.data;
          this.pagination = response.data.pagination;
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
      getItemImage(item) {
        let imagePath = null;
        if(item.image != null && item.image != '') {
          imagePath = "/archivos/imagenes/usuarios/" + item.image.path;
        }else if(item.persona.genero == 'Masculino') {
            imagePath = "/archivos/imagenes/usuario-masculino.jpg";
        }else {
          imagePath = "/archivos/imagenes/usuario-femenino.jpg";
        }
        return imagePath;
      },
      clearFilePath() {
        this.showImagePreview = false;
        let image = document.getElementById('image');
        image.value = '';
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
            this.showImagePreview = false;
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
        $('#modal').on('shown.bs.modal', function() { $('#user_id').focus() });
      },
      openModalUpdate(item) {
        this.editMode = true;
        this.fillUser = item.user.username + ' - ' + item.user.persona.dni + ' - ' + item.user.persona.nombres + ' ' + item.user.persona.apellidos;
        this.form.facultad_id = item.departamento.facultad_id;
        this.getDepartamentos();
        let dataToFill = {
          'id': item.id,
          'user_id': item.user_id,
          'fecha_inicio': item.fecha_inicio,
          'grado': item.grado,
          'categoria': item.categoria,
          'cti': item.cti,
          'orcid': item.orcid,
          'facultad_id': item.departamento.facultad_id,
          'departamento_id': item.departamento_id,
          'main': item.main,
          'image': ''
        }
        this.form.reset();
        this.form.clear();
        this.clearFilePath();
        this.errors = {};
        this.form.fill(dataToFill);
        $('#modal').modal({ show: true });
        $('#modal').on('shown.bs.modal', function() { $('#user_id').focus() });
      },
      searchUser(search, loading) {
        loading(true);
        let url = "/api/investigador/search/user?search=" + search;
        axios.get(url).then(response => {
          this.users = response.data.users;
          loading(false);
        }).catch(error => {
          toastr.error('Hubo un error inesperado, intente nuevamente', '¡Error!');
          loading(false);
        });
      },
      create() {
        this.isLoading = true;
        this.form.submit('post', '/api/investigador', {
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
        let url = '/api/investigador/' + this.form.id;
        let data = new FormData();
        if (this.form.fecha_inicio == null) {
          this.form.fecha_inicio = '';
        }
        data.append('id', this.form.id);
        data.append('user_id', this.form.user_id);
        data.append('fecha_inicio', this.form.fecha_inicio);
        data.append('grado', this.form.grado);
        data.append('categoria', this.form.categoria);
        data.append('cti', this.form.cti);
        data.append('orcid', this.form.orcid);
        data.append('facultad_id', this.form.facultad_id);
        data.append('departamento_id', this.form.departamento_id);
        data.append('main', this.form.main);
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
            axios.post('/api/investigador/alta-baja/0/' + id).then(response => {
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
            axios.post('/api/investigador/alta-baja/1/' + id).then(response => {
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
            this.form.delete('/api/investigador/' + id).then(response => {
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
      passwordReset: function(id) {
        Swal.fire({
          icon: 'warning',
          title: '¿Estás seguro?',
          text: '¡Se restablecerá la contraseña del usuario!',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, reestablecer',
          cancelButtonText: 'No, cancelar'
        }).then((result) => {
          if(result.value) {
            this.isLoading = true;
            axios.post('/api/investigador/restablecer-password/' + id).then(response => {
              if(response.data.result) {
                Fire.$emit('transaction')
                toastr.success(response.data.message, '¡Completado!');
                Swal.fire({
                  icon: 'success',
                  title: '¡La contraseña fue reestablecida correctamente!',
                  html: `
                  <div class="card">
                    <div class="card-header">
                      <h5 class="m-0">
                        <strong>Guarde las nuevas credenciales</strong>
                      </h5>
                    </div>
                    <div class="card-body">
                      <p class="text-left">
                        <strong>Apellidos y nombres:</strong>
                        ${response.data.name}
                      </p>
                      <p class="text-left">
                        <strong>Investigador:</strong>
                        ${response.data.investigadorname}
                      </p>
                      <p class="text-left">
                        <strong>Nueva contraseña:</strong>
                        ${response.data.new_password}
                      </p>
                    </div>
                  </div>
                  `,
                });
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
      }
    },
    created() {
      this.getFacultades();
      this.getItems(this.thisPage);
      Fire.$on('transaction', () => {
        this.getFacultades();
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
