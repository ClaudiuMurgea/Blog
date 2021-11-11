<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post_Category;


class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'text', 'published', 'image_path', 'slug'];

    public function Comments ()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function PostCategory ()
    {
        return $this->hasMany(PostCategory::class, 'post_id', 'id');
    }
}
