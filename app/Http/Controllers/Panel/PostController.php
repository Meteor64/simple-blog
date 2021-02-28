<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Post\CreatePostRequest;
use App\Http\Requests\Panel\Post\updatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        if (User::isAuthor()) {
            $postsQuery = Post::where('user_id', $user->id)->with(['user']);

        } else {
            $postsQuery = Post::with(['user']);
        }
        if ($request->search) {
            $postsQuery->where('title', 'LIKE', "%{$request->search}%");
        }
        $posts = $postsQuery->paginate(10);
        return view('panel.posts.index', compact('posts'));
    }

    public function create()
    {
//        $categories = Category::where('parent_id', null)->get();
        $categories = Category::all();
        return view('panel.posts.create', compact('categories'));
    }

    public function store(CreatePostRequest $request)
    {
        $categoryIds = $request->categories;

        $file = $request->file('banner');
        $file_name = $this->saveFile($file);
        $data = $request->validated();
        if ($request->slug != null) {
            $data['slug'] = SlugService::createSlug(Post::class, 'slug', $request->slug);
        }
        $data['banner'] = $file_name;
        $data['user_id'] = auth()->user()->id;

        $post = Post::create($data);
        $post->categories()->sync($categoryIds);

        return redirect(route('posts.index'))->with('success', 'مطلب جدید با موفقیت ایجاد شد.');
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
//        $categories = $post->categories()->get()->pluck('name','id');
//        $categories = Category::all()->where('parent_id', null);
        $categories = Category::all();
        return view('panel.posts.edit', compact('post', 'categories'));
    }

    public function update(updatePostRequest $request, Post $post)
    {
        $categoryIds = $request->categories;
        $data = $request->validated();

        if ($request->has('banner')) {
            if ($post->banner != null) {
                $file = public_path('images/banners/' . $post->banner);
                unlink($file);
            }
            $file = $request->file('banner');
            $file_name = $this->saveFile($file);
            $data['banner'] = $file_name;

        }

        $post->update($data);
        $post->categories()->sync($categoryIds);

        return redirect(route('posts.index'))->with('success', 'مطلب مورد نظر با موفقیت بروزرسانی شد.');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        try {
            $post->delete();
            $file = public_path('images/banners/' . $post->banner);
            if (file_exists($file)) {
                unlink($file);
            }
            return back()->with('success', 'مطلب مورد نظر با موفقیت حذف شد.');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    private function saveFile($file): string
    {
        $base_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $ext = $file->getClientOriginalExtension();
        $file_name = $base_name . '-' . time() . '.' . $ext;
        $file->storeAs('images/banners', $file_name, 'public_files');
        return $file_name;
    }
}
