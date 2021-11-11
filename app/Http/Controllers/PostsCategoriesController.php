<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Category;

class PostsCategoriesController extends Controller
{
    public function index ()
    {   
        $posts = Post::all();
        return view('PostsCategories.index', compact('posts'));
    }

    public function store (Request $request, $postID)
    {   
        $categories = request()->validate([
            'categories' => 'required|unique:post_categories,category_id'
        ]);
        
        $i = 0;
        foreach($categories as $values => $value) 
        {
            
            $count = count($value);
            
            for(; $i < $count;) 
            {
                // $postCategory = PostCategory::where('category_id', !$value[$i])->create([
                //     'category_id' => $value[$i],
                //     'post_id' => $postID
                // ]);
                $postCategory = new PostCategory;
                $postCategory = where('post_id', $postID)->get();
                dd($postCategory);
                if($postCategory->category_id != $value[$i]) {
                $postCategory->post_id = $postID;      
                $postCategory->category_id = $value[$i];
                $postCategory->save();
                $i++; }
            }
        }

        return redirect()->back()->with('message', 'Category succesfully selected!');
    }

    public function show (Post $post)
    {   
        $postCategories = PostCategory::where('post_id',$post->id)->pluck('category_id')->all();
        $categories = Category::all();
        return view('PostsCategories.show', compact('post', 'categories','postCategories'));
    }

    // public function destroy ($postID)
    // {   
    //     dd($postID);
    //     return redirect()->back()->with('message', 'Success');
    // }
}
