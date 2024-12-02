<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<script type="module">
    let main = new Vue({
        el: '#main',
        data: {
            preLoader: true,
            loader: true,
            semestres: {},
            abreviatura: '',
            semestre_id: '',
            viajes: [],
            universidades: [],
            paises: [],
            facultad: '',
            tosearch_semestre: '4',
            chart: null,
            secondaryChart: null,
            tertiaryChart: null,
            root: null,
            root2: null,
            root3: null,
            xAxis: null,
            xAxis2: null,
            xAxis3: null,
            series: null,
            series2: null,
            series3: null,
        },
        created: function() {
            this.getSemestres();
        },
        mounted: function() {
            this.preLoader = false;
            this.$nextTick(() => {
                const chartElement = document.getElementById('chartdiv');
                if (chartElement) {
                    this.initChart();
                    this.updateChart();
                } else {
                    console.error('No se encontró el contenedor con id "chartdiv".');
                }

                const secondaryChartElement = document.getElementById('secondaryChartdiv');
                if (secondaryChartElement) {
                    this.initSecondaryChart();
                    this.updateSecondaryChart();
                } else {
                    console.error('No se encontró el contenedor con id "secondaryChartdiv".');
                }

                const tertiaryChartElement = document.getElementById('tertiaryChartdiv');
                if (tertiaryChartElement) {
                    this.initTertiaryChart();
                    this.updateTertiaryChart();
                } else {
                    console.error('No se encontró el contenedor con id "tertiaryChartdiv".');
                }
            });
        },
        methods: {
            getColor(index) {
                const predefinedColors = [
                    "#67b7dc", "#6794dc", "#6771dc", "#8067dc", "#a367dc",
                    "#c767dc", "#dc67ce", "#dc67ab", "#dc6788", "#dc6967",
                    "#dc8c67"
                ];
                return predefinedColors[index % predefinedColors.length];
            },
            changeSemestre: function() {
                this.updateChart();
                this.semestre_id = this.tosearch_semestre;
            },
            handled: function(abreviatura) {
                this.updateSecondaryChart(abreviatura);
                this.updateTertiaryChart(abreviatura);
                this.getFacultad(abreviatura);
            },
            getFacultad: function(abreviatura) {
                if (!abreviatura) {
                    console.error("No se capturó la abreviatura de la facultad");
                    return;
                }
                this.loader = true;
                const url =
                    `/axios/vue/cooperacion/movilidadPrincipal/facultad_get_item?facultad=${abreviatura}`;
                axios
                    .get(url)
                    .then((response) => {
                        this.facultad = response.data;
                        this.loader = false;
                    })
                    .catch((error) => {
                        console.error("Error al obtener la facultad:", error);
                        this.loader = false;
                    });
            },
            getSemestres: function() {
                this.loader = true;
                var url = '/axios/vue/cooperacion/movilidadPrincipal/get-graphic-items';
                axios.get(url).then(response => {
                    this.semestres = response.data.semestres;
                    this.loader = false;
                }).catch(error => {
                    console.error('Error al obtener los semestres:', error);
                    this.loader = false;
                });
            },
            // Grafico Principal
            initChart: function() {
                this.root = am5.Root.new("chartdiv");

                this.root.setThemes([am5themes_Animated.new(this.root)]);

                this.chart = this.root.container.children.push(am5xy.XYChart.new(this.root, {
                    panX: true,
                    panY: true,
                    wheelX: "panX",
                    wheelY: "zoomX",
                    pinchZoomX: true,
                    paddingLeft: 0,
                    paddingRight: 1
                }));

                var cursor = this.chart.set("cursor", am5xy.XYCursor.new(this.root, {}));
                cursor.lineY.set("visible", false);

                var xRenderer = am5xy.AxisRendererX.new(this.root, {
                    minGridDistance: 30,
                    minorGridEnabled: true
                });

                xRenderer.labels.template.setAll({
                    rotation: -90,
                    centerY: am5.p50,
                    centerX: am5.p100,
                    paddingRight: 15
                });

                xRenderer.grid.template.setAll({
                    location: 1
                });

                this.xAxis = this.chart.xAxes.push(am5xy.CategoryAxis.new(this.root, {
                    maxDeviation: 0.3,
                    categoryField: "abreviatura",
                    renderer: xRenderer,
                    tooltip: am5.Tooltip.new(this.root, {})
                }));

                var yRenderer = am5xy.AxisRendererY.new(this.root, {
                    strokeOpacity: 0.1
                });

                var yAxis = this.chart.yAxes.push(am5xy.ValueAxis.new(this.root, {
                    maxDeviation: 0.3,
                    renderer: yRenderer
                }));

                this.series = this.chart.series.push(am5xy.ColumnSeries.new(this.root, {
                    name: "Series 1",
                    xAxis: this.xAxis,
                    yAxis: yAxis,
                    valueYField: "total",
                    sequencedInterpolation: true,
                    categoryXField: "abreviatura",
                    tooltip: am5.Tooltip.new(this.root, {
                        labelText: "{valueY}"
                    })
                }));

                this.series.columns.template.setAll({
                    cornerRadiusTL: 5,
                    cornerRadiusTR: 5,
                    strokeOpacity: 0
                });

                // Lista de colores predefinidos
                const predefinedColors = [
                    "#67b7dc", "#6794dc", "#6771dc", "#8067dc", "#a367dc",
                    "#c767dc", "#dc67ce", "#dc67ab", "#dc6788", "#dc6967",
                    "#dc8c67"
                ];

                this.chart.set("colors", am5.ColorSet.new(this.root, {
                    colors: predefinedColors.map(color => am5.color(color)),
                    reuse: true
                }));

                this.series.columns.template.adapters.add("fill", (fill, target) => {
                    return this.chart.get("colors").getIndex(this.series.columns.indexOf(target));
                });

                this.series.columns.template.adapters.add("stroke", (stroke, target) => {
                    return this.chart.get("colors").getIndex(this.series.columns.indexOf(target));
                });
            },
            updateChart: function() {
                this.loader = true;
                let url = '/axios/vue/cooperacion/movilidadPrincipal/get-graphic-items';

                if (this.tosearch_semestre) {
                    url += `?tosearch_semestre=${this.tosearch_semestre}`;
                }

                axios.get(url)
                    .then(response => {
                        const data = response.data;

                        if (data.viajes && Array.isArray(data.viajes) && data.viajes.length > 0) {
                            this.viajes = data.viajes;

                            const chartData = data.viajes.map(viaje => ({
                                abreviatura: viaje.abreviatura,
                                total: viaje.total
                            }));

                            this.xAxis.data.setAll(chartData);
                            this.series.data.setAll(chartData);

                            this.series.appear(1000);
                            this.chart.appear(1000, 100);
                        } else {
                            console.log('No se encontraron datos para viajes');
                            this.viajes = [];
                        }

                        this.loader = false;
                    })
                    .catch(error => {
                        console.error("Error al cargar datos del gráfico:", error);
                        this.loader = false;
                    });
            },

            // Gráfico Secundario
            initSecondaryChart: function() {
                this.root2 = am5.Root.new("secondaryChartdiv");

                this.root2.setThemes([am5themes_Animated.new(this.root2)]);

                this.secondaryChart = this.root2.container.children.push(am5xy.XYChart.new(this.root2, {
                    panX: true,
                    panY: true,
                    wheelX: "panX",
                    wheelY: "zoomX",
                    pinchZoomX: true,
                    paddingLeft: 0,
                    paddingRight: 1
                }));

                var cursor = this.secondaryChart.set("cursor", am5xy.XYCursor.new(this.root2, {}));
                cursor.lineY.set("visible", false);

                var xRenderer = am5xy.AxisRendererX.new(this.root2, {
                    minGridDistance: 30,
                    minorGridEnabled: true
                });

                xRenderer.labels.template.setAll({
                    oversizedBehavior: "wrap",
                    textAlign: "center",
                    maxWidth: 100
                });

                xRenderer.grid.template.setAll({
                    location: 1
                });

                this.xAxis2 = this.secondaryChart.xAxes.push(am5xy.CategoryAxis.new(this.root2, {
                    maxDeviation: 0.3,
                    categoryField: "nombre",
                    renderer: xRenderer,
                    tooltip: am5.Tooltip.new(this.root2, {})
                }));

                var yRenderer = am5xy.AxisRendererY.new(this.root2, {
                    strokeOpacity: 0.1
                });

                var yAxis = this.secondaryChart.yAxes.push(am5xy.ValueAxis.new(this.root2, {
                    maxDeviation: 0.3,
                    renderer: yRenderer
                }));

                this.series2 = this.secondaryChart.series.push(am5xy.ColumnSeries.new(this.root2, {
                    name: "Secondary Series",
                    xAxis: this.xAxis2,
                    yAxis: yAxis,
                    valueYField: "count",
                    sequencedInterpolation: true,
                    categoryXField: "nombre",
                    tooltip: am5.Tooltip.new(this.root2, {
                        labelText: "{valueY}"
                    })
                }));

                this.series2.columns.template.setAll({
                    cornerRadiusTL: 5,
                    cornerRadiusTR: 5,
                    strokeOpacity: 0
                });

                // Lista de colores predefinidos
                const predefinedColors = [
                    "#67b7dc", "#6794dc", "#6771dc", "#8067dc", "#a367dc",
                    "#c767dc", "#dc67ce", "#dc67ab", "#dc6788", "#dc6967",
                    "#dc8c67"
                ];

                this.secondaryChart.set("colors", am5.ColorSet.new(this.root, {
                    colors: predefinedColors.map(color => am5.color(color)),
                    reuse: true
                }));

                this.series2.columns.template.adapters.add("fill", (fill, target) => {
                    return this.secondaryChart.get("colors").getIndex(this.series2.columns.indexOf(
                        target));
                });

                this.series2.columns.template.adapters.add("stroke", (stroke, target) => {
                    return this.secondaryChart.get("colors").getIndex(this.series2.columns.indexOf(
                        target));
                });
            },
            updateSecondaryChart: function(abreviatura) {
                this.loader = true;
                if (!abreviatura) {
                    return;
                }
                let url = '/axios/vue/cooperacion/movilidadPrincipal/universidades_get_items';

                if (this.tosearch_semestre) {
                    url += `?semestre_id=${this.tosearch_semestre}`;
                    url += `&abreviatura=${abreviatura}`;
                }

                axios.get(url)
                    .then(response => {
                        const data = response.data;

                        if (data.universidades && Array.isArray(data.universidades) && data
                            .universidades.length > 0) {
                            this.universidades = data.universidades;

                            const chartData = data.universidades.map(universidad => ({
                                nombre: universidad.nombre,
                                count: universidad.count
                            }));

                            this.xAxis2.data.setAll(chartData);
                            this.series2.data.setAll(chartData);

                            this.series2.appear(1000);
                            this.secondaryChart.appear(1000, 100);

                        } else {
                            console.log('No se encontraron datos para universidades');
                            this.universidades = [];
                        }

                        this.loader = false;
                    })
                    .catch(error => {
                        console.error("Error al cargar datos del gráfico:", error);
                        this.loader = false;
                    });
            },

            // Gráfico Terciario
            initTertiaryChart: function() {
                this.root3 = am5.Root.new("tertiaryChartdiv");

                this.root3.setThemes([am5themes_Animated.new(this.root3)]);

                this.tertiaryChart = this.root3.container.children.push(am5xy.XYChart.new(this.root3, {
                    panX: true,
                    panY: true,
                    wheelX: "panX",
                    wheelY: "zoomX",
                    pinchZoomX: true,
                    paddingLeft: 0,
                    paddingRight: 1
                }));

                var cursor = this.tertiaryChart.set("cursor", am5xy.XYCursor.new(this.root3, {}));
                cursor.lineY.set("visible", false);

                var xRenderer = am5xy.AxisRendererX.new(this.root3, {
                    minGridDistance: 30,
                    minorGridEnabled: true
                });

                xRenderer.labels.template.setAll({
                    rotation: -90,
                    centerY: am5.p50,
                    centerX: am5.p100,
                    paddingRight: 15
                });

                xRenderer.grid.template.setAll({
                    location: 1
                });

                this.xAxis3 = this.tertiaryChart.xAxes.push(am5xy.CategoryAxis.new(this.root3, {
                    maxDeviation: 0.3,
                    categoryField: "nombre",
                    renderer: xRenderer,
                    tooltip: am5.Tooltip.new(this.root3, {})
                }));

                var yRenderer = am5xy.AxisRendererY.new(this.root3, {
                    strokeOpacity: 0.1
                });

                var yAxis = this.tertiaryChart.yAxes.push(am5xy.ValueAxis.new(this.root3, {
                    maxDeviation: 0.3,
                    renderer: yRenderer
                }));

                this.series3 = this.tertiaryChart.series.push(am5xy.ColumnSeries.new(this.root3, {
                    name: "Tertiary Series",
                    xAxis: this.xAxis3,
                    yAxis: yAxis,
                    valueYField: "count",
                    sequencedInterpolation: true,
                    categoryXField: "nombre",
                    tooltip: am5.Tooltip.new(this.root3, {
                        labelText: "{valueY}"
                    })
                }));

                this.series3.columns.template.setAll({
                    cornerRadiusTL: 5,
                    cornerRadiusTR: 5,
                    strokeOpacity: 0
                });

                // Lista de colores predefinidos
                const predefinedColors = [
                    "#67b7dc", "#6794dc", "#6771dc", "#8067dc", "#a367dc",
                    "#c767dc", "#dc67ce", "#dc67ab", "#dc6788", "#dc6967",
                    "#dc8c67"
                ];

                this.tertiaryChart.set("colors", am5.ColorSet.new(this.root, {
                    colors: predefinedColors.map(color => am5.color(color)),
                    reuse: true
                }));

                this.series3.columns.template.adapters.add("fill", (fill, target) => {
                    return this.tertiaryChart.get("colors").getIndex(this.series3.columns.indexOf(
                        target));
                });

                this.series3.columns.template.adapters.add("stroke", (stroke, target) => {
                    return this.tertiaryChart.get("colors").getIndex(this.series3.columns.indexOf(
                        target));
                });
            },
            updateTertiaryChart: function(abreviatura) {
                this.loader = true;
                if (!abreviatura) {
                    return;
                }
                let url = '/axios/vue/cooperacion/movilidadPrincipal/paises_get_items';

                if (this.tosearch_semestre) {
                    url += `?semestre_id=${this.tosearch_semestre}`;
                    url += `&abreviatura=${abreviatura}`;
                }

                axios.get(url)
                    .then(response => {
                        const data = response.data;

                        if (data.paises && Array.isArray(data.paises) && data.paises.length > 0) {
                            this.paises = data.paises;

                            const chartData = data.paises.map(pais => ({
                                nombre: pais.nombre,
                                count: pais.count
                            }));

                            this.xAxis3.data.setAll(chartData);
                            this.series3.data.setAll(chartData);

                            this.series3.appear(1000);
                            this.tertiaryChart.appear(1000, 100);
                        } else {
                            console.log('No se encontraron datos para paises');
                            this.paises = [];
                        }

                        this.loader = false;
                    })
                    .catch(error => {
                        console.error("Error al cargar datos del gráfico:", error);
                        this.loader = false;
                    });
            },
        },
    });
</script>
