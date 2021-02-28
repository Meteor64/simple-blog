<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;


/**
 * @method static paginate(int $int)
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'link',
        'parent_id',
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    #[Pure] public function getParentName(): string
    {
        return is_null($this->parent) ? 'ندارد' : $this->parent->name;
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
