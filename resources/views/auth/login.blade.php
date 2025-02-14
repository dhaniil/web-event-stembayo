<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('assets/asset')
    <link rel="stylesheet" href="{{ asset('css/login-page.css') }}"> 
    <title>Login</title>
    <!-- Vue.js dan animasi -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        .fade-enter-active, .fade-leave-active {
            transition: opacity 0.5s;
        }
        .fade-enter, .fade-leave-to {
            opacity: 0;
        }
        .loading {
            position: relative;
            pointer-events: none;
        }
        .loading:after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin: -10px 0 0 -10px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .input-group {
            margin-bottom: 1rem;
            position: relative;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
            border-color: #80bdff;
        }
        .alert {
            animation: shake 0.82s cubic-bezier(.36,.07,.19,.97) both;
        }
        @keyframes shake {
            10%, 90% { transform: translate3d(-1px, 0, 0); }
            20%, 80% { transform: translate3d(2px, 0, 0); }
            30%, 50%, 70% { transform: translate3d(-4px, 0, 0); }
            40%, 60% { transform: translate3d(4px, 0, 0); }
        }
        @media (max-width: 768px) {
            .right-card {
                display: none;
            }
            .left-card {
                width: 100% !important;
                padding: 2rem !important;
            }
        }
    </style>
</head>
<body>
    <section class="login-form animate__animated animate__fadeIn">
        <div id="app" class="container-fluid" v-cloak>
            <div class="row">
                <div class="card left-card col-lg-6 h-auto">
                    <div class="judul">
                        <h1 class="login-title">Welcome!</h1>
                        <p>Event Stembayo</p>
                    </div>
                    <!-- Form Login -->
                    <form class="login" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input 
                                type="email" 
                                name="email" 
                                v-model="email"
                                placeholder="Email" 
                                class="form-control" 
                                :class="{'is-invalid': emailError}"
                                @input="validateEmail"
                                required>
                            <div class="invalid-feedback" v-if="emailError">
                                @{{ emailError }}
                            </div>
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
                                <label class="form-check-label" for="remember">Ingat saya</label>
                            </div>
                            <!-- <a href="#" class="forgot-password">Forgot Password?</a> -->
                        </div>
                        <div class="login-register">
                            <button type="submit" class="btn" :class="{'loading': isLoading}" :disabled="isLoading || !isFormValid">
                                @{{ isLoading ? 'Loading...' : 'Log In' }}
                            </button>
                            <p class="text-center">Belum memiliki akun?<br> <a href="{{ route('register') }}">Register</a> Sekarang</p>  
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
                email: '',
                password: '',
                passwordFieldType: 'password',
                isLoading: false,
                emailError: '',
                passwordIcon: 'bi bi-eye-slash'
            },
            computed: {
                isFormValid() {
                    return this.email && this.password && !this.emailError;
                }
            },
            methods: {
                togglePasswordVisibility() {
                    this.passwordFieldType = this.passwordFieldType === 'password' ? 'text' : 'password';
                    this.passwordIcon = this.passwordFieldType === 'password' ? 'bi bi-eye-slash' : 'bi bi-eye';
                },
                validateEmail() {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!this.email) {
                        this.emailError = 'Email is required';
                    } else if (!emailRegex.test(this.email)) {
                        this.emailError = 'Please enter a valid email address';
                    } else {
                        this.emailError = '';
                    }
                }
            },
            mounted() {
                const form = document.querySelector('form');
                form.addEventListener('submit', () => {
                    if (this.isFormValid) {
                        this.isLoading = true;
                    }
                });
            }
        });
    </script>
</body>
</html>
