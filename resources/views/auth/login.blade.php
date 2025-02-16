<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Event Stembayo</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-t from-indigo-200 to-white font-montserrat min-h-screen antialiased">
    <div id="app" class="flex items-center justify-center min-h-screen p-4" v-cloak>
        <div class="flex w-full max-w-6xl relative">
            <!-- Left Card - Login Form -->
            <div class="w-full md:w-[400px] bg-white p-8 rounded-3xl shadow-lg z-10 transform translate-x-0 md:translate-x-24 transition-all duration-500 ease-in-out opacity-0 animate-fadeIn">
                <div class="text-center mb-8">
                    <h1 class="text-4xl font-extrabold text-indigo-600 mb-1">Welcome!</h1>
                    <p class="text-gray-600">Event Stembayo</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    <!-- Email Input -->
                    <div class="relative">
                        <div class="flex">
                            <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-300 bg-white text-gray-500">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input 
                                type="email" 
                                name="email" 
                                v-model="email"
                                @input="validateEmail"
                                placeholder="Email" 
                                class="flex-1 block w-full rounded-r-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-all duration-200"
                                :class="{'border-red-500': emailError}"
                                required
                            >
                        </div>
                        <p v-if="emailError" class="mt-1 text-xs text-red-500">@{{ emailError }}</p>
                    </div>

                    <!-- Password Input -->
                    <div class="relative">
                        <div class="flex">
                            <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-300 bg-white text-gray-500">
                                <i class="bi bi-key"></i>
                            </span>
                            <input 
                                :type="passwordFieldType"
                                name="password" 
                                v-model="password"
                                placeholder="Password" 
                                class="flex-1 block w-full rounded-none border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-all duration-200"
                                required
                            >
                            <button 
                                type="button"
                                @click="togglePasswordVisibility"
                                class="inline-flex items-center px-3 rounded-r-lg border border-l-0 border-gray-300 bg-white text-gray-500 hover:bg-gray-50 transition-colors duration-200"
                            >
                                <i :class="passwordIcon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Error Messages -->
                    @if($errors->any())
                        <div class="p-3 rounded-lg bg-red-50 text-red-600 text-sm animate-shake">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input 
                            type="checkbox"
                            name="remember"
                            id="remember"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        >
                        <label for="remember" class="ml-2 text-sm text-gray-600">Ingat saya</label>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit"
                        :disabled="isLoading || !isFormValid"
                        class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full font-medium transition-all duration-200 transform hover:scale-[1.02] hover:shadow-lg disabled:bg-indigo-400 disabled:cursor-not-allowed disabled:transform-none"
                        :class="{'relative': isLoading}"
                    >
                        <span v-if="!isLoading">Log In</span>
                        <svg v-else class="animate-spin h-5 w-5 text-white mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>

                    <!-- Register Link -->
                    <p class="text-center text-sm text-gray-600">
                        Belum memiliki akun?<br>
                        <a href="{{ route('register') }}" class="text-indigo-600 font-semibold hover:text-indigo-700 hover:underline transition-colors duration-200">Register</a> Sekarang
                    </p>
                </form>
            </div>

            <!-- Right Card - Image -->
            <div class="hidden md:block w-[400px] bg-indigo-600 p-8 rounded-3xl shadow-lg -translate-x-24 relative overflow-hidden">
                <div class="relative z-10 text-center">
                    <img 
                        src="https://smkn2depoksleman.sch.id/utama/wp-content/uploads/2023/03/LOGO-SMK-N-2-DEPOK-SLEMAN-150x150.png" 
                        alt="Stembayo"
                        class="w-24 h-24 mx-auto"
                    >
                    <h3 class="text-2xl font-bold text-white mt-4">STEMBAYO</h3>
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-indigo-600/50 to-black/40"></div>
                <div class="absolute inset-0 bg-[url('https://i.ibb.co/LhwSwy5/SOC02116.jpg')] bg-cover bg-center -z-10"></div>
            </div>
        </div>
    </div>

    <style>
        @keyframes shake {
            10%, 90% { transform: translate3d(-1px, 0, 0); }
            20%, 80% { transform: translate3d(2px, 0, 0); }
            30%, 50%, 70% { transform: translate3d(-4px, 0, 0); }
            40%, 60% { transform: translate3d(4px, 0, 0); }
        }
        .animate-shake { animation: shake 0.82s cubic-bezier(.36,.07,.19,.97) both; }
        .animate-fadeIn { animation: fadeIn 0.8s ease forwards; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        [v-cloak] { display: none; }
    </style>

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
