@extends('extend.main')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stembayo Events</title>
    @include('assets/asset')

    @vite('resources/css/app.css')

    @section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />
    @endsection

</head>
<style>
    /* css di public/css/dashboard.css */
</style>
<body>
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
    <img src="https://i.ibb.co/LhwSwy5/SOC02116.jpg" class="d-block w-full bg-grey-500" style="width: 100%" alt="..." draggable="false">
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
              <div class="slide w-full flex-shrink-0">
                <img src="https://i.ibb.co.com/QCKD2xz/banner.png" alt="Slide1 1458x325" class="w-full h-full object-cover" />
              </div>
              <div class="slide w-full flex-shrink-0 object">
                <img src="https://i.ibb.co.com/QCKD2xz/banner.png" alt="Slide2 1458x325" class="w-full  h-full object-cover" />
              </div>
              <div class="slide w-full flex-shrink-0">
                <img src="https://i.ibb.co.com/QCKD2xz/banner.png" alt="Slide3 1458x325" class="w-full h-full object-cover" />
              </div>
            </div>
            <div class="indicators absolute left-1/2  flex z-30 justify-center gap-3 h-4 p-2 transform -translate-x-1/2 -translate-y-[30px]  items-center rounded-t-lg">
                <button class="indicator w-1 h-1 sm:w-1 sm:h-1 md:w-2 md:h-2 lg:w-2 lg:h-2  bg-gray-300 rounded-full"></button>
                <button class="indicator w-1 h-1 sm:w-1 sm:h-1 md:w-2 md:h-2 lg:w-2 lg:h-2  bg-gray-300 rounded-full"></button>
                <button class="indicator w-1 h-1 sm:w-1 sm:h-1 md:w-2 md:h-2 lg:w-2 lg:h-2  bg-gray-300 rounded-full"></button>
            </div>
        </div>
        
    </section>

    
      

    <main class="main-content">
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
                                            <h4 class="title text-center">Events</h4>
                                        </div>
                                        <div class="option col-12 col-md-auto d-flex justify-content-center align-items-center flex-wrap">
                                        </div>
                                    </div>
                                </div>


                                <div class="card-body">
                                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                                        <div class="carousel-inner">
                                            <!-- @php
                                                $chunks = $events->chunk(4);
                                            @endphp
                                
                                            @foreach($chunks as $chunkIndex => $chunk) -->
                                                <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                                                    <div class="row">
                                                        <!-- @foreach($chunk as $event) -->
                                                            <div class="col-lg-3 col-md-4 col-sm-6 col-5">
                                                                <div class="card">
                                                                    <a href="{{ route('events.show', $event->id) }}" class="img-href">
                                                                        <img src="{{ asset('storage/' . $event->image) }}" alt="Image" class="card-img" loading="lazy">
                                                                        <div class="event-name d-flex flex-column">
                                                                            <figcaption>{{ $event->name }}</figcaption>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        <!-- @endforeach -->
                                                    </div>
                                                </div>
                                            <!-- @endforeach -->
                                        </div>
                                    </div>
                                </div>

                                 <!-- <div class="card-footer">
                                    <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item">
                                        <a class="page-link" data-bs-target="#carouselExample" data-bs-slide="prev">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                        </li>
                                        <li class="page-item"><a class="page-link" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1">1</a></li>
                                        <li class="page-item"><a class="page-link" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2">2</a></li>
                                        <li class="page-item">
                                        <a class="page-link" data-bs-target="#carouselExample" data-bs-slide="next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                        </li>
                                    </ul>
                                    </nav>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            
        </section>
    </main>     


    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>  -->
    <script src="{{ asset('js/filament/dashboard/move.js') }}"></script>
</body>
</html>