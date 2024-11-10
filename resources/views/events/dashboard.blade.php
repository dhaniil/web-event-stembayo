<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stembayo Events</title>
    {{-- ambil dari assets/asset --}}
    @include('assets/asset')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" /> 
</head>
<style>
    /* css di public/css/dashboard.css */
</style>
<body>
    <!-- Navbar -->
    <nav class="navbar sticky-top navbar-expand-lg ">
        <div class="container">
        <a class="navbar-brand" href="https://www.instagram.com/smkn2depoksleman.official?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==">
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
    </nav>

    <!-- Carousel Awal -->
<div class="carousel">
    <div class="gambar-awal">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://i.ibb.co.com/LhwSwy5/SOC02116.jpg" class="d-block w-100" alt="...">
      <!-- https://smkn2depoksleman.sch.id/utama/wp-content/uploads/2024/03/DSC_0003-4.jpg -->
      <div class="carousel-caption">
        <h4 class="judul">Website Event Stembayo</h4>
        <p>Selamat Datang Anggap Saja Sekolah Sendiri</p>
        <!-- <input type="text" class="search-bar form-control" placeholder="Search Event" aria-label="Search"> -->
        <!-- <a class="button" type="submit">See More</a> -->
      </div>
      </div>
    </div>
    </div>
    </div>


    <main class="main-content">
        <!-- Event -->
        <section class="event" >
               
            <div id="app">
                <div class="carousel-event position-relative">
                    <div class="row justify-content-center">
                        <div class="col">
                            <div class="prev">
                                <a class="page-link" data-bs-target="#carouselExample" data-bs-slide="prev">
                                    <span><i class="bi bi-caret-left"></i>
                                    </span>
                                </a>
                            </div>
                        </div>

                        <div class="col-10">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col">
                                            <h4 class="title">Events</h4>
                                        </div>
                                        <div class="option col-12 col-md-auto d-flex justify-content-center align-items-center flex-wrap">
                                            <a class="button"href="{{ route('events.eventonly') }}">See More</a>
                                        </div>
                                    </div>
                                </div>


                                <div class="card-body">
                                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                                        <div class="carousel-inner">
                                            @php
                                                $chunks = $events->chunk(4);
                                            @endphp
                                
                                            @foreach($chunks as $chunkIndex => $chunk)
                                                <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                                                    <div class="row">
                                                        @foreach($chunk as $event)
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
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="card-footer">
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
                                </div> --}}
                            </div>
                        </div>

                        <div class="col">
                            <div class="next">
                                <a class="page-link" data-bs-target="#carouselExample" data-bs-slide="next">
                                    <span><i class="bi bi-caret-right"></i>
                                    </span>
                                </a>
                            </div>  
                        </div>
                    </div>
                </div> 
            </div>
            
        </section>
    </main>     



    <!-- Footer -->
    @include('layouts.footer')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>