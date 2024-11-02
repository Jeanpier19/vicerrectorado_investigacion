<script type="text/javascript">
  let app = new Vue({
    el: '#signIn',
    data:{
      divLoaderRegister: false,
      errors: [],
      escuelas: [],
      newItem: {'dni': '', 'nombres': '', 'apellidos': '', 'genero': '', 'fecha_nacimiento': '', 'email': '', 'telefono': '', 'cti': '', 'orcid': '', 'estado': '', 'escuela_id': ''},
    },
    created: function() {
      this.getItems();
    },
    methods: {
      getItems: function() {
        var url = 'investigadores/escuelas';
        axios.get(url).then(response => {
          this.escuelas  = response.data.escuelas;
        });
      },
      clearFields() {
        this.newItem.dni = '';
        this.newItem.nombres = '';
        this.newItem.apellidos = '';
        this.newItem.genero = '';
        this.newItem.fecha_nacimiento = '';
        this.newItem.email = '';
        this.newItem.telefono = '';
        this.newItem.cti = '';
        this.newItem.orcid = '';
        this.newItem.escuela_id = '';
        this.newItem.password = '';
        this.newItem.confirmar_password = '';
        this.errors = [];
      },
      openSignInModal: function() {
        this.clearFields();
        $('#signInModal').modal({
          show: true,
          backdrop: false
        });
        $('#signInModal').on('shown.bs.modal', function() {
          $('#dni').focus();
        });
      },
      create: function () { 
        let url = 'investigadores/store';
        this.divLoaderRegister = true;
        let data = new FormData();
        data.append('estado', '0');
        data.append('dni', this.newItem.dni);
        data.append('nombres', this.newItem.nombres);
        data.append('apellidos', this.newItem.apellidos);
        data.append('genero', this.newItem.genero);
        data.append('fecha_nacimiento', this.newItem.fecha_nacimiento);
        data.append('email', this.newItem.email);
        data.append('telefono', this.newItem.telefono);
        data.append('cti', this.newItem.cti);
        data.append('orcid', this.newItem.orcid);
        data.append('escuela_id', this.newItem.escuela_id);
        data.append('cti', this.newItem.cti);
        data.append('orcid', this.newItem.orcid);
        data.append('_method', 'POST');
        axios.post(url, data).then(response => {
          this.divLoaderRegister = false;
          if(response.data.result) {
            this.getItems(this.thisPage);
            Swal.fire({
              type: 'success',
              title: '¡Completado!',
              text: response.data.message,
            });
            this.clearFields();
            $("#signInModal").modal('hide');
          }else {
            Swal.fire({
              type: 'error',
              title: 'Hubo un error!',
              text: response.data.message,
            });
          }
        }).catch(error => {
          if(error.response.status == 422) {
            this.divLoaderRegister = false;
            this.errors = error.response.data.errors;
          }
        });
      },
    },
  });
</script>