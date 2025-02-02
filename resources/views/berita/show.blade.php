@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $berita->judul }}</h1>

    @if ($berita->isi)
        <p>{{ $berita->isi }}</p>
    @endif


    {{-- Gallery Event --}}
    @if ($berita->galleries->count() > 0)
        <h3>Galeri Event</h3>
        <div class="row">
            @foreach ($berita->galleries as $gallery)
                <div class="col-md-3">
                    <img src="{{ asset('storage/' . $gallery->image_path) }}" class="img-fluid rounded" alt="Gallery Image">
                </div>
            @endforeach
        </div>
    @endif

    {{-- Event Terkait --}}
    <h3>Event Terkait</h3>
    <ul>
        @foreach ($eventTerkait as $event)
            <li><a href="{{ route('berita.show', $event->berita) }}">{{ $event->name }}</a></li>
        @endforeach
    </ul>
</div>
@endsection
