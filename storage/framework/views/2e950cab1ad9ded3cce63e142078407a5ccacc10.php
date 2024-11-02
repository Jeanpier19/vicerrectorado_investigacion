<script type="text/javascript">
  let main = new Vue({
    el: '#main',
    data:{
      preLoader: true,
      loader: true,
      items: {},
      investigador: null,
      pagination: {
        'total': 0,
        'per_page': 0,
        'current_page': 0,
        'last_page': 0,
        'from': 0,
        'to': 0
      },
      newItem: '',
      errors: [],
      divLoaderRegister: false, 
      offset: 6,
      thisPage: 1,
      // search
      search: '',
      qty_toshow: 10,
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
        var url = '/axios/vue/investigacion/investigadores/get-items?page=' + page + '&search=' + this.search + '&qty_toshow=' + this.qty_toshow;
        axios.get(url).then(response => {
          this.items = response.data.items.data;
          this.pagination = response.data.pagination;
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
      truncateText: function(text, length) {
        if(text.length > length)
          return text.substring(0, length) + '...';
        else
          return text;
      },
      openProjectsModal(item) {
        this.investigador = item;
        $('#modalProjects').modal({ show: true });
      },
      openPublicationsModal(item) {
        this.investigador = item;
        $('#modalPublications').modal({ show: true });
      },
      getItemImage(user) {
        let imagePath = null;
        if(user.image != null && user.image != '') {
          imagePath = "/archivos/imagenes/usuarios/" + user.image.path;
        }else if(user.persona.genero == 'Masculino') {
            imagePath = "/archivos/imagenes/usuario-masculino.jpg";
        }else {
          imagePath = "/archivos/imagenes/usuario-femenino.jpg";
        }
        return imagePath;
      },
    },
  });
</script><?php /**PATH D:\1. Tecnología Web\Proyecto\SEMANA IX\appVRI\resources\views/web/vue/investigadores.blade.php ENDPATH**/ ?>