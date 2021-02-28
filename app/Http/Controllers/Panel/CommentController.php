<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {

        if ($request->has('status')) {
            $comments = Comment::with(['user', 'post'])
                ->where('is_approved', !!$request->get('status'))
                ->withCount('replies')
                ->orderBy('id', 'DESC')->paginate(10);
        } else {
            $comments = Comment::with(['user', 'post'])->withCount('replies')
                ->orderBy('id', 'DESC')->paginate(10);
        }
        return view('panel.comment.index', compact('comments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment_id' => ['required', 'integer', 'exists:comments,id'],
            'post_id' => ['required', 'integer', 'exists:posts,id'],
            'content' => ['required', 'string', 'max:700'],
        ]);
        $data = $request->only(['comment_id', 'content', 'post_id']);
        $data['is_approved'] = 1;
        $data['user_id'] = auth()->user()->id;
        try {

            Comment::create($data);
            return redirect(route('comments.index'))->with('success', 'پاسخ با موفقیت ثبت شد.');
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function show(Comment $comment)
    {
//       $answers = Comment::where('')
        return view('panel.comment.show', compact('comment'));
    }

    public function update(Comment $comment)
    {
        $comment->update([
            'is_approved' => !$comment->is_approved
        ]);
        return back()->with('success', 'کامنت مورد نطر با موفقیت ویرایش شد.');

    }

    public function destroy(Comment $comment)
    {
        try {
            $comment->delete();
            return back()->with('success', 'کامنت مورد نطر با موفقیت حذف شد.');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
