<script type="text/javascript">
  let main = new Vue({
    el: '#main',
    data:{
      preLoader: true,
      loader: true,
      items: {},
      tipos_financiacion: {},
      facultades: {},
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
      // search
      search: '',
      qty_toshow: '10',
      tosearch_anio_desde: '2010',
      tosearch_anio_hasta: '2022',
      tosearch_facultad: [],
      tosearch_tipo_financiacion: [],
    },
    created: function() {
      this.getItems(this.thisPage);
    },
    mounted: function () {
       this.preLoader = false;
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
          to=this.pagination.last_page;
        }
        let pagesArray = [];
        while(from <= to) {
          pagesArray.push(from);
          from++;
        }
        return pagesArray;
      }
    },
    methods: {
      getItems: function(page) {
        if(parseInt(this.tosearch_anio_desde) > parseInt(this.tosearch_anio_hasta)) {
          iziToast.show({
            class: 'iziToast-danger',
            title: '¡Error¡',
            message: 'El año posterior no debe ser mayor al anterior',
            position: 'topRight',
            icon: 'fe-icon-x-circle'
          });
          return;
        }
        this.loader = true;
        var url = '/axios/vue/proyectos-investigacion/get-items?page=' + page + '&search=' + this.search + '&qty_toshow=' + this.qty_toshow + '&tosearch_anio_desde=' + this.tosearch_anio_desde + '&tosearch_anio_hasta=' + this.tosearch_anio_hasta + '&tosearch_facultad=' + JSON.stringify(this.tosearch_facultad) + '&tosearch_tipo_financiacion=' + JSON.stringify(this.tosearch_tipo_financiacion);
        axios.get(url).then(response => {
          this.items = response.data.items.data;
          this.pagination = response.data.pagination;
          this.tipos_financiacion = response.data.tipos_financiacion;
          this.facultades = response.data.facultades;
          this.loader = false;
        });
      },
      changePage: function(page) {
        this.pagination.current_page = page;
        this.getItems(page);
        this.thisPage = page;
      },
      searchItems: function() {
        this.getItems();
        this.thisPage = 1;
      },
    },
  });
</script><?php /**PATH /var/www/appVRI/resources/views/web/vue/proyectos-investigacion.blade.php ENDPATH**/ ?>