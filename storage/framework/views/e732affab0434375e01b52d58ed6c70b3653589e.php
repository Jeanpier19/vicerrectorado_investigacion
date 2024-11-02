
<?php $__env->startSection('title', 'Proyectos de Investigación | '); ?>
<?php $__env->startSection('content'); ?>
  <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
    <div class="container text-left align-self-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('web.index')); ?>">Inicio</a></li>
        </ol>
      </nav>
      <h1 class="page-title-heading mt-3">Proyectos de Investigación</h1>
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
                <h4 class="widget-title"><i class="fe-icon-filter"></i> AÑO</h4>
                <label class="p-0">Del</label>
                <select class="form-control mb-3" id="tosearch_anio_desde" v-model="tosearch_anio_desde" @change="searchItems()">
                  <option value="2022">2022</option>
                  <option value="2021">2021</option>
                  <option value="2020">2020</option>
                  <option value="2019">2019</option>
                  <option value="2018">2018</option>
                  <option value="2017">2017</option>
                  <option value="2016">2016</option>
                  <option value="2015">2015</option>
                  <option value="2014">2014</option>
                  <option value="2013">2013</option>
                  <option value="2012">2012</option>
                  <option value="2011">2011</option>
                  <option value="2010">2010</option>
                </select>
                <label class="p-0">Al</label>
                <select class="form-control" id="tosearch_anio_hasta" v-model="tosearch_anio_hasta" @change="searchItems()">
                  <option value="2022">2022</option>
                  <option value="2021">2021</option>
                  <option value="2020">2020</option>
                  <option value="2019">2019</option>
                  <option value="2018">2018</option>
                  <option value="2017">2017</option>
                  <option value="2016">2016</option>
                  <option value="2015">2015</option>
                  <option value="2014">2014</option>
                  <option value="2013">2013</option>
                  <option value="2012">2012</option>
                  <option value="2011">2011</option>
                  <option value="2010">2010</option>
                </select>
              </div>
              <div class="widget">
                <h4 class="widget-title"><i class="fe-icon-filter"></i> Financiación</h4>
                <div class="custom-control custom-checkbox" v-for="item in tipos_financiacion">
                  <input class="custom-control-input" type="checkbox" :id="'TipoFinanciacion' + item.id" :value="item.id" v-model="tosearch_tipo_financiacion" @change="searchItems()">
                  <label class="custom-control-label" :for="'TipoFinanciacion' + item.id">{{ item.nombre }}</label>
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
                  <th>Financiación</th>
                  <th>Título</th>
                  <th>Facultad</th>
                  <th>Responsable</th>
                  <th>Corresponsables</th>
                  <th>Año</th>
                  <th>Estado</th>
                  <th>Presupuesto</th>
                  <th>Entregable</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="10" class="text-center" v-if="items.length == 0">No se encontraron registros coincidentes</td>
                </tr>
                <tr v-for="item in items">
                  <td v-text="item.tipo_financiacion.nombre"></td>
                  <td>
                    <a :href="item.link" class="font-weight-bold" target="_blank" v-if="item.link" v-text="item.titulo"></a>
                    <span v-else v-text="item.titulo"></span>
                  </td>
                  <td v-text="item.facultad.abreviatura"></td>
                  <td v-text="item.responsable"></td>
                  <td v-text="item.corresponsables"></td>
                  <td v-text="item.anio"></td>
                  <td v-text="item.estado"></td>
                  <td v-text="'S/. ' + item.presupuesto"></td>
                  <td v-text="item.entregable"></td>
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
  <?php echo $__env->make('web.vue.proyectos-investigacion', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/appVRI/resources/views/web/proyectos-investigacion.blade.php ENDPATH**/ ?>