<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post_Category;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['categoryname', 'slug'];

    public function PostCategory ()
    { 
        return $this->hasMany(PostCategory::class, 'category_id', 'id');
    }
}
