@extends('extend.main')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/show.css') }}" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')
<div class="content-area">
    <div class="event-container">
        <div class="event-header" style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
            @if($event->image)
                <div class="event-image-wrapper" style="width: 100%; max-width: 1200px; margin: 0 auto;">
                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" class="event-image">
                    <div class="event-overlay"></div>
                </div>
            @endif
            
            <div class="event-title-section">
                <h1>{{ $event->name }}</h1>
                <div class="event-meta">
                    <span class="event-category">{{ $event->kategori }}</span>
                    <span class="event-status {{ $event->status }}">{{ ucfirst($event->status) }}</span>
                    @auth
                        <button class="favorite-btn {{ $event->favouritedBy()->where('user_id', auth()->id())->exists() ? 'active' : '' }}"
                                onclick="toggleFavorite({{ $event->id }})">
                            <i class="fa-heart {{ $event->favouritedBy()->where('user_id', auth()->id())->exists() ? 'fas' : 'far' }}"></i>
                        </button>
                    @endauth
                </div>
            </div>
        </div>

        <div class="event-content" data-aos="fade-up">
            <div class="event-details">
                <div class="detail-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="detail-info">
                        <h3>Tanggal</h3>
                        <p>{{ $startDate }} - {{ $endDate }}</p>
                        <p class="time">{{ $jamMulai }} - {{ $jamSelesai }}</p>
                    </div>
                </div>

                <div class="detail-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="detail-info">
                        <h3>Lokasi</h3>
                        <p>{{ $event->tempat }}</p>
                    </div>
                </div>

                <div class="detail-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="detail-info">
                        <h3>Penyelenggara</h3>
                        <p>{{ $event->penyelenggara }}</p>
                    </div>
                </div>
            </div>

            <div class="event-description p-4">
                <h2>Tentang Event</h2>
                <p>{{ $event->description }}</p>
            </div>

            <!-- <div class="action-buttons">
                @auth
                    @if(!$event->favouritedBy()->where('user_id', auth()->id())->exists())
                        <form action="{{ route('favourite.add', $event->id) }}" method="POST" class="favourite-form">
                            @csrf
                            <button type="submit" class="btn-favorite">
                                <i class="far fa-heart"></i> Tambah ke Favorit
                            </button>
                        </form>
                    @else
                        <form action="{{ route('favourite.remove', $event->id) }}" method="POST" class="favourite-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-unfavorite">
                                <i class="fas fa-heart"></i> Hapus dari Favorit
                            </button>
                        </form>
                    @endif
                @endauth
            </div> -->

            <!-- Reviews Section -->
            <div class="reviews-section" style="margin-top: 40px; padding: 20px; background: #f8f9fa; border-radius: 15px;">
                <div class="reviews-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                    <h2 style="font-size: 24px; color: #333;">Ulasan ({{ $event->ulasan->count() }})</h2>
                    @auth
                        <button type="button" class="btn-add-review" onclick="openReviewModal()" 
                                style="background: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 8px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-plus"></i> Tambah Ulasan
                        </button>
                    @endauth
                </div>

                <div class="reviews-list" style="display: grid; gap: 20px;">
                    @forelse($event->ulasan as $ulasan)
                        <div class="review-card" data-aos="fade-up" 
                             style="background: white; padding: 20px; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                            <div class="review-header" style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                                <div class="reviewer-info">
                                    <h4 style="margin: 0; color: #333; font-size: 18px;">{{ $ulasan->user->name }}</h4>
                                    <span style="color: #666; font-size: 14px;">{{ $ulasan->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="rating" style="color: #ffd700;">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $ulasan->rating ? 'active' : '' }}" 
                                           style="{{ $i <= $ulasan->rating ? 'color: #ffd700;' : 'color: #ddd;' }}"></i>
                                    @endfor
                                </div>
                            </div>
                            <p class="review-content" style="margin: 0; color: #444; line-height: 1.6;">{{ $ulasan->komentar }}</p>
                        </div>
                    @empty
                        <p class="no-reviews" style="text-align: center; color: #666; padding: 20px;">Belum ada ulasan untuk event ini</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Review Modal -->
<div id="reviewModal" class="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); z-index: 1000;">
    <div class="modal-content" style="background: white; padding: 30px; border-radius: 15px; width: 90%; max-width: 500px; position: relative; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <span class="close" onclick="closeReviewModal()" style="position: absolute; right: 20px; top: 15px; font-size: 24px; cursor: pointer;">&times;</span>
        <h2 style="margin-bottom: 20px; color: #333;">Tambah Ulasan</h2>
        <form action="{{ route('ulasan.store') }}" method="POST" class="review-form">
            @csrf
            <input type="hidden" name="event_id" value="{{ $event->id }}">
            <div class="rating-input" style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 10px;">Rating</label>
                <div class="star-rating" style="display: flex; gap: 10px; justify-content: center;">
                    @for($i = 5; $i >= 1; $i--)
                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" style="display: none;"/>
                        <label for="star{{ $i }}" style="cursor: pointer; font-size: 24px; color: #ddd;">
                            <i class="fas fa-star"></i>
                        </label>
                    @endfor
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="komentar" style="display: block; margin-bottom: 10px;">Komentar</label>
                <textarea name="komentar" id="komentar" rows="4" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; resize: vertical;"></textarea>
            </div>
            <button type="submit" class="btn-submit" style="width: 100%; padding: 12px; background: #007bff; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: bold;">
                Kirim Ulasan
            </button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init();
    });
    
    function openReviewModal() {
        const modal = document.getElementById('reviewModal');
        modal.style.display = 'flex';
        modal.style.opacity = '1';
    }
    
    function closeReviewModal() {
        const modal = document.getElementById('reviewModal');
        modal.style.opacity = '0';
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    }

    // Star rating functionality
    const stars = document.querySelectorAll('.star-rating label');
    stars.forEach((star, index) => {
        star.addEventListener('mouseover', () => {
            stars.forEach((s, i) => {
                s.style.color = i <= index ? '#ffd700' : '#ddd';
            });
        });
    });

    document.querySelector('.star-rating').addEventListener('mouseleave', () => {
        stars.forEach(star => {
            star.style.color = '#ddd';
        });
        const selected = document.querySelector('input[name="rating"]:checked');
        if (selected) {
            const index = parseInt(selected.value) - 1;
            stars.forEach((s, i) => {
                s.style.color = i <= index ? '#ffd700' : '#ddd';
            });
        }
    });

    function toggleFavorite(eventId) {
        const btn = event.currentTarget;
        const icon = btn.querySelector('i');
        const isFavorited = icon.classList.contains('fas');
        
        fetch(`/favourite/${eventId}`, {
            method: isFavorited ? 'DELETE' : 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                icon.classList.toggle('fas');
                icon.classList.toggle('far');
                btn.classList.toggle('active');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memproses favorit');
        });
    }
</script>
@endsection
