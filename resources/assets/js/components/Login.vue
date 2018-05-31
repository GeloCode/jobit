<template>
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login</div>

                <div class="card-body">
                    <form role="form">
                       

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">Email Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" v-model="loginDetails.email" required autofocus>

                                
                                    <span class="invalid-feedback">
                                        <strong>{{emailError}}</strong>
                                    </span>
                            
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" v-model="loginDetails.password" name="password" required>

                               
                                    <span class="invalid-feedback">
                                        <strong>{{passwordError}}</strong>
                                    </span>
                              
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" v-model="loginDetails.remember"  name="remember" > Remember Me Remember Password
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" @click.prevent="loginPost" class="btn btn-primary">
                                    Login
                                </button>
                                    <a class="btn btn-link" href="#">
                                </a>
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
      loginDetails: {
        email: "",
        password: "",
        remember: true
      },
      errorsEmail: false,
      errorsPassword: false,
      emailError: null,
      passwordError: null
    };
  },
  methods: {
    loginPost() {
      let vm = this;
      axios
        .post("/login", vm.loginDetails)
        .then(function(response) {
          var redirect = (window.location.href = "/home");
          axios.get(redirect);
        })
        .catch(function(error) {
         toastr.error("Los credenciales no son correctos");
        });
    }
  },
  mounted() {}
};
</script>