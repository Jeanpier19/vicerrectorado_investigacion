<script type="text/javascript">
  let main = new Vue({
    el: '#main',
    data:{
      isLoading: false,
      errors: {},
      facultades: {},
      departamentos: {},
      newItem: {
        'dni': '',
        'nombres': '',
        'apellidos': '',
        'genero': '',
        'celular': '',
        'email': '',
        'grado': '',
        'categoria': '',
        'cti': '',
        'orcid': '',
        'facultad_id': '',
        'departamento_id': ''
      },
    },
    created: function() {
      this.getFacultades();
    },
    methods: {
      getFacultades() {
        this.isLoading = true;
        var url = '/axios/vue/get-facultades';
        axios.get(url).then(response => {
          this.facultades = response.data.facultades;
          this.isLoading = false;
        });
      },
      getDepartamentos() {
        this.departamentos = {};
        this.newItem.departamento_id = '';
        this.isLoading = true;
        var url = '/axios/vue/get-departamentos?facultad_id=' + this.newItem.facultad_id;
        axios.get(url).then(response => {
          this.departamentos = response.data.departamentos;
          this.isLoading = false;
        });
      },
      clearFields() {
        this.newItem.dni = '';
        this.newItem.nombres = '';
        this.newItem.apellidos = '';
        this.newItem.genero = '';
        this.newItem.celular = '';
        this.newItem.email = '';
        this.newItem.grado = '';
        this.newItem.categoria = '';
        this.newItem.cti = '';
        this.newItem.orcid = '';
        this.newItem.facultad_id = '';
        this.newItem.departamento_id = '';
        this.errors = {};
      },
      openSignInModal: function() {
        this.clearFields();
        $('#signInModal').modal({ show: true });
        $('#signInModal').on('shown.bs.modal', function() { $('#dni').focus(); });
      },
      create: function () {
        this.isLoading = true;
        if(this.newItem.orcid.trim().length != 19) {
          iziToast.show({
            class: 'iziToast-danger',
            title: '¡Error¡',
            message: 'Su ID de ORCID es inválido (####-####-####-####)',
            position: 'topRight',
            icon: 'fe-icon-x-circle'
          });
        }
        let url = '/axios/vue/investigacion/investigadores/registrar-solicitud';
        let data = new FormData();
        data.append('dni', this.newItem.dni);
        data.append('nombres', this.newItem.nombres);
        data.append('apellidos', this.newItem.apellidos);
        data.append('genero', this.newItem.genero);
        data.append('celular', this.newItem.celular);
        data.append('email', this.newItem.email);
        data.append('grado', this.newItem.grado);
        data.append('categoria', this.newItem.categoria);
        data.append('departamento_id', this.newItem.departamento_id);
        data.append('cti', this.newItem.cti);
        data.append('orcid', this.newItem.orcid);
        data.append('_method', 'POST');
        axios.post(url, data).then(response => {
          this.isLoading = false;
          if(response.data.result) {
            iziToast.show({
              class: 'iziToast-success',
              title: '¡Completado¡',
              message: response.data.message,
              position: 'topRight',
              icon: 'fe-icon-check-circle',
              timeout: '60000'
            });
            this.clearFields();
            $("#signInModal").modal('hide');
          }else {
            iziToast.show({
              class: 'iziToast-danger',
              title: '¡Error¡',
              message: response.data.message,
              position: 'topRight',
              icon: 'fe-icon-x-circle'
            });
          }
        }).catch(error => {
          if(error.response.status == 422) {
            this.errors = error.response.data.errors;
            iziToast.show({
              class: 'iziToast-danger',
              title: '¡Error!',
              message: 'Por favor verifique los campos obligatorios antes de guardar',
              position: 'topRight',
              icon: 'fe-icon-x-circle'
            });
          }
          this.isLoading = false;
        });
      },
    },
  });
</script><?php /**PATH /var/www/appVRI/resources/views/web/vue/registro-investigador.blade.php ENDPATH**/ ?>