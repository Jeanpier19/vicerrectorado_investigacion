<script type="text/javascript">
  let main = new Vue({
    el: '#main',
    data:{
      preLoader: true,
      loader: true,
      items: {},
      tipos_convenio_especifico: {},
      facultades: {},
      files: {},
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
      tosearch_tipo: '2',
      tosearch_facultad: [],
      tosearch_tipo_convenio_especifico: [],
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
        this.loader = true;
        var url = '/axios/vue/cooperacion/convenios/get-items?page=' + page + '&search=' + this.search + '&qty_toshow=' + this.qty_toshow + '&tosearch_tipo=' + this.tosearch_tipo + '&tosearch_facultad=' + JSON.stringify(this.tosearch_facultad) + '&tosearch_tipo_convenio_especifico=' + JSON.stringify(this.tosearch_tipo_convenio_especifico);
        axios.get(url).then(response => {
          this.items = response.data.items.data;
          this.pagination = response.data.pagination;
          this.facultades = response.data.facultades;
          this.tipos_convenio_especifico = response.data.tipos_convenio_especifico;
          this.files = response.data.files;
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
      exportExcel: function() {
        this.divPreLoader = true;
        var url = '/axios/vue/cooperacion/convenios/export';
        let data = new FormData();
        data.append('type', 1);
        data.append('search', this.search);
        data.append('qty_toshow', this.qty_toshow);
        data.append('tipo_convenio', this.tipo_convenio);
        data.append('tipo_convenio_especifico_id', this.tipo_convenio_especifico_id);
        data.append('facultad_id', this.facultad_id);
        data.append('_method', 'POST');
        axios.post(url, data).then(() => {
          iziToast.show({
            class: 'iziToast-success',
            title: '¡Excel',
            message: 'generado correctamente!',
            position: 'topRight',
            icon: 'fe-icon-check-circle'
          });
          this.divPreLoader = false;
        }).catch(() => {
          this.divPreLoader = false;
        });
      },
      getPDF(temp){
        var doc = "<?php echo e(asset('/')); ?>archivos/documentos/convenios/"+ temp;
        return doc;
      },
    },
  });
</script><?php /**PATH /var/www/appVRI/resources/views/web/vue/convenios.blade.php ENDPATH**/ ?>