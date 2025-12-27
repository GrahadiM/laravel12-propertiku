@extends('admin.layout')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Post</h1>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary btn-sm shadow-sm">
                Tambah Post <i class="fa fa-plus"></i>
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Post</h6>
            </div>
            <div class="card-body">

                @if (session('message'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong>{{ session('message') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered" id="postsTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Judul</th>
                                <th>Excerpt</th>
                                <th>Image</th>
                                <th>Tanggal Dibuat</th>
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
@endsection

@push('style-alt')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
    <style>
        /* Custom styling untuk DataTables */
        #postsTable_wrapper .dataTables_filter {
            float: right;
        }

        #postsTable_wrapper .dataTables_length {
            float: left;
        }

        #postsTable_wrapper .dataTables_paginate {
            float: right;
        }

        .img-thumbnail {
            max-width: 150px;
            height: auto;
        }
    </style>
@endpush

@push('script-alt')
    <!-- DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables
            $('#postsTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('admin.posts.datatables') }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        width: '5%'
                    },
                    {
                        data: 'title',
                        name: 'title',
                        render: function(data, type, row) {
                            // Truncate long titles
                            if (type === 'display' && data.length > 50) {
                                return data.substr(0, 50) + '...';
                            }
                            return data;
                        }
                    },
                    {
                        data: 'excerpt',
                        name: 'excerpt',
                        render: function(data, type, row) {
                            // Truncate long excerpts
                            if (type === 'display' && data.length > 100) {
                                return data.substr(0, 100) + '...';
                            }
                            return data;
                        }
                    },
                    {
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            if (type === 'display') {
                                if (data) {
                                    return '<img src="' + data +
                                        '" class="img-thumbnail" alt="Post Image">';
                                }
                                return '<span class="text-muted">No Image</span>';
                            }
                            return data;
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row) {
                            if (type === 'display') {
                                return new Date(data).toLocaleDateString('id-ID', {
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric'
                                });
                            }
                            return data;
                        }
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
                    [0, 'desc']
                ] // Default urutkan berdasarkan ID descending
            });
        });
    </script>
@endpush
