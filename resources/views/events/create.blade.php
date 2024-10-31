<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Tambah Event Baru</h1>

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form untuk menambahkan event baru -->
        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama Event</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="start_date" class="form-label">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="jam_mulai" class="form-label">Jam Mulai</label>
                    <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai') }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="end_date" class="form-label">Tanggal Selesai</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="jam_selesai" class="form-label">Jam Selesai</label>
                    <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai') }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="tempat" class="form-label">Tempat</label>
                <input type="text" class="form-control" id="tempat" name="tempat" value="{{ old('tempat') }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Tipe Event</label>
                <input type="text" class="form-control" id="type" name="type" value="{{ old('type') }}" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Gambar (opsional)</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>

            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-select" id="kategori" name="kategori" required>
                    <option selected disabled>Pilih Kategori</option>
                    <option value="KTYME Islam">KTYME Islam</option>
                    <option value="KTYME Kristiani">KTYME Kristiani</option>
                    <option value="KBBP">KBBP</option>
                    <option value="KBPL">KBPL</option>
                    <option value="BPPK">BPPK</option>
                    <option value="KK">KK</option>
                    <option value="PAKS">PAKS</option>
                    <option value="KJDK">KJDK</option>
                    <option value="PPBN">PPBN</option>
                    <option value="HUMTIK">HUMTIK</option>
                    <option value="-">-</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="penyelenggara" class="form-label">Penyelenggara</label>
                <input type="text" class="form-control" id="penyelenggara" name="penyelenggara" value="{{ old('penyelenggara') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Tambah Event</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>