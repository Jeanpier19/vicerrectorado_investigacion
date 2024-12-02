@extends('layouts.web.master')
@section('title', 'Explorer | ')
@section('custom_css')
    <style>
        .custom-control {
            display: flex;
            flex-wrap: wrap;
        }

        .custom-control-link {
            display: inline-block;
            padding: 10px 20px;
            border: 1px solid #ececec;
            color: #000;
            text-decoration: none;
            text-align: left;
            width: 100%;
            box-sizing: border-box;
        }

        .custom-control-link:hover {
            background-color: #6771DC;
            color: #fff;
        }

        .color-btn {
            background: #717DF8;
            color: #fff;
            margin-top: 1rem;
            height: 40px;
            border-radius: 5px;
        }

        @media (min-width: 768px) {
            .custom-control {
                flex-direction: row;
            }

            .custom-control-link {
                width: auto;
                flex: 1;
            }
        }

        @media (max-width: 767px) {
            .custom-control {
                flex-direction: column;
            }

            .custom-control-link {
                font-size: 14px;
                padding: 8px 15px;
                width: 100%;
            }
        }

        .card {
            margin: 0 auto;
            height: 20rem;
            min-height: 250px;

            & img {
                height: 50%;
                object-fit: contain;
            }
        }

        .card-title {
            font-size: 13px;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            overflow: hidden;
            min-height: 50px;
        }

        .pagination .page-item .page-link {
            color: #007bff;
            border-radius: 0.25rem;
        }

        .pagination .page-item .page-link:hover {
            background-color: #717DF8 !important;
            color: white;
        }

        .pagination .page-item.active .page-link {
            background-color: #717DF8;
            color: white;
        }

        .pagination .page-item.disabled .page-link {
            color: #ccc;
            pointer-events: none;
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
                    <div class="col-xl-12 col-lg-12">
                        <div class="row">
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <h1>Explora tus oportunidades</h1>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <div class="custom-control custom-anchor">
                                    <a href="{{ route('web.movilidadP') }}" class="custom-control-link w-100">
                                        Reportes
                                    </a>
                                    <a href="#Explora" class="custom-control-link w-100">
                                        Explora tus oportunidades
                                    </a>
                                    <a href="{{ route('web.movilidad') }}" class="custom-control-link w-100">
                                        Registros
                                    </a>
                                </div>
                            </div>
                        </div>
                        {{-- Tarjetas --}}
                        <div class="row justify-content-center text-center">
                            <div class="col-xl-12 col-lg-12">
                                <div class="row fila justify-content-center">
                                    <div v-if="!preLoader" v-for="universidad in universidades" :key="universidad.id"
                                        class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex justify-content-center">
                                        <div class="card" style="width: 18rem;">
                                            <img :src="universidad.logos ? `/archivos/imagenes/instituciones/${universidad.logos}` : '/archivos/imagenes/Universidad.svg'"
                                                alt="Universidad">
                                            <div class="card-body">
                                                <h5 class="card-title">@{{ universidad.nombre }}</h5>
                                                <a :href="universidad.enlace" :target="universidad.enlace ? '_blank' : '_top'"
                                                    class="btn color-btn">Procedimiento</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <!-- Paginación -->
                                <nav aria-label="Page navigation example" v-if="total > perPage">
                                    <ul class="pagination justify-content-center">

                                        <li class="page-item" :class="{ 'disabled': currentPage === 1 }">
                                            <a class="page-link" href="#" @click.prevent="changePage(currentPage - 1)"
                                                aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>

                                        <li v-for="(page, index) in pages" :key="index" class="page-item"
                                            :class="{ 'active': currentPage === page }">

                                            <a v-if="page !== '...'" class="page-link" href="#"
                                                @click.prevent="changePage(page)">
                                                @{{ page }}
                                            </a>
                                            <span v-else class="page-link">...</span>
                                        </li>

                                        <li class="page-item" :class="{ 'disabled': currentPage === lastPage }">
                                            <a class="page-link" href="#" @click.prevent="changePage(currentPage + 1)"
                                                aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
            </template>
        </div>
    </section>
@endsection
@section('custom_js')
    @include('web.vue.movilidadExplorer')
@endsection
