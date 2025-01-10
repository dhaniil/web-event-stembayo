@extends('extend.main')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/eventonly.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endsection

@section('content')
<div class="container">
    <h1>Favourite Events</h1>   
    <div class="row">
        @foreach($favouriteEvents as $event)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ $event->image_url }}" class="card-img-top" alt="{{ $event->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-text">{{ Str::limit($event->description, 100) }}</p>
                        <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary">View Event</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection