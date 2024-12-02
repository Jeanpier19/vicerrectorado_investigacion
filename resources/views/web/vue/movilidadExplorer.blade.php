<script type="module">
    let main = new Vue({
        el: "#main",
        data: {
            preLoader: true,
            loader: true,
            universidades: [],
            total: 0,
            perPage: 10,
            currentPage: 1,
            lastPage: 1,
        },
        mounted: function() {
            this.preLoader = false;
            this.getInstituciones();
        },
        methods: {
            getInstituciones: function(page = 1, perPage = 8) {
                this.loader = true;
                var url =
                    `/axios/vue/cooperacion/movilidadExplorer/instituciones_get_items?page=${page}&per_page=${perPage}`;
                axios.get(url).then(response => {
                    this.universidades = response.data.data || [];
                    this.total = response.data.total;
                    this.perPage = response.data.per_page;
                    this.currentPage = response.data.current_page;
                    this.lastPage = response.data.last_page;

                    this.pages = this.paginate(this.currentPage, this.lastPage);

                    this.loader = false;
                }).catch(error => {
                    console.error("Error al obtener las instituciones:", error);
                    this.loader = false;
                });
            },
            changePage: function(page) {
                if (page >= 1 && page <= this.lastPage) {
                    this.getInstituciones(page, this.perPage);
                }
            },
            paginate: function(currentPage, lastPage) {
                const pageNumbers = [];
                const maxPages = 5;

                if (lastPage <= maxPages) {
                    for (let i = 1; i <= lastPage; i++) {
                        pageNumbers.push(i);
                    }
                } else {
                    if (currentPage <= 3) {

                        for (let i = 1; i <= 3; i++) {
                            pageNumbers.push(i);
                        }
                        pageNumbers.push('...');
                        pageNumbers.push(lastPage);
                    } else if (currentPage >= lastPage - 2) {

                        pageNumbers.push(1);
                        pageNumbers.push('...');
                        for (let i = lastPage - 2; i <= lastPage; i++) {
                            pageNumbers.push(i);
                        }
                    } else {

                        pageNumbers.push(1);
                        pageNumbers.push('...');
                        for (let i = currentPage - 1; i <= currentPage + 1; i++) {
                            pageNumbers.push(i);
                        }
                        pageNumbers.push('...');
                        pageNumbers.push(lastPage);
                    }
                }

                return pageNumbers;
            }
        }
    });
</script>
