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
        <li class="breadcrumb-item active" aria-current="page">Solicitudes de Creación</li>
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
                <th>Solicitado</th>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Departamento</th>
                <th>Grado</th>
                <th>Categoría</th>
                <th>CTI</th>
                <th>ORCID</th>
                <th style="min-width: 180px">Acción</th>
              </tr>
            </thead>
            <tbody>
              <tr v-if="items.length == 0">
                <td colspan="10" class="text-center">No hay registros en la tabla</td>
              </tr>
              <tr v-for="item, key in items">
                <td v-text="key + pagination.from"></td>
                <td>{{ item.created_at | myDate }}</td>
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
                  <button type="button" class="btn btn-dark btn-sm" @click.prevent="openModal(item)" v-tooltip:top="'Ver Información'">
                  <i class="fas fa-fw fa-eye"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" @click.prevent="verifyItem(item.id)" v-tooltip:top="'Verificar'">
                    <i class="fas fa-fw fa-check"></i>
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
            <div class="modal-header">
              <h5 class='modal-title font-weight-bold'><i class='fas fa-fw fa-eye'></i>&nbsp;Información Proporcionada</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label>DNI</label>
                  <div class="form-control" v-text="form.dni"></div>
                </div>
                <div class="form-group col-md-4">
                  <label>Nombres</label>
                  <div class="form-control" v-text="form.nombres"></div>
                </div>
                <div class="form-group col-md-4">
                  <label>Apellidos</label>
                  <div class="form-control" v-text="form.apellidos"></div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label>Género</label>
                  <div class="form-control" v-text="form.genero"></div>
                </div>
                <div class="form-group col-md-4">
                  <label>Celular</label>
                  <div class="form-control" v-text="form.celular"></div>
                </div>
                <div class="form-group col-md-4">
                  <label>Email</label>
                  <div class="form-control" v-text="form.email"></div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Grado Académico</label>
                  <div class="form-control" v-text="form.grado"></div>
                </div>
                <div class="form-group col-md-6">
                  <label>Categoría</label>
                  <div class="form-control" v-if="form.categoria==1" v-text="'Auxiliar'"></div>
                  <div class="form-control" v-if="form.categoria==2" v-text="'Asociado'"></div>
                  <div class="form-control" v-if="form.categoria==3" v-text="'Principal'"></div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-5">
                  <label>Facultad</label>
                  <div class="form-control" v-text="form.facultad"></div>
                </div>
                <div class="form-group col-md-7">
                  <label>Departamento Académico</label>
                  <div class="form-control" v-text="form.departamento"></div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-5">
                  <label>CTI</label>
                  <div class="form-control">
                    <a :href="form.cti" v-text="form.cti" target="_blank"></a>
                  </div>
                </div>
                <div class="form-group col-md-7">
                  <label>ORCID</label>
                  <div class="form-control">
                    <a :href="'https://orcid.org/' + form.orcid" v-text="form.orcid" target="_blank"></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i>Cerrar</button>
            </div>
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
        items: {},
        form: new Form({
          'id': '',
          'dni': '',
          'nombres': '',
          'apellidos': '',
          'genero': '',
          'celular': '',
          'email': '',
          'grado': '',
          'categoria': '',
          'facultad': '',
          'departamento': '',
          'cti': '',
          'orcid': '',
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
        axios.get('/api/solicitud-creacion?page=' + page + '&search=' + this.search).then(response => {
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
      openModal(item) {
        let dataToFill = {
          'id': item.id,
          'dni': item.user.persona.dni,
          'nombres': item.user.persona.nombres,
          'apellidos': item.user.persona.apellidos,
          'genero': item.user.persona.genero,
          'celular': item.user.persona.celular,
          'email': item.user.persona.email,
          'grado': item.grado,
          'categoria': item.categoria,
          'facultad': item.departamento.facultad.nombre,
          'departamento': item.departamento.nombre,
          'cti': item.cti,
          'orcid': item.orcid,
        }
        this.form.reset();
        this.form.clear();
        this.form.fill(dataToFill);
        $('#modal').modal({ show: true });
      },
      searchUser(search, loading) {
        loading(true);
        let url = "/api/solicitud-creacion/search/user?search=" + search;
        axios.get(url).then(response => {
          this.users = response.data.users;
          loading(false);
        }).catch(error => {
          toastr.error('Hubo un error inesperado, intente nuevamente', '¡Error!');
          loading(false);
        });
      },
      verifyItem: function(id) {
        Swal.fire({
          icon: 'warning',
          title: '¿Estás seguro?',
          text: '¡Se verificará la creación del Usuario/Investigador!',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, verificar',
          cancelButtonText: 'No, cancelar'
        }).then((result) => {
          if(result.value) {
            this.isLoading = true;
            axios.post('/api/solicitud-creacion/verificar/' + id).then(response => {
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
            this.form.delete('/api/solicitud-creacion/' + id).then(response => {
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
            axios.post('/api/solicitud-creacion/restablecer-password/' + id).then(response => {
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
                        ${response.data.solicitud-creacionname}
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
