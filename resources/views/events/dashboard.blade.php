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
        <!-- About -->
        <!-- <section class="about text-start text-dark py-5">
            <div class="container">
                <h1 class="display-4">Events</h1>
                <p class="deskripsi">Pada saat tahun ajaran baru di bulan Januari 1972, Kompleks Sekolah yang terletak di dukuh Mrican, Caturtunggal, Depok, Sleman, Yogyakarta, belum selesai secara sempurna baik dari bangunan fisik dan peralatan belajar, sehingga awal penerimaan siswa pertama tidak dilakukan di Kampus STM pembangunan Mrican, akan tetapi dilakukan di STM Negeri 1 Jetis.</p>
                <p class="deskripsi">Nama STEMBAYO tercetus pada tahun kedua sejak berdirinya sekolah yaitu tahun 1973. Untuk keperluan kegiatan ekstra kurikuler pada saat itu sekelompok siswa pecinta alam mendirikan perkumpulan Camille Papasektembayo (Putra Pecinta Alam STM Pembangunan Yogyakarta) yang selanjutnya secara lebih mudah mereka menyebut Pecinta Alam STEMBAYO. Nama ini diketahui oleh pengelola sekolah, sehingga istilah STEMBAYO lebih dikenal dan familiar untuk sebutan STM Pembangunan Yogyakarta hingga sekarang.</p>
                <!-- <a href="#" class="btn btn-warning btn-lg">Get Started</a> -->
            </div>
        </section> 

        <!-- Event -->
        <section class="event" >
            <div id="app" class="container">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h4 class="title">Events</h4>
                                <!-- <p class="info">Berikut Event-event yang akan segera hadir di Stembayo</p> -->
                            </div>
                            <div class="option col-12 col-md-auto d-flex justify-content-center align-items-center flex-wrap">
                                <!-- <a class="button"href="#">Terbaru</a>
                                <a class="button"href="#">Tanggal</a>
                                <a class="button"href="#">Sekbid</a> -->
                                <a class="button"href="{{ route('events.eventonly') }}">See More</a>
                            </div>
                        </div>
                    </div>


                    <div class="card-body">
                        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="row">
                                    @foreach($events as $event)
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-5" v-for="(card, index) in cards" :key="index">
                                            <div class="card">
                                                <a href="{{ route('events.show', $event->id) }}" class="img-href">
                                                <img src="{{ asset('storage/' . $event->image) }}" alt="Image" class="card-img">
                                                <div class="event-name d-flex flex-column">
                                                    <figcaption>{{ $event->name }}</figcaption>
                                                </a>
                                                    <!-- <h5 class="card-title">[[ card.title ]]</h5> -->
                                                    <!-- <p class="card-text">[[ card.description ]]</p> -->
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="card-footer">
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
                </div>
                </div>
            </div>
        </section>
    </main>     



    <!-- Footer -->
    @include('layout.footer')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>