<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('assets/asset')
    <link rel="stylesheet" href="{{ asset('css/login-page.css') }}"> 
    <title>Login</title>
    <!-- Tambahkan Vue.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
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
                    <!-- Form Login -->
                    <form class="login" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person"></i>
                            </span>
                            <input type="email" name="email" placeholder="Email" class="form-control" required>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-key"></i>
                            </span>
                            <input :type="passwordFieldType" name="password" class="form-control" placeholder="Password" v-model="password" required>
                            <span class="input-group-text cihuy" @click="togglePasswordVisibility">
                                <i :class="passwordIcon"></i>
                            </span>
                        </div>
                        <!-- Pesan Error jika Login Gagal -->
                        @if($errors->any())
                            <div class="alert alert-danger mt-2">
                                {{ $errors->first() }}
                            </div>
                        @endif
                        <div class="form-group form-check d-flex justify-content-between">
                            <div class="checkbox">
                                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                            <a href="#" class="forgot-password">Forgot Password?</a>
                        </div>
                        <div class="login-register">
                            <button type="submit" class="btn">Log In</button>
                            <p class="text-center">Don't have an account yet? <br> <a href="{{ route('register') }}">Register</a> now!</p>  
                        </div>
                    </form>
                </div>
                <div class="card right-card col-lg-6">
                    <div class="logo">
                        <img src="https://smkn2depoksleman.sch.id/utama/wp-content/uploads/2023/03/LOGO-SMK-N-2-DEPOK-SLEMAN-150x150.png" alt="Stembayo">
                        <h3>STEMBAYO</h3>
                    </div>  
                    <div class="img-card">
                        {{-- <img src="{{ asset('storage/images/3Z5sMVptiZHcIKQChuxRQFKB8NvyVawJs0y3ULmw.jpg') }}" class="card-img" alt="CardImage"> --}}
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
