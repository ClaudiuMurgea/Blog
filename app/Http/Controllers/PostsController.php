<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;
use App\Models\PostCategory;
use App\Models\Category;

class PostsController extends Controller
{   
    public function __construct ()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index ()
    {   
        $posts = Post::where('published', 1)->get();
        $categories = Category::all();
        return view('Posts.index', compact('posts','categories'));
    }

    public function create ()
    {
        return view('Posts.create');
    }

    public function store (Request $request)
    {        
        $this->validateRequest();

        $newImageName = 'image';
        if($request->image){
        $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();
        $request->image->move(public_path('/images'), $newImageName); }
        
        $slug = Str::slug('PostSlug', '-');

        Post::create([
            'title' => $request->input('title'),
            'text' => $request->input('text'),
            'published' => $request->input('published'),
            'image_path' => $newImageName,
            'slug' => $slug
        ]);

        return redirect('/')->with('message', 'Post succesfully created!');      
    }

    public function show (Post $post) 
    {   
        $postCategories = PostCategory::where('post_id', $post->id)->get();

        return view('Posts.show', compact('post', 'postCategories'));
    }

    public function edit (Post $post)
    {
        $categories = Category::all();
        $postCategories = PostCategory::where('post_id', $post->id)->pluck('category_id')->all();

        return view('Posts.edit', compact('post', 'categories', 'postCategories'));
    }

    public function update (Request $request,Post $post)
    {   
        $this->validateRequest();
        
        $newImageName = 'image';
        if($request->image){       
            $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();
            $request->image->move(public_path('/images'), $newImageName); }

        $slug = Str::slug('PostSlug', '-');

        Post::where('id', $post->id)->update([
            'title' => $request->input('title'),
            'text' => $request->input('text'),
            'published' => $request->input('published'),
            'image_path' => $newImageName,
            'slug' => $slug
        ]);
    #Categories
    #1-Delete old category relation to post

        $categories = request()->validate([
            'categories' => 'required'
        ]);

        $deleteOldCategories = PostCategory::where('post_id', $post->id)->get();

        foreach($deleteOldCategories as $oldCategory) 
        {
            $oldCategory->delete();
        }

    #2-Create new relation to post

        foreach($categories as $values => $value) 
        {
            foreach($value as $index => $category)
            {   
                $newPostCategory = PostCategory::create([
                    'category_id' => $category,
                    'post_id' => $post->id
                ]);
            }
        }
  
        return redirect('/')->with('message', 'Post succesfully edited!'); 
    }

    public function destroy (Post $post)
    {
        $post->delete();

        return redirect('/')->with('message', 'Post succesfully deleted!');
    }

    public function validateRequest ()
    {
        return request()->validate([
            'title' => 'required|min:3',
            'text' => 'required',
            'published' => 'required',
            'image' => 'nullable|image'      
        ]);
    }

}
