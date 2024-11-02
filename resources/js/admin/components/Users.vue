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
        <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
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
                Registrar Usuario
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
                <th>Apellidos y Nombres</th>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Foto</th>
                <th>Activo</th>
                <th style="min-width: 180px">Acción</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item, key in items">
                <td v-text="key + pagination.from"></td>
                <td v-text="item.persona.dni"></td>
                <td v-text="item.persona.apellidos + ' ' + item.persona.nombres"></td>
                <td v-text="item.username"></td>
                <td>
                  <ul class="list-group">
                    <li class="list-group-item" v-for="role in item.roles" v-text="role.name"></li>
                  </ul>
                </td>
                <td>
                  <a :href="getItemImage(item)" class="fancybox" data-fancybox="Usuario"><img :src="getItemImage(item)" width="60px" height="60px" :alt="item.persona.apellidos + ' ' + item.persona.nombres"></a>
                </td>
                <td>
                  <span class="badge badge-warning p-2 text-white" v-if="item.status==0">Inactivo</span>
                  <span class="badge badge-success p-2" v-if="item.status==1">Activo</span>
                  <span class="badge badge-danger p-2" v-if="item.status==2">Solicitud</span>
                </td>
                <td>
                  <button type="button" class="btn btn-sm" :class="item.status ? 'btn-dark' : 'btn-success'" @click.prevent="item.status ? disableItem(item.id) : enableItem(item.id)" v-tooltip:top="item.status ? 'Desactivar' : 'Activar'">
                    <i class="fas fa-fw fa-arrow-circle-down" :class="item.status ? 'fa-arrow-circle-down' : 'fa-arrow-circle-up'"></i>
                  </button> 
                  <button type="button" class="btn btn-warning btn-sm text-white" @click.prevent="openModalUpdate(item)" v-tooltip:top="'Editar'">
                  <i class="fas fa-fw fa-edit"></i>
                  </button>
                  <button type="button" class="btn btn-danger btn-sm" @click.prevent="deleteItem(item.id)" v-tooltip:top="'Eliminar'">
                    <i class="fas fa-fw fa-trash"></i>
                  </button>
                  <button type="button" class="btn btn-primary btn-sm" @click.prevent="passwordReset(item.id)" v-tooltip:top="'Restablecer la contraseña'">
                    <i class="fas fa-fw fa-key"></i>
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
                <span v-if="editMode"><i class='fas fa-fw fa-edit'></i>&nbsp;Editar Usuario</span>
                <span v-else><i class='fas fa-fw fa-plus-circle'></i>&nbsp;Registrar Usuario</span>
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label>DNI&nbsp;<span class="text-danger">*</span></label>
                  <input v-model="form.dni" type="text" name="dni" id="dni" 
                  class="form-control" :class="{ 'is-invalid': form.errors.has('dni') }"
                  placeholder="Ingrese el N° de DNI">
                  <has-error :form="form" field="dni"></has-error>
                  <!-- udpate -->
                  <small v-show="errors.dni" v-for="error in errors.dni" class="text-danger font-weight-bold" v-text="error + '. '"></small>
                </div>
                <div class="form-group col-md-4">
                  <label>Nombres&nbsp;<span class="text-danger">*</span></label>
                  <input v-model="form.nombres" type="text" name="nombres"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('nombres') }"
                  placeholder="Ingrese los Nombres">
                  <has-error :form="form" field="nombres"></has-error>
                  <!-- udpate -->
                  <small v-show="errors.nombres" v-for="error in errors.nombres" class="text-danger font-weight-bold" v-text="error + '. '"></small>
                </div>
                <div class="form-group col-md-4">
                  <label>Apellidos&nbsp;<span class="text-danger">*</span></label>
                  <input v-model="form.apellidos" type="text" name="apellidos"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('apellidos') }"
                  placeholder="Ingrese los Apellidos">
                  <has-error :form="form" field="apellidos"></has-error>
                  <!-- udpate -->
                  <small v-show="errors.apellidos" v-for="error in errors.apellidos" class="text-danger font-weight-bold" v-text="error + '. '"></small>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label>Género&nbsp;<span class="text-danger">*</span></label>
                  <select v-model="form.genero" name="genero"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('genero') }">
                    <option value="" disabled>Seleccione su Género...</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                  </select>
                  <has-error :form="form" field="genero"></has-error>
                  <!-- udpate -->
                  <small v-show="errors.genero" v-for="error in errors.genero" class="text-danger font-weight-bold" v-text="error + '. '"></small>
                </div>
                <div class="form-group col-md-3">
                  <label>Email</label>
                  <input v-model="form.email" type="email" name="email"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('email') }"
                  placeholder="Ingrese el Email">
                  <has-error :form="form" field="email"></has-error>
                  <!-- udpate -->
                  <small v-show="errors.email" v-for="error in errors.email" class="text-danger font-weight-bold" v-text="error + '. '"></small>
                </div>
                <div class="form-group col-md-3">
                  <label>Teléfono</label>
                  <input v-model="form.telefono" type="text" name="telefono"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('telefono') }"
                  placeholder="Ingrese el N° de Teléfono">
                  <has-error :form="form" field="telefono"></has-error>
                </div>
                <div class="form-group col-md-3">
                  <label>Celular</label>
                  <input v-model="form.celular" type="text" name="celular"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('celular') }"
                  placeholder="Ingrese el N° de Celular">
                  <has-error :form="form" field="celular"></has-error>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-xl-8 col-lg-8 col-md-6 col-sm-12">
                <label for="image" class="font-weight-bold">Foto (jpg, jpeg, png)</label>
                <input type="file" id="image" accept="image/jpg,image/jpeg,image/png" @change="getImage"
                class="form-control" :class="{'is-invalid': form.errors.has('image')}" >
                <div class="text-center" v-show="showImagePreview">
                <img src="" class="img-fluid img-thumbnail mt-1" id="imagePreview" width="200px" alt="Imagen seleccionada">
                </div>
                <has-error :form="form" field="image" class="d-block"></has-error>
              </div>
              <div class="form-group col-xl-4 col-lg-4 col-md-6 col-sm-12">
                <label class="font-weight-bold">
                Seleccione un Rol
                <span class="text-danger">*</span>
                </label>
                <ul class="list-unstyled m-0">
                <li v-for="role, key in roles">
                  <label>
                  <input v-model="form.role" type="radio" name="form.role" :id="role.id" :value="role.id"
                  :class="{ 'is-invalid': form.errors.has('role') }">
                  <label :for="role.id">{{ role.name }}</label>
                  </label>
                </li>
                </ul>
                <has-error :form="form" field="role" class="d-block"></has-error>
                <!-- udpate -->
                <small v-show="errors.role" v-for="error in errors.role" class="text-danger font-weight-bold" v-text="error + '. '"></small>
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
        items: {},
        roles: {},
        form: new Form({
          'id': '',
          'dni': '',
          'nombres': '',
          'apellidos': '',
          'genero': '',
          'email': '',
          'telefono': '',
          'celular': '',
          'role': '',
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
      getItems(page) {
        this.loader = true;
        axios.get('/api/user?page=' + page + '&search=' + this.search).then(response => {
          this.items = response.data.items.data;
          this.roles = response.data.roles;
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
        $('#modal').on('shown.bs.modal', function() { $('#dni').focus() });
      },
      openModalUpdate(item) {
        this.editMode = true;
        let role = '';
        if (item.roles.length != 0) {
          role = item.roles[0].id;
        }
        let dataToFill = {
          'id': item.id,
          'dni': item.persona.dni,
          'nombres': item.persona.nombres,
          'apellidos': item.persona.apellidos,
          'genero': item.persona.genero,
          'email': item.persona.email,
          'telefono': item.persona.telefono,
          'celular': item.persona.celular,
          'role': role,
          'image': ''
        }
        this.form.reset();
        this.form.clear();
        this.clearFilePath();
        this.errors = {};
        this.form.fill(dataToFill);
        $('#modal').modal({ show: true });
        $('#modal').on('shown.bs.modal', function() { $('#dni').focus() });
      },
      create() {
        this.isLoading = true;
        this.form.submit('post', '/api/user', {
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
        let url = '/api/user/' + this.form.id;
        let data = new FormData();
        data.append('id', this.form.id);
        data.append('dni', this.form.dni);
        data.append('nombres', this.form.nombres);
        data.append('apellidos', this.form.apellidos);
        data.append('genero', this.form.genero);
        data.append('email', this.form.email);
        data.append('telefono', this.form.telefono);
        data.append('celular', this.form.celular);
        data.append('image', this.form.image);
        data.append('role', this.form.role);
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
            axios.post('/api/user/alta-baja/0/' + id).then(response => {
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
            axios.post('/api/user/alta-baja/1/' + id).then(response => {
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
            this.form.delete('/api/user/' + id).then(response => {
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
            axios.post('/api/user/restablecer-password/' + id).then(response => {
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
                        <strong>Usuario:</strong>
                        ${response.data.username}
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
