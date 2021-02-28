<?php

namespace App\Http\Controllers;

use App\Http\Requests\LandingStoreCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class LandingCommentController extends Controller
{
    public function store(LandingStoreCommentRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        Comment::create($data);
        return back()->with('success', 'نظر شما با موفقیت ارسال شد و پس از تایید مدیر نمایش داده می شود.');
    }
}
