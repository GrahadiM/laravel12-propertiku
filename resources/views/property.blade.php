@extends('layouts.app')

@section('content')
<section class="container mt-5">
    <div class="row mb-4 align-items-center">
        <div class="col-lg-6">
            <h2 class="fw-bold">Daftar Properti Terkini</h2>
            <p class="text-muted">Temukan hunian terbaik untuk keluarga Anda.</p>
        </div>

        <div class="col-lg-6">
            <div class="d-flex flex-wrap justify-content-lg-end gap-2">
                <a href="{{ route('property') }}"
                   class="btn {{ !request('category') ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-4">
                    Semua
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('property', ['category' => $cat->title]) }}"
                       class="btn {{ request('category') == $cat->title ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-4">
                        {{ $cat->title }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <hr class="mb-5">

    <div class="row">
        @forelse($properties as $property)
            <div class="col-lg-4 mb-5">
                <div class="card package-card border-0 shadow-sm h-100">
                    <a href="{{ route('detail', $property) }}" class="package-link text-decoration-none">
                        <div class="package-wrapper-img overflow-hidden position-relative">
                            <span class="badge bg-primary position-absolute mt-3 ms-3" style="z-index: 10; padding: 8px 15px;">
                                {{ $property->category->title ?? 'Properti' }}
                            </span>

                            @if($property->galleries->count() > 0)
                                <img src="{{ Storage::url($property->galleries->first()->path) }}" class="img-fluid" style="height: 250px; width: 100%; object-fit: cover;" />
                            @else
                                <img src="{{ asset('frontend/assets/images/default-properti.jpg') }}" class="img-fluid" style="height: 250px; width: 100%; object-fit: cover;" />
                            @endif
                        </div>

                        <div class="package-price d-flex justify-content-center">
                            <span class="btn btn-light position-absolute package-btn shadow-sm" style="transform: translateY(-50%);">
                                <strong>Rp {{ number_format($property->price, 0, ',', '.') }}</strong>
                            </span>
                        </div>

                        <div class="p-3">
                            <h5 class="mt-4 text-dark fw-bold">{{ $property->name }}</h5>
                            <p class="text-muted small mb-3"><i class="bx bx-map text-danger"></i> {{ $property->location }}</p>

                            <div class="d-flex justify-content-between border-top pt-3 text-muted">
                                <span class="small"><i class="bx bx-bed"></i> {{ $property->bedroom }} KT</span>
                                <span class="small"><i class="bx bx-bath"></i> {{ $property->bathroom }} KM</span>
                                <span class="small"><i class="bx bx-area"></i> {{ $property->surface_area }} m²</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="bx bx-search-alt text-muted" style="font-size: 4rem;"></i>
                <p class="mt-3 text-muted">Maaf, properti untuk kategori ini belum tersedia.</p>
            </div>
        @endforelse
    </div>
</section>
@endsection
