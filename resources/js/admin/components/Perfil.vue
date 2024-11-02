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
        <li class="breadcrumb-item active" aria-current="page">Perfil</li>
      </ol>
    </nav>
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
      <div class="col-md-4">
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <a :href="getItemImage(form.image)" class="fancybox" data-fancybox="Usuario" :data-caption="form.apellidos + ' ' + form.nombres"><img :src="getItemImage(form.image)" class="profile-user-img img-fluid img-circle" alt="Foto"></a>
            </div>
            <div class="text-center mt-1">
              <button type="button" class="btn btn-success" @click.prevent="openModalUpdateProfilePicture()">Cambiar Foto</button>
            </div>
            <h3 class="profile-username text-center" v-text="form.nombres + ' ' + form.apellidos"></h3>
            <p class="text-muted text-center" v-text="form.cargo"></p>
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>DNI</b> <a class="float-right" v-text="form.dni"></a>
              </li>
              <li class="list-group-item">
                <b>Género</b> <a class="float-right" v-text="form.genero"></a>
              </li>
              <li class="list-group-item">
                <b>Teléfono</b> <a class="float-right" v-text="form.telefono"></a>
              </li>
              <li class="list-group-item">
                <b>Celular</b> <a class="float-right" v-text="form.celular"></a>
              </li>
              <li class="list-group-item">
                <b>Email</b> <a class="float-right" v-text="form.email"></a>
              </li>
              <li class="list-group-item" v-if="user.investigador">
                <b>Grado</b> <a class="float-right" v-text="form.grado"></a>
              </li>
              <li class="list-group-item" v-if="user.investigador">
                <b>Categoría</b> <a class="float-right" v-if="form.categoria==1" v-text="'Auxiliar'"></a><a class="float-right" v-if="form.categoria==2" v-text="'Asociado'"></a><a class="float-right" v-if="form.categoria==3" v-text="'Principal'"></a>
              </li>
              <li class="list-group-item" v-if="user.investigador">
                <b>CTI</b> <a class="float-right" :href="form.cti" target="_blank" v-text="form.cti"></a>
              </li>
              <li class="list-group-item" v-if="user.investigador">
                <b>ORCID</b> <a class="float-right" :href="'https://orcid.org/' + form.orcid" target="_blank" v-text="form.orcid"></a>
              </li>
              <li class="list-group-item social">
                <a :href="form.facebook"><i class="fab fa-fw fa-facebook"></i></a>
                <a :href="form.twitter"><i class="fab fa-fw fa-twitter"></i></a>
                <a :href="form.instagram"><i class="fab fa-fw fa-instagram"></i></a>
                <a :href="form.linkedin"><i class="fab fa-fw fa-linkedin"></i></a>
                <a :href="form.github"><i class="fab fa-fw fa-github"></i></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="profile-username text-center">Configuraciones</h3>
          </div>
          <div class="card-body">
          <form @submit.prevent="update()">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Género&nbsp;<span class="text-danger">*</span></label>
                <select v-model="form.genero" name="genero"
                class="form-control" :class="{ 'is-invalid': form.errors.has('genero') }">
                  <option value="" disabled>Seleccione su Género...</option>
                  <option value="Masculino">Masculino</option>
                  <option value="Femenino">Femenino</option>
                </select>
                <has-error :form="form" field="genero"></has-error>
              </div>
              <div class="form-group col-md-4">
                <label>Email</label>
                <input v-model="form.email" type="text" name="email" id="email" 
                class="form-control" :class="{ 'is-invalid': form.errors.has('email') }"
                placeholder="Ingrese su Email">
                <has-error :form="form" field="email"></has-error>
              </div>
              <div class="form-group col-md-4">
                <label>Fecha de Nacimiento</label>
                <input v-model="form.fecha_nacimiento" type="date" name="fecha_nacimiento" id="fecha_nacimiento" 
                class="form-control" :class="{ 'is-invalid': form.errors.has('fecha_nacimiento') }">
                <has-error :form="form" field="fecha_nacimiento"></has-error>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Teléfono</label>
                <input v-model="form.telefono" type="text" name="telefono" id="telefono" 
                class="form-control" :class="{ 'is-invalid': form.errors.has('telefono') }"
                placeholder="Ingrese su N° de Teléfono">
                <has-error :form="form" field="telefono"></has-error>
              </div>
              <div class="form-group col-md-6">
                <label>Celular</label>
                <input v-model="form.celular" type="text" name="celular" id="celular" 
                class="form-control" :class="{ 'is-invalid': form.errors.has('celular') }"
                placeholder="Ingrese su N° de Celular">
                <has-error :form="form" field="celular"></has-error>
              </div>
            </div>
            <div class="form-group">
              <label>Dirección</label>
              <input v-model="form.direccion" type="text" name="direccion" id="direccion" 
              class="form-control" :class="{ 'is-invalid': form.errors.has('direccion') }"
              placeholder="Ingrese su Dirección">
              <has-error :form="form" field="direccion"></has-error>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Facebook</label>
                <input v-model="form.facebook" type="text" name="facebook" id="facebook" 
                class="form-control" :class="{ 'is-invalid': form.errors.has('facebook') }"
                placeholder="Ingrese el link de su Facebook">
                <has-error :form="form" field="facebook"></has-error>
              </div>
              <div class="form-group col-md-6">
                <label>Twitter</label>
                <input v-model="form.twitter" type="text" name="twitter" id="twitter" 
                class="form-control" :class="{ 'is-invalid': form.errors.has('twitter') }"
                placeholder="Ingrese el link de su Twitter">
                <has-error :form="form" field="twitter"></has-error>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Instagram</label>
                <input v-model="form.instagram" type="text" name="instagram" id="instagram" 
                class="form-control" :class="{ 'is-invalid': form.errors.has('instagram') }"
                placeholder="Ingrese el link de su Instagram">
                <has-error :form="form" field="instagram"></has-error>
              </div>
              <div class="form-group col-md-6">
                <label>LinkedIn</label>
                <input v-model="form.linkedin" type="text" name="linkedin" id="linkedin" 
                class="form-control" :class="{ 'is-invalid': form.errors.has('linkedin') }"
                placeholder="Ingrese el link de su LinkeIn">
                <has-error :form="form" field="linkedin"></has-error>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>GitHub</label>
                <input v-model="form.github" type="text" name="github" id="github" 
                class="form-control" :class="{ 'is-invalid': form.errors.has('github') }"
                placeholder="Ingrese el link de su GitHub">
                <has-error :form="form" field="github"></has-error>
              </div>
              <div class="form-group col-md-6">
                <label>Sitio Web</label>
                <input v-model="form.sitio_web" type="text" name="sitio_web" id="sitio_web" 
                class="form-control" :class="{ 'is-invalid': form.errors.has('sitio_web') }"
                placeholder="Ingrese el link de su Sitio Web">
                <has-error :form="form" field="sitio_web"></has-error>
              </div>
            </div>
            <div class="form-row" v-if="user.investigador">
              <div class="form-group col-md-6">
                <label>Grado&nbsp;<span class="text-danger">*</span></label>
                <input v-model="form.grado" type="text" name="grado" id="grado" 
                class="form-control" :class="{ 'is-invalid': form.errors.has('grado') }"
                placeholder="Ingrese su Grado">
                <has-error :form="form" field="grado"></has-error>
              </div>
              <div class="form-group col-md-6">
                <label>Categoría&nbsp;<span class="text-danger">*</span></label>
                <select v-model="form.categoria" name="categoria"
                class="form-control" :class="{ 'is-invalid': form.errors.has('categoria') }">
                  <option value="" disabled>Seleccione su Categoría...</option>
                  <option value="1">Auxiliar</option>
                  <option value="2">Asociado</option>
                  <option value="3">Principal</option>
                </select>
                <has-error :form="form" field="categoria"></has-error>
              </div>
              <div class="form-group col-md-6">
                <label>CTI&nbsp;<span class="text-danger">*</span></label>
                <input v-model="form.cti" type="text" name="cti" id="cti" 
                class="form-control" :class="{ 'is-invalid': form.errors.has('cti') }"
                placeholder="Ingrese el link de su CTI">
                <has-error :form="form" field="cti"></has-error>
              </div>
              <div class="form-group col-md-6">
                <label>ORCID&nbsp;<span class="text-danger">*</span></label>
                <input v-model="form.orcid" type="text" name="orcid" id="orcid" 
                class="form-control" :class="{ 'is-invalid': form.errors.has('orcid') }"
                v-mask="'####-####-####-####'"
                placeholder="####-####-####-####">
                <has-error :form="form" field="orcid"></has-error>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Fecha de Inicio</label>
                <input v-model="form.fecha_inicio" type="date" name="fecha_inicio" id="fecha_inicio" 
                class="form-control" :class="{ 'is-invalid': form.errors.has('fecha_inicio') }">
                <has-error :form="form" field="fecha_inicio"></has-error>
              </div>
              <div class="form-group col-md-6">
                <label>Usuario&nbsp;<span class="text-danger">*</span></label>
                <input v-model="form.username" type="text" name="username" id="username" 
                class="form-control" :class="{ 'is-invalid': form.errors.has('username') }"
                placeholder="Ingrese el link de su GitHub">
                <has-error :form="form" field="username"></has-error>
              </div>
            </div>
            <span class="text-muted">Llene los siguientes campos solo en caso que requiera cambiar su contraseña</span>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Nueva Contraseña</label>
                <input v-model="form.password" type="password" name="password" id="password" 
                class="form-control" :class="{ 'is-invalid': form.errors.has('password') }"
                placeholder="Ingrese una Nueva Contraseña">
                <has-error :form="form" field="password"></has-error>
              </div>
              <div class="form-group col-md-6">
                <label>Contraseña Actual</label>
                <input v-model="form.password_actual" type="password" name="password_actual" id="password_actual" 
                class="form-control" :class="{ 'is-invalid': form.errors.has('password_actual') }"
                placeholder="Ingrese el link de su GitHub">
                <has-error :form="form" field="password_actual"></has-error>
              </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Guardar cambios</button>
          </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
      <div class="modal-dialog modal-xs" role="document">
        <div class="modal-content">
          <form @submit.prevent="updateProfilePicture()">
            <div class="modal-header">
              <h5 class='modal-title font-weight-bold'><i class='fas fa-fw fa-image'></i>&nbsp;Cambiar Foto</span></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body bg-white">
              <div class="form-row">
                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                  <label for="image" class="font-weight-bold">Imagen (jpg, jpeg, png)&nbsp;<span class="text-danger">*</span></label>
                  <input type="file" id="image" accept="image/jpg,image/jpeg,image/png" @change="getImage"
                  class="form-control" :class="{'is-invalid': form.errors.has('image')}" >
                  <!-- udpate -->
                  <small v-show="errors.image" v-for="error in errors.image" class="text-danger font-weight-bold" v-text="error + '. '"></small>
                  <div class="text-center mt-1">
                    <img :src="getItemImage(form.fillImage)" class="img-fluid img-thumbnail mt-1" id="imagePreview" width="200px" alt="Foto">
                  </div>
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
</template>
<style>
  .social {
    text-align: center;
  }
  .social a {
    font-size: 18px;
  }
