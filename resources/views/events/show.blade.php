@extends('extend.main')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/show.css') }}" />
@endsection

@section('content')
  <section class="event-detail">
    <div class="main-content">
        <div class="card">
          <div class="event-image">
            <img src={{ asset('storage/' . $event->image) }} alt="Event Image">
            <p class="img-desc">Sistem Informasi Jaringan Aplikasi</p>
          </div>
          <div class="event-desc">
            <div class="event-title">
              <h2>{{ $event->name }}</h2>
            </div>
            <div class="event-detail">
              <p class="desc-event">Deskripsi Event Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium. </p>
            </div>
            <div class="event-date">
              <table>
                <tr>
                  <td>Hari</td>
                  <td>: Jumat</td>
                </tr>
                <tr>
                  <td>Tanggal</td>
                  <td>: 1 September 2023</td>
                </tr>
                <tr>
                  <td>Waktu</td>
                  <td>: 08.00 - selesai</td>
                </tr>
                <tr>
                  <td>Tempat</td>
                  <td>: Ruang Auditorium Bima</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
    </div>


    

    <div class="favourite-buttons">
        <form action="{{ route('favourite.add', $event->id) }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-primary">Tambahkan ke Favorit</button>
        </form>
        <form action="{{ route('favourite.remove', $event->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus dari Favorit</button>
        </form>
    </div>

    <div class="tes">
    </div>

<section class="bg-white py-8 lg:py-16 antialiased">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Ulasan ({{ $event->ulasan->count() }})</h2>
            <button type="button" data-modal-target="review-modal" data-modal-toggle="review-modal" 
                class="py-2.5 px-5 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                Tambah Ulasan
            </button>
        </div>

        <!-- Reviews List -->
        <div class="space-y-4">
            @foreach($event->ulasan as $ulasan)
                <article class="p-6 border rounded-lg">
                    <div class="flex items-center mb-2">
                        <div class="mr-3 text-sm">
                            <p class="font-semibold text-gray-900">{{ $ulasan->user->name }}</p>
                            <p class="text-gray-600">{{ $ulasan->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <div class="flex items-center mb-2">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-4 h-4 {{ $i <= $ulasan->rating ? 'text-yellow-300' : 'text-gray-300' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                            </svg>
                        @endfor
                    </div>
                    <p class="text-gray-700">{{ $ulasan->komentar }}</p>
                </article>
            @endforeach
        </div>
    </div>

    <!-- Review Modal -->
    <div id="review-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <div class="flex items-center justify-between p-4 border-b">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Tambah Ulasan
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="review-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
                <form action="{{ route('ulasan.store') }}" method="POST" class="p-4 md:p-5">
                    @csrf
                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Rating</label>
                        <div class="flex items-center space-x-1">
                            @for($i = 1; $i <= 5; $i++)
                                <input type="radio" id="rating{{ $i }}" name="rating" value="{{ $i }}" class="hidden peer">
                                <label for="rating{{ $i }}" class="cursor-pointer">
                                    <svg class="w-6 h-6 text-gray-300 peer-checked:text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                </label>
                            @endfor
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="komentar" class="block mb-2 text-sm font-medium text-gray-900">Komentar</label>
                        <textarea id="komentar" name="komentar" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" required></textarea>
                    </div>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Kirim Ulasan
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection