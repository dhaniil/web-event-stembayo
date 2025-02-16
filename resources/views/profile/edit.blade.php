@extends('extend.main') 

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}" />
@endsection

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<section class="profile-page">
    <div class="main-content mt-16">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="left-card">
                        <h1> User Profile</h1>
                            <div class="img-profile d-flex mb-3">
                                <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : 'https://as2.ftcdn.net/v2/jpg/05/89/93/27/1000_F_589932782_vQAEAZhHnq1QCGu5ikwrYaQD0Mmurm0N.jpg' }}" alt="Avatar" class="avatar" draggable="false">
                                <div class="img-option">
                                    <form action="{{ route('profile.update.picture') }}" method="POST" enctype="multipart/form-data" style="display: inline;">
                                        @csrf
                                        <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*" style="display: none;" onchange="this.form.submit()">
                                        <a class="btn1" onclick="document.getElementById('profile_picture').click();">Upload</a>
                                    </form>
                                    <form action="{{ route('profile.delete.picture') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn2">Delete</button>
                                    </form>
                                </div>
                            </div>
                            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="input-profile">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-person-fill"></i>
                                            </span>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-envelope-fill"></i>
                                            </span>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nomer" class="form-label">No HP</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-telephone-fill"></i>
                                            </span>
                                        <input type="text" class="form-control" id="nomer" value="{{ old('nomer', $user->nomer) }}" name="nomer">
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="mb-3 w-100">
                                            <label for="kelas" class="form-label">Kelas</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-easel-fill"></i>
                                                </span>
                                            <select class="form-control" id="kelas" name="kelas">
                                                <option value="10" {{ old('kelas', $user->kelas) == 10 ? 'selected' : '' }}>10</option>
                                                <option value="11" {{ old('kelas', $user->kelas) == 11 ? 'selected' : '' }}>11</option>
                                                <option value="12" {{ old('kelas', $user->kelas) == 12 ? 'selected' : '' }}>12</option>
                                                <option value="13" {{ old('kelas', $user->kelas) == 13 ? 'selected' : '' }}>13</option>
                                            </select>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3 w-100">
                                            <label for="jurusan" class="form-label">Jurusan</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-mortarboard-fill"></i>
                                                </span>
                                            <select class="form-control" id="jurusan" name="jurusan">
                                                <option value="SIJA A" {{ old('jurusan', $user->jurusan) == "SIJA A" ? 'selected' : '' }}>SIJA A</option>
                                                <option value="SIJA B" {{ old('jurusan', $user->jurusan) == "SIJA B" ? 'selected' : '' }}>SIJA B</option>
                                                <option value="TFLM A" {{ old('jurusan', $user->jurusan) == "TFLM A" ? 'selected' : '' }}>TFLM A</option>
                                                <option value="TFLM B" {{ old('jurusan', $user->jurusan) == "TFLM B" ? 'selected' : '' }}>TFLM B</option>
                                                <option value="KA A" {{ old('jurusan', $user->jurusan) == "KA A" ? 'selected' : '' }}>KA A</option>
                                                <option value="KA B" {{ old('jurusan', $user->jurusan) == "KA B" ? 'selected' : '' }}>KA B</option>
                                                <option value="GP A" {{ old('jurusan', $user->jurusan) == "GP A" ? 'selected' : '' }}>GP A</option>
                                                <option value="GP B" {{ old('jurusan', $user->jurusan) == "GP B" ? 'selected' : '' }}>GP B</option>
                                                <option value="DPIB A" {{ old('jurusan', $user->jurusan) == "DPIB A" ? 'selected' : '' }}>DPIB A</option>
                                                <option value="DPIB B" {{ old('jurusan', $user->jurusan) == "DPIB B" ? 'selected' : '' }}>DPIB B</option>
                                                <option value="TKR A" {{ old('jurusan', $user->jurusan) == "TKR A" ? 'selected' : '' }}>TKR A</option>
                                                <option value="TKR B" {{ old('jurusan', $user->jurusan) == "TKR B" ? 'selected' : '' }}>TKR B</option>
                                                <option value="TOI A" {{ old('jurusan', $user->jurusan) == "TOI A" ? 'selected' : '' }}>TOI A</option>
                                                <option value="TOI B" {{ old('jurusan', $user->jurusan) == "TOI B" ? 'selected' : '' }}>TOI B</option>
                                                <option value="TEK A" {{ old('jurusan', $user->jurusan) == "TEK A" ? 'selected' : '' }}>TEK A</option>
                                                <option value="TEK B" {{ old('jurusan', $user->jurusan) == "TEK B" ? 'selected' : '' }}>TEK B</option>
                                                <option value="TKI A" {{ old('jurusan', $user->jurusan) == "TKI A" ? 'selected' : '' }}>TKI A</option>
                                                <option value="TKI B" {{ old('jurusan', $user->jurusan) == "TKI B" ? 'selected' : '' }}>TKI B</option>
                                                <option value="TP" {{ old('jurusan', $user->jurusan) == "TP" ? 'selected' : '' }}>TP</option>
                                                <option value="TBKR" {{ old('jurusan', $user->jurusan) == "TBKR" ? 'selected' : '' }}>TBKR</option>
                                                <option value="TITL" {{ old('jurusan', $user->jurusan) == "TITL" ? 'selected' : '' }}>TITL</option>
                                            </select>
                                        </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="btn-profile">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="right-card">
                        <div class="view-card">
                            <div class="flex justify-center">
                                <img class="avatar" src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : 'https://as2.ftcdn.net/v2/jpg/05/89/93/27/1000_F_589932782_vQAEAZhHnq1QCGu5ikwrYaQD0Mmurm0N.jpg' }}" alt="Avatar" draggable="false">
                            </div>
                            <div class="user">
                                <h3 class="text-sm pt-2 m-0">{{ $user->name }}</h3>
                                <p class="text-xs text-[#5356FF]">{{ $user->email }}</p>
                            </div>
                            <hr>
                            <div class="desc">
                                <div class="w-full">
                                    <span class="jurusan rounded-md py-0.5 px-1 text-[#5356FF] text-sm font-semibold">{{ $user->kelas }} {{ $user->jurusan }}</span>
                                </div>
                                <h4 class="desc-jurusan text-xs">
                                    @if(str_contains($user->jurusan, 'SIJA'))
                                        Sistem Informasi Jaringan dan Aplikasi
                                    @elseif(str_contains($user->jurusan, 'TFLM'))
                                        Teknik Fabrikasi Logam dan Manufaktur
                                    @elseif(str_contains($user->jurusan, 'KA'))
                                        Kimia Analisis
                                    @elseif(str_contains($user->jurusan, 'GP'))
                                        Geologi Pertambangan
                                    @elseif(str_contains($user->jurusan, 'DPIB'))
                                        Desain Pemodelan dan Informasi Bangunan
                                    @elseif(str_contains($user->jurusan, 'TKR'))
                                        Teknik Kendaraan Ringan
                                    @elseif(str_contains($user->jurusan, 'TOI'))
                                        Teknik Otomasi Industrial
                                    @elseif(str_contains($user->jurusan, 'TEK'))
                                        Teknik Elektronika
                                    @elseif(str_contains($user->jurusan, 'TKI'))
                                        Teknik Kimia Industri
                                    @elseif($user->jurusan == 'TP')
                                        Teknik Pemesinan
                                    @elseif($user->jurusan == 'TBKR')
                                        Teknik Bodi Kendaraan Ringan
                                    @elseif($user->jurusan == 'TITL')
                                        Teknik Instalasi Tenaga Listrik
                                    @endif
                                </h4>
                                <h4 class="text-sm">SMKN 2 Depok</h4>
                            </div>
                        </div>
                        <div class="pw-card">
                            <h4>Change Password</h4>
                            <form action="{{ route('profile.update.password') }}" method="POST">
                                @csrf
                                <div class="input-pw">
                                    <div class="mb-3">
                                        <label for="current_password" class="form-label">Current Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-key-fill"></i>
                                            </span>
                                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                                        </div>
                                        @error('current_password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">New Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                            <input type="password" class="form-control" id="password" name="password" required>
                                        </div>
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-shield-lock-fill"></i>
                                            </span>
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-pw">
                                    <button type="submit" class="btn">Change</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection





