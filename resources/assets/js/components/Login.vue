<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-group">
                    <div class="card p-4">
                        <div class="card-body">
                            <h1>Login</h1>
                            <p class="text-muted">Sign In to your account</p>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                </div>
                                <input id="email" type="email" class="form-control" name="email" v-model="loginDetails.email" required autofocus>
                                <span v-if="msg.email">
                                    <strong v-text="msg.email"></strong>
                                </span>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </div>
                                <input id="password" type="password" class="form-control" v-model="loginDetails.password" name="password" required>
                                <span v-if="msg.password">
                                    <strong v-text="msg.password"></strong>
                                </span>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label>
                                        <input type="checkbox" v-model="loginDetails.remember" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" @click.prevent="loginPost" class="btn btn-primary">
                                        Login
                                    </button>
                                    <a class="btn btn-link" href="#">
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
                        <div class="card-body text-center">
                            <div>
                                <h2>Sign up</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua.</p>
                                <a href="./register">
                                    <button type="button" class="btn btn-primary active mt-3">Register Now!</button>
                                </a>
                            </div>
                        </div>
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
                msg: {
                    email: "",
                    password: "",
                }
            };
        },
         watch: {
            "loginDetails.email": function(value) {
            this.loginDetails.email = value;
            this.check_email(value);
            },
            "loginDetails.password": function(value) {
            this.loginDetails.password = value;
            this.checkPassword(value);
            },
        },
        methods: {
            loginPost() {
                var notDo = true;
                if (this.msg.email != ""){
                    toastr.error("Tu email es incorrecto.");
                    notDo = false;
                }
                if (this.msg.password != ""){
                    toastr.error("Tu password es incorrecta.");
                    notDo = false;
                }
                if(notDo){
                    let vm = this;
                    axios
                        .post("/login", vm.loginDetails)
                        .then(function (response) {
                            var redirect = (window.location.href = "/home");
                            axios.get(redirect);
                        })
                        .catch(function (error) {
                            toastr.error("Los credenciales no son correctos");
                        });
                }
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
    };
</script>