@extends('layouts.web.master')
@section('title', 'Círculos de investigación | ')
@section('content')
  <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
    <div class="container text-left align-self-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('web.index') }}">Inicio</a></li>
        </ol>
      </nav>
      <h1 class="page-title-heading mt-3">Círculos de Investigación</h1>
    </div>
  </div>
  <section class="container pt-3 mb-3">
    {{-- <h2 class="h6 font-weight-normal">Área de investigación: Ciencias Médicas y la Salud</h2>
    <div class="table-responsive">
      <figure>
        <table class="table table-striped">
          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th style="min-width: 200px">Línea de investigación</th>
              <th>Círculo de investigación</th>
              <th style="min-width: 140px">Miembros</th>
              <th style="min-width: 140px">Proyectos</th>
              <th style="min-width: 160px">Publicaciones</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Salud Pública y Prevención de Enfermedades</td>
              <td>Círculo sobre Cuidados en enfermería y Salud Mental</td>
              <td>
                <a href="javascript:void(0)" class="btn btn-sm btn-style-6 btn-primary" data-toggle="tooltip" data-placement="bottom" title="Ver Miembros">Ver</a>
              </td>
              <td>
                <a href="javascript:void(0)" class="btn btn-sm btn-style-6 btn-success" data-toggle="tooltip" data-placement="bottom" title="Ver Proyectos">Ver</a>
              </td>
              <td>
                <a href="javascript:void(0)" class="btn btn-sm btn-style-6 btn-info" data-toggle="tooltip" data-placement="bottom" title="Ver Publicaciones">Ver Publicaciones</a>
              </td>
            </tr>
          </tbody>
        </table>
      </figure>
    </div> --}}
  </section>
  <!--===================================
  =            Modal Members            =
  ====================================-->
  <div class="modal fade" id="modalMembers" tabindex="-1" role="dialog" aria-labelledby="Miembros" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLongTitle">Miembros del círculo de investigación</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-3 col-form-label font-weight-bold">Área de investigación</label>
            <label for="inputPassword" class="col-sm-9 col-form-label">Ciencias Médicas y la Salud</label>
          </div>
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-3 col-form-label font-weight-bold">Línea de investigación</label>
            <label for="inputPassword" class="col-sm-9 col-form-label">Salud Pública y Prevención de Enfermedades</label>
          </div>
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-3 col-form-label font-weight-bold">Círculo de investigación</label>
            <label for="inputPassword" class="col-sm-9 col-form-label">Círculo de Cuidados en enfermería y Salud Mental</label>
          </div>
          <h3 class="mb-3">Lista de Miembros</h3>
          <div class="table-responsive">
            <table class="table table-primary">
              <thead>
                <tr>
                  <th>Apellidos y nombres</th>
                  <th>Correo electrónico</th>
                  <th>Facultad</th>
                  <th>Rol</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Martinez Ramirez Jose Miguel</td>
                  <td>jmmartinez@unasam.edu.pe</td>
                  <td>Facultad de Ciencias</td>
                  <td>Investigador Principal</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-file-excel"></i> Exportar Excel</button>
        <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-file-pdf"></i> Exportar PDF</button>
        <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Cerrar</button>
        </form>
        </div>
      </div>
      </div>
    </div>
  <!--====  End of Modal Members  ====-->
  <!-- Modal -->
  <div class="modal fade" id="modalProjects" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h2 class="modal-title" id="exampleModalLongTitle">Proyectos del círculo de investigación</h2>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
      <div class="form-group row">
        <label for="inputPassword" class="col-sm-3 col-form-label font-weight-bold">Área de investigación</label>
        <label for="inputPassword" class="col-sm-9 col-form-label">Ciencias Médicas y la Salud</label>
      </div>
      <div class="form-group row">
        <label for="inputPassword" class="col-sm-3 col-form-label font-weight-bold">Línea de investigación</label>
        <label for="inputPassword" class="col-sm-9 col-form-label">Salud Pública y Prevención de Enfermedades</label>
      </div>
      <div class="form-group row">
        <label for="inputPassword" class="col-sm-3 col-form-label font-weight-bold">Círculo de investigación</label>
        <label for="inputPassword" class="col-sm-9 col-form-label">Círculo de Cuidados en enfermería y Salud Mental</label>
      </div>
      <div class="table-responsive">
        <h3 class="mb-3">Lista de Proyectos</h3>
        <table class="table table-primary">
          <thead>
            <tr>
              <th>Título</th>
              <th style="min-width: 150px">Tipo de financiación</th>
              <th style="min-width: 160px">Investigador principal</th>
              <th style="min-width: 120px">Fecha de inicio</th>
              <th style="min-width: 160px">Fecha de finalización</th>
              <th style="min-width: 120px">Presupuesto</th>
              <th>Estado</th>
              <th>Archivo</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>La temperatura de enfriamiento y el método de recogida y sus efectos en la calidad de la leche cruda en el Centro Experimental de Tingua</td>
              <td>Canon</td>
              <td>Jorge Antonio Ramírez Rodríguez</td>
              <td>01/01/2019</td>
              <td>01/05/2019</td>
              <td>S/. 497 049.48</td>
              <td>Concedido</td>
              <td>
                <a href="#" class="btn btn-danger">
                  <i class="fas fa-fw fa-file-pdf"></i>   
                </a>
              </td>
            </tr>
            <tr>
              <td>La temperatura de enfriamiento y el método de recogida y sus efectos en la calidad de la leche cruda en el Centro Experimental de Tingua</td>
              <td>Canon</td>
              <td>Jorge Antonio Ramírez Rodríguez</td>
              <td>01/01/2019</td>
              <td>01/05/2019</td>
              <td>S/. 497 049.48</td>
              <td>En ejecución</td>
              <td>
                <a href="#" class="btn btn-danger">
                  <i class="fas fa-fw fa-file-pdf"></i>   
                </a>
              </td>
            </tr>
            <tr>
              <td>La temperatura de enfriamiento y el método de recogida y sus efectos en la calidad de la leche cruda en el Centro Experimental de Tingua</td>
              <td>Canon</td>
              <td>Jorge Antonio Ramírez Rodríguez</td>
              <td>01/01/2019</td>
              <td>01/05/2019</td>
              <td>S/. 497 049.48</td>
              <td>Denegado</td>
              <td>
                <a href="#" class="btn btn-danger">
                  <i class="fas fa-fw fa-file-pdf"></i>   
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-file-excel"></i> Exportar Excel</button>
      <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-file-pdf"></i> Exportar PDF</button>
      <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Cerrar</button>
      </form>
      </div>
    </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modalPublications" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h2 class="modal-title" id="exampleModalLongTitle">Publicaciones del círculo de investigación</h2>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
      <div class="form-group row">
        <label for="inputPassword" class="col-sm-3 col-form-label font-weight-bold">Área de investigación</label>
        <label for="inputPassword" class="col-sm-9 col-form-label">Ciencias Médicas y la Salud</label>
      </div>
      <div class="form-group row">
        <label for="inputPassword" class="col-sm-3 col-form-label font-weight-bold">Línea de investigación</label>
        <label for="inputPassword" class="col-sm-9 col-form-label">Salud Pública y Prevención de Enfermedades</label>
      </div>
      <div class="form-group row">
        <label for="inputPassword" class="col-sm-3 col-form-label font-weight-bold">Círculo de investigación</label>
        <label for="inputPassword" class="col-sm-9 col-form-label">Círculo de Cuidados en enfermería y Salud Mental</label>
      </div>
      <div class="table-responsive">
        <h3 class="mb-3">Lista de Publicaciones</h3>
        <table class="table table-primary">
          <thead>
            <tr>
              <th>Título</th>
              <th style="min-width: 150px">Tipo de publicación</th>
              <th style="min-width: 160px">Autores</th>
              <th style="min-width: 160px">Fecha de publicación</th>
              <th>Archivo</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>La temperatura de enfriamiento y el método de recogida y sus efectos en la calidad de la leche cruda en el Centro Experimental de Tingua</td>
              <td>Boletín</td>
              <td>
                <ul class="list-group">
                  <li class="list-group-item border-dark">GAMBOA VELÁSQUEZ JORGE ANTONIO</li>
                  <li class="list-group-item border-dark">NIVIN VARGAS LAURA ROSA</li>
                </ul>
              </td>
              <td>01/01/2019</td>
              <td>
                <a href="#" class="btn btn-danger">
                  <i class="fas fa-fw fa-file-pdf"></i>   
                </a>
              </td>
            </tr>
            <tr>
              <td>La temperatura de enfriamiento y el método de recogida y sus efectos en la calidad de la leche cruda en el Centro Experimental de Tingua</td>
              <td>Guías de práctica</td>
              <td>
                <ul class="list-group">
                  <li class="list-group-item border-dark">GAMBOA VELÁSQUEZ JORGE ANTONIO</li>
                  <li class="list-group-item border-dark">GAMBOA VELÁSQUEZ JORGE ANTONIO</li>
                  <li class="list-group-item border-dark">NIVIN VARGAS LAURA ROSA</li>
                </ul>
              </td>
              <td>01/01/2019</td>
              <td>
                <a href="#" class="btn btn-danger">
                  <i class="fas fa-fw fa-file-pdf"></i>   
                </a>
              </td>
            </tr>
            <tr>
              <td>La temperatura de enfriamiento y el método de recogida y sus efectos en la calidad de la leche cruda en el Centro Experimental de Tingua</td>
              <td>Libro</td>
              <td>
                <ul class="list-group">
                  <li class="list-group-item border-dark">GAMBOA VELÁSQUEZ JORGE ANTONIO</li>
                </ul>
              </td>
              <td>01/01/2019</td>
              <td>
                <a href="#" class="btn btn-danger">
                  <i class="fas fa-fw fa-file-pdf"></i>   
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-file-excel"></i> Exportar Excel</button>
      <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-file-pdf"></i> Exportar PDF</button>
      <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Cerrar</button>
      </form>
      </div>
    </div>
    </div>
  </div>
@stop