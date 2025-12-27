@extends('layouts.app')

@section('content')
    <main>
        <section class="container mt-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('property') }}">Properti</a></li>
                    <li class="breadcrumb-item active">{{ $property->name }}</li>
                </ol>
            </nav>

            <div class="text-center mb-5">
                <h1 class="main-color">{{ $property->name }}</h1>
                <span class="text-muted"><i class="bx bx-map"></i> {{ $property->location }}</span>
            </div>
        </section>

        <section class="container detail">
            <div class="swiper mySwiper detail-container">
                <div class="swiper-wrapper">
                    @forelse ($property->galleries as $gallery)
                        <div class="detail-card swiper-slide">
                            <img src="{{ Storage::url($gallery->path) }}" alt="image" class="detail-img" />
                        </div>
                    @empty
                        <div class="detail-card swiper-slide">
                            <img src="{{ asset('frontend/assets/images/default-property.jpg') }}" class="detail-img" />
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="row" style="margin-top: 50px">
                <div class="col-lg-8 mb-5">
                    <div class="card border-0 shadow-sm p-4">
                        <h3 class="fw-bold mb-4">Deskripsi Properti</h3>
                        {!! $property->description !!}

                        <hr class="my-4">
                        <h4 class="fw-bold mb-3">Spesifikasi</h4>
                        <div class="row">
                            <div class="col-6 col-md-3 mb-3">
                                <small class="text-muted d-block">Kamar Tidur</small>
                                <strong><i class="bx bx-bed"></i> {{ $property->bedroom }}</strong>
                            </div>
                            <div class="col-6 col-md-3 mb-3">
                                <small class="text-muted d-block">Kamar Mandi</small>
                                <strong><i class="bx bx-bath"></i> {{ $property->bathroom }}</strong>
                            </div>
                            <div class="col-6 col-md-3 mb-3">
                                <small class="text-muted d-block">Luas Tanah</small>
                                <strong><i class="bx bx-area"></i> {{ $property->surface_area }}</strong>
                            </div>
                            <div class="col-6 col-md-3 mb-3">
                                <small class="text-muted d-block">Sertifikat</small>
                                <strong><i class="bx bx-file"></i> {{ $property->certificate }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm p-4 sticky-top" style="top: 100px">
                        <h4 class="text-center mb-4">Informasi Harga</h4>
                        <div class="alert alert-primary text-center">
                            <h3 class="mb-0 fw-bold">Rp{{ number_format($property->price, 0, ',', '.') }}</h3>
                        </div>

                        @auth
                            <a href="{{ route('order', $property->slug) }}" class="btn btn-primary btn-lg w-100 mb-3">
                                <i class="bx bx-shopping-bag"></i> Booking Sekarang
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg w-100 mb-3">
                                Login untuk Booking
                            </a>
                        @endauth

                        <a href="https://api.whatsapp.com/send?phone=6285767113554&text=Halo, saya tertarik dengan properti: {{ $property->name }}"
                           target="_blank" class="btn btn-success w-100">
                            <i class="bx bxl-whatsapp"></i> Hubungi Agen
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
