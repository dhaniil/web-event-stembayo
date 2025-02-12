<!-- resources/views/favourites/index.blade.php -->
@extends('extend.main')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/eventonly.css') }}" />
@endsection

@section('content')
<section class="event">
    <div class="main-content mt-16">
        <div class="filter-container mb-4">
            <form action="{{ route('favourites') }}" method="GET" class="d-flex align-items-center">
                <select name="kategori" class="form-control me-2 filter">
                    <option value="">Pilih Kategori</option>
                    <option value="KTYME Islam" {{ request('kategori') == 'KTYME Islam' ? 'selected' : '' }}>KTYME Islam</option>
                    <option value="KTYME Kristiani" {{ request('kategori') == 'KTYME Kristiani' ? 'selected' : '' }}>KTYME Kristiani</option>
                    <option value="KBBP" {{ request('kategori') == 'KBBP' ? 'selected' : '' }}>KBBP</option>
                    <option value="KBPL" {{ request('kategori') == 'KBPL' ? 'selected' : '' }}>KBPL</option>
                    <option value="BPPK" {{ request('kategori') == 'BPPK' ? 'selected' : '' }}>BPPK</option>
                    <option value="KK" {{ request('kategori') == 'KK' ? 'selected' : '' }}>KK</option>
                    <option value="PAKS" {{ request('kategori') == 'PAKS' ? 'selected' : '' }}>PAKS</option>
                    <option value="KJDK" {{ request('kategori') == 'KJDK' ? 'selected' : '' }}>KJDK</option>
                    <option value="PPBN" {{ request('kategori') == 'PPBN' ? 'selected' : '' }}>PPBN</option>
                    <option value="HUMTIK" {{ request('kategori') == 'HUMTIK' ? 'selected' : '' }}>HUMTIK</option>
                </select>

                <button type="submit" class="btn me-2">Filter</button>
                <a href="{{ route('favourites') }}" class="btn">Reset</a>
            </form>
        </div>

        <div class="card-container">
            <div class="row">
                @if($favourites->isEmpty())
                    <p class="text-center">Silahkan favoritkan event yang ada</p>
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