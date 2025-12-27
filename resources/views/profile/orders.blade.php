@extends('layouts.app')

@section('content')
    <main>
        <section class="container mt-5" style="margin-bottom: 70px">
            <div class="col-12 col-md">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="title-alt" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="title-alt" href="{{ route('profile') }}">Profile</a>
                        </li>
                        <li class="breadcrumb-item main-color">Riwayat Order</li>
                    </ol>
                </nav>
            </div>
        </section>

        <section class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">

                    <!-- Info Panel -->
                    <div class="card shadow mb-4">
                        <div class="card-header bg-danger text-white">
                            <h5 class="fw-bold mb-0"><i class="bx bx-info-circle"></i> Informasi Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Status Order:</h6>
                                    <ul class="list-unstyled">
                                        <li><span class="badge bg-warning">Pending</span> - Menunggu pembayaran</li>
                                        <li><span class="badge bg-success">Success</span> - Pembayaran berhasil</li>
                                        <li><span class="badge bg-danger">Failed</span> - Pembayaran gagal</li>
                                        <li><span class="badge bg-secondary">Expire</span> - Waktu pembayaran habis</li>
                                        <li><span class="badge bg-dark">Cancel</span> - Order dibatalkan</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6>Metode Pembayaran:</h6>
                                    <ul>
                                        <li>Transfer Bank (BCA, BNI, BRI, Mandiri)</li>
                                        <li>E-Wallet (GoPay, ShopeePay, OVO)</li>
                                        <li>Kartu Kredit</li>
                                        <li>Minimarket (Alfamart, Indomaret)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order List -->
                    <div class="card shadow">
                        <div class="card-header bg-info">
                            <h5 class="fw-bold mb-0"><i class="bx bx-history"></i> Riwayat Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ session('success') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ session('error') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if ($orders->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Paket Travel</th>
                                                <th>Lokasi</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Tanggal</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td><strong>{{ $order->order_id }}</strong></td>
                                                    <td>
                                                        <div>
                                                            <strong>{{ $order->travelPackage->name }}</strong>
                                                            <br>
                                                            <small
                                                                class="text-muted">{{ $order->travelPackage->duration }}</small>
                                                        </div>
                                                    </td>
                                                    <td>{{ $order->travelPackage->location }}</td>
                                                    <td>Rp {{ number_format($order->amount, 0, ',', '.') }}</td>
                                                    <td>
                                                        <span
                                                            class="badge
                                                    @if ($order->status == 'success') bg-success
                                                    @elseif($order->status == 'pending') bg-warning
                                                    @elseif($order->status == 'failed') bg-danger
                                                    @elseif($order->status == 'expire') bg-secondary
                                                    @elseif($order->status == 'cancel') bg-dark
                                                    @else bg-secondary @endif">
                                                            {{ ucfirst($order->status) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                                    <td>
                                                        <div class="btn-group-vertical btn-group-sm" role="group">
                                                            @if ($order->status == 'success')
                                                                <span class="btn btn-success btn-sm disabled">
                                                                    <i class="bx bx-check-circle"></i> Selesai
                                                                </span>
                                                                <a href="{{ route('detail', $order->travelPackage->slug) }}"
                                                                    class="btn btn-info btn-sm mt-1">
                                                                    <i class="bx bx-shopping-bag"></i> Order Lagi
                                                                </a>
                                                            @elseif($order->status == 'pending')
                                                                <!-- Button Bayar untuk order pending -->
                                                                <button type="button"
                                                                    class="btn btn-primary btn-sm pay-button"
                                                                    data-order-id="{{ $order->order_id }}"
                                                                    data-snap-token="{{ $order->snap_token }}"
                                                                    data-package-name="{{ $order->travelPackage->name }}">
                                                                    <i class="bx bx-credit-card"></i> Bayar Sekarang
                                                                </button>
                                                                <!-- Button Cek Status -->
                                                                <button type="button"
                                                                    class="btn btn-secondary btn-sm mt-1 check-status-button"
                                                                    data-order-id="{{ $order->order_id }}">
                                                                    <i class="bx bx-refresh"></i> Cek Status
                                                                </button>
                                                                <!-- Button Batalkan -->
                                                                <form action="{{ route('order.cancel', $order->id) }}"
                                                                    method="POST" class="d-inline mt-1">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-sm"
                                                                        onclick="return confirm('Apakah Anda yakin ingin membatalkan order ini?')">
                                                                        <i class="bx bx-x-circle"></i> Batalkan
                                                                    </button>
                                                                </form>
                                                            @elseif($order->status == 'failed' || $order->status == 'expire' || $order->status == 'cancel')
                                                                <!-- Button Order Ulang untuk status failed/expire/cancel -->
                                                                <a href="{{ route('order', $order->travelPackage->slug) }}"
                                                                    class="btn btn-info btn-sm">
                                                                    <i class="bx bx-rotate-left"></i> Order Ulang
                                                                </a>
                                                                <a href="{{ route('detail', $order->travelPackage->slug) }}"
                                                                    class="btn btn-secondary btn-sm mt-1">
                                                                    <i class="bx bx-detail"></i> Lihat Detail
                                                                </a>
                                                            @else
                                                                <a href="{{ route('detail', $order->travelPackage->slug) }}"
                                                                    class="btn btn-info btn-sm">
                                                                    Order Lagi
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $orders->links() }}
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="bx bx-package display-1 text-muted"></i>
                                    <h4 class="text-muted mt-3">Belum ada order</h4>
                                    <p class="text-muted">Anda belum melakukan pemesanan paket travel.</p>
                                    <a href="{{ route('package') }}" class="btn btn-info">
                                        <i class="bx bx-shopping-bag"></i> Jelajahi Paket Travel
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('script-alt')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle Pay Button Click
            const payButtons = document.querySelectorAll('.pay-button');

            payButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.getAttribute('data-order-id');
                    const snapToken = this.getAttribute('data-snap-token');
                    const packageName = this.getAttribute('data-package-name');

                    if (!snapToken) {
                        alert('Token pembayaran tidak tersedia. Silakan hubungi administrator.');
                        return;
                    }

                    // Show loading state
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="bx bx-loader bx-spin"></i> Memproses...';
                    this.disabled = true;

                    // Trigger Snap payment
                    window.snap.pay(snapToken, {
                        onSuccess: function(result) {
                            console.log('Payment success:', result);
                            alert('Pembayaran berhasil! Order ID: ' + orderId);
                            window.location.reload();
                        },
                        onPending: function(result) {
                            console.log('Payment pending:', result);
                            alert(
                                'Pembayaran pending. Silakan selesaikan pembayaran Anda.');
                            window.location.reload();
                        },
                        onError: function(result) {
                            console.log('Payment error:', result);
                            alert(
                                'Terjadi kesalahan saat pembayaran. Silakan coba lagi.');
                            // Reset button
                            button.innerHTML = originalText;
                            button.disabled = false;
                        },
                        onClose: function() {
                            console.log('Payment popup closed');
                            // Reset button if user closes the popup
                            button.innerHTML = originalText;
                            button.disabled = false;
                        }
                    });
                });
            });

            // Handle Check Status Button
            const checkStatusButtons = document.querySelectorAll('.check-status-button');

            checkStatusButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.getAttribute('data-order-id');

                    // Show loading
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="bx bx-loader bx-spin"></i> Mengecek...';
                    this.disabled = true;

                    // Simulate API call to check status
                    fetch(`/payment/check-status/${orderId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                alert('Status pembayaran: BERHASIL\nOrder ID: ' + orderId);
                                window.location.reload();
                            } else if (data.status === 'pending') {
                                alert(
                                    'Status pembayaran: MASIH MENUNGGU\nSilakan selesaikan pembayaran Anda.');
                            } else {
                                alert('Status pembayaran: ' + data.status.toUpperCase());
                            }
                        })
                        .catch(error => {
                            console.error('Error checking status:', error);
                            alert(
                            'Gagal memeriksa status pembayaran. Silakan refresh halaman.');
                        })
                        .finally(() => {
                            // Reset button
                            this.innerHTML = originalText;
                            this.disabled = false;
                        });
                });
            });
        });
    </script>

    <style>
        .btn-group-vertical .btn {
            margin-bottom: 2px;
        }

        .badge {
            font-size: 0.75em;
            padding: 0.4em 0.6em;
        }

        .table td {
            vertical-align: middle;
        }
    </style>
@endpush
