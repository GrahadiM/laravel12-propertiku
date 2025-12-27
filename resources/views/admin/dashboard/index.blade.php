@extends('admin.layout')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Travel Packages Card -->
            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Paket Travel
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $travelPackages }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-hotel fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Posts Card -->
            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Post
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $posts }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-book fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Transactions Card -->
            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total Transaksi
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalTransactions }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Transactions Card -->
            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                    Pending
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingTransactions }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-spinner fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success Transactions Card -->
            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Success
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $successTransactions }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Revenue Card -->
            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Total Revenue
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp
                                    {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Charts Row -->
        <div class="row">

            <!-- Monthly Transactions Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Transaksi 6 Bulan Terakhir</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="monthlyTransactionsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Distribution Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Distribusi Status Transaksi</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="statusDistributionChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            @foreach ($statusDistribution['labels'] as $index => $label)
                                <span class="mr-2">
                                    <i class="fas fa-circle"
                                        style="color: {{ $statusDistribution['colors'][strtolower($label)] ?? '#6c757d' }}"></i>
                                    {{ $label }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Additional Charts Row -->
        <div class="row">

            <!-- Revenue Chart -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Revenue 6 Bulan Terakhir</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Packages Chart -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Paket Travel Terpopuler</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-bar">
                            <canvas id="topPackagesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Recent Transactions Table -->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Transaksi Terbaru</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Paket Travel</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentTransactions as $transaction)
                                        <tr>
                                            <td>{{ $transaction->order_id }}</td>
                                            <td>{{ $transaction->user->name }}</td>
                                            <td>{{ $transaction->travelPackage->name }}</td>
                                            <td>Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                            <td>
                                                <span
                                                    class="badge
                                        @if ($transaction->status == 'success') badge-success
                                        @elseif($transaction->status == 'pending') badge-warning
                                        @elseif($transaction->status == 'failed') badge-danger
                                        @else badge-secondary @endif">
                                                    {{ ucfirst($transaction->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('script-alt')
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Monthly Transactions Chart
        document.addEventListener('DOMContentLoaded', function() {
            const monthlyCtx = document.getElementById('monthlyTransactionsChart').getContext('2d');
            const monthlyChart = new Chart(monthlyCtx, {
                type: 'line',
                data: {
                    labels: @json($monthlyTransactions['labels']),
                    datasets: [{
                        label: 'Jumlah Transaksi',
                        data: @json($monthlyTransactions['data']),
                        borderColor: '#4e73df',
                        backgroundColor: 'rgba(78, 115, 223, 0.1)',
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });

            // Status Distribution Chart
            const statusCtx = document.getElementById('statusDistributionChart').getContext('2d');
            const statusChart = new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: @json($statusDistribution['labels']),
                    datasets: [{
                        data: @json($statusDistribution['data']),
                        backgroundColor: [
                            '#28a745', // success
                            '#ffc107', // pending
                            '#dc3545', // failed
                            '#6c757d' // others
                        ],
                        hoverBackgroundColor: [
                            '#218838',
                            '#e0a800',
                            '#c82333',
                            '#5a6268'
                        ],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                },
            });

            // Revenue Chart
            const revenueCtx = document.getElementById('revenueChart').getContext('2d');
            const revenueChart = new Chart(revenueCtx, {
                type: 'bar',
                data: {
                    labels: @json($monthlyTransactions['labels']),
                    datasets: [{
                        label: 'Revenue (Rp)',
                        data: @json($monthlyTransactions['revenue']),
                        backgroundColor: 'rgba(40, 167, 69, 0.8)',
                        borderColor: 'rgba(40, 167, 69, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g,
                                        ".");
                                }
                            }
                        }
                    }
                }
            });

            // Top Packages Chart
            const topPackagesCtx = document.getElementById('topPackagesChart').getContext('2d');
            const topPackagesChart = new Chart(topPackagesCtx, {
                type: 'bar',
                data: {
                    labels: @json($topPackages->pluck('name')),
                    datasets: [{
                        label: 'Jumlah Transaksi',
                        data: @json($topPackages->pluck('transaction_count')),
                        backgroundColor: 'rgba(78, 115, 223, 0.8)',
                        borderColor: 'rgba(78, 115, 223, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    indexAxis: 'y',
                    scales: {
                        x: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        });
    </script>

    <style>
        .chart-area,
        .chart-bar,
        .chart-pie {
            position: relative;
            height: 300px;
            width: 100%;
        }

        @media (min-width: 768px) {

            .chart-area,
            .chart-bar,
            .chart-pie {
                height: 320px;
            }
        }
    </style>
@endpush
