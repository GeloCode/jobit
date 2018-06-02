<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mx-4">
                    <div class="card-body p-4">
                        <h1>Register</h1>
                        <p class="text-muted">Create your account</p>
                        <form class="form-horizontal" role="form">
                            <div class="input-group mb-3" :class="{'has-error' : hasErrors.email}">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-at"></i>
                                    </span>
                                </div>
                                <input id="email" type="email" class="form-control" name="email" v-model="registerData.email" required>
                                <span v-if="hasErrors.email" class="help-block">
                                    <strong>{{errorMessage.email}}</strong>
                                </span>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user-tag"></i>
                                    </span>
                                </div>
                                <select v-model="registerData.rol_id" class="form-control" name="selectRol">
                                    <option value="0" disabled>Select your role</option>
                                    <option v-for="role in roles" :key="role.id" :value="role.id" v-text="role.nombre"></option>
                                </select>
                            </div>
                            <div class="input-group mb-3" :class="{'has-error' : hasErrors.password}">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                </div>
                                <input id="password" type="password" class="form-control" name="password" v-model="registerData.password" required>
                                <span v-if="hasErrors.password" class="help-block">
                                    <strong>{{errorMessage.password}}</strong>
                                </span>
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                </div>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" v-model="registerData.password_confirmation"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary" @click.prevent="registerPost()">Create Account</button>
                        </form>
                    </div>
                </div>
                <div class="card-footer p-4">
                    <div class="row"></div>
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
                    direccion: false,
                    telefono: false,
                    codigo_postal: false
                },
                roles: [],
                provincias: [],
                errorMessage: {
                    email: null,
                    password: null
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
                    .then(function (response) {
                        var redirect = (window.location.href = "/home");
                        axios.get(redirect);
                    })
                    .catch(function (error) {
                        toastr.error("Los credenciales no son correctos.");
                    });
            },
            getRoles: function () {
                var url = "rol/getRoles";
                axios
                    .get(url)
                    .then(response => {
                        this.roles = response.data;
                        console.log(this.roles);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        computed: {
            passwordValidate() {
                var vm = this.registerData;
                var _this = this;
                return vm.password_confirmation !== vm.password
                    ? toastr.error("Las contraseñas no coinciden")
                    : (_this.passwordMatch = null);
            }
        },
        created() {
            this.getRoles();
        }
    };
</script>