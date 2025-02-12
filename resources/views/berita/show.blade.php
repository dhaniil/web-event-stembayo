@extends('extend.main')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/eventonly.css') }}" />
    <style>
        .berita-content {
            padding: 2rem;
        }
        .berita-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .berita-header {
            margin-bottom: 2rem;
        }
        .berita-metadata {
            color: #666;
            font-size: 0.9rem;
            margin: 1rem 0;
        }
        .berita-body {
            line-height: 1.8;
        }
    </style>
@endsection

@section('content')
<section class="event">
    <div class="main-content">
        <div class="berita-content">
            <div class="berita-header">
                <h1>{{ $berita->title }}</h1>
                <div class="berita-metadata">
                    <span>Kategori: {{ ucfirst($berita->category) }}</span> |
                    <span>Diterbitkan: {{ $berita->published_at->format('d M Y') }}</span> |
                    <span>Oleh: {{ $berita->author->name }}</span> |
                    <span>Dilihat: {{ $berita->views }} kali</span>
                </div>
            </div>

            @if($berita->image)
                <img src="{{ asset('storage/' . $berita->image) }}" alt="{{ $berita->title }}" class="berita-image">
            @endif

            @if($berita->excerpt)
                <div class="lead mb-4">
                    {{ $berita->excerpt }}
                </div>
            @endif

            <div class="berita-body">
                {!! $berita->content !!}
            </div>
        </div>
    </div>
</section>
@endsection
