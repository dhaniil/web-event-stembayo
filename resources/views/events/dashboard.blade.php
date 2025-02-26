@extends('extend.main')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />
<style>
    .kard {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.5s ease, transform 0.5s ease;
    }
    
    .kard.fade-up {
        opacity: 1;
        transform: translateY(0);
    }

    .filter-container {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 12px;
        padding: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        width: 100%;
    }

    .filter-form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .filter-select {
        width: 100%;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .button-group {
        display: flex;
        gap: 0.5rem;
        width: 100%;
    }

    .btn-filter {
        flex: 1;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.9rem;
        display: inline-flex;
        justify-content: center;
        align-items: center;
    }

    @media (min-width: 768px) {
        .filter-form {
            flex-direction: row;
            align-items: center;
        }

        .filter-select {
            width: auto;
            min-width: 200px;
        }

        .button-group {
            width: auto;
        }

        .btn-filter {
            width: 120px;
            flex: none;
        }
    }

    .btn-filter.primary {
        background: #4f46e5;
        color: white;
        border: 2px solid #4f46e5;
    }

    .btn-filter.primary:hover {
        background: #4338ca;
        border-color: #4338ca;
        transform: translateY(-1px);
    }

    .btn-filter.outline {
        background: transparent;
        color: #4f46e5;
        border: 2px solid #4f46e5;
    }

    .btn-filter.outline:hover {
        background: rgba(79, 70, 229, 0.1);
        transform: translateY(-1px);
    }

    /* Banner carousel styles */
    .carousel .slides {
        transition: transform 0.5s ease-in-out;
    }
    
    .carousel .slide {
        min-height: 300px;
        aspect-ratio: 19/6;
    }
    
    .carousel .slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .carousel .indicator.active {
        background-color: #4f46e5;
        width: 8px;
        height: 8px;
    }
    
    .carousel .empty-banner {
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f0f4ff 0%, #e6e9ff 100%);
        height: 300px;
        border-radius: 12px;
        text-align: center;
        color: #4f46e5;
        padding: 2rem;
    }
    
    .carousel .empty-banner i {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }
    
    .carousel .empty-banner h3 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    
    .carousel .empty-banner p {
        color: #6b7280;
    }
</style>
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
                @if(isset($banners) && $banners->count() > 0)
                    @php $validBanners = false; @endphp
                    
                    @foreach($banners as $banner)
                        @if($banner->image && file_exists(public_path('storage/' . $banner->image)))
                            @php $validBanners = true; @endphp
                            <div class="slide w-full flex-shrink-0">
                                <img src="{{ asset('storage/' . $banner->image) }}" alt="Banner" class="w-full h-full object-cover" />
                            </div>
                        @else
                            <!-- Log the issue to browser console for frontend debugging -->
                            <script>console.warn('Invalid banner image: {{ $banner->image ?? "null" }}');</script>
                        @endif
                    @endforeach
                    
                    <!-- If we have banners in the database but none with valid images -->
                    @if(!$validBanners)
                        <div class="slide w-full flex-shrink-0">
                            <div class="empty-banner">
                                <div>
                                    <i class="bi bi-images"></i>
                                    <h3>Banner Tidak Dapat Ditampilkan</h3>
                                    <p>File banner tidak ditemukan</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="slide w-full flex-shrink-0">
                        <div class="empty-banner">
                            <div>
                                <i class="bi bi-images"></i>
                                <h3>Belum Ada Banner Event</h3>
                                <p>Banner event akan ditampilkan di sini saat tersedia</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            
            @if(isset($banners) && $banners->count() > 1)
                @php $validBannerCount = 0; @endphp
                @foreach($banners as $banner)
                    @if($banner->image && file_exists(public_path('storage/' . $banner->image)))
                        @php $validBannerCount++; @endphp
                    @endif
                @endforeach
                
                @if($validBannerCount > 1)
                    <div class="indicators absolute left-1/2 flex z-30 justify-center gap-3 h-4 p-2 transform -translate-x-1/2 -translate-y-[30px] items-center rounded-t-lg">
                        @php $indicatorIndex = 0; @endphp
                        @foreach($banners as $banner)
                            @if($banner->image && file_exists(public_path('storage/' . $banner->image)))
                                <button class="indicator w-2 h-2 md:w-3 md:h-3 bg-gray-300 rounded-full {{ $indicatorIndex === 0 ? 'active' : '' }}" data-index="{{ $indicatorIndex }}"></button>
                                @php $indicatorIndex++; @endphp
                            @endif
                        @endforeach
                    </div>
                @endif
            @endif
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
                                                <form id="filterForm" action="{{ route('events.dashboard') }}#event" method="GET" class="filter-form">
                                                    <select name="kategori" class="filter-select">
                                                        <option value="">Semua Kategori</option>
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

                                                    <div class="button-group">
                                                        <button type="submit" class="btn-filter primary">Filter</button>
                                                        <a href="{{ route('events.dashboard') }}" class="btn-filter primary outline">Reset</a>
                                                    </div>
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
                                                <p>Tidak ada event yang sesuai dengan kriteria yang anda cari.</p>
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
<script>
// Function to handle animations
function animateCards() {
    const cards = document.querySelectorAll('.kard:not(.fade-up)');
    cards.forEach((card, index) => {
        setTimeout(() => {
            card.classList.add('fade-up');
        }, index * 100); // 100ms delay between each card
    });
}

// Initialize Intersection Observer
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            animateCards();
        }
    });
}, { threshold: 0.1 });

// Observe the cards container
observer.observe(document.querySelector('.atasan-card'));

// Function to fetch and update content with animations
function fetchAndUpdateContent(url) {
    fetch(url)
        .then(response => response.text())
        .then(html => {
            const temp = document.createElement('div');
            temp.innerHTML = html;
            
            const newEvents = temp.querySelector('.atasan-card');
            const currentEvents = document.querySelector('.atasan-card');
            
            if (newEvents && currentEvents) {
                currentEvents.innerHTML = newEvents.innerHTML;
                // Reset and trigger animations after content update
                const cards = document.querySelectorAll('.kard');
                cards.forEach(card => card.classList.remove('fade-up'));
                animateCards();
            }

            history.pushState({}, '', url);
        });
}

// Handle filter form submit
document.getElementById('filterForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = this;
    const url = new URL(form.action);
    const formData = new FormData(form);
    
    for (const [key, value] of formData) {
        url.searchParams.append(key, value);
    }

    fetchAndUpdateContent(url);
});

// Update reset button selector to match new class
document.querySelector('.btn-filter.outline').addEventListener('click', function(e) {
    e.preventDefault();
    const resetUrl = this.href + '#event';
    fetchAndUpdateContent(resetUrl);
});

// Trigger initial animation
document.addEventListener('DOMContentLoaded', () => {
    animateCards();
    initBannerCarousel();
});

// Banner Carousel functionality
function initBannerCarousel() {
    const slidesContainer = document.querySelector('.slides');
    const indicators = document.querySelectorAll('.indicator');
    const slideCount = document.querySelectorAll('.slide').length;
    
    if (slideCount <= 1) return; // Don't initialize carousel if there's only one slide
    
    let currentSlide = 0;
    let intervalId;
    
    // Function to move to a specific slide
    function goToSlide(index) {
        if (index < 0) index = slideCount - 1;
        if (index >= slideCount) index = 0;
        
        currentSlide = index;
        slidesContainer.style.transform = `translateX(-${currentSlide * 100}%)`;
        
        // Update indicators
        indicators.forEach((indicator, i) => {
            indicator.classList.toggle('active', i === currentSlide);
        });
    }
    
    // Add click events to indicators
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            clearInterval(intervalId);
            goToSlide(index);
            startAutoSlide();
        });
    });
    
    function startAutoSlide() {
        clearInterval(intervalId);
        intervalId = setInterval(() => {
            goToSlide(currentSlide + 1);
        }, 5000); // Change slides every 5 seconds
    }
    
    // Start the carousel
    startAutoSlide();
    goToSlide(0);
}
</script>
@endsection
