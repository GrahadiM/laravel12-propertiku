<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreGalleryRequest;
use App\Models\Property;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function store(StoreGalleryRequest $request, Property $property): RedirectResponse
    {
        $data = $request->all();
        $data['path'] = $request->file('path')->store(
            'assets/gallery', 'public'
        );

        $property->galleries()->create($data);

        return redirect()->route('admin.properties.edit', $property)->with('message', 'Added Successfully !');
    }

    public function edit( Property $property, Gallery $gallery): View
    {
        return view('admin.galleries.edit', [
            'travelPackage' => $property,
            'gallery' => $gallery
        ]);
    }

    public function update(StoreGalleryRequest $request, Property $property, Gallery $gallery): RedirectResponse
    {
        if($request->path){
            File::delete('storage/' . $gallery->path);
        }

        $data = $request->all();
        $data['path'] = $request->file('path')->store(
            'assets/gallery', 'public'
        );
        $gallery->update($data);

        return redirect()->route('admin.properties.edit', $property)->with('message', 'Updated Successfully !');
    }

    public function destroy( Property $property, Gallery $gallery): RedirectResponse
    {
        if($gallery->path){
            File::delete('storage/' . $gallery->path);
        }

        $gallery->delete();

        return redirect()->route('admin.properties.edit', $property)->with('message', 'Deleted Successfully !');
    }
}
