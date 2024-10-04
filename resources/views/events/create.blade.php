@extends('layouts.app')

@section('content')
<h1>Tambah Event Baru</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('events.simpan') }}">
    @csrf
    <div class="form-group">
        <label for="name">Nama Event</label>
        <input type="text" name="name" class="form-control" id="name" required>
    </div>
    <div class="form-group">
        <label for="date">Tanggal Event</label>
        <input type="date" name="date" class="form-control" id="date" required>
    </div>
    <div class="form-group">
        <label for="description">Deskripsi Event</label>
        <textarea name="description" class="form-control" id="description" rows="4" required></textarea>
    </div>
    <div class="form-group">
        <label for="price">Harga Tiket</label>
        <input type="number" name="price" class="form-control" id="price" required>
    </div>
    <div class="form-group">
        <label for="type">Jenis Tiket</label>
        <input type="text" name="type" class="form-control" id="type" required>
    </div>
    <button type="submit" class="btn btn-primary">Tambah Event</button>
    <a href="{{ route('events.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
