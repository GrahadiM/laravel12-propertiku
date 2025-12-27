@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Properti: {{ $property->name }}</h1>
    </div>

    <div class="row">
        <div class="col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Unit</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.properties.update', $property) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control" name="category_id">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $property->category_id ? 'selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $property->name) }}" />
                        </div>
                        <div class="row">
                            <div class="col-md-6"><label><i class="fa fa-bed"></i> Kamar Tidur</label><input type="number" name="bedroom" class="form-control" value="{{ $property->bedroom }}"></div>
                            <div class="col-md-6"><label><i class="fa fa-bath"></i> Kamar Mandi</label><input type="number" name="bathroom" class="form-control" value="{{ $property->bathroom }}"></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4"><label><i class="fa fa-expand"></i> Luas Tanah</label><input type="text" name="building_area" class="form-control" value="{{ $property->building_area }}"></div>
                            <div class="col-md-4"><label><i class="fa fa-expand"></i> Luas Bangunan</label><input type="text" name="surface_area" class="form-control" value="{{ $property->surface_area }}"></div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><i class="fa fa-file"></i> Sertifikat</label>
                                    <select name="certificate" class="form-control">
                                        <option value="AJB" {{ (old('certificate') ?? $property->certificate) == 'AJB' ? 'selected' : '' }}>AJB</option>
                                        <option value="HGB" {{ (old('certificate') ?? $property->certificate) == 'HGB' ? 'selected' : '' }}>HGB</option>
                                        <option value="SHM" {{ (old('certificate') ?? $property->certificate) == 'SHM' ? 'selected' : '' }}>SHM</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <label>Deskripsi</label>
                            <textarea name="description" id="description" rows="5" class="form-control">{{ old('description', $property->description) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="number" class="form-control" name="price" value="{{ old('price', $property->price) }}" />
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Galeri Foto</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse($property->galleries as $gallery)
                            <div class="col-6 mb-3">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $gallery->path) }}" class="img-fluid rounded border shadow-sm" style="height: 120px; width: 100%; object-fit: cover;">
                                    <form action="{{ route('admin.properties.galleries.destroy', [$property, $gallery]) }}" method="POST" class="mt-1">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm btn-block" onclick="return confirm('Hapus foto?')"><i class="fa fa-trash"></i> Hapus</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center text-muted">Belum ada foto.</div>
                        @endforelse
                    </div>
                    <hr>
                    <form action="{{ route('admin.properties.galleries.store', $property) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Tambah Foto Baru</label>
                            <input type="file" name="path" class="form-control-file" required>
                        </div>
                        <button type="submit" class="btn btn-success btn-sm btn-block"><i class="fa fa-upload"></i> Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
