@extends('layouts.app')

@section('content')
<section class="event">
            <div id="app" class="container">
                <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">

                        </div>
                        <div class="option col-12 col-md-auto d-flex justify-content-center align-items-center flex-wrap">

                        </div>
                    </div>
                </div>


            <div class="card-body">
                <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12" v-for="(card, index) in cards" :key="index">
                                    <div class="card">
                                        <img :src="card.image" class="card-img-top" :alt="'Card Image ' + (index + 1)">
                                            <h5 class="card-title">[[ card.title ]]</h5>
                                            <p class="card-text">[[ card.description ]]</p>
                                            <a :href="card.link" class="btn btn-primary">Go somewhere</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div  class="carousel-item">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12" v-for="(card, index) in cards" :key="index">
                                <div class="card">


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>


            <div class="card-footer">
                <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                    <a class="page-link" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                    </li>
                    <li class="page-item"><a class="page-link" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1">1</a></li>
                    <li class="page-item"><a class="page-link" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2">2</a></li>
                    <li class="page-item">
                    <a class="page-link" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                    </li>
                </ul>
                </nav>
            </div>

        </section>
@endsection

@push('styles')
<style>
    .event-details {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f7f9fc;
    }

    .event-box {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        width: 100%;
        overflow: hidden;
    }

    /* Gaya untuk bagian gambar */
    .event-image {
        height: 25%; /* 25% dari tinggi kotak */
        background-color: #ddd;
    }

    .event-image img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Menyesuaikan gambar agar proporsional */
    }

    /* Gaya untuk bagian deskripsi event */
    .event-description {
        padding: 20px;
    }

    .event-description h1 {
        margin-bottom: 15px;
        font-size: 1.8rem;
        font-weight: bold;
        text-align: center;
    }

    .event-description p {
        font-size: 1.1rem;
        margin: 10px 0;
    }

    /* Gaya untuk tombol pembelian tiket */
    .purchase-section {
        margin-top: 20px;
    }

    .btn-block {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 1.2rem;
        text-align: center;
    }

    .btn-block:hover {
        background-color: #0056b3;
    }
</style>
@endpush
