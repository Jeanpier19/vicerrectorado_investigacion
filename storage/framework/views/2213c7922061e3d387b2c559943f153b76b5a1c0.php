
<?php $__env->startSection('title', 'Movilidad | '); ?>
<?php $__env->startSection('content'); ?>
  <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
    <div class="container text-left align-self-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('web.index')); ?>">Inicio</a></li>
        </ol>
      </nav>
      <h1 class="page-title-heading mt-3">Movilidad </h1>
    </div>
  </div>
  <section class="container-fluid pt-3 mb-3">
    <div class="sk-cube-grid" v-show="preLoader">
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
    <template v-if="!preLoader">
      <div class="row">
        <div class="col-xl-2 col-lg-3">
          <a class="offcanvas-toggle" href="#filters" data-toggle="offcanvas"><i class="fe-icon-sidebar"></i></a>
          <aside class="offcanvas-container" id="filters">
            <div class="offcanvas-scrollable-area px-4 pt-5 px-lg-0 pt-lg-0"><span class="offcanvas-close"><i class="fe-icon-x"></i></span>
              <div class="widget">
                <h4 class="widget-title"><i class="fe-icon-filter"></i> SEMESTRE</h4>
                <select class="form-control mb-3" id="tosearch_semestre" v-model="tosearch_semestre" @change="searchItems()">
                  <option v-for="item in semestres" :value="item.id" v-text="item.anio + '-' + item.periodo"></option>
                </select>
              </div>
              <div class="widget">
                <h4 class="widget-title"><i class="fe-icon-filter"></i> Tipo</h4>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="Tipo1" value="1" v-model="tosearch_tipo" @change="searchItems()">
                  <label class="custom-control-label" for="Tipo1">Estudiantes</label>
                </div>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="Tipo2" value="2" v-model="tosearch_tipo" @change="searchItems()">
                  <label class="custom-control-label" for="Tipo2">Docentes</label>
                </div>
              </div>
              <div class="widget">
                <h4 class="widget-title"><i class="fe-icon-filter"></i> Facultad</h4>
                <div class="custom-control custom-checkbox" v-for="item in facultades">
                  <input class="custom-control-input" type="checkbox" :id="'Facultad' + item.id" :value="item.id" v-model="tosearch_facultad" @change="searchItems()">
                  <label class="custom-control-label" :for="'Facultad' + item.id">{{ item.nombre }}&nbsp;<span class="text-muted">({{ item.abreviatura }})</span></label>
                </div>
              </div>
            </div>
          </aside>
        </div>
        <div class="col-xl-10 col-lg-9">
          <div class="row">
            <div class="form-group col-lg-9 col-md-9 col-sm-12">
              <label class="font-weight-bold p-0" for="search">Buscar</label>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Buscar..." v-model="search" @keyup.enter="searchItems()">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-primary" @click.prevent="searchItems()"><i class="fe-icon-search"></i></button>
                </div>
              </div>
            </div>
            <div class="form-group col-lg-3 col-md-3 col-sm-12">
              <label class="font-weight-bold p-0" for="qty_toshow">Mostrar</label>
              <select class="form-control" id="qty_toshow" v-model="qty_toshow" @change="searchItems()">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="40">40</option>
                <option value="60">60</option>
                <option value="80">80</option>
                <option value="100">100</option>
                <option :value="pagination.total">Todo ({{ pagination.total }})</option>
              </select>
            </div>
          </div>
          <!--================================
          =            Pagination            =
          =================================-->
          <div class="row py-3" v-show="!loader">
            <div class="col-12">
              <nav class="pagination">
                <a class="btn btn-sm btn-style-6 btn-primary" href="javascript:void(0)" v-if="pagination.current_page > 1" tabindex="-1" @click.prevent="changePage(pagination.current_page - 1)"><i class="fe-icon-chevron-left"></i>Anterior</a>
                <ul class="pages">
                  <li class="d-block d-sm-none w-100">{{ pagination.current_page }} / {{ pagination.last_page }}</li>
                  <li class="d-none d-sm-inline-block" v-for="page in pagesNumber" :class="page == isActived ? 'active' : ''">
                    <a href="javascript:void(0)" @click.prevent="changePage(page)">{{ page }}</a>
                  </li>
                </ul>
                <a class="btn btn-sm btn-style-6 btn-primary" href="javascript:void(0)" v-if="pagination.current_page < pagination.last_page" @click.prevent="changePage(pagination.current_page + 1)">Siguiente<i class="fe-icon-chevron-right"></i></a>
              </nav>
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
            <p v-if="pagination.from">Mostrando de {{ pagination.from }} a {{ pagination.to }} de {{ pagination.total }} registros</p>
            <table class="table table-striped">
              <thead class="table-dark">
                <tr>
                  <th>Tipo</th>
                  <th>Nombres y Apellidos</th>
                  <th>Institución</th>
                  <th>Semestre</th>
                  <th>Facultad</th>
                  <th>Modalidad</th>
                  <th>País</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="7" class="text-center" v-if="items.length == 0">No se encontraron registros coincidentes</td>
                </tr>
                <tr v-for="item in items">
                  <td v-text="item.tipo == 1 ? 'Estudiantes' : 'Docentes'"></td>
                  <td v-text="item.nombres + ' ' + item.apellidos"></td>
                  <td v-text="item.institucion.nombre"></td>
                  <td v-text="item.semestre.anio + '-' + item.semestre.periodo"></td>
                  <td v-text="item.facultad.abreviatura"></td>
                  <td v-text="item.modalidad"></td>
                  <td v-text="item.pais"></td>
                </tr>
              </tbody>
            </table>
          </div>
          <!--================================
          =            Pagination            =
          =================================-->
          <div class="row py-3" v-show="!loader">
            <div class="col-12">
              <p v-if="pagination.from">Mostrando de {{ pagination.from }} a {{ pagination.to }} de {{ pagination.total }} registros</p>
            </div>
            <div class="col-12">
              <nav class="pagination">
                <a class="btn btn-sm btn-style-6 btn-primary" href="javascript:void(0)" v-if="pagination.current_page > 1" tabindex="-1" @click.prevent="changePage(pagination.current_page - 1)"><i class="fe-icon-chevron-left"></i>Anterior</a>
                <ul class="pages">
                  <li class="d-block d-sm-none w-100">{{ pagination.current_page }} / {{ pagination.last_page }}</li>
                  <li class="d-none d-sm-inline-block" v-for="page in pagesNumber" :class="page == isActived ? 'active' : ''">
                    <a href="javascript:void(0)" @click.prevent="changePage(page)">{{ page }}</a>
                  </li>
                </ul>
                <a class="btn btn-sm btn-style-6 btn-primary" href="javascript:void(0)" v-if="pagination.current_page < pagination.last_page" @click.prevent="changePage(pagination.current_page + 1)">Siguiente<i class="fe-icon-chevron-right"></i></a>
              </nav>
            </div>
          </div>
          <!--====  End of Pagination  ====-->
          <div class="text-center text-lg-right wow fadeInDown mt-3">
            <a href="#" class="btn btn-sm btn-success btn-style-4"><i class="fe-icon-download-cloud"></i> Exportar Excel</a>
            <a href="#" class="btn btn-sm btn-danger btn-style-4"><i class="fe-icon-download-cloud"></i>Exportar PDF</a>
          </div>
        </div>
      </div>
    </template>
  </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom_js'); ?>
  <?php echo $__env->make('web.vue.movilidad', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\1. Tecnología Web\Proyecto\SEMANA IX\AppVRI\appVRI\resources\views/web/movilidad.blade.php ENDPATH**/ ?>