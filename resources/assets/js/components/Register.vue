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
                                <span v-if="msg.email">
                                    <strong>{{msg.email}}</strong>
                                </span>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <select v-model="registerData.rol_id" class="form-control" name="selectRol">
                                    <option value="0" disabled>Select your role</option>
                                    <option v-for="role in roles" :key="role.id" :value="role.id" v-text="role.nombre"></option>
                                </select>
                                <span v-if="msg.selectRol">
                                    <strong>{{msg.selectRol}}</strong>
                                </span>
                            </div>
                            <div class="input-group mb-3" :class="{'has-error' : hasErrors.password}">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                </div>
                                <input id="password" type="password" class="form-control" name="password" v-model="registerData.password" required>
                                <span v-if="msg.password">
                                    <strong>{{msg.password}}</strong>
                                </span>
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                </div>
                                <input id="password-confirm" type="password"  placeholder="Password confirmation" class="form-control" name="password_confirmation" v-model="registerData.password_confirmation"
                                    required>
                                <span v-if="msg.password_confirmation">
                                    <strong>{{msg.password_confirmation}}</strong>
                                </span>
                            </div>
                            <button type="submit" class="btn btn-primary" @click.prevent="registerPost()" :disabled="disableSubmitButton">Create Account</button>
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
                    direccion: false,
                    telefono: false,
                    codigo_postal: false
                },
                roles: [],
                provincias: [],
                errorMessage: {
                    email: null,
                    password: null
                },
                msg: {
                    email: "",
                    password: "",
                    password_confirmation: "",
                    selectRol: "",
                },
                disableSubmitButton: true
                //passwordMatch:null
            };
        },
        watch: {
            "registerData.email": function (value) {
                this.registerData.email = value;
                this.check_email(value);
            },
            "registerData.password": function (value) {
                this.registerData.password = value;
                this.checkPassword(value);
            },
            "registerData.password_confirmation": function (value) {
                this.registerData.password_confirmation = value;
                this.checkConfirmPassword(value);
            }
        },
        methods: {
            registerPost() {
                var notDo = true;
                if ($("[name='selectRol']").val() == null) {
                    this.msg.selectRol = "Please, select a rol.";
                    toastr.error("Selecciona un rol.");
                    notDo = false;
                } else {
                    this.msg.selectRol = "";
                }
                if (this.msg.email != "") {
                    toastr.error("El email introducido no es válido.");
                    notDo = false;
                }
                if (notDo) {
                    var _this = this;
                    var vm = this.hasErrors;
                    var _vm = this.errorMessage;
                    axios
                        .post("register", _this.registerData)
                        .then(function (response) {
                            var redirect = (window.location.href = "/perfil#execute");
                            axios.get(redirect);
                        })
                        .catch(function (error) {
                            toastr.error("Rellena todos los campos correctamente.");
                        });
                }
            },
            getRoles: function () {
                var url = "rol/getRoles";
                axios.get(url).then(response => {
                    this.roles = response.data;
                });
            },
            check_email(value) {
                if (/^\w+([\.-]?\ w+)*@\w+([\.-]?\ w+)*(\.\w{2,3})+$/.test(value)) {
                    this.msg.email = "";
                } else {
                    this.msg.email = "Keep Typing... We are waiting for correct Email";
                }
            },
            checkPassword(value) {
                this.passwordLengthCheck(value);
            },
            checkConfirmPassword(value) {
                if (value == this.registerData.password) {
                    this.msg.password_confirmation = "";
                    this.disableSubmitButton = false;
                } else {
                    this.msg.password_confirmation =
                        "Password does not match, please try again";
                }
            },
            passwordLengthCheck(passwordToCheck) {
                var remainingChars = 6 - passwordToCheck.length;
                if (passwordToCheck.length < 6) {
                    this.msg.password =
                        "Password must contain 6 characters. " +
                        remainingChars +
                        " more to go...";
                } else {
                    this.msg.password = "";
                    return true;
                }
            }
        },
        computed: {
            passwordValidate() {
                var vm = this.registerData;
                var _this = this;
                return vm.password_confirmation !== vm.password ?
                    toastr.error("Las contraseñas no coinciden") :
                    (_this.passwordMatch = null);
            }
        },
        created() {
            this.getRoles();
        }
    };
</script>