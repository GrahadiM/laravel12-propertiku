@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Paket Travel</h1>
        <a href="{{ route('admin.travel-packages.create') }}" class="btn btn-primary btn-sm shadow-sm">
            Tambah Paket Travel <i class="fa fa-plus"></i>
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Paket Travel</h6>
        </div>
        <div class="card-body">

            @if(session('message'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>{{ session('message') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" id="travelPackagesTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Paket</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Durasi</th>
                            <th>Harga</th>
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
    #travelPackagesTable_wrapper .dataTables_filter {
        float: right;
    }
    #travelPackagesTable_wrapper .dataTables_length {
        float: left;
    }
    #travelPackagesTable_wrapper .dataTables_paginate {
        float: right;
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
    $(document).ready(function () {
        // Inisialisasi DataTables
        $('#travelPackagesTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: "{{ route('admin.travel-packages.datatables') }}",
                type: 'GET'
            },
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    width: '5%'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'category.title',
                    name: 'category.title'
                },
                {
                    data: 'location',
                    name: 'location'
                },
                {
                    data: 'duration',
                    name: 'duration'
                },
                {
                    data: 'price',
                    name: 'price',
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            // Remove any existing formatting for numbers
                            const number = typeof data === 'string' ?
                                parseInt(data.replace(/[^\d]/g, '')) : data;

                            return 'Rp ' + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
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
            order: [[0, 'asc']] // Default urutkan berdasarkan ID ascending
        });
    });
</script>
@endpush
