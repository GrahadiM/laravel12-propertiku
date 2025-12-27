<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Property; // Menggunakan Model Property
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StorePropertyRequest; // Pastikan Request ini sudah dibuat
use App\Http\Requests\UpdatePropertyRequest; // Pastikan Request ini sudah dibuat

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.properties.index');
    }

    /**
     * Get data for DataTables
     */
    public function datatables(): JsonResponse
    {
        $properties = Property::with('category')
            ->select('properties.*')
            ->latest();

        return DataTables::of($properties)
            ->addIndexColumn()
            ->addColumn('action', function ($property) {
                return '
                    <div class="btn-group" role="group">
                        <a href="'.route('admin.properties.edit', $property).'"
                           class="btn btn-info btn-sm"
                           title="Edit">
                            <i class="fa fa-pencil-alt"></i>
                        </a>
                        <form class="d-inline"
                              action="'.route('admin.properties.destroy', $property).'"
                              method="POST">
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button type="submit"
                                    class="btn btn-danger btn-sm"
                                    title="Delete"
                                    onclick="return confirm(\'Apakah Anda yakin ingin menghapus properti ini?\')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </div>
                ';
            })
            ->editColumn('price', function ($property) {
                return 'Rp ' . number_format($property->price, 0, ',', '.');
            })
            ->editColumn('created_at', function ($property) {
                return $property->created_at->format('d/m/Y H:i');
            })
            ->editColumn('updated_at', function ($property) {
                return $property->updated_at->format('d/m/Y H:i');
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::orderBy('title')->get();

        return view('admin.properties.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyRequest $request): RedirectResponse
    {
        // dd($request->all());
        try {
            $slug = Str::slug($request->name);

            Property::create($request->validated() + [
                'slug' => $slug
            ]);

            return redirect()
                ->route('admin.properties.index')
                ->with('message', 'Properti berhasil ditambahkan!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property): View
    {
        $categories = Category::orderBy('title')->get();
        $property->load('galleries');

        return view('admin.properties.edit', [
            'property' => $property,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyRequest $request, Property $property): RedirectResponse
    {
        try {
            $slug = Str::slug($request->name);

            $property->update($request->validated() + [
                'slug' => $slug
            ]);

            return redirect()
                ->route('admin.properties.index')
                ->with('message', 'Properti berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property): RedirectResponse
    {
        try {
            // Cek apakah properti memiliki galeri foto
            if ($property->galleries()->exists()) {
                return redirect()
                    ->route('admin.properties.index')
                    ->with('error', 'Tidak dapat menghapus properti karena masih memiliki galeri foto.');
            }

            $property->delete();

            return redirect()
                ->route('admin.properties.index')
                ->with('message', 'Properti berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()
                ->route('admin.properties.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
