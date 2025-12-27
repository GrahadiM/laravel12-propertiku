<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\TravelPackage;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreTravelPackageRequest;
use App\Http\Requests\UpdateTravelPackageRequest;

class TravelPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.travel-packages.index');
    }

    /**
     * Get data for DataTables
     */
    public function datatables(): JsonResponse
    {
        $travelPackages = TravelPackage::with('category')
            ->select('travel_packages.*')
            ->latest();

        return DataTables::of($travelPackages)
            ->addIndexColumn()
            ->addColumn('action', function ($travelPackage) {
                return '
                    <div class="btn-group" role="group">
                        <a href="'.route('admin.travel-packages.edit', $travelPackage).'"
                           class="btn btn-info btn-sm"
                           title="Edit">
                            <i class="fa fa-pencil-alt"></i>
                        </a>
                        <form class="d-inline"
                              action="'.route('admin.travel-packages.destroy', $travelPackage).'"
                              method="POST">
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button type="submit"
                                    class="btn btn-danger btn-sm"
                                    title="Delete"
                                    onclick="return confirm(\'Apakah Anda yakin ingin menghapus paket travel ini?\')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </div>
                ';
            })
            ->editColumn('price', function ($travelPackage) {
                return 'Rp ' . number_format($travelPackage->price, 0, ',', '.');
            })
            ->editColumn('created_at', function ($travelPackage) {
                return $travelPackage->created_at->format('d/m/Y H:i');
            })
            ->editColumn('updated_at', function ($travelPackage) {
                return $travelPackage->updated_at->format('d/m/Y H:i');
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

        return view('admin.travel-packages.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTravelPackageRequest $request): RedirectResponse
    {
        try {
            $slug = Str::slug($request->name);

            TravelPackage::create($request->validated() + [
                'slug' => $slug
            ]);

            return redirect()
                ->route('admin.travel-packages.index')
                ->with('message', 'Paket travel berhasil ditambahkan!');

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
    public function edit(TravelPackage $travelPackage): View
    {
        $categories = Category::orderBy('title')->get();
        $travelPackage->load('galleries');
        // dd($travelPackage, $categories);

        return view('admin.travel-packages.edit', [
            'travelPackage' => $travelPackage,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTravelPackageRequest $request, TravelPackage $travelPackage): RedirectResponse
    {
        try {
            $slug = Str::slug($request->name);

            $travelPackage->update($request->validated() + [
                'slug' => $slug
            ]);

            return redirect()
                ->route('admin.travel-packages.index')
                ->with('message', 'Paket travel berhasil diperbarui!');

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
    public function destroy(TravelPackage $travelPackage): RedirectResponse
    {
        try {
            // Check if travel package has galleries
            if ($travelPackage->galleries()->exists()) {
                return redirect()
                    ->route('admin.travel-packages.index')
                    ->with('error', 'Tidak dapat menghapus paket travel karena masih memiliki galeri foto.');
            }

            $travelPackage->delete();

            return redirect()
                ->route('admin.travel-packages.index')
                ->with('message', 'Paket travel berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()
                ->route('admin.travel-packages.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
