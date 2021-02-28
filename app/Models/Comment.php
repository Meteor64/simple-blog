<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'is_approved',
        'user_id',
        'post_id',
        'comment_id',
    ];
    protected $with = ['approvedReplies'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class,'comment_id');
    }

    public function getStringApproved(): string
    {
        return !!$this->is_approved ? 'تایید شده' : 'تایید نشده';
    }

    public function approvedReplies()
    {
        return $this->replies()->where('is_approved',true);
    }

    public function getUserProfileImage()
    {
        return asset('images/profile/'.$this->profile_img);
    }
}
