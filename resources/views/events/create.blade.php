@extends('layouts.sidebar')

@section('content')
<div class="container">
    <h1>Tambah Event Baru</h1>
    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Nama Event</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="start_date">Tanggal Mulai</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
        </div>

        <div class="form-group">
            <label for="end_date">Tanggal Selesai</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="type">Tipe Event</label>
            <input type="text" class="form-control" id="type" name="type" required>
        </div>

        <div class="form-group">
            <label for="image">Pamflet Event</label>
            <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
        </div>

        <div class="form-group">
            <label for="kategori">Kategori</label>
            <select class="form-control" id="kategori" name="kategori" required>
                <option value="-">-</option> <!-- Opsi default "-" -->
            @foreach($kategori as $kategori)
                <option value="{{ $kategori }}">{{ $kategori }}</option>
            @endforeach
        </select>

        </div>

        <div class="form-group">
            <label for="penyelenggara">Penyelenggara</label>
            <input type="text" class="form-control" id="penyelenggara" name="penyelenggara" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan Event</button>
    </form>
</div>
@endsection
