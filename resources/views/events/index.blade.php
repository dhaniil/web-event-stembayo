@extends('layouts.app')

@section('content')
<h1>Daftar Event</h1>

<!-- Form untuk filter event -->
<form method="GET" action="{{ route('events.dashboard') }}" class="mb-4">
    <select name="filter" class="form-control d-inline-block" style="width: auto;">
        <option value="">Filter berdasarkan</option>
        <option value="monthly">Bulanan</option>
        <option value="yearly">Tahunan</option>
    </select>
    <button type="submit" class="btn btn-primary">Filter</button>
</form>

<!-- Tombol untuk menambah event -->
<a href="{{ route('events.create') }}" class="btn btn-success mb-4">Tambah Event</a>

<ul>
    @foreach($events as $event)
        <li>
            <a href="{{ route('events.show', $event->id) }}">{{ $event->name }}</a> - {{ $event->date }}
        </li>
    @endforeach
</ul>
@endsection
