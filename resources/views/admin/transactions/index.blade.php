@extends('admin.layout')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Manajemen Transaksi</h1>
            <div class="btn-group">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exportModal">
                    <i class="fa fa-download"></i> Export
                </button>
            </div>
        </div>

        <!-- Alert Area -->
        <div id="alert-container"></div>

        <!-- Statistics Cards -->
        <div class="row">
            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Transaksi
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="total-transactions">0</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Success
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="success-transactions">0</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pending
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="pending-transactions">0</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-spinner fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Failed
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="failed-transactions">0</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-times fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Total Revenue
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="total-revenue">Rp 0</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                    Avg. Transaction
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="avg-transaction">Rp 0</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- DataTable -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Transaksi</h6>
                {{-- <div class="filter-section">
                    <select id="status-filter" class="form-control form-control-sm d-inline-block w-auto">
                        <option value="">Semua Status</option>
                        <option value="success">Success</option>
                        <option value="pending">Pending</option>
                        <option value="failed">Failed</option>
                        <option value="cancel">Cancel</option>
                        <option value="expire">Expire</option>
                    </select>
                </div> --}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="transactionsTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Paket Travel</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Tanggal Order</th>
                                <th>Terakhir Diupdate</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data akan di-load oleh DataTables via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Transaction Detail Modal -->
    <div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby="transactionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transactionModalLabel">Detail Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="transaction-detail-content">
                        <!-- Content will be loaded here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Export Modal -->
    <div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="exportModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exportModalLabel">Export Data Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="exportForm">
                        @csrf
                        <div class="form-group">
                            <label for="export_format">Format Export</label>
                            <select class="form-control" id="export_format" name="format">
                                <option value="excel">Excel</option>
                                <option value="csv">CSV</option>
                                <option value="pdf">PDF</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="start_date">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="start_date" name="start_date">
                        </div>
                        <div class="form-group">
                            <label for="end_date">Tanggal Akhir</label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
                        <div class="form-group">
                            <label for="export_status">Status</label>
                            <select class="form-control" id="export_status" name="status">
                                <option value="">Semua Status</option>
                                <option value="success">Success</option>
                                <option value="pending">Pending</option>
                                <option value="failed">Failed</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" id="exportSubmit" class="btn btn-primary">Export</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style-alt')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">
    <style>
        .badge-success {
            background-color: #28a745;
        }

        .badge-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .badge-danger {
            background-color: #dc3545;
        }

        .badge-secondary {
            background-color: #6c757d;
        }

        .badge-dark {
            background-color: #343a40;
        }

        .filter-section {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .transaction-detail-item {
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .transaction-detail-item:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: bold;
            color: #495057;
        }

        .detail-value {
            color: #6c757d;
        }

        .btn-group .btn {
            margin: 0 2px;
        }
    </style>
@endpush

@push('script-alt')
    <!-- DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            let table;

            // Initialize DataTables
            function initializeDataTable() {
                table = $('#transactionsTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('admin.transactions.datatables') }}",
                        type: 'GET',
                        data: function(d) {
                            d.status = $('#status-filter').val();
                        },
                        error: function(xhr, error, thrown) {
                            console.error('DataTables error:', error, thrown);
                            showAlert('danger', 'Gagal memuat data transaksi. Silakan refresh halaman.');
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,
                            width: '5%'
                        },
                        {
                            data: 'order_id',
                            name: 'order_id',
                            width: '15%'
                        },
                        {
                            data: 'user.name',
                            name: 'user.name',
                            render: function(data, type, row) {
                                return data || 'N/A';
                            }
                        },
                        {
                            data: 'travelPackage.name',
                            name: 'travelPackage.name',
                            render: function(data, type, row) {
                                return data || 'N/A';
                            }
                        },
                        {
                            data: 'amount',
                            name: 'amount',
                            orderable: true,
                            searchable: false,
                            width: '10%'
                        },
                        {
                            data: 'status',
                            name: 'status',
                            width: '10%'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at',
                            width: '12%'
                        },
                        {
                            data: 'updated_at',
                            name: 'updated_at',
                            width: '12%'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            width: '15%'
                        }
                    ],
                    language: {
                        processing: "Sedang memproses...",
                        lengthMenu: "Tampilkan _MENU_ entri",
                        zeroRecords: "Tidak ditemukan data yang sesuai",
                        emptyTable: "Tidak ada data yang tersedia pada tabel ini",
                        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                        infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
                        infoFiltered: "(disaring dari _MAX_ entri keseluruhan)",
                        search: "Cari:",
                        paginate: {
                            first: "Pertama",
                            last: "Terakhir",
                            next: "Selanjutnya",
                            previous: "Sebelumnya"
                        }
                    },
                    order: [
                        [6, 'desc']
                    ], // Default order by created_at desc
                    drawCallback: function(settings) {
                        // Update statistics after each draw
                        updateStatistics();
                    },
                    error: function(xhr, error, thrown) {
                        console.error('DataTables error:', error, thrown);
                        showAlert('danger', 'Terjadi kesalahan saat memuat data.');
                    }
                });
            }

            // Initialize the table
            initializeDataTable();

            // Status filter change event
            $('#status-filter').change(function() {
                if (table) {
                    table.ajax.reload();
                }
            });

            // View transaction details dengan AJAX
            $(document).on('click', '.view-details', function() {
                const transactionId = $(this).data('transaction-id');

                // Show loading
                $('#transaction-detail-content').html(`
                    <div class="text-center py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p class="mt-2">Memuat data transaksi...</p>
                    </div>
                `);

                // Fetch transaction details via AJAX
                $.ajax({
                    url: "{{ url('admin/transactions') }}/" + transactionId,
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            const transaction = response.transaction;
                            const travelPackage = response.travel_package;
                            const user = response.user;

                            const content = `
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="transaction-detail-item">
                                            <div class="detail-label">Order ID</div>
                                            <div class="detail-value">${transaction.order_id}</div>
                                        </div>
                                        <div class="transaction-detail-item">
                                            <div class="detail-label">Customer</div>
                                            <div class="detail-value">${user ? user.name : 'N/A'} (${user ? user.email : 'N/A'})</div>
                                        </div>
                                        <div class="transaction-detail-item">
                                            <div class="detail-label">Paket Travel</div>
                                            <div class="detail-value">${travelPackage ? travelPackage.name : 'N/A'}</div>
                                        </div>
                                        <div class="transaction-detail-item">
                                            <div class="detail-label">Lokasi</div>
                                            <div class="detail-value">${travelPackage ? travelPackage.location : 'N/A'}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="transaction-detail-item">
                                            <div class="detail-label">Amount</div>
                                            <div class="detail-value">Rp ${formatNumber(transaction.amount)}</div>
                                        </div>
                                        <div class="transaction-detail-item">
                                            <div class="detail-label">Status</div>
                                            <div class="detail-value">
                                                <span class="badge badge-${getStatusColor(transaction.status)}">
                                                    ${transaction.status ? transaction.status.charAt(0).toUpperCase() + transaction.status.slice(1) : 'N/A'}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="transaction-detail-item">
                                            <div class="detail-label">Tanggal Order</div>
                                            <div class="detail-value">${formatDate(transaction.created_at)}</div>
                                        </div>
                                        <div class="transaction-detail-item">
                                            <div class="detail-label">Terakhir Diupdate</div>
                                            <div class="detail-value">${formatDate(transaction.updated_at)}</div>
                                        </div>
                                    </div>
                                </div>
                                ${transaction.payment_data ? `
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <div class="transaction-detail-item">
                                                <div class="detail-label">Payment Data</div>
                                                <pre class="detail-value" style="background: #f8f9fa; padding: 10px; border-radius: 5px; font-size: 12px; max-height: 200px; overflow-y: auto;">${JSON.stringify(transaction.payment_data, null, 2)}</pre>
                                            </div>
                                        </div>
                                    </div>
                                ` : ''}
                            `;

                            $('#transaction-detail-content').html(content);
                        } else {
                            $('#transaction-detail-content').html(`
                                <div class="alert alert-danger">
                                    <i class="fa fa-exclamation-triangle"></i> ${response.message}
                                </div>
                            `);
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'Terjadi kesalahan saat memuat data transaksi';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        $('#transaction-detail-content').html(`
                            <div class="alert alert-danger">
                                <i class="fa fa-exclamation-triangle"></i> ${errorMessage}
                            </div>
                        `);
                    }
                });
            });

            // Handle form submissions dengan AJAX
            $(document).on('submit', '.delete-form, form[action*="update-status"]', function(e) {
                e.preventDefault();

                const form = $(this);
                const url = form.attr('action');
                const method = form.find('input[name="_method"]').val() || 'POST';

                if (!confirm('Apakah Anda yakin?')) {
                    return;
                }

                $.ajax({
                    url: url,
                    type: method,
                    data: form.serialize(),
                    success: function(response) {
                        if (response.success) {
                            showAlert('success', response.message);
                            table.ajax.reload();
                        } else {
                            showAlert('danger', response.message);
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'Terjadi kesalahan';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        showAlert('danger', errorMessage);
                    }
                });
            });

            // Export form handler
            $('#exportSubmit').click(function() {
                const formData = $('#exportForm').serialize();

                $.ajax({
                    url: "{{ route('admin.transactions.export') }}",
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            showAlert('success', response.message);
                            $('#exportModal').modal('hide');
                        } else {
                            showAlert('danger', response.message);
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'Terjadi kesalahan saat export';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        showAlert('danger', errorMessage);
                    }
                });
            });

            // Update statistics function
            function updateStatistics() {
                $.ajax({
                    url: "{{ route('admin.transactions.statistics') }}",
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            $('#total-transactions').text(response.total_transactions);
                            $('#success-transactions').text(response.success_transactions);
                            $('#pending-transactions').text(response.pending_transactions);
                            $('#failed-transactions').text(response.failed_transactions);
                            $('#total-revenue').text('Rp ' + formatNumber(response.total_revenue));
                            $('#avg-transaction').text('Rp ' + formatNumber(response.avg_transaction));
                        }
                    },
                    error: function() {
                        console.error('Failed to load statistics');
                    }
                });
            }

            // Helper function untuk show alert
            function showAlert(type, message) {
                const alertHtml = `
                    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                        ${message}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                `;
                $('#alert-container').html(alertHtml);

                // Auto remove alert after 5 seconds
                setTimeout(function() {
                    $('.alert').alert('close');
                }, 5000);
            }

            // Helper functions
            function formatNumber(number) {
                if (!number) return '0';
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            function formatDate(dateString) {
                if (!dateString) return 'N/A';
                const date = new Date(dateString);
                return date.toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }

            function getStatusColor(status) {
                const colors = {
                    'success': 'success',
                    'pending': 'warning',
                    'failed': 'danger',
                    'cancel': 'secondary',
                    'expire': 'dark'
                };
                return colors[status] || 'secondary';
            }

            // Initialize statistics on page load
            updateStatistics();
        });
    </script>
@endpush
