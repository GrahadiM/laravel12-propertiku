@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Paket Travel - {{ $travelPackage->name }}</h1>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-5 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <form action="{{ route('admin.travel-packages.update', $travelPackage) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="category_id">Category Travel</label>
                            <select class="form-control" id="category_id" name="category_id">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == $travelPackage->category_id ? 'selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $travelPackage->name) }}" />
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" id="location" name="location"
                                value="{{ old('location', $travelPackage->location) }}" />
                        </div>
                        <div class="form-group">
                            <label for="duration">Duration</label>
                            <input type="text" class="form-control" id="duration" name="duration"
                                value="{{ old('duration', $travelPackage->duration) }}" />
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control">{{ old('description', $travelPackage->description) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" name="price"
                                value="{{ old('price', $travelPackage->price) }}" />
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Gallery Images</h6>
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

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th width="10%">ID</th>
                                    <th width="50%">Image</th>
                                    <th width="40%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($travelPackage->galleries as $gallery)
                                <tr>
                                    <td>{{ $gallery->id }}</td>
                                    <td class="text-center">
                                        @if($gallery->path)
                                            @if(Str::startsWith($gallery->path, ['http://', 'https://']))
                                                {{-- External URL --}}
                                                <img width="200" src="{{ $gallery->path }}"
                                                     alt="Gallery Image {{ $gallery->id }}"
                                                     class="img-thumbnail"
                                                     style="max-height: 150px; object-fit: cover;">
                                            @else
                                                {{-- Local Storage --}}
                                                <img width="200" src="{{ asset('storage/' . $gallery->path) }}"
                                                     alt="Gallery Image {{ $gallery->id }}"
                                                     class="img-thumbnail"
                                                     style="max-height: 150px; object-fit: cover;">
                                                <div class="mt-2 small text-muted">
                                                    {{ $gallery->path }}
                                                </div>
                                            @endif
                                        @else
                                            <span class="text-danger">No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.travel-packages.galleries.edit', [$travelPackage, $gallery]) }}"
                                               class="btn btn-info btn-sm" title="Edit">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                            <form class="d-inline"
                                                  action="{{ route('admin.travel-packages.galleries.destroy', [$travelPackage, $gallery]) }}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-danger btn-sm"
                                                        title="Delete"
                                                        onclick="return confirm('Are you sure you want to delete this image?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4">
                                        <i class="fa fa-image fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">No images found for this travel package.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer">
                    <form action="{{ route('admin.travel-packages.galleries.store', $travelPackage) }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="path" class="font-weight-bold">Add New Image</label>
                            <input type="file" class="form-control form-control-file" id="path" name="path"
                                   accept="image/*" required />
                            <small class="form-text text-muted">
                                Supported formats: JPG, JPEG, PNG, GIF. Max size: 2MB
                            </small>
                            @error('path')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fa fa-upload"></i> Upload Image
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script-alt')
<script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#description' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endpush
