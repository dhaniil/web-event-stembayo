<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('assets/asset')
    <link rel="stylesheet" href="{{ asset('css/regist-page.css') }}"> 
    <title>Register</title>
    <!-- Tambahkan Vue.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
</head>

<body>
    <section class="regist-form">
        <div class="container-fluid">
            <div class="regist-card">
                <div class="judul">
                    <h1>Register</h1>
                    <p>Event Stembayo</p>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-person"></i>
                        </span>
                        <input type="text" name="name" placeholder="Name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input type="email" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-key"></i>
                        </span>
                        <input type="password" name="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-key-fill"></i>
                        </span>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control" required>
                    </div>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-phone"></i>
                        </span>
                        <input type="text" name="nomer" placeholder="Nomor HP" class="form-control @error('nomer') is-invalid @enderror" value="{{ old('nomer') }}" required>
                        @error('nomer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="login-register">
                        <button type="submit" class="btn">Sign Up</button>
                        <p class="text-center">Alredy have account? <br> <a href="{{ route('login') }}">Log In</a> now!</p>  
                    </div>
                </form>
            </div>
        </div>
</body>
