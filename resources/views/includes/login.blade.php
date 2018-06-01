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
                                    <i class="fa fa-user"></i>
                                </span>
                            </div>
                            
                            <input id="email" type="email" class="form-control" name="email" v-model="loginDetails.email" required autofocus>
                                    <span class="invalid-feedback">
                                        <strong>{{emailError}}</strong>
                                    </span>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-lock"></i>
                                </span>
                            </div>
                            <input id="password" type="password" class="form-control" v-model="loginDetails.password" name="password" required>
                                    <span class="invalid-feedback">
                                        <strong>{{passwordError}}</strong>
                                    </span>
                        </div>
                        <div class="row">
                            <div class="col-6">
                            <label>
                                        <input type="checkbox" v-model="loginDetails.remember"  name="remember" > Remember Me
                                    </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" @click.prevent="loginPost" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-link px-0">(TO DO)Forgot password?</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
                    <div class="card-body text-center">
                        <div>
                            <h2>Sign up</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua.</p>
                            <button type="button" class="btn btn-primary active mt-3">Register Now!</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>