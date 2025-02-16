@extends('layouts.app')

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush

@section('content')
<div class="container">
    <!-- Modal untuk mengisi kelas dan jurusan -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">Lengkapi Profil Anda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile.update.kelas-jurusan') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <p>Silakan lengkapi informasi tambahan di bawah ini (opsional)</p>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Masukkan kelas Anda">
                        </div>
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Masukkan jurusan Anda">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Lewati</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Content halaman home -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h4 class="text-center">{{ __('Selamat datang di Event Stembayo!') }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session()->has('show_profile_modal'))
@push('scripts')
<script>
window.addEventListener('load', function() {
    var profileModal = new bootstrap.Modal(document.getElementById('profileModal'));
    profileModal.show();
});
</script>
@endpush
@endif
@endsection
