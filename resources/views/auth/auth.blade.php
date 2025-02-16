<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth - Event Stembayo</title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
</head>
<body class="bg-gradient-to-t from-indigo-200 to-white font-montserrat min-h-screen antialiased overflow-hidden">
    <!-- Background & Balloon Container -->
    <div class="fixed inset-0 pointer-events-none">
        <!-- Gradient Background -->
        <div class="absolute inset-0 bg-gradient-to-t from-indigo-200 to-white"></div>
        
        <!-- Balloon Container -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="balloon balloon-1"></div>
            <div class="balloon balloon-2"></div>
            <div class="balloon balloon-3"></div>
            <div class="balloon balloon-4"></div>
            <div class="balloon balloon-5"></div>
            <div class="balloon balloon-6"></div>
            <div class="balloon balloon-7"></div>
            <div class="balloon balloon-8"></div>
        </div>
    </div>

    <div id="app" class="flex items-center justify-center min-h-screen p-4 relative z-10" v-cloak>
        <div class="relative w-full max-w-[800px] h-[600px]">
            <!-- Container for both forms -->
            <div class="flex w-full h-full relative">
                <!-- Login Form - Left Side -->
                <div class="w-1/2 bg-white rounded-l-3xl p-8 shadow-lg">
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
                    </form>
                </div>

                <!-- Register Form - Right Side -->
                <div class="w-1/2 bg-white rounded-r-3xl p-8 shadow-lg">
                    <div class="text-center mb-8">
                        <h1 class="text-4xl font-extrabold text-indigo-600 mb-1">Register</h1>
                        <p class="text-gray-600">Event Stembayo</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-4">
                        @csrf
                        <!-- Name Input -->
                        <div class="relative">
                            <div class="flex">
                                <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-300 bg-white text-gray-500">
                                    <i class="bi bi-person"></i>
                                </span>
                                <input 
                                    type="text" 
                                    name="name" 
                                    placeholder="Name" 
                                    value="{{ old('name') }}"
                                    class="flex-1 block w-full rounded-r-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-all duration-200"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Email Input -->
                        <div class="relative">
                            <div class="flex">
                                <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-300 bg-white text-gray-500">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input 
                                    type="email" 
                                    name="email" 
                                    placeholder="Email" 
                                    value="{{ old('email') }}"
                                    class="flex-1 block w-full rounded-r-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-all duration-200"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Password Input -->
                        <div class="relative">
                            <div class="flex">
                                <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-300 bg-white text-gray-500">
                                    <i class="bi bi-key"></i>
                                </span>
                                <input 
                                    type="password" 
                                    name="password" 
                                    placeholder="Password" 
                                    class="flex-1 block w-full rounded-r-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-all duration-200"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Confirm Password Input -->
                        <div class="relative">
                            <div class="flex">
                                <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-300 bg-white text-gray-500">
                                    <i class="bi bi-key-fill"></i>
                                </span>
                                <input 
                                    type="password" 
                                    name="password_confirmation" 
                                    placeholder="Confirm Password" 
                                    class="flex-1 block w-full rounded-r-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-all duration-200"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Phone Number Input -->
                        <div class="relative">
                            <div class="flex">
                                <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-300 bg-white text-gray-500">
                                    <i class="bi bi-phone"></i>
                                </span>
                                <input 
                                    type="text" 
                                    name="nomer" 
                                    placeholder="Nomor HP" 
                                    value="{{ old('nomer') }}"
                                    class="flex-1 block w-full rounded-r-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-all duration-200"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button 
                            type="submit"
                            class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full font-medium transition-all duration-200 transform hover:scale-[1.02] hover:shadow-lg"
                        >
                            Sign Up
                        </button>
                    </form>
                </div>

                <!-- Sliding Overlay -->
                <div 
                    class="absolute top-0 w-1/2 h-full bg-indigo-600/90 backdrop-blur-sm rounded-3xl shadow-lg transition-transform duration-500 ease-in-out transform"
                    :class="[isLoginView ? 'translate-x-0' : 'translate-x-full']"
                >
                    <!-- Overlay Content for Login View -->
                    <div v-if="isLoginView" class="relative z-10 h-full flex flex-col items-center justify-center text-white p-8 text-center">
                        <h2 class="text-3xl font-bold mb-4">Sudah memiliki akun?</h2>
                        <p class="mb-8">Login sekarang dan bergabung!</p>
                        <button 
                            @click="toggleView"
                            class="px-8 py-2 border-2 border-white rounded-full hover:bg-white hover:text-indigo-600 transition-colors duration-300"
                        >
                            Login
                        </button>
                    </div>

                    <!-- Overlay Content for Register View -->
                    <div v-else class="relative z-10 h-full flex flex-col items-center justify-center text-white p-8 text-center">
                        <h2 class="text-3xl font-bold mb-4">Belum memiliki akun?</h2>
                        <p class="mb-8">Daftar sekarang dan bergabung dengan Event Stembayo!</p>
                        <button 
                            @click="toggleView"
                            class="px-8 py-2 border-2 border-white rounded-full hover:bg-white hover:text-indigo-600 transition-colors duration-300"
                        >
                            Register
                        </button>
                    </div>
                </div>
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

        @keyframes float {
            0% { 
                transform: translateY(150vh) translateX(var(--tx-start)) rotate(0deg) scale(0.8); 
                opacity: 0; 
            }
            20% { 
                transform: translateY(100vh) translateX(calc(var(--tx-start) + 30px)) rotate(10deg) scale(1); 
                opacity: 0.4; 
            }
            40% { 
                transform: translateY(60vh) translateX(calc(var(--tx-start) - 30px)) rotate(-10deg) scale(1.1); 
                opacity: 0.8;
            }
            50% { 
                transform: translateY(40vh) translateX(var(--tx-start)) rotate(0deg) scale(1.2); 
                opacity: 1;
            }
            60% { 
                transform: translateY(20vh) translateX(calc(var(--tx-start) + 20px)) rotate(8deg) scale(1.1); 
                opacity: 0.8;
            }
            80% { 
                transform: translateY(-20vh) translateX(calc(var(--tx-start) - 20px)) rotate(-8deg) scale(1); 
                opacity: 0.4;
            }
            100% { 
                transform: translateY(-80vh) translateX(var(--tx-start)) rotate(0deg) scale(0.8); 
                opacity: 0;
            }
        }

        .balloon {
            position: absolute;
            width: var(--size);
            height: var(--size);
            background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.4));
            border-radius: 50%;
            box-shadow: 
                0 4px 8px rgba(0, 0, 0, 0.1),
                inset -3px -3px 8px rgba(0, 0, 0, 0.1),
                0 0 20px rgba(255, 255, 255, 0.4);
            animation: float var(--duration) infinite ease-in-out;
            transform-origin: center;
            will-change: transform, opacity;
            bottom: -50px;
        }

        .balloon-1 { --size: 25px; --left: 10%; --duration: 14s; --tx-start: 20px; animation-delay: -2s; left: var(--left); }
        .balloon-2 { --size: 35px; --left: 30%; --duration: 16s; --tx-start: -25px; animation-delay: -4s; left: var(--left); }
        .balloon-3 { --size: 20px; --left: 50%; --duration: 12s; --tx-start: 30px; animation-delay: -1s; left: var(--left); }
        .balloon-4 { --size: 30px; --left: 70%; --duration: 15s; --tx-start: -15px; animation-delay: -3s; left: var(--left); }
        .balloon-5 { --size: 40px; --left: 20%; --duration: 18s; --tx-start: 25px; animation-delay: -5s; left: var(--left); }
        .balloon-6 { --size: 28px; --left: 45%; --duration: 13s; --tx-start: -20px; animation-delay: -2.5s; left: var(--left); }
        .balloon-7 { --size: 32px; --left: 65%; --duration: 17s; --tx-start: 15px; animation-delay: -6s; left: var(--left); }
        .balloon-8 { --size: 22px; --left: 85%; --duration: 11s; --tx-start: -10px; animation-delay: -3.5s; left: var(--left); }

        .animate-shake { animation: shake 0.82s cubic-bezier(.36,.07,.19,.97) both; }
        [v-cloak] { display: none; }
    </style>

    <script>
        new Vue({
            el: '#app',
            data: {
                isLoginView: true,
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
                toggleView() {
                    this.isLoginView = !this.isLoginView;
                },
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
            }
        });
    </script>
</body>
</html>
