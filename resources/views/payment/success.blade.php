@extends('layouts.app')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body text-center py-5">
                        <div class="text-success mb-4">
                            <i class="fa fa-clock fa-5x"></i>
                        </div>
                        <h3 class="text-success">Pembayaran Berhasil</h3>
                        <p class="text-muted mb-4">Terima kasih telah melakukan pembayaran. Pesanan Anda sedang diproses.</p>

                        @if (session('order_id'))
                            <div class="alert alert-info">
                                <strong>Order ID:</strong> {{ session('order_id') }}
                            </div>
                        @endif

                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <a href="{{ route('home') }}" class="btn btn-primary me-md-2">
                                <i class="fa fa-home"></i> Kembali ke Home
                            </a>
                            <a href="{{ route('profile.orders') }}" class="btn btn-outline-primary">
                                <i class="fa fa-history"></i> Lihat Riwayat Order
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
