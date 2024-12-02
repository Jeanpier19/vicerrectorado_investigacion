@extends('layouts.web.master')
@section('title', 'Home | ')
@section('custom_css')
    <style>
        .custom-control-link {
            display: inline-block;
            padding: 10px 20px;
            border: 1px solid #ececec;
            color: #000;
            text-decoration: none;
            text-align: left;
        }

        .custom-control-link:hover {
            background-color: #6771DC;
            color: #fff;
        }

        #chartdiv {
            width: 50%;
            margin: 0 auto;
            height: 450px;
        }

        .tarjeta {
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .tarjeta-body {
            height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-text {
            padding-left: 1rem;
        }

        .card-text h5 {
            font-size: 2rem;
            font-weight: bold;
            color: #fff;
        }

        .card-text p {
            font-size: 18px;
            color: #fff;
        }


        .enlace-viaje {
            width: 100%;
            text-align: center;
            color: #fff;
            font-size: 1.5rem;
            background: #abb0d4;
            padding: 10px 1.5rem;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        .enlace-viaje:hover {
            background: #9a9ec0;
            color: #fff;
        }

        .texto-viaje {
            margin-right: 10px;
        }

        .icono-viaje {
            width: 20px;
            height: 20px;
            margin-left: 8px;
        }
    </style>
@endsection
@section('content')
    <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título"
        style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
        <div class="container text-left align-self-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('web.index') }}">Inicio</a></li>
                </ol>
            </nav>
            <h1 class="page-title-heading mt-3">Movilidad</h1>
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
        <div>
            <template v-if="!preLoader">
                <div class="row">
                    <div class="col-xl-2 col-lg-3">
                        <a class="offcanvas-toggle" href="#filters" data-toggle="offcanvas"><i
                                class="fe-icon-sidebar"></i></a>
                        <aside class="offcanvas-container" id="filters">
                            <div class="offcanvas-scrollable-area px-4 pt-5 px-lg-0 pt-lg-0"><span
                                    class="offcanvas-close"><i class="fe-icon-x"></i></span>
                                <div class="widget">
                                    <h4 class="widget-title"><i class="fe-icon-filter"></i> Año</h4>
                                    <div class="custom-control custom-checkbox">
                                        <select class="form-control mb-3" id="tosearch_semestre" v-model="tosearch_semestre"
                                            @change="changeSemestre()">
                                            <option v-for="item in semestres" :value="item.id"
                                                v-text="item.anio + '-' + item.periodo"></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="widget">
                                    <div class="custom-control custom-anchor">
                                        <a href="#Reportes" class="custom-control-link w-100">
                                            Reportes
                                        </a>
                                        <a href="{{ route('web.movilidadE') }}" class="custom-control-link w-100">
                                            Explora tus oportunidades
                                        </a>
                                        <a href="{{ route('web.movilidad') }}" class="custom-control-link w-100">
                                            Registros
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                    <div class="col-xl-10 col-10">
                        <div class="row">
                            <div id="chartdiv"></div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="row d-flex justify-content-center gap-3 mt-2">
                            <div class="row">
                                <div v-if="viajes.length === 0" class="col-12 text-center">
                                    <p>No hay viajes en el semestre seleccionado.</p>
                                </div>
                                <div v-for="(viaje, index) in viajes" :key="viaje.abreviatura" class="col-md-4">
                                    <div class="tarjeta" style="width: 20rem;">
                                        <div class="tarjeta-body" :style="{ backgroundColor: getColor(index) }">
                                            <div class="card-text">
                                                <h5>@{{ viaje.total }}</h5>
                                                <p v-text="viaje.total > 1 ? `viajes` : `viaje`">.</p>
                                            </div>
                                            <a href="#" data-toggle="modal" data-target="#myModal"
                                                @click="handled(viaje.abreviatura)" class="btn enlace-viaje">
                                                <span class="texto-viaje">@{{ viaje.abreviatura }}</span>
                                                <img src="/archivos/imagenes/EnlaceModal.svg" class="icono-viaje"
                                                    alt="Icono Modal"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document" style="max-width: 70%;">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row col-md-12">
                            <div class="col-md-12">
                                <div class="widget">
                                    <h4 class="widget-title"><img src="/archivos/imagenes/Facultad.svg" alt="">
                                        FACULTAD
                                    </h4>
                                    <div class="custom-control custom-checkbox">
                                        <label class="form-label" for="" v-text="facultad"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <div class="col-md-6 gap-3">
                                <div class="widget" style="height: 550px;">
                                    <h4 class="widget-title"><img src="/archivos/imagenes/Universidad.svg"
                                            alt="">
                                        UNIVERSIDADES VISITADAS</h4>
                                    <div class="row">
                                        <div id="secondaryChartdiv" style="width: 100%; height: 400px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 gap-3">
                                <div class="widget" style="height: 550px;">
                                    <h4 class="widget-title"><img src="/archivos/imagenes/Pais.svg" alt="">
                                        PAISES
                                        VISITADOS</h4>
                                    <div class="custom-control custom-checkbox">
                                        <div class="row">
                                            <div id="tertiaryChartdiv" style="width: 100%; height: 400px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('custom_js')
    @include('web.vue.movilidadPrincipal')
@endsection
