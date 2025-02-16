<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Event Stembayo</title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-t from-indigo-200 to-white font-montserrat min-h-screen antialiased">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="w-full max-w-md">
            <!-- Register Card -->
            <div class="bg-white p-8 rounded-3xl shadow-lg animate-fadeIn">
                <div class="text-center mb-8">
                    <h1 class="text-4xl font-extrabold text-indigo-600 mb-1">Register</h1>
                    <p class="text-gray-600">Event Stembayo</p>
                </div>

                @if(session('success'))
                    <div class="p-3 mb-4 rounded-lg bg-green-50 text-green-600 text-sm animate-fade-in">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="p-3 mb-4 rounded-lg bg-red-50 text-red-600 text-sm animate-shake">
                        {{ session('error') }}
                    </div>
                @endif

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
                                class="flex-1 block w-full rounded-r-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-all duration-200 @error('name') border-red-500 @enderror"
                                required
                            >
                        </div>
                        @error('name')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
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
                                class="flex-1 block w-full rounded-r-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-all duration-200 @error('email') border-red-500 @enderror"
                                required
                            >
                        </div>
                        @error('email')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
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
                                class="flex-1 block w-full rounded-r-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-all duration-200 @error('password') border-red-500 @enderror"
                                required
                            >
                        </div>
                        @error('password')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
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
                                class="flex-1 block w-full rounded-r-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-all duration-200 @error('nomer') border-red-500 @enderror"
                                required
                            >
                        </div>
                        @error('nomer')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit"
                        class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full font-medium transition-all duration-200 transform hover:scale-[1.02] hover:shadow-lg"
                    >
                        Sign Up
                    </button>

                    <!-- Login Link -->
                    <p class="text-center text-sm text-gray-600">
                        Sudah memiliki akun?<br>
                        <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:text-indigo-700 hover:underline transition-colors duration-200">Log In</a> Sekarang
                    </p>
                </form>
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
    </style>
</body>
</html>
