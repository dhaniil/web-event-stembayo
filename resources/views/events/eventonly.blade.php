{{-- ini diambil dari resources/views/extend/main.blade.php --}}
@extends('extend.main') 

{{-- nggo misah css e --}}
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/eventonly.css') }}" />
@endsection

@section('content')
<section class="event">
    <div class="main-content">
        <h2>EVENTS</h2>
        <div class="card-container">
            <div class="row">
                @foreach($events as $event)
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="card">
                        <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="CardImage">
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->name }}</h5>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($event->description, 60, '...') }}</p>
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection