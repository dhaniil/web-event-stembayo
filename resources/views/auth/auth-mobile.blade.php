<x-guest-layout>
    <div x-data="{ 
            activeTab: window.location.href.includes('register') ? 'register' : 'login',
            isLoginLoading: false, 
            isRegisterLoading: false, 
            showPassword: false,
            switchTab(tab) {
                this.activeTab = tab;
                window.history.pushState({}, '', `?tab=${tab}`);
            }
        }" 
        class="min-h-screen bg-gradient-to-t from-indigo-200 to-white font-montserrat antialiased overflow-hidden"
        x-cloak>
        <div class="flex min-h-screen items-center justify-center p-4 relative z-10">
            <div class="w-full max-w-md">
                <!-- Auth Container -->
                <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl p-8 relative overflow-hidden">
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <div class="bg-white/80 rounded-2xl w-24 h-24 mx-auto mb-4 flex items-center justify-center shadow-lg">
                            <img src="{{ asset('storage/assets/stembayo.png') }}" alt="STEMBAYO" class="w-16 h-16 object-contain">
                        </div>
                        <h1 class="text-3xl font-bold text-indigo-600 mb-1">Event STEMBAYO</h1>
                        <p class="text-gray-600 text-sm">Platform Event Sekolah</p>
                    </div>

                    <!-- Tab Navigation -->
                    <div class="flex flex-col justify-center mb-8">
                        <nav class="flex bg-gray-100 p-1 rounded-xl">
                            <button 
                                type="button"
                                @click="switchTab('login')"
                                :class="{'bg-white shadow text-indigo-600': activeTab === 'login', 'text-gray-600': activeTab !== 'login'}"
                                class="px-6 py-2.5 text-sm font-medium rounded-lg transition-all duration-200"
                            >
                                <i class="bi bi-box-arrow-in-right mr-2"></i>Masuk
                            </button>
                            <button 
                                type="button"
                                @click="switchTab('register')"
                                :class="{'bg-white shadow text-indigo-600': activeTab === 'register', 'text-gray-600': activeTab !== 'register'}"
                                class="px-6 py-2.5 text-sm font-medium rounded-lg transition-all duration-200"
                            >
                                <i class="bi bi-person-plus mr-2"></i>Daftar
                            </button>
                        </nav>
                    </div>

                    <!-- Login Form -->
                    <div x-show="activeTab === 'login'"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-4"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="space-y-6">
                        <form method="POST" action="{{ route('login') }}" class="space-y-4">
                            @csrf
                            <!-- Email Input -->
                            <div class="space-y-2">
                                <div class="flex">
                                    <span class="inline-flex items-center px-3 rounded-l-xl border border-r-0 border-gray-300 bg-white text-gray-500">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input 
                                        type="email" 
                                        name="email" 
                                        placeholder="Email" 
                                        class="flex-1 block w-full rounded-r-xl border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-all duration-200"
                                        required
                                    >
                                </div>
                            </div>

                            <!-- Password Input -->
                            <div class="space-y-2">
                                <div class="flex">
                                    <span class="inline-flex items-center px-3 rounded-l-xl border border-r-0 border-gray-300 bg-white text-gray-500">
                                        <i class="bi bi-shield-lock"></i>
                                    </span>
                                    <div class="relative flex-1">
                                        <input 
                                            :type="showPassword ? 'text' : 'password'"
                                            name="password" 
                                            placeholder="Password" 
                                            class="w-full rounded-r-xl border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-all duration-200"
                                            required
                                        >
                                        <button 
                                            type="button"
                                            @click="showPassword = !showPassword"
                                            class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-indigo-600"
                                        >
                                            <i class="bi" :class="showPassword ? 'bi-eye-slash' : 'bi-eye'"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Remember Me -->
                            <div class="flex items-center justify-between">
                                <label class="flex items-center">
                                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                                </label>
                            </div>

                            <!-- Error Messages -->
                            @if($errors->any())
                                <div class="p-3 rounded-xl bg-red-50 text-red-600 text-sm">
                                    {{ $errors->first() }}
                                </div>
                            @endif

                            <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-medium transition-all duration-200 transform hover:scale-[1.02] hover:shadow-lg">
                                Masuk
                            </button>
                        </form>
                    </div>

                    <!-- Register Form -->
                    <div x-show="activeTab === 'register'"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-4"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="space-y-6">
                        <form method="POST" action="{{ route('register') }}" class="space-y-4">
                            @csrf
                            <!-- Name -->
                            <div class="space-y-2">
                                <div class="flex">
                                    <span class="inline-flex items-center px-3 rounded-l-xl border border-r-0 border-gray-300 bg-white text-gray-500">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input 
                                        type="text" 
                                        name="name" 
                                        placeholder="Nama Lengkap" 
                                        class="flex-1 block w-full rounded-r-xl border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-all duration-200"
                                        required
                                    >
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="space-y-2">
                                <div class="flex">
                                    <span class="inline-flex items-center px-3 rounded-l-xl border border-r-0 border-gray-300 bg-white text-gray-500">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input 
                                        type="email" 
                                        name="email" 
                                        placeholder="Email" 
                                        class="flex-1 block w-full rounded-r-xl border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-all duration-200"
                                        required
                                    >
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="space-y-2">
                                <div class="flex">
                                    <span class="inline-flex items-center px-3 rounded-l-xl border border-r-0 border-gray-300 bg-white text-gray-500">
                                        <i class="bi bi-shield-lock"></i>
                                    </span>
                                    <div class="relative flex-1">
                                        <input 
                                            :type="showPassword ? 'text' : 'password'"
                                            name="password" 
                                            placeholder="Password" 
                                            class="w-full rounded-r-xl border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-all duration-200"
                                            required
                                        >
                                        <button 
                                            type="button"
                                            @click="showPassword = !showPassword"
                                            class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-indigo-600"
                                        >
                                            <i class="bi" :class="showPassword ? 'bi-eye-slash' : 'bi-eye'"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="space-y-2">
                                <div class="flex">
                                    <span class="inline-flex items-center px-3 rounded-l-xl border border-r-0 border-gray-300 bg-white text-gray-500">
                                        <i class="bi bi-shield-lock"></i>
                                    </span>
                                    <div class="relative flex-1">
                                        <input 
                                            :type="showPassword ? 'text' : 'password'"
                                            name="password_confirmation" 
                                            placeholder="Konfirmasi Password" 
                                            class="w-full rounded-r-xl border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-all duration-200"
                                            required
                                        >
                                        <button 
                                            type="button"
                                            @click="showPassword = !showPassword"
                                            class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-indigo-600"
                                        >
                                            <i class="bi" :class="showPassword ? 'bi-eye-slash' : 'bi-eye'"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-medium transition-all duration-200 transform hover:scale-[1.02] hover:shadow-lg">
                                Daftar
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Footer -->
                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-600">
                        SMK Negeri 2 Depok Sleman &copy; {{ date('Y') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Link Stylesheet -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </div>
</x-guest-layout>
