<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'mobile',
        'role',
        'email',
        'password',
        'profile_img',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getPersianRole(): string
    {
        return match ($this->role) {
            "admin" => 'مدیر',
            "author" => 'نویسنده',
            "user" => 'کاربر عادی',
        };
    }

    public function getJalaliDate(): string
    {
        return verta($this->created_at)->format('Y/m/d');
    }

//    IsAdmin
    public static function isAdmin(): bool
    {
        if (auth()->user()->role == 'admin')
            return true;
        return false;
    }

//    IsAuthor
    public static function isAuthor(): bool
    {
        if (auth()->user()->role == 'author')
            return true;
        return false;
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->belongsToMany(Post::class, 'likes');
    }

    public function getProfileImgAttribute($value): string
    {
        return $value != null ? $value : 'profile.jpg';
    }

    public function getProfileUrl()
    {
        return asset('images/profile/' . $this->profile_img);
    }
}
