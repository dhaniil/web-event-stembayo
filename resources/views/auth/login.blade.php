<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('assets/asset')
    <link rel="stylesheet" href="{{ asset('css/login-page.css') }}"> 
    <title>Login</title>
</head>
<body>
    <section class="login-form">
        <div id="app" class="container-fluid">
            <div class="row">
                <div class="card left-card col-lg-6">
                    <div class="judul">
                        <h1 class="login-title">Welcome!</h1>
                        <p>Event Stembayo</p>
                    </div>
                    <!-- <h6 class="card-subtitle mb-2 text-body-secondary">Login dulu rek</h6> -->
                    <form class="login">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person"></i>
                            </span>
                            <input type="email" placeholder="Email" class="form-control" required>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-key"></i>
                            </span>
                            <input :type="passwordFieldType" class="form-control" placeholder="Password" v-model="password" required>
                            <span class="input-group-text cihuy" @click="togglePasswordVisibility">
                                <i :class="passwordIcon"></i>
                            </span>
                        </div>
                        <div class="form-group form-check d-flex justify-content-between">
                            <input type="checkbox" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">Ingat Saya</label>
                            <a href="#" class="forgot-password">Lupa Password?</a>
                        </div>
                        <button type="submit" class="btn">Log In</button>
                    </form>
                </div>
                <div class="card right-card col-lg-6">
                    <!-- <div class="img-bg">
                        <img src="https://i.ibb.co.com/LhwSwy5/SOC02116.jpg">
                    </div> -->
                    <div class="logo">
                        <img src="https://smkn2depoksleman.sch.id/utama/wp-content/uploads/2023/03/LOGO-SMK-N-2-DEPOK-SLEMAN-150x150.png" alt="Stembayo">
                        <h3>STEMBAYO</h3>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

    <script>
        new Vue({
        el: '#app',
        data: {
            password: '',
            isPasswordVisible: false
        },
        computed: {
            passwordFieldType() {
                return this.isPasswordVisible ? 'text' : 'password';
            },
            passwordIcon() {
                return this.isPasswordVisible ? 'bi bi-eye-slash' : 'bi bi-eye';
            }
        },
        methods: {
            togglePasswordVisibility() {
                this.isPasswordVisible = !this.isPasswordVisible;
            }
        }
    });
    </script>
</body>
</html>