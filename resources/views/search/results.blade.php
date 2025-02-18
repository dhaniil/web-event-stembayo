@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] pt-20 w-full">
    <div class="container px-4 py-8 max-w-7xl mx-auto">
        <!-- Search Header -->
        <div class="mb-12 text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-3 font-montserrat">Hasil Pencarian</h1>
            <p class="text-lg text-gray-600 font-medium">"{{ $query }}"</p>
            <div class="w-20 h-1 bg-[#3c5cff] mx-auto mt-4"></div>
        </div>

        @if($events->isEmpty() && $berita->isEmpty())
            <div class="flex flex-col items-center justify-center py-16 px-4">
                <div class="bg-white p-8 rounded-xl shadow-lg text-center max-w-md w-full">
                    <i class="fas fa-search text-4xl text-gray-400 mb-4"></i>
                    <p class="text-xl text-gray-600 mb-2">Tidak ada hasil ditemukan</p>
                    <p class="text-gray-500">Coba kata kunci lain atau periksa ejaan</p>
                </div>
            </div>
        @else
            @if(!$events->isEmpty())
                <div class="mb-12">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-[#3c5cff] pl-3 font-montserrat">Event Terkait</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($events as $event)
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
                            <img src="{{ $event->image_url }}" alt="{{ $event->name }}" class="w-full h-48 object-cover">
                            <div class="p-5">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="bg-blue-100 text-[#3c5cff] text-xs px-2.5 py-1 rounded-full">{{ $event->type }}</span>
                                    <span class="bg-purple-100 text-purple-600 text-xs px-2.5 py-1 rounded-full">{{ $event->kategori }}</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $event->name }}</h3>
                                <p class="text-gray-600 mb-4 text-sm">{{ Str::limit($event->description, 100) }}</p>
                                <div class="flex items-center justify-between">
                                    <a href="{{ route('events.show', $event->id) }}" class="text-[#3c5cff] font-semibold hover:text-[#1a40ff] transition-colors">
                                        Lihat Detail →
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if(!$berita->isEmpty())
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-[#3c5cff] pl-3 font-montserrat">Berita Terkait</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($berita as $item)
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover">
                            @endif
                            <div class="p-5">
                                @if($item->category)
                                    <div class="mb-3">
                                        <span class="bg-gray-100 text-gray-600 text-xs px-2.5 py-1 rounded-full">{{ $item->category }}</span>
                                    </div>
                                @endif
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $item->title }}</h3>
                                <p class="text-gray-600 mb-4 text-sm">{{ Str::limit($item->excerpt, 100) }}</p>
                                <div class="flex items-center justify-between">
                                    <a href="{{ route('berita.show', $item->slug) }}" class="text-[#3c5cff] font-semibold hover:text-[#1a40ff] transition-colors">
                                        Baca Selengkapnya →
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($events->hasPages() || $berita->hasPages())
                <div class="mt-8">
                    <div class="flex justify-center space-x-4">
                        @if($events->hasPages())
                            {{ $events->links() }}
                        @endif
                        @if($berita->hasPages())
                            {{ $berita->links() }}
                        @endif
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>
@endsection
