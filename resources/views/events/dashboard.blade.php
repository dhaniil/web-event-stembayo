@extends('extend.main')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />
@endsection

@section('content')
    <!-- Navbar -->
    <!-- <nav class="navbar sticky-top navbar-expand-lg ">
        <div class="container p-4">
        <a class="navbar-brand px-2" href="https://www.instagram.com/smkn2depoksleman.official?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==">
            <img src="https://i.ibb.co.com/P5Lyxyc/stmby.png" alt="Logo" width="80" height="80" class="d-inline-block align-middle">
           STEMBAYO
            </a>
            {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
            </button> --}}
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    {{-- <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cart</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link " href="#">Log In</a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </nav> -->

    <!-- Carousel Awal -->
<div class="carousel">
    <div class="gambar-awal">
  <div class="carousel-inner">
    <div class="carousel-item active">
    <img src="{{ asset('storage/assets/SOC02116.jpg') }}" class="d-block w-full bg-grey-500" style="width: 100%" alt="..." draggable="false">
    <div class="carousel-caption text-center"></div>
      <div id="caption" class="carousel-caption text-center">
        <h1 class="judul font-extrabold text-1xl sm:text-4xl md:text-6xl lg:text-5xl text-center">SELAMAT DATANG</h1>
        <h4 class="dikit text-center font-medium text-xs sm:text-sm  md:text-xl lg:text-1xl">Seputar Info Mengenai Event Stembayo</h4>
        <!-- <input type="text" class="search-bar form-control" placeholder="Search Event" aria-label="Search"> -->
        <a class="button mt-2 active:scale-90" id="scroll" type="submit">See More</a>
      </div>
      </div>
    </div>
    </div>
    </div>

      
    <section id="sorotan-event" class="flex m-6 justify-center">
        <div class="carousel relative w-full max-w-6xl mx-auto overflow-hidden rounded-2xl shadow-lg">
            <div class="slides flex transition-transform duration-500 ease-in-out">
                @php
                    $banners = App\Models\EventBanner::all();
                @endphp
                @if(count($banners) > 0)
                    @foreach($banners as $banner)
                        <div class="slide w-full flex-shrink-0">
                            @if($banner->image && file_exists(public_path('storage/' . $banner->image)))
                                <img src="{{ asset('storage/' . $banner->image) }}" alt="Banner" class="w-full h-full object-cover" />
                            @else
                                <p>No image found.</p>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="slide w-full flex-shrink-0">
                        <p>No banners found.</p>
                    </div>
                @endif
            </div>
            <div class="indicators absolute left-1/2  flex z-30 justify-center gap-3 h-4 p-2 transform -translate-x-1/2 -translate-y-[30px]  items-center rounded-t-lg">
                @if(count($banners) > 0)
                    @foreach($banners as $index => $banner)
                        <button class="indicator w-1 h-1 sm:w-1 sm:h-1 md:w-2 md:h-2 lg:w-2 lg:h-2  bg-gray-300 rounded-full"></button>
                    @endforeach
                @endif
            </div>
        </div>

    </section>

    
      

    <main class="main-content bg-transparent p-0">
        <!-- Event -->
        <section id="event" class="event" >
            <div id="app">
                <div class="carousel-event position-relative">
                    <div class="d-flex justify-content-center">
                        <div class="col-10">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col">
                                            <h4 class="title">Events</h4>
                                        </div>
                                        <div class="option col-12 col-md-auto d-flex justify-content-center align-items-center flex-wrap">
                                            <div class="filter-container mb-4">
                                                <form action="{{ route('events.dashboard') }}" method="GET" class="d-flex align-items-center">
                                                    <div class="input-group me-2">
                                                        <input type="text" 
                                                               name="tanggal" 
                                                               id="datepicker" 
                                                               class="form-control datepicker" 
                                                               value="{{ request('tanggal') }}" 
                                                               placeholder="Pilih Tanggal" 
                                                               autocomplete="off">
                                                    </div>
                                                    
                                                    <select name="kategori" class="form-control me-2">
                                                        <option value="">Pilih Kategori</option>
                                                        @php
                                                            $categories = [
                                                                'KTYME Islam', 'KTYME Kristiani', 'KBBP', 'KBPL',
                                                                'BPPK', 'KK', 'PAKS', 'KJDK', 'PPBN', 'HUMTIK'
                                                            ];
                                                        @endphp
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category }}" {{ request('kategori') == $category ? 'selected' : '' }}>
                                                                {{ $category }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                                                    <a href="{{ route('events.dashboard') }}" class="btn btn-secondary">Reset</a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="body-card">
                                    <div class="atasan-card flex justify-center items-center gap-4 p-4 flex-wrap">
                                        @forelse($events as $event)
                                            <div class="kard transition-all rounded-xl">
                                                <a href="{{ route('events.show', $event->id) }}" class="img-href no-underline">
                                                    <div class="p-2 bg-white flex flex-col rounded-xl justify-center items-center">
                                                        <img src="{{ asset('storage/' . $event->image) }}" alt="Image" class="card-img" loading="lazy">
                                                        <div class="flex flex-col items-center text-center w-full">
                                                            <h1 class="head text-lg max-w-sm text-center text-black w-full">{{ $event->name }}</h1>
                                                            <p class="desc max-w-sm w-full">{{ $event->description }}</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @empty
                                            <div class="text-center w-full p-4">
                                                <p>No events found matching your criteria.</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            
        </section>
    </main>     


@endsection

@section('scripts')
<script src="{{ asset('js/filament/dashboard/move.js') }}"></script>
@endsection
