<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Event</h2>

    <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nama Event</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $event->name) }}" required>
        </div>

        <div class="form-group">
            <label for="start_date">Tanggal Mulai</label>
            <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $event->start_date) }}" required>
        </div>

        <div class="form-group">
            <label for="end_date">Tanggal Selesai</label>
            <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $event->end_date) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" class="form-control" required>{{ old('description', $event->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="type">Tipe</label>
            <input type="text" name="type" class="form-control" value="{{ old('type', $event->type) }}" required>
        </div>

        <div class="form-group">
            <label for="kategori">Kategori</label>
            <select name="kategori" class="form-control" required>
                @foreach ($kategori as $kat)
                    <option value="{{ $kat }}" {{ $event->kategori == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="penyelenggara">Penyelenggara</label>
            <input type="text" name="penyelenggara" class="form-control" value="{{ old('penyelenggara', $event->penyelenggara) }}" required>
        </div>

        <div class="form-group">
            <label for="image">Gambar Event</label>
            @if ($event->image)
                <div>
                    <img src="{{ asset('storage/' . $event->image) }}" alt="Event Image" style="max-width: 200px;">
                </div>
            @endif
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Event</button>
        <a href="{{ route('events.eventonly') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

</body>
</html>
