<!-- resources/views/favourites/index.blade.php -->
@extends('extend.main')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/eventonly.css') }}" />
@endsection

@section('content')
<section class="event">
    <div class="main-content mt-16">
    
        <div class="card-container">
            <div class="row">
                @if($favourites->isEmpty())
                <div class="empty-state text-center py-5">
                    <div class="empty-state-icon mb-4">
                        <i class="far fa-heart" style="font-size: 4rem; color: #dc3545;"></i>
                    </div>
                    <h3 class="empty-state-title mb-2">Belum Ada Event Favorit</h3>
                    <p class="empty-state-description mb-4 text-muted">Silahkan favoritkan event yang ada</p>
                </div>
                @else
                    @foreach($favourites as $favourite)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="card">
                            <img src="{{ asset('storage/' . $favourite->event->image) }}" class="card-img-top" alt="CardImage">
                            <div class="card-body">
                                <div class="desc">
                                    <h5 class="card-title">{{ $favourite->event->name }}</h5>
                                    <p class="card-text">{{ \Illuminate\Support\Str::limit($favourite->event->description, 55, '...') }}</p>
                                </div>
                                <div class="view-btn d-flex justify-content-between">
                                    <a href="{{ route('events.show', $favourite->event->id) }}" class="btn">Lihat Detail</a>
                                    <form action="{{ route('favourite.remove', $favourite->event->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
@endsection