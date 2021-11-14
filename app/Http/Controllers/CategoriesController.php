<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\PostCategory;
use App\Models\Post;

class CategoriesController extends Controller
{   
    public function __construct ()
    {
        $this->middleware('auth')->except('show');
    }

    public function index ()
    {   $categories = Category::all();
        return view('categories.index', compact('categories', $categories));
    }

    public function create ()
    {
        return view('Categories.create');
    }

    public function store (Request $request)
    {
        $data = request()->validate([
            'category-name' => 'required|min:3',     
        ]);

        $categoryID = Category::orderBy('id', 'desc')->first();

        if(!$categoryID == null) {
            $slug = Str::slug($request->input('category-name').' '.$categoryID->id, '-');
        } 
        $slug = Str::slug($request->input('category-name'), '-');
            


        $categoryName = Str::ucfirst($request->input('category-name'));

        $category = new Category();
        $category->categoryname = $categoryName;
        $category->slug = $slug;
        $category->save();

        return redirect('/admin/categories')->with('message', 'Category created!');
    }

    public function show ($slug)
    {  
        $category = Category::with('PostCategory')->where('slug' , $slug)->first();
        
        return view('Categories.show', compact('category'));
    }

    public function edit ($slug)
    {   
        $category = Category::where('slug', $slug)->get()->first();
        return view('Categories.edit', compact('category'));
    }

    public function update (Request $request, Category $category)
    {   
        $categoryName = request()->validate([
            'category-name' => 'required'
        ]);

        $slug = Str::slug($request->input('category-name').' '.$category->id, '-');

        $category = Category::where('id', $category->id)->update([
            'categoryname' => $request->input('category-name'),
            'slug' => $slug
        ]);
        
        return redirect('/admin/categories')->with('message', 'Category succesfully edited!');
    }

    public function destroy (Category $category)
    {   
        $category->delete();

        return redirect('/admin/categories')->with('message', 'Category succesfully deleted!');
    }
}
