<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $users_count = User::count();
        $comments_count = $this->getCommentsCount();
        $posts_count = $this->getPostsCount();

        $categories_count = Category::count();
        return view('panel.index', compact('users_count', 'comments_count',
            'categories_count', 'posts_count'));
    }

    /**
     * @return mixed
     */
    private function getPostsCount(): mixed
    {
        if (auth()->user()->isAuthor()) {
            $posts_count = Post::where('user_id', auth()->user()->id)->count();
        } else {
            $posts_count = Post::count();
        }
        return $posts_count;
    }

    /**
     * @return mixed
     */
    private function getCommentsCount(): mixed
    {
        if (auth()->user()->isAuthor()) {
            $comments_count = Comment::whereHas('post', function ($query) {
                return $query->where('user_id', auth()->user()->id);
            })->count();
        } else {
            $comments_count = Comment::count();
        }
        return $comments_count;
    }
}
