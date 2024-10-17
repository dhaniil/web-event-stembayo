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
          <div class="event-ticket">
            <div class="row">
              <div class="card card1 col-lg-3 col-md-4 col-sm-6 col-12">
                <h4>Ticket</h4>
                <a class="btn" href="#">Pesan</a>
              </div>
              {{-- <div class="card card2 col-lg-3 col-md-4 col-sm-6 col-12">
                <h4>Golden Ticket</h4>
                <p class="harga">Rp. 50.000</p>
                <a class="btn" href="#">Pesan</a>
              </div>
              <div class="card card3 col-lg-3 col-md-4 col-sm-6 col-12">
                <h4>Silver Ticket</h4>
                <p class="harga">Rp. 50.000</p>
                <a class="btn" href="#">Pesan</a>
              </div> --}}
          </div>
        </div>
    </div>
  <section>
@endsection