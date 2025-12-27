@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Properti Baru</h1>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.properties.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kategori Properti</label>
                            <select name="category_id" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Properti</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Contoh: Green Lake Residence" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Lokasi</label>
                    <input type="text" class="form-control" name="location" value="{{ old('location') }}" />
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fa fa-bed"></i> Kamar Tidur</label>
                            <input type="number" class="form-control" name="bedroom" value="{{ old('bedroom') }}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fa fa-bath"></i> Kamar Mandi</label>
                            <input type="number" class="form-control" name="bathroom" value="{{ old('bathroom') }}" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><i class="fa fa-expand"></i> Luas Tanah (m²)</label>
                            <input type="number" class="form-control" name="surface_area" value="{{ old('surface_area') }}" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><i class="fa fa-expand"></i> Luas Bangunan (m²)</label>
                            <input type="number" class="form-control" name="building_area" value="{{ old('building_area') }}" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sertifikat</label>
                            <select name="certificate" class="form-control">
                                <option value="">-- Pilih Sertifikat --</option>
                                <option value="AJB" {{ old('certificate') == 'AJB' ? 'selected' : '' }}>AJB</option>
                                <option value="HGB" {{ old('certificate') == 'HGB' ? 'selected' : '' }}>HGB</option>
                                <option value="SHM" {{ old('certificate') == 'SHM' ? 'selected' : '' }}>SHM</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Deskripsi Properti</label>
                    <textarea name="description" id="description" rows="5" class="form-control">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Harga (Rp)</label>
                    <input type="number" class="form-control" name="price" value="{{ old('price') }}" />
                </div>

                <button type="submit" class="btn btn-primary btn-block shadow-sm">Simpan Properti</button>
            </form>
        </div>
    </div>
</div>
@endsection
