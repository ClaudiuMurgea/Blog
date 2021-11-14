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

    public function AdminIndex ()
    {
        $posts = Post::all();

        $categories = Category::all();

        return view('Posts.adminIndex', compact('posts', 'categories'));
    }

    public function create ()
    {   
        $categories = Category::all();
        return view('Posts.create', compact('categories'));
    }

    public function store (Request $request)
    {        
        $this->validateRequest();

        $newImageName = 'image';
        if($request->image){
        $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();
        $request->image->move(public_path('/images'), $newImageName); }
        
        $postID = Post::orderBy('id', 'desc')->first();

        if(!$postID == null) {
            $slug = Str::slug($request->input('title').' '.$postID->id, '-');            
        } 
        
        $slug = Str::slug($request->input('title'), '-');


        
        
        $post = Post::create([
            'title' => $request->input('title'),
            'text' => $request->input('text'),
            'published' => $request->input('published'),
            'image_path' => $newImageName,
            'slug' => $slug
        ]);

        #Category
    
        $categories = request()->validate([
            'categories' => ''
        ]);

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

        return redirect('/')->with('message', 'Post succesfully created!');      
    }

    public function show ($slug) 
    {   
        $post = Post::with('PostCategory')->where('slug', $slug)->first();

        return view('Posts.show', compact('post'));
    }

    public function edit ($slug)
    {
        $categories = Category::all();
        $post = Post::with('PostCategory')->where('slug', $slug)->first();

        $postCategories = PostCategory::where('post_id', $post->id)->pluck('category_id')->all();
        
        return view('Posts.edit', compact('post', 'categories', 'postCategories'));
    }

    public function update (Request $request,Post $post)
    {   
        $this->validateRequest();

        $categories = request()->validate([
            'categories' => 'required'
        ]);
        
        $newImageName = 'image';
        if($request->image){       
            $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();
            $request->image->move(public_path('/images'), $newImageName); }
        
        $slug = Str::slug($request->input('title').' '.$post->id, '-');

        Post::where('id', $post->id)->update([
            'title' => $request->input('title'),
            'text' => $request->input('text'),
            'published' => $request->input('published'),
            'image_path' => $newImageName,
            'slug' => $slug
        ]);

    #Categories
    #1-Delete old category relation to post

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
