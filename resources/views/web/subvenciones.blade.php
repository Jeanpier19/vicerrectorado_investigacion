@extends('layouts.web.master')
@section('title', 'Subvenciones | ')
@section('content')
  <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
    <div class="container text-left align-self-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('web.index') }}">Inicio</a></li>
        </ol>
      </nav>
      <h1 class="page-title-heading mt-3">Subvenciones</h1>
    </div>
  </div>
	<section class="container pt-3 mb-3 section-requirements">
			<div class="row">
				<!--===============================
				=            Nav Pills            =
				================================-->
				<div class="col-lg-3 wow fadeInLeft mb-3">
					<!-- Nav pills -->
					<ul class="nav nav-pills flex-column">
					  <li class="nav-item">
					    <a class="nav-link active" data-toggle="pill" href="#tab1">Convocatoria</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" data-toggle="pill" href="#tab2">Solicitudes</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" data-toggle="pill" href="#tab3">Aprobación</a>
					  </li>
					</ul>
				</div>
				<!--====  End of Nav Pills  ====-->
				<!--===============================
				=            Tab Panes            =
				================================-->
				<div class="col-9 wow fadeInRight">
					<div class="tab-content">
					  <div class="tab-pane container fade show p-0 active" id="tab1">
					  	<h2>Convocatoria</h2>
					  	<hr>
					  	<p>Las soluciones se harán con no menos de dos meses de anticipación a la fecha de la realización del Evento Académico. Se entiende Evento Académico como toda actividad de carácter académico de corta duración, tales como conferencias, seminarios, talleres, cursos especializados, estadías cortas de investigación.</p>
					  	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					  	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					  	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					  	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					  	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					  	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					  	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					  	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					  	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					  	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					  	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					  	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					  </div>
					  <div class="tab-pane container fade show p-0" id="tab2">
					  	<h2>Solicitudes</h2>
					  	<hr>
					  	<h3 style="font-size: 18px; color: #333">Estudiantes de pre-grado y post-grado</h3>
			            <p>Los estudiantes de pre-grado y posgrado que soliciten la subvención deben presentar los siguientes documentos y requisitos:</p>
			            <ul style="list-style: disc; margin-left: 20px">
			            	<li>Carta del Decano al Vicerrector de Investigación solicitando el apoyo.</li>
			            	<li>Aceptación de participación al Evento Académico, y evidencia de haber solicitado apoyo económico a los organizadores.</li>
			            	<li>Resumen del trabajo a presentar: Póster o exposición oral en caso de conferencia, o plan de trabajo si fuera estadía.</li>
			            	<li>Pertenecer preferentemente al tercio superior, con copia del documento que lo indique, si es estudiante de pre-grado.</li>
			            	<li>Carta de compromiso que el trabajo estará en los “Proceedings” de la Conferencia o resumen de la estadía de investigación, según el caso. Se entregará al Vicerrectorado de Investigación copia relevante el libro de resúmenes del Evento Académico dentro de un plazo máximo de un año.</li>
			            	<li>El apoyo para el estudiante será de una vez por año, preferentemente.</li>
			            	<li>Si el trabajo es en grupo, sólo se apoyará a un estudiante en representación del grupo para que presente el trabajo.</li>
			            	<li>Se dará apoyo a aquellos trabajos que sean producto de un proyecto de investigación registrado en la , o el trabajo de tesis. En cualquier caso, tiene que ser visado por el Instituto de Investigación de la Facultad.</li>
			            </ul>
			            <p>Según la disponibilidad de los recursos, se podrá financiar parte o la totalidad del evento. Se dará preferencia a aquellos postulantes que son subvencionados parcialmente por la Facultad respectiva.</p>
			            <h3 style="font-size: 18px; color: #333">Docentes</h3>
			            <p>Los docentes ordinarios o contratados que soliciten subvención deben de presentar los siguientes documentos:</p>
			            <ul style="list-style: disc; margin-left: 20px">
			            	<li>Carta del Decano al Vicerrector de Investigación solicitando el apoyo.</li>
			            	<li>Aceptación de participación en el Evento Académico, y evidencia de haber solicitado apoyo económico a los organizadores.</li>
			            	<li>Resumen del trabajo a presentar: Póster o exposición oral en caso de conferencia o plan de trabajo si fuera estadía.</li>
			            	<li>Carta de compromiso que el trabajo estará en los “Proceedings” de la Conferencia o resumen de la estadía de investigación, según el caso. Se entregará al Vicerrectorado de Investigación copia relevante el libro de resúmenes del Evento Académico dentro de un plazo máximo de un año.</li>
			            	<li>El apoyo para un docente es de una vez por año.</li>
			            	<li>Se dará apoyo aquellos trabajos que sean producto de un proyecto de investigación registrado en la , o del trabajo de tesis. En cualquier caso, tiene que ser visado por el Instituto de Investigación de la Facultad o la Escuela de Posgrado.</li>
			            </ul>
			            <p>Según disponibilidad de los recursos, se podrá financiar parte o la totalidad del evento. Se dará preferencia a aquellos postulantes que son subvencionados parcialmente por la Facultad respectiva.</p>
					  </div>
					  <div class="tab-pane container fade show p-0" id="tab3">
					  	<h2>Aprobación</h2>
					  	<hr>
					  	<p>El Vicerrectorado de Investigación nombrará una comisión para calificar las solicitudes y recomendar la pertinencia y monto de subvención</p>
					  </div>
					</div>	
				</div>
				<!--====  End of Tab Panes  ====-->
			</div>
	</section>
@stop