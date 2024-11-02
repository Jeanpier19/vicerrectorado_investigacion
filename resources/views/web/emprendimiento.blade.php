{{-- @extends('layouts.web.master')
@section('title', 'Emprendimiento - Proyectos de emprendimiento - Vicerectorado de Investigación VRI UNASAM - Dirección del Instituto de Investigación DII UNASAM - Universidad Nacional Santiago Antúnez de Mayolo UNASAM')
@section('content')
	<section class="section">
		<div class="container">
			<h1 class="wow fadeInDown">Proyectos de emprendimiento</h1>
			<hr class="wow fadeInDown">
			<div class="form-row">
				<div class="form-group col-lg-4 wow fadeInLeft">
					<label for="" class="font-weight-bold">Año</label>
					<select name="" class="form-control">
						<option value="">Todos...</option>
						<option value="2019">2019</option>
						<option value="2018">2018</option>
						<option value="2017">2017</option>
						<option value="2016">2016</option>
						<option value="2015">2015</option>
					</select>
				</div>
				<div class="form-group col-lg-4 wow fadeInRight">
					<label for="" class="font-weight-bold">Facultad</label>
					<select name="" class="form-control">
						<option value="">Todos...</option>
						<option value="2019">Facultad de Ciencias</option>
						<option value="2019">Facultad de Ingenieria Civil</option>
					</select>
				</div>
				<div class="form-group col-lg-4 wow fadeInRight">
					<label for="" class="font-weight-bold">Estado</label>
					<select name="" class="form-control">
						<option value="">Todos...</option>
						<option value="2019">Vigente</option>
						<option value="2019">Finalziado</option>
					</select>
				</div>
			</div>
			<div class="text-center text-lg-right wow fadeInDown">
				<a href="#" class="btn btn-outline-primary-dii">
					<i class="fas fa-fw fa-search"></i>
					Buscar
				</a>
			</div>
			<div class="table-responsive wow fadeInUp">
				<h2 class="mb-3 text-center" style="font-size: 20px">Lista de todos los proyectos de emprendimiento</h2>
				<table class="table table-primary-dii table-striped table-hover">
					<thead>
						<tr>
							<th>Título</th>
							<th style="min-width: 150px">Objetivo</th>
							<th style="min-width: 160px">Resultados esperados</th>
							<th style="min-width: 120px">Fecha de inicio</th>
							<th style="min-width: 160px">Fecha de finalización</th>
							<th style="min-width: 120px">Presupuesto</th>
							<th>Estado</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>La temperatura de enfriamiento y el método de recogida y sus efectos en la calidad de la leche cruda en el Centro Experimental de Tingua</td>
							<td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
							<td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
							<td>01/01/2019</td>
							<td>01/05/2019</td>
							<td>
								<a href="#" class="btn btn-danger-dii">
									<i class="fas fa-fw fa-file-pdf"></i>		
								</a>
							</td>
							<td>Activo</td>
						</tr>
						<tr>
							<td>La temperatura de enfriamiento y el método de recogida y sus efectos en la calidad de la leche cruda en el Centro Experimental de Tingua</td>
							<td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
							<td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
							<td>01/01/2019</td>
							<td>01/05/2019</td>
							<td>
								<a href="#" class="btn btn-danger-dii">
									<i class="fas fa-fw fa-file-pdf"></i>		
								</a>
							</td>
							<td>Activo</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="text-center text-lg-right wow fadeInDown mt-3">
                <a href="#" class="btn btn-outline-success-dii">
                    <i class="fas fa-fw fa-file-excel"></i>
                    Exportar Excel
                </a>
                <a href="#" class="btn btn-outline-danger-dii">
                    <i class="fas fa-fw fa-file-pdf"></i>
                    Exportar PDF
                </a>
            </div>
		</div>
	</section>
@stop --}}

@extends('layouts.web.master')
@section('title', 'Proyectos de Emprendimiento | ')
@section('content')
  <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
    <div class="container text-left align-self-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('web.index') }}">Inicio</a></li>
        </ol>
      </nav>
      <h1 class="page-title-heading mt-3">Proyectos de Emprendimiento</h1>
    </div>
  </div>
  <section class="container pt-3 mb-3">
    
  </section>
@endsection