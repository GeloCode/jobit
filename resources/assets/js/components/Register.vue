<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-group" :class="{'has-error' : hasErrors.name}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           v-model="registerData.name" required autofocus>
                                    <span v-if="hasErrors.name" class="help-block">
                                        <strong>{{errorMessage.name}}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group" :class="{'has-error' : hasErrors.email}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           v-model="registerData.email" required>
                                    <span v-if="hasErrors.email" class="help-block">
                                        <strong>{{errorMessage.email}}</strong>
                                    </span>

                                </div>
                            </div>

                            <div class="form-group" :class="{'has-error' : hasErrors.password}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password"
                                           v-model="registerData.password" required>
                                    <span v-if="hasErrors.password" class="help-block">
                                        <strong>{{errorMessage.password}}</strong>
                                    </span>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" v-model="registerData.password_confirmation"
                                           required>
                                </div>
                            </div>

                            <div class="form-group" :class="{'has-error' : hasErrors.telefono}">
                                <label for="telefono" class="col-md-4 control-label">telefono</label>

                                <div class="col-md-6">
                                    <input id="telefono" type="text" class="form-control" name="telefono"
                                           v-model="registerData.telefono" required autofocus>
                                    <span v-if="hasErrors.telefono" class="help-block">
                                        <strong>{{errorMessage.telefono}}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group" :class="{'has-error' : hasErrors.codigo_postal}">
                                <label for="codigo_postal" class="col-md-4 control-label">Código postal</label>

                                <div class="col-md-6">
                                    <input id="codigo_postal" type="text" class="form-control" name="codigo_postal"
                                           v-model="registerData.codigo_postal" required autofocus>
                                    <span v-if="hasErrors.codigo_postal" class="help-block">
                                        <strong>{{errorMessage.codigo_postal}}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group" :class="{'has-error' : hasErrors.direccion}">
                                <label for="direccion" class="col-md-4 control-label">direccion</label>

                                <div class="col-md-6">
                                    <input id="direccion" type="text" class="form-control" name="direccion"
                                           v-model="registerData.direccion" required autofocus>
                                    <span v-if="hasErrors.direccion" class="help-block">
                                        <strong>{{errorMessage.direccion}}</strong>
                                    </span>
                                </div>
                            </div>


                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Role</label>
                                    <div class="col-md-9">
                                        <select v-model="registerData.rol_id" class="form-control" name="selectRol">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="role in roles" :key="role.id" :value="role.id" v-text="role.nombre"></option>
                                        </select>
                                    </div>
                                </div>
                                
                            <div class="form-group">
                                <select class="custom-select" name="selectProvincia" v-model="registerData.provincia_id">
                                    <option value="0" disabled>Elige tu Provincia</option>
                                    <option v-for="provincia in provincias" :key="provincia.id" :value="provincia.id" v-text="provincia.nombre"></option>
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" @click.prevent="registerPost()">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      registerData: {
        direccion:"",
        telefono:"",
        codigo_postal:"",
        provincia_id: 0,
        rol_id: 0,
        name: "",
        email: "",
        password: "",
        password_confirmation: ""
      },
      hasErrors: {
        name: false,
        email: false,
        password: false,
        direccion:false,
        telefono:false,
        codigo_postal:false
      },
      roles: [],
      provincias: [],
      errorMessage: {
        name:null,
        email:null,
        password:null,
        direccion:null,
        telefono:null,
        codigo_postal:null
      }
      //passwordMatch:null
    };
  },
  methods: {
    registerPost() {
      var _this = this;
      var vm = this.hasErrors;
      var _vm = this.errorMessage;
      axios
        .post("register", _this.registerData)
        .then(function(response) {
            var redirect =  window.location.href = '/home';
          axios.get(redirect);
        })
        .catch(function(error) {
          var errors = error.response;
          if (errors.statusText === "Unprocessable Entity") {
            if (errors.data) {
              if (errors.data.name) {
                vm.name = true;
                _vm.name = _.isArray(errors.data.name)
                  ? errors.data.name[0]
                  : errors.data.name;
              }
              if (errors.data.email) {
                vm.email = true;
                _vm.email = _.isArray(errors.data.email)
                  ? errors.data.email[0]
                  : errors.data.email;
              }
              if (errors.data.password) {
                vm.password = true;
                _vm.password = _.isArray(errors.data.password)
                  ? errors.data.password[0]
                  : errors.data.password;
              }
            }
          }
        });
    },
    getProvincias: function() {
      var url = "provincias";
      axios.get(url).then(response => {
        this.provincias = response.data;
      });
    },
    getRoles: function() {
      var url = "rol/getRoles";
      axios.get(url)
        .then(response => {
          this.roles = response.data;
        }).catch(function(error) {
          console.log(error);
        });
    }
  },
  computed: {
    passwordValidate() {
      var vm = this.registerData;
      var _this = this;
      return vm.password_confirmation !== vm.password
        ? (_this.passwordMatch = "The password confirmation does not match.")
        : (_this.passwordMatch = null);
    }
  },
  created() {
    this.getProvincias();
    this.getRoles();
  }
};
</script>