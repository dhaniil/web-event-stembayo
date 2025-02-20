@extends('extend.main')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />
@endsection

@section('content')
<main class="main-content bg-transparent p-0">
    <section id="event" class="event">
        <div id="app">
            <div class="carousel-event position-relative">
                <div class="d-flex justify-content-center">
                    <div class="col-10">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col">
                                        <h4 class="title">Filtered Events</h4>
                                    </div>
                                    <div class="option col-12 col-md-auto d-flex justify-content-center align-items-center flex-wrap">
                                        <div class="filter-container mb-4">
                                            <form action="{{ route('events.filter') }}" method="GET" class="d-flex align-items-center">
                                                <div class="input-group me-2">
                                                    <input type="text" 
                                                           name="tanggal" 
                                                           id="datepicker" 
                                                           class="form-control datepicker" 
                                                           value="{{ request('tanggal') }}" 
                                                           placeholder="Pilih Tanggal" 
                                                           autocomplete="off">
                                                </div>
                                                
                                                <select name="kategori" class="form-control me-2">
                                                    <option value="">Pilih Kategori</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category }}" {{ request('kategori') == $category ? 'selected' : '' }}>
                                                            {{ $category }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                <button type="submit" class="btn btn-primary me-2">Filter</button>
                                                <a href="{{ route('events.dashboard') }}" class="btn btn-secondary">Reset</a>
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
                                            <p>No events found matching your criteria.</p>
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
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#datepicker", {
            dateFormat: "Y-m-d",
            defaultDate: "{{ request('tanggal') }}"
        });
    });
</script>
@endsection
