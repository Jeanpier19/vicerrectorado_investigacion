
<?php $__env->startSection('title', 'Semilleros de Investigación | '); ?>
<?php $__env->startSection('content'); ?>
  <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
    <div class="container text-left align-self-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('web.index')); ?>">Inicio</a></li>
        </ol>
      </nav>
      <h1 class="page-title-heading mt-3">Semilleros de Investigación</h1>
    </div>
  </div>
  <section class="container pt-3 mb-3 wow fadeIn">
    <div class="card">
      <div class="card-header">
        <div class="card-body">
          <div class="row">
            <div class="form-group col-lg-9 col-md-9 col-sm-12">
              <label class="font-weight-bold p-0" for="search">Buscar</label>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Cualquier criterio de búsqueda..." v-model="search" @keyup.enter="searchItems()">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-primary" @click.prevent="searchItems()">
                    <i class="fe-icon-search"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="form-group col-lg-3 col-md-3 col-sm-12">
              <label class="font-weight-bold p-0" for="qty_toshow">Mostrar</label>
              <select class="form-control" id="qty_toshow" v-model="qty_toshow" @change="searchItems()">
                <option value="" selected>Todo</option>
                <option value="3">3</option>
                <option value="6">6</option>
                <option value="9">9</option>
                <option value="12">12</option>
                <option value="15">15</option>
              </select>
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
            <figure>
              <table class="table table-striped" id="table">
                <thead class="table-dark">
                  <tr>
                    <th width="10px">#</th>
                    <th>Grupos de investigación</th>
                    <th>Integrantes</th>
                    <th>Línea de investigación</th>
                  </tr>
                </thead>
                <tbody>
                  <tr >
                    <td colspan="4">
                      <p class="text-center my-2">No hay datos disponibles en la tabla</p>
                    </td>
                  </tr>
                 
                </tbody>
              </table>
            </figure>
          </div>
          <!--================================
          =            Pagination            =
          =================================-->
          <div class="row pt-3" v-show="!loader">
            <div class="col-12">
              <p v-if="pagination.from">Mostrando de 1  de 1 registros</p>
            </div>
            <div class="col-12">
              <nav class="pagination">
                <a class="prev-btn" href="javascript:void(0)" v-if="pagination.current_page > 1" tabindex="-1" @click.prevent="changePage(pagination.current_page - 1)"><i class="fe-icon-chevron-left"></i>Anterior</a>
                <ul class="pages">
                  <li class="d-block d-sm-none w-100">1 / 1</li>
                  <li class="d-none d-sm-inline-block" v-for="page in pagesNumber" :class="page == isActived ? 'active' : ''">
                    <a href="javascript:void(0)" @click.prevent="changePage(page)">1</a>
                  </li>
                </ul>
                <a class="next-btn" href="javascript:void(0)" v-if="pagination.current_page < pagination.last_page" @click.prevent="changePage(pagination.current_page + 1)">Siguiente<i class="fe-icon-chevron-right"></i></a>
              </nav>
            </div>
          </div>
          <!--====  End of Pagination  ====-->
        </div>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom_js'); ?>
  <?php echo $__env->make('web.vue.grupos-investigacion', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/appVRI/resources/views/web/semilleros-investigacion.blade.php ENDPATH**/ ?>