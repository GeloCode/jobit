<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form">                        
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
        rol_id: 0,
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
        email:null,
        password:null,
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
    this.getRoles();
  }
};
</script>