@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Properti</h1>
        <a href="{{ route('admin.properties.create') }}" class="btn btn-primary btn-sm shadow-sm">
            Tambah Properti <i class="fa fa-plus"></i>
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Unit Properti</h6>
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
                <table class="table table-bordered" id="propertiesTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Properti</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
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
@endpush

@push('script-alt')
<!-- DataTables JavaScript -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
<script>
    $(document).ready(function () {
        $('#propertiesTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: "{{ route('admin.properties.datatables') }}",
                type: 'GET'
            },
            columns: [
                { data: 'id', name: 'id', width: '5%' },
                { data: 'name', name: 'name' },
                { data: 'category.title', name: 'category.title' },
                { data: 'location', name: 'location' },
                {
                    data: 'price',
                    name: 'price',
                    render: function(data) {
                        return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                    }
                },
                { data: 'action', name: 'action', orderable: false, searchable: false, width: '15%' }
            ],
            language: { url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json" }
        });
    });
</script>
@endpush
