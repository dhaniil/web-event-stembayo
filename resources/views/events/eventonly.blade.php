@extends('extend.main')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/eventonly.css') }}" />
@endsection

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


@section('content')
<section class="event">
    <div class="main-content">
        <h2>EVENTS</h2>
    
        <!-- Form Filter -->
        <div class="filter-container mb-4">
            <form action="{{ route('events.eventonly') }}" method="GET" class="d-flex align-items-center">
                <input type="text" name="tanggal" id="datepicker" class="form-control me-2 tanggal" placeholder="Pilih Tanggal" readonly>
        
                <!-- Ikon Kalender -->
                {{-- <i class="fas fa-calendar-alt" id="calendar-icon" style="position: absolute; right: 10px; cursor: pointer; font-size: 20px;"></i> --}}
                
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
                <a href="{{ route('events.eventonly') }}" class="btn">Reset</a>
            </form>
        </div>

        <div class="card-container">
            <div class="row">
                @if($events->isEmpty())
                    <p class="text-center">Event tidak ditemukan</p>
                @else
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
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const datePicker = flatpickr("#datepicker", {
            dateFormat: "Y-m-d",
            defaultDate: "{{ request('tanggal') }}",
            allowInput: false
        });

        document.getElementById("calendar-icon").addEventListener("click", function() {
            datePicker.open();
        });
    });
</script>
