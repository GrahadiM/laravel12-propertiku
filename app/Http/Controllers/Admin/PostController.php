<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class PostController extends Controller
{
    public function index(): View
    {
        return view('admin.posts.index');
    }

    /**
     * Get data for DataTables
     */
    public function datatables(): JsonResponse
    {
        $posts = Post::select('posts.*')->latest();

        return DataTables::of($posts)
            ->addIndexColumn()
            ->addColumn('action', function ($post) {
                return '
                    <div class="btn-group" role="group">
                        <a href="'.route('admin.posts.edit', $post).'"
                           class="btn btn-info btn-sm"
                           title="Edit">
                            <i class="fa fa-pencil-alt"></i>
                        </a>
                        <form class="d-inline"
                              action="'.route('admin.posts.destroy', $post).'"
                              method="POST">
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button type="submit"
                                    class="btn btn-danger btn-sm"
                                    title="Delete"
                                    onclick="return confirm(\'Apakah Anda yakin ingin menghapus post ini?\')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </div>
                ';
            })
            ->editColumn('image', function ($post) {
                if ($post->image) {
                    return asset('storage/' . $post->image);
                }
                return null;
            })
            ->editColumn('created_at', function ($post) {
                return $post->created_at->format('Y-m-d H:i:s');
            })
            ->editColumn('updated_at', function ($post) {
                return $post->updated_at->format('Y-m-d H:i:s');
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create(): View
    {
        return view('admin.posts.create');
    }

    public function store(StorePostRequest $request): RedirectResponse
    {
        try {
            $data = $request->all();
            $data['slug'] = Str::slug($request->title);

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store(
                    'assets/posts', 'public'
                );
            }

            Post::create($data);

            return redirect()
                ->route('admin.posts.index')
                ->with('message', 'Post berhasil ditambahkan!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit(Post $post): View
    {
        return view('admin.posts.edit', [
            'post' => $post
        ]);
    }

    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        try {
            $data = $request->all();
            $data['slug'] = Str::slug($request->title);

            if ($request->hasFile('image')) {
                // Delete old image
                if ($post->image) {
                    File::delete('storage/' . $post->image);
                }

                $data['image'] = $request->file('image')->store(
                    'assets/posts', 'public'
                );
            } else {
                $data['image'] = $post->image;
            }

            $post->update($data);

            return redirect()
                ->route('admin.posts.index')
                ->with('message', 'Post berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(Post $post): RedirectResponse
    {
        try {
            if ($post->image) {
                File::delete('storage/' . $post->image);
            }

            $post->delete();

            return redirect()
                ->route('admin.posts.index')
                ->with('message', 'Post berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()
                ->route('admin.posts.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
