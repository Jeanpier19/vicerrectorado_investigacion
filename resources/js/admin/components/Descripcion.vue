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
        <li class="breadcrumb-item active" aria-current="page">Descripción</li>
      </ol>
    </nav>
    <div class="card">
      <div class="card-body">
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
          <form @submit.prevent="update()">
            <div class="form-group">
              <label>Descripción&nbsp;<span class="text-danger">*</span></label>
              <ckeditor :editor="editor" v-model="form.descripcion" :config="editorConfig" :class="{ 'is-invalid': form.errors.has('descripcion') }"></ckeditor>
              <has-error :form="form" field="descripcion"></has-error>
            </div>
            <div class="form-group">
              <label>Misión&nbsp;<span class="text-danger">*</span></label>
              <ckeditor :editor="editor" v-model="form.mision" :config="editorConfig" :class="{ 'is-invalid': form.errors.has('mision') }"></ckeditor>
              <has-error :form="form" field="mision"></has-error>
            </div>
            <div class="form-group">
              <label>Visión&nbsp;<span class="text-danger">*</span></label>
              <ckeditor :editor="editor" v-model="form.vision" :config="editorConfig" :class="{ 'is-invalid': form.errors.has('vision') }"></ckeditor>
              <has-error :form="form" field="vision"></has-error>
            </div>
            <div class="form-group">
              <label>Dirección&nbsp;<span class="text-danger">*</span></label>
              <input v-model="form.direccion" type="text" name="direccion" id="direccion"
              class="form-control" :class="{ 'is-invalid': form.errors.has('direccion') }"
              placeholder="Ingrese la Dirección">
              <has-error :form="form" field="direccion"></has-error>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Email 1&nbsp;<span class="text-danger">*</span></label>
                <input v-model="form.email_1" type="email" name="email_1" id="email_1"
                class="form-control" :class="{ 'is-invalid': form.errors.has('email_1') }"
                placeholder="Ingrese el Email 1">
                <has-error :form="form" field="email_1"></has-error>
              </div>
              <div class="form-group col-md-4">
                <label>Email 2</label>
                <input v-model="form.email_2" type="email" name="email_2" id="email_2"
                class="form-control" :class="{ 'is-invalid': form.errors.has('email_2') }"
                placeholder="Ingrese el Email 2">
                <has-error :form="form" field="email_2"></has-error>
              </div>
              <div class="form-group col-md-4">
                <label>Email 3</label>
                <input v-model="form.email_3" type="email" name="email_3" id="email_3"
                class="form-control" :class="{ 'is-invalid': form.errors.has('email_3') }"
                placeholder="Ingrese el Email 3">
                <has-error :form="form" field="email_3"></has-error>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-2">
                <label>Teléfono 1&nbsp;<span class="text-danger">*</span></label>
                <input v-model="form.telefono_1" type="text" name="telefono_1" id="telefono_1"
                class="form-control" :class="{ 'is-invalid': form.errors.has('telefono_1') }"
                placeholder="Ingrese el Teléfono 1">
                <has-error :form="form" field="telefono_1"></has-error>
              </div>
              <div class="form-group col-md-2">
                <label>Anexo 1&nbsp;<span class="text-danger">*</span></label>
                <input v-model="form.anexo_1" type="text" name="anexo_1" id="anexo_1"
                class="form-control" :class="{ 'is-invalid': form.errors.has('anexo_1') }"
                placeholder="Ingrese el Anexo 1">
                <has-error :form="form" field="anexo_1"></has-error>
              </div>
              <div class="form-group col-md-2">
                <label>Teléfono 2</label>
                <input v-model="form.telefono_2" type="text" name="telefono_2" id="telefono_2"
                class="form-control" :class="{ 'is-invalid': form.errors.has('telefono_2') }"
                placeholder="Ingrese el Teléfono 2">
                <has-error :form="form" field="telefono_2"></has-error>
              </div>
              <div class="form-group col-md-2">
                <label>Anexo 2</label>
                <input v-model="form.anexo_2" type="text" name="anexo_2" id="anexo_2"
                class="form-control" :class="{ 'is-invalid': form.errors.has('anexo_2') }"
                placeholder="Ingrese el Anexo 2">
                <has-error :form="form" field="anexo_2"></has-error>
              </div>
              <div class="form-group col-md-2">
                <label>Teléfono 3</label>
                <input v-model="form.telefono_3" type="text" name="telefono_3" id="telefono_3"
                class="form-control" :class="{ 'is-invalid': form.errors.has('telefono_3') }"
                placeholder="Ingrese el Teléfono 3">
                <has-error :form="form" field="telefono_3"></has-error>
              </div>
              <div class="form-group col-md-2">
                <label>Anexo 3</label>
                <input v-model="form.anexo_3" type="text" name="anexo_3" id="anexo_3"
                class="form-control" :class="{ 'is-invalid': form.errors.has('anexo_3') }"
                placeholder="Ingrese el Anexo 3">
                <has-error :form="form" field="anexo_3"></has-error>
              </div>
              <div class="form-group">
                <label for="organigrama" class="font-weight-bold">Organigrama (PDF)</label>
                <a :href="'/archivos/documentos/descripcion/' + form.organigrama_path" class="btn btn-sm btn-success" target="_blank"><i class="fas fa-fw fa-file-pdf"></i> Ver Organigrama</a>
                <input type="file" id="organigrama" class="form-control" @change="getFileOrganigrama" accept="application/pdf">
              </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Guardar Cambios</button>
          </form>
        </div>
      </div>
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
        descripcion: {},
        form: new Form({
          'id': '',
          'descripcion': '',
          'mision': '',
          'vision': '',
          'direccion': '',
          'email_1': '',
          'email_2': '',
          'email_3': '',
          'telefono_1': '',
          'telefono_2': '',
          'telefono_3': '',
          'anexo_1': '',
          'anexo_2': '',
          'anexo_3': '',
          'organigrama_path': '',
          'organigrama': '',
        }),
      }
    },
    methods: {
      getItems(page) {
        this.loader = true;
        axios.get('/api/descripcion').then(response => {
          this.descripcion = response.data.descripcion;
          let organigrama_path = '';
          if(this.descripcion.file) {
            organigrama_path = this.descripcion.file.path;
          }
          let dataToFill = {
            'id': this.descripcion.id,
            'descripcion': this.descripcion.descripcion,
            'mision': this.descripcion.mision,
            'vision': this.descripcion.vision,
            'direccion': this.descripcion.direccion,
            'email_1': this.descripcion.email_1,
            'email_2': this.descripcion.email_2,
            'email_3': this.descripcion.email_3,
            'telefono_1': this.descripcion.telefono_1,
            'telefono_2': this.descripcion.telefono_2,
            'telefono_3': this.descripcion.telefono_3,
            'anexo_1': this.descripcion.anexo_1,
            'anexo_2': this.descripcion.anexo_2,
            'anexo_3': this.descripcion.anexo_3,
            'organigrama_path': organigrama_path,
            'organigrama': '',
          };
          this.form.reset();
          this.form.clear();
          this.form.fill(dataToFill);
          this.loader = false;
        }).catch(() => {
          toastr.error('No se pudo obtener los registros, recargue la página e intente nuevamente', '¡Error!');
        })
      },
      getFileOrganigrama(event) {
        let files = event.target.files;
        if(!files.length) {
          this.form.organigrama = null;
        }else {
          this.form.organigrama = event.target.files[0];
        }
      },
      update(id) {
        this.isLoading = true;
        let url = '/api/descripcion/' + this.form.id;
        let data = new FormData();
        data.append('id', this.form.id);
        data.append('descripcion', this.form.descripcion);
        data.append('mision', this.form.mision);
        data.append('vision', this.form.vision);
        data.append('direccion', this.form.direccion);
        data.append('email_1', this.form.email_1);
        data.append('email_2', this.form.email_2);
        data.append('email_3', this.form.email_3);
        data.append('telefono_1', this.form.telefono_1);
        data.append('telefono_2', this.form.telefono_2);
        data.append('telefono_3', this.form.telefono_3);
        data.append('anexo_1', this.form.anexo_1);
        data.append('anexo_2', this.form.anexo_2);
        data.append('anexo_3', this.form.anexo_3);
        data.append('organigrama_path', this.form.organigrama_path);
        data.append('organigrama', this.form.organigrama);
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
    },
    created() {
      this.getItems(this.thisPage);
      Fire.$on('transaction', () => {
        this.getItems(this.thisPage);
      })
    },
    computed: {
      
    },
  }
</script>
