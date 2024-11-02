
<?php $__env->startSection('title', 'Requisitos, Deberes y Derechos | Registro de Investigadores | '); ?>
<?php $__env->startSection('content'); ?>
  <div class="page-title d-flex mb-3 wow fadeIn" aria-label="Título" style="background-image: url(/archivos/imagenes/bg-page-title.jpg);">
    <div class="container text-left align-self-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('web.index')); ?>">Inicio</a></li>
        </ol>
      </nav>
      <h1 class="page-title-heading mt-3">Requisitos, Deberes y Derechos</h1>
    </div>
  </div>
  <section class="container pt-3 mb-3">
    <h2 class="h4 block-title text-dark">Requisitos para creación de cuenta de investigador</h2>
    <p class="text-muted">Consignar sus datos en el <a href="javascript:void(0)" class="h6" data-toggle="modal" data-target="#signInModal" title="Buscar">Formulario de registro</a></p> 
    <!--=================================
    =            signInModal            =
    ==================================-->
    <div class="modal fade" id="signInModal" tabindex="-1" role="dialog" aria-labelledby="Registro" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
          <h2 class="h4 text-dark">Formulario de registro (Investigador)</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <div class="modal-body text-left">
            <form class="needs-validation wizard p-2" method="post" @submit.prevent="create" novalidate>
              <?php echo csrf_field(); ?>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="dni" class="font-weight-bold p-0">DNI&nbsp;<span class="text-danger">*</span></label>
                  <input type="number" class="form-control" :class="{'is-invalid': errors.dni}" id="dni" placeholder="Ingrese su N° de DNI" v-model="newItem.dni" v-on:focus="errors.dni = null" required>
                  <div v-if="errors.dni" v-for="error in errors.dni" class="invalid-feedback">{{ error + '. ' }}</div>
                  <div class="invalid-feedback" v-if="!errors.dni">¡Por favor introduzca su N° de DNI!</div>
                </div>
                <div class="form-group col-md-4">
                  <label for="nombres" class="font-weight-bold p-0">Nombres&nbsp;<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" :class="{'is-invalid': errors.nombres}" id="nombres" placeholder="Ingrese sus nombres" v-model="newItem.nombres" v-on:focus="errors.nombres = null" required>
                  <div v-if="errors.nombres" v-for="error in errors.nombres" class="invalid-feedback">{{ error + '. ' }}</div>
                  <div class="invalid-feedback" v-if="!errors.nombres">¡Por favor introduzca sus Nombres!</div>
                </div>
                <div class="form-group col-md-4">
                  <label for="apellidos" class="font-weight-bold p-0">Apellidos&nbsp;<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" :class="{'is-invalid': errors.apellidos}" id="apellidos" placeholder="Ingrese sus apellidos" v-model="newItem.apellidos" v-on:focus="errors.apellidos = null" required>
                  <div v-if="errors.apellidos" v-for="error in errors.apellidos" class="invalid-feedback">{{ error + '. ' }}</div>
                  <div class="invalid-feedback" v-if="!errors.apellidos">¡Por favor introduzca sus Apellidos!</div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="genero" class="font-weight-bold p-0">Género&nbsp;<span class="text-danger">*</span></label>
                  <select class="form-control" :class="{'is-invalid': errors.genero}" id="genero" v-model="newItem.genero" v-on:focus="errors.genero = null" required>
                    <option value="" disabled>Seleccione su Género...</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                  </select>
                  <div v-if="errors.genero" v-for="error in errors.genero" class="invalid-feedback">{{ error + '. ' }}</div>
                  <div class="invalid-feedback" v-if="!errors.genero">¡Por favor seleccione su Género!</div>
                </div>
                <div class="form-group col-md-4">
                  <label for="celular" class="font-weight-bold p-0">Celular&nbsp;<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" :class="{'is-invalid': errors.celular}" id="celular" placeholder="Ingrese su N° de Celular" v-model="newItem.celular" v-on:focus="errors.celular = null" required>
                  <div v-if="errors.celular" v-for="error in errors.celular" class="invalid-feedback">{{ error + '. ' }}</div>
                  <div class="invalid-feedback" v-if="!errors.celular">¡Por favor introduzca su N° de Celular!</div>
                </div>
                <div class="form-group col-md-4">
                  <label for="email" class="font-weight-bold p-0">Email</label>
                  <input type="email" class="form-control" :class="{'is-invalid': errors.email}" id="email" placeholder="Ingrese su email" v-model="newItem.email" v-on:focus="errors.email = null">
                  <div v-if="errors.email" v-for="error in errors.email" class="invalid-feedback">{{ error + '. ' }}</div>
                  <div class="invalid-feedback" v-if="!errors.email">¡Por favor introduzca correctamente su Email!</div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="grado" class="font-weight-bold p-0">Grado Académico&nbsp;<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" :class="{'is-invalid': errors.grado}" id="grado" placeholder="Ingrese su Grado Académico" v-model="newItem.grado" v-on:focus="errors.grado = null" required>
                  <div v-if="errors.grado" v-for="error in errors.grado" class="invalid-feedback">{{ error + '. ' }}</div>
                  <div class="invalid-feedback" v-if="!errors.grado">¡Por favor introduzca su Grado Académico!</div>
                </div>
                <div class="form-group col-md-6">
                  <label for="categoria" class="font-weight-bold p-0">Categoría&nbsp;<span class="text-danger">*</span></label>
                  <select class="form-control" :class="{'is-invalid': errors.categoria}" id="categoria" v-model="newItem.categoria" v-on:focus="errors.categoria = null" required>
                    <option value="" disabled>Seleccione su Categoría...</option>
                    <option value="1">Auxiliar</option>
                    <option value="2">Asociado</option>
                    <option value="3">Principal</option>
                  </select>
                  <div v-if="errors.categoria" v-for="error in errors.categoria" class="invalid-feedback">{{ error + '. ' }}</div>
                  <div class="invalid-feedback" v-if="!errors.categoria">¡Por favor seleccione su Categoría!</div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-5">
                  <label for="facultad_id" class="font-weight-bold p-0">Facultad&nbsp;<span class="text-danger">*</span></label>
                  <select class="form-control" :class="{'is-invalid': errors.facultad_id}" id="facultad_id" v-model="newItem.facultad_id" v-on:focus="errors.facultad_id = null" v-on:change="getDepartamentos(newItem.facultad_id)" required>
                    <option value="" disabled>Seleccione su Facultad...</option>
                    <option v-for="item in facultades" :value="item.id">{{ item.nombre }}</option>
                  </select>
                  <div v-if="errors.facultad_id" v-for="error in errors.facultad_id" class="invalid-feedback">{{ error + '. ' }}</div>
                  <div class="invalid-feedback" v-if="!errors.facultad_id">¡Por favor seleccione su Facultad!</div>
                </div>
                <div class="form-group col-md-7">
                  <label for="departamento_id" class="font-weight-bold p-0">Departamento Académico&nbsp;<span class="text-danger">*</span></label>
                  <select class="form-control" :class="{'is-invalid': errors.departamento_id}" id="departamento_id" v-model="newItem.departamento_id" v-on:focus="errors.departamento_id = null" required>
                    <option value="" disabled>Seleccione su Departamento Académico...</option>
                    <option v-for="item in departamentos" :value="item.id">{{ item.nombre }}</option>
                  </select>
                  <div v-if="errors.departamento_id" v-for="error in errors.departamento_id" class="invalid-feedback">{{ error + '. ' }}</div>
                  <div class="invalid-feedback" v-if="!errors.departamento_id">¡Por favor seleccione su Departamento Académico!</div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="cti" class="font-weight-bold p-0">CTI Vitae&nbsp;<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" :class="{'is-invalid': errors.cti}" id="cti" placeholder="Ingrese el link de su CTI Vitae" v-model="newItem.cti" v-on:focus="errors.cti = null" required>
                  <div v-if="errors.cti" v-for="error in errors.cti" class="invalid-feedback">{{ error + '. ' }}</div>
                  <div class="invalid-feedback" v-if="!errors.cti">¡Por favor introduzca el Link de su CTI!</div>
                </div>
                <div class="form-group col-md-6">
                  <label for="orcid" class="font-weight-bold p-0">ORCID&nbsp;<span class="text-danger">*</span></label>
                  <input class="form-control" :class="{'is-invalid': errors.orcid}" id="orcid" placeholder="####-####-####-####" v-model="newItem.orcid" v-on:focus="errors.orcid = null" required>
                  <div v-if="errors.orcid" v-for="error in errors.orcid" class="invalid-feedback">{{ error + '. ' }}</div>
                  <div class="invalid-feedback" v-if="!errors.orcid">¡Por favor introduzca su ID de ORCID!</div>
                </div>
              </div>
              <div class="sk-cube-grid" v-show="isLoading">
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
              <div class="row">
                <div class="col-md-6 text-center text-lg-left mb-2">
                  <small>En caso de algún problema favor enviar un email a: investigacion@unasam.edu.com</small>
                </div>
                <div class="col-md-6 text-center text-lg-right">
                  <button type="submit" class="btn btn-sm btn-style-4 btn-info"><i class="fas fa-fw fa-share-square"></i> Enviar solicitud</button>
                  <button type="button" class="btn btn-sm btn-style-4 btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Cerrar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--====  End of signInModal  ====-->
    <p class="text-muted">Se validarán sus datos y se le enviará un email de confirmación al correo electrónico proporcionado</p>
    <h2 class="h4 block-title text-dark">Requisitos para creación de cuenta de Líder de Círculo de Investigación</h2>
    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet sequi, laudantium, nesciunt similique temporibus, deserunt corporis fuga ducimus incidunt placeat, ipsam dolorum. A voluptates numquam neque qui veniam ipsa? Aliquid! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae ullam unde sed eligendi labore, hic modi consequatur minus voluptatum, quisquam, sequi, deserunt vero nesciunt repellendus distinctio ducimus ea. Eveniet, inventore.</p>
    <ul style="list-style: disc;">
      <li class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum esse libero cupiditate, incidunt ex, consequuntur culpa mollitia veritatis error accusamus, quibusdam quis laudantium vero minima accusantium consectetur commodi nulla molestias!</li>
      <li class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis blanditiis, dolorum quas rerum nostrum repellat totam veritatis sint nam et. Quam eos, at! Quia rerum, quaerat eum similique, veniam fugiat.</li>
      <li class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam voluptas, vero sit eius vitae nemo autem. Iusto, sed minima quisquam laboriosam aspernatur architecto, quas cum iste impedit reiciendis, mollitia rerum.</li>
      <li class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam inventore quo quaerat temporibus rem omnis officiis, alias aspernatur, cumque voluptatem earum ut amet, optio at modi. Vero debitis hic nihil?</li>
    </ul>
  </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom_js'); ?>
  <?php echo $__env->make('web.vue.registro-investigador', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/appVRI/resources/views/web/requisitos-deberes-derechos.blade.php ENDPATH**/ ?>