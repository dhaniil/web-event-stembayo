@extends('extend.main')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/eventonly.css') }}" />
@endsection

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@section('content')
<section class="event">
    <div class="main-content mt-16">
        <div class="filter-container mb-4">
            <form action="{{ route('berita.index') }}" method="GET" class="d-flex align-items-center">
                <input type="text" name="tanggal" id="datepicker" class="form-control me-2 tanggal" placeholder="Pilih Tanggal" readonly>
                
                <select name="category" class="form-control me-2 filter">
                    <option value="">Pilih Kategori</option>
                    <option value="umum" {{ request('category') == 'umum' ? 'selected' : '' }}>Umum</option>
                    <option value="teknologi" {{ request('category') == 'teknologi' ? 'selected' : '' }}>Teknologi</option>
                    <option value="budaya" {{ request('category') == 'budaya' ? 'selected' : '' }}>Budaya</option>
                    <option value="pendidikan" {{ request('category') == 'pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                    <option value="kesehatan" {{ request('category') == 'kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                </select>

                <button type="submit" class="btn me-2">Filter</button>
                <a href="{{ route('berita.index') }}" class="btn">Reset</a>
            </form>
        </div>

        <div class="card-container">
            <div class="row">
                @if($beritas->isEmpty())
                    <p class="text-center">Tidak ada berita</p>
                @else
                    @foreach($beritas as $berita)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="card">
                            <img src="{{ asset('storage/' . $berita->image) }}" class="card-img-top" alt="BeritaImage">
                            <div class="card-body">
                                <div class="desc">
                                    <h5 class="card-title">{{ $berita->title }}</h5>
                                    <p class="card-text">{{ $berita->excerpt ?? \Illuminate\Support\Str::limit($berita->content, 55, '...') }}</p>
                                    <span class="text-muted">{{ $berita->published_at->format('d M Y') }}</span>
                                </div>
                                <div class="view-btn">
                                    <a href="{{ route('berita.show', $berita->id) }}" class="btn">View Details</a>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr("#datepicker", {
            dateFormat: "Y-m-d",
            defaultDate: "{{ request('tanggal') }}",
            allowInput: false
        });
    });
</script>
