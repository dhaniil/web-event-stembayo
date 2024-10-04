<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stembayo Events</title>
    <!-- CDN Bootsrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jersey+10&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Pixelify+Sans:wght@400..700&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <!-- CSS & Logo -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" /> 
    <link rel="icon" href="https://smkn2depoksleman.sch.id/utama/wp-content/uploads/2024/09/cropped-Untitled-design-5-3.png" type="image/icon"> 
</head>
<style>
    /* css di public/css/dashboard.css */
</style>
<body>

    <!-- Navbar -->
    <nav class="navbar sticky-top navbar-expand-lg ">
        <div class="container">
        <a class="navbar-brand" href="#">
            <img src="https://i.ibb.co.com/P5Lyxyc/stmby.png" alt="Logo" width="80" height="80" class="d-inline-block align-middle">
            <!--ini bisa diisi nama logo -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Home</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i>Cart</a>
                    </li> -->
                    <li class="nav-item">
                    <a class="nav-link " href="#">Log In</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Carousel Awal -->
<div id="carousel">
    <div class="gambar-awal">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://smkn2depoksleman.sch.id/utama/wp-content/uploads/2024/03/DSC_0003-4.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption">
        <a>Web Event Stembayo</a>
        <p>Selamat Datang Anggap Saja Sekolah Sendiri</p>
        <button class="btn btn-warning" type="submit">See More</button>
      </div>
      </div>
    </div>
    </div>
    </div>


    <!-- About -->
    <section class="about text-start text-dark py-5">
        <div class="container">
            <h1 class="display-4">About Stembayo</h1>
            <p class="deskripsi">Pada saat tahun ajaran baru di bulan Januari 1972, Kompleks Sekolah yang terletak di dukuh Mrican, Caturtunggal, Depok, Sleman, Yogyakarta, belum selesai secara sempurna baik dari bangunan fisik dan peralatan belajar, sehingga awal penerimaan siswa pertama tidak dilakukan di Kampus STM pembangunan Mrican, akan tetapi dilakukan di STM Negeri 1 Jetis.</p>
            <p class="deskripsi">Nama STEMBAYO tercetus pada tahun kedua sejak berdirinya sekolah yaitu tahun 1973. Untuk keperluan kegiatan ekstra kurikuler pada saat itu sekelompok siswa pecinta alam mendirikan perkumpulan Camille Papasektembayo (Putra Pecinta Alam STM Pembangunan Yogyakarta) yang selanjutnya secara lebih mudah mereka menyebut Pecinta Alam STEMBAYO. Nama ini diketahui oleh pengelola sekolah, sehingga istilah STEMBAYO lebih dikenal dan familiar untuk sebutan STM Pembangunan Yogyakarta hingga sekarang.</p>
            <!-- <a href="#" class="btn btn-warning btn-lg">Get Started</a> -->
        </div>
    </section>

    <!-- Event -->
    <section class="event">
        <div class="container">
            <h1 class="display-5 text-center">Stembayo Events</h1>
            <div id="carouselExample" class="carousel slide">
                <div class="carousel-inner">
                    @foreach ($events as $event)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="card">
                                        <img src="{{ $event->image_url ?? 'https://via.placeholder.com/300x200' }}" class="card-img-top" alt="Card Image">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $event->title }}</h5>
                                            <p class="card-text">{{ $event->description }}</p>
                                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary">View Details</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="card">
                                        <img src="{{ $event->image_url ?? 'https://via.placeholder.com/300x200' }}" class="card-img-top" alt="Card Image">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $event->title }}</h5> 
                                            <p class="card-text">{{ $event->description }}</p>
                                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="pagination">
            <a href="#" class="btn btn-warning btn-lg" data-bs-target="#carouselExample" data-bs-slide="prev"><i class="fas fa-arrow-left"></i></a>
            <a href="#" class="btn btn-warning btn-lg"  data-bs-target="#carouselExample" data-bs-slide="next"><i class="fas fa-arrow-right"></i></a>
            </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-light text-center py-4">
        <p>&copy; 2024 3L. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>