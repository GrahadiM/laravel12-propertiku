@extends('layouts.app')

@section('content')
    <main>
        <section class="hero" id="hero"
            style="background-image: url('{{ asset('frontend/assets/images/alhamraresto-banner.jpg') }}'); background-repeat: no-repeat; background-size: cover; height: 100vh;">
            <div class="hero-content h-100 d-flex justify-content-center align-items-center flex-column">
                <h1 class="text-center text-white display-4">
                    Al Hamra Restaurant - Temukan Makanan Impian Anda
                </h1>
                <p class="text-white">Makanan Terbaik di Lokasi Strategis</p>
                <a href="#property" class="btn btn-hero mt-5">Lihat Makanan</a>
            </div>
        </section>

        <section class="container why-us text-center">
            <h2 class="section-title">Kenapa Memilih Al Hamra Restaurant</h2>
            <hr width="40" class="text-center" />
            <div class="row mt-5">
                <div class="col-lg-4 mb-3">
                    <div class="card pt-4 pb-3 px-2">
                        <i class="bx bx-home-alt why-us-icon mb-4"></i>
                        <h4 class="mb-3">Lokasi Strategis</h4>
                        <p>Dekat dengan akses transportasi, sekolah, dan pusat perbelanjaan.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-3">
                    <div class="card pt-4 pb-3 px-2">
                        <i class="bx bx-shield-quarter why-us-icon mb-4"></i>
                        <h4 class="mb-3">Keamanan 24/7</h4>
                        <p>Sistem keamanan satu pintu (one gate system) dengan CCTV dan petugas keamanan.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-3">
                    <div class="card pt-4 pb-3 px-2">
                        <i class="bx bx-certification why-us-icon mb-4"></i>
                        <h4 class="mb-3">Sertifikat Terjamin</h4>
                        <p>Semua unit sudah memiliki legalitas lengkap (SHM/HGB) dan siap huni.</p>
                    </div>
                </div>
            </div>
        </section>

        @foreach ($categories as $category)
            <section class="container package text-center" id="property">
                <h2 class="section-title">{{ $category->title }}</h2>
                <hr width="40" class="text-center" />
                <div class="row mt-5 justify-content-center">

                    @foreach ($category->properties as $property)
                        <div class="col-lg-4 mb-5">
                            <div class="card package-card">
                                <a href="{{ route('detail', $property) }}" class="package-link">
                                    <div class="package-wrapper-img overflow-hidden">
                                        @if($property->galleries->count() > 0)
                                            <img src="{{ Storage::url($property->galleries->first()->path) }}" class="img-fluid" />
                                        @else
                                            <img src="{{ asset('frontend/assets/images/default-properti.jpg') }}" class="img-fluid" />
                                        @endif
                                    </div>
                                    <div class="package-price d-flex justify-content-center">
                                        <span class="btn btn-light position-absolute package-btn">
                                            Rp {{ number_format($property->price, 0, ',', '.') }}
                                        </span>
                                    </div>
                                    <div class="p-3">
                                        <h5 class="mt-3 text-dark">{{ $property->name }}</h5>
                                        <p class="text-muted"><i class="bx bx-map"></i> {{ $property->location }}</p>
                                        <div class="d-flex justify-content-around border-top pt-2">
                                            <small><i class="bx bx-bed"></i> {{ $property->bedroom }} KT</small>
                                            <small><i class="bx bx-bath"></i> {{ $property->bathroom }} KM</small>
                                            <small><i class="bx bx-area"></i> {{ $property->surface_area }} m²</small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </section>
        @endforeach
    </main>
@endsection
