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
                    <li class="breadcrumb-item main-color">Profile</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-info">
                        <h5 class="fw-bold mb-0"><i class="bx bx-user"></i> Profile</h5>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-4 text-center mb-4">
                                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 120px; height: 120px;">
                                    <i class="bx bx-user display-4 text-primary"></i>
                                </div>
                                <h5 class="mt-3">{{ $user->name }}</h5>
                                <p class="text-muted">{{ $user->is_admin ? 'Administrator' : 'Customer' }}</p>
                            </div>
                            <div class="col-md-8">
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Nama Lengkap:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        {{ $user->name }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Email:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        {{ $user->email }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Telepon:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        {{ $user->phone ?? '-' }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Alamat:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        {{ $user->address ?? '-' }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Bergabung:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        {{ $user->created_at->format('d F Y') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('profile.edit') }}" class="btn btn-info">
                                <i class="bx bx-edit"></i> Edit Profile
                            </a>
                            <a href="{{ route('profile.orders') }}" class="btn btn-warning">
                                <i class="bx bx-history"></i> Riwayat Order
                            </a>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-danger">
                                <i class="bx bx-log-out"></i> Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders -->
                @if($recentOrders->count() > 0)
                <div class="card shadow mt-4">
                    <div class="card-header bg-info">
                        <h5 class="fw-bold mb-0"><i class="bx bx-history"></i> Order Terbaru</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Paket</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOrders as $order)
                                    <tr>
                                        <td>{{ $order->order_id }}</td>
                                        <td>{{ $order->travelPackage->name }}</td>
                                        <td>Rp {{ number_format($order->amount, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge
                                                @if($order->status == 'success') bg-success
                                                @elseif($order->status == 'pending') bg-warning
                                                @elseif($order->status == 'failed') bg-danger
                                                @else bg-secondary @endif">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('profile.orders') }}" class="btn btn-primary btn-sm">
                                Lihat Semua Order
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
</main>
@endsection
