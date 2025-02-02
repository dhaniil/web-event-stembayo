@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Berita Event</h1>
    <div class="row">
        @foreach ($berita as $berita)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $berita->judul }}</h5>
                        <p class="card-text">{{ Str::limit($berita->isi, 100) }}</p>
                        <a href="{{ route('berita.show', $berita) }}" class="btn btn-primary">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
