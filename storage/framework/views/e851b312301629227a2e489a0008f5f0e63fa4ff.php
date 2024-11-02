<script type="text/javascript">
  let main = new Vue({
    el: '#main',
    data:{
      loader: true,
      items: {},
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
      qty_toshow: '',
    },
    created: function() {
      this.getItems(this.thisPage);
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
        var url = '/axios/vue/areas-investigacion/get-items?page=' + page + '&search=' + this.search + '&qty_toshow=' + this.qty_toshow;
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
    },
  });
</script><?php /**PATH /var/www/appVRI/resources/views/web/vue/areas-investigacion.blade.php ENDPATH**/ ?>