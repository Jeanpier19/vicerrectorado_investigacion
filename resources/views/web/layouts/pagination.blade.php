<div class="row">
  <div class="col-lg-4 col-sm-12">
    <div>
      <p v-if="pagination.from">Mostrando de @{{ pagination.from }} a @{{ pagination.to }} de @{{ pagination.total }} registros</p>
    </div>  
  </div>
  <div class="col-lg-8 col-sm-12">
    <nav>
      <ul class="pagination justify-content-end">
        <li class="page-item" v-if="pagination.current_page > 1">
          <a class="page-link" href="javascript:void(0);" @click.prevent="changePage(1)">Inicio</a>
        </li>
        <li class="page-item" v-if="pagination.current_page > 1">
          <a class="page-link" href="javascript:void(0);" tabindex="-1" @click.prevent="changePage(pagination.current_page - 1)">Anterior</a>
        </li>
        <li class="page-item" v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']">
          <a class="page-link" href="javascript:void(0);" @click.prevent="changePage(page)">@{{ page }}</a>
        </li>
        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
          <a class="page-link" href="javascript:void(0);" @click.prevent="changePage(pagination.current_page + 1)">Siguiente</a>
        </li>
        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
          <a class="page-link" href="javascript:void(0);" @click.prevent="changePage(pagination.last_page)">Último</a>
        </li>
      </ul>
    </nav>
  </div>
</div>