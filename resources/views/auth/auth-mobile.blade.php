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
<body class="bg-gradient-to-t from-indigo-200 to-white font-montserrat min-h-screen antialiased">
    <div id="app" class="min-h-screen" v-cloak>
        <!-- Login Form -->
        <div v-if="isLoginView" class="p-4">
            <div class="text-center mb-8 pt-8">
                <h1 class="text-3xl font-extrabold text-indigo-600 mb-1">Selamat datang!</h1>
                <p class="text-gray-600">Event Stembayo</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <!-- Email Input -->
                <div class="space-y-2">
                    <label class="text-sm text-gray-600">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        v-model="email"
                        @input="validateEmail"
                        placeholder="Email" 
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                        required
                    >
                    <p v-if="emailError" class="text-xs text-red-500">@{{ emailError }}</p>
                </div>

                <!-- Password Input -->
                <div class="space-y-2">
                    <label class="text-sm text-gray-600">Password</label>
                    <div class="relative">
                        <input 
                            :type="passwordFieldType"
                            name="password" 
                            v-model="password"
                            placeholder="Password" 
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                            required
                        >
                        <button 
                            type="button"
                            @click="togglePasswordVisibility"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2"
                        >
                            <i :class="passwordIcon"></i>
                        </button>
                    </div>
                </div>

                @if($errors->any())
                    <div class="p-3 rounded-lg bg-red-50 text-red-600 text-sm">
                        {{ $errors->first() }}
                    </div>
                @endif

                <button 
                    type="submit"
                    :disabled="!isFormValid"
                    class="w-full py-3 bg-indigo-600 text-white rounded-lg font-medium disabled:bg-indigo-400"
                >
                    Login
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-600">Belum punya akun?</p>
                <button 
                    @click="toggleView"
                    class="mt-2 text-indigo-600 font-medium"
                >
                    Register
                </button>
            </div>
        </div>

        <!-- Register Form -->
        <div v-else class="p-4">
            <div class="text-center mb-8 pt-8">
                <h1 class="text-3xl font-extrabold text-indigo-600 mb-1">Register</h1>
                <p class="text-gray-600">Event Stembayo</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                <!-- Name Input -->
                <div class="space-y-2">
                    <label class="text-sm text-gray-600">Nama</label>
                    <input 
                        type="text" 
                        name="name" 
                        placeholder="Nama Lengkap" 
                        value="{{ old('name') }}"
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                        required
                    >
                </div>

                <!-- Email Input -->
                <div class="space-y-2">
                    <label class="text-sm text-gray-600">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="Email" 
                        value="{{ old('email') }}"
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                        required
                    >
                </div>

                <!-- Password Input -->
                <div class="space-y-2">
                    <label class="text-sm text-gray-600">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="Password" 
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                        required
                    >
                </div>

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <label class="text-sm text-gray-600">Konfirmasi Password</label>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        placeholder="Konfirmasi Password" 
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                        required
                    >
                </div>

                <!-- Phone Number -->
                <div class="space-y-2">
                    <label class="text-sm text-gray-600">Nomor HP</label>
                    <input 
                        type="text" 
                        name="nomer" 
                        placeholder="Nomor HP" 
                        value="{{ old('nomer') }}"
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                        required
                    >
                </div>

                <button 
                    type="submit"
                    class="w-full py-3 bg-indigo-600 text-white rounded-lg font-medium"
                >
                    Register
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-600">Sudah punya akun?</p>
                <button 
                    @click="toggleView"
                    class="mt-2 text-indigo-600 font-medium"
                >
                    Login
                </button>
            </div>
        </div>
    </div>

    <script>
        new Vue({
            el: '#app',
            data: {
                isLoginView: true,
                email: '',
                password: '',
                passwordFieldType: 'password',
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