</style>
<script>
  import Form from 'vform'
  import { objectToFormData } from 'object-to-formdata'

  export default {
    data() {
      return {
        // loader
        loader: true, 
        isLoading: false,
        fullPage: true,
        //
        user: {},
        errors: {},
        showImagePreview: false,
        form: new Form({
          'id': '',
          'dni': '',
          'nombres': '',
          'apellidos': '',
          'genero': '',
          'email': '',
          'fecha_nacimiento': '',
          'telefono': '',
          'celular': '',
          'direccion': '',
          'facebook': '',
          'twitter': '',
          'instagram': '',
          'linkedin': '',
          'github': '',
          'sitio_web': '',
          'username': '',
          'password': '',
          'password_actual': '',
          'image': '',
          'fillImage': '',
          //
          'fecha_inicio': '',
          'grado': '',
          'categoria': '',
          'cti': '',
          'orcid': '',
        }),
      }
    },
    methods: {
      getData() {
        this.loader = true;
        axios.get('/api/user/profile/profile-data').then(response => {
          this.user = response.data.user;
          this.form.id = this.user.id;
          this.form.dni = this.user.persona.dni;
          this.form.nombres = this.user.persona.nombres;
          this.form.apellidos = this.user.persona.apellidos;
          this.form.genero = this.user.persona.genero;
          this.form.email = this.user.persona.email;
          this.form.fecha_nacimiento = this.user.persona.fecha_nacimiento;
          this.form.telefono = this.user.persona.telefono;
          this.form.celular = this.user.persona.celular;
          this.form.direccion = this.user.persona.direccion;
          this.form.facebook = this.user.persona.facebook;
          this.form.twitter = this.user.persona.twitter;
          this.form.instagram = this.user.persona.instagram;
          this.form.linkedin = this.user.persona.linkedin;
          this.form.github = this.user.persona.github;
          this.form.sitio_web = this.user.persona.sitio_web;
          this.form.username = this.user.username;
          this.form.image = this.user.image;
          this.form.fillImage = this.user.image;
          //
          if(this.user.investigador) {
            this.form.fecha_inicio = this.user.investigador.fecha_inicio;
            this.form.grado = this.user.investigador.grado;
            this.form.categoria = this.user.investigador.categoria;
            this.form.cti = this.user.investigador.cti;
            this.form.orcid = this.user.investigador.orcid;
          }
          this.loader = false;
        }).catch(() => {
          toastr.error('No se pudo obtener los registros, recargue la página e intente nuevamente', '¡Error!');
        });
      },
      getItemImage(image) {
        let imagePath = null;
        if(image != null && image != '') {
          imagePath = "/archivos/imagenes/usuarios/" + image.path;
        }else {
          if(this.form.genero == 'Masculino') {
            imagePath = "/archivos/imagenes/usuario-masculino.jpg";
          }else if(this.form.genero == 'Femenino') {
            imagePath = "/archivos/imagenes/usuario-femenino.jpg";
          }
        }
        return imagePath;
      },
      update() {
        this.isLoading = true;
        if((this.form.orcid.trim().length != 19) && (this.user.investigador)) {
          toastr.error('Su ID de ORCID es inválido (####-####-####-####)', '¡Error!');
        }
        this.form.post('/api/user/profile/profile-data').then(response => {
          Fire.$emit('transaction');
          if(response.data.result) {
            Fire.$emit('transaction');
            $('#modal').modal('hide');
            toastr.success(response.data.message, '¡Completado!');
          }else {
            toastr.error(response.data.message, '¡Error!');
          }
          this.form.password = '';
          this.form.password_actual = '';
          this.isLoading = false;
        }).catch(error => {
          if(error.response.status == 422) {
            this.errors = error.response.data.errors;
            toastr.error('Por favor verifique los campos obligatorios antes de guardar', '¡Error!');
          }else {
            toastr.error('Hubo un error inesperado, recargue la página e intente nuevamente', '¡Error!');
          }
          this.form.password = '';
          this.form.password_actual = '';
          this.isLoading = false;
        });
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
            this.form.fillImage = this.user.image;
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
          this.form.fillImage = this.user.image;
          this.showImagePreview = false;
        }else {
          this.form.fillImage = event.target.files[0];
          this.addImage(event);
        }
      },
      openModalUpdateProfilePicture() {
        this.clearFilePath();
        this.errors = {};
        let imagePreview = document.getElementById('imagePreview');
        imagePreview.setAttribute('src', this.getItemImage(this.form.fillImage));
        $('#modal').modal({ show: true });
        $('#modal').on('shown.bs.modal', function() { $('#image').focus() });
      },
      updateProfilePicture() {
        this.isLoading = true;
        let url = '/api/user/profile/profile-data/update-profile-picture';
        let data = new FormData();
        data.append('image', this.form.fillImage);
        data.append('_method', 'POST');
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
    },
    created() {
      this.getData();
      Fire.$on('transaction', () => {
        this.getData();
      });
    },
  }
</script>
