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
            'category-name' => 'unique:categories,categoryname|required|min:3',     
        ]);

        $slug = Str::slug('CategorySlug', '-');
        $categoryName = Str::ucfirst($request->input('category-name'));

        $category = new Category();
        $category->categoryname = $categoryName;
        $category->slug = $slug;
        $category->save();

        return redirect('/admin/categories')->with('message', 'Category created!');
    }

    public function show (Category $category)
    {  
        $postsForCategories = PostCategory::where('category_id' , $category->id)->get();
        
        return view('Categories.show', compact('postsForCategories', 'category'));
    }

    public function edit (Category $category)
    {
        return view('Categories.edit', compact('category'));
    }

    public function update (Request $request, Category $category)
    {   
        $categoryName = request()->validate([
            'category-name' => 'required'
        ]);

        $category = Category::where('id', $category->id)->update([
            'categoryname' => $request->input('category-name')
        ]);
        
        return redirect('/admin/categories')->with('message', 'Category succesfully edited!');
    }

    public function destroy (Category $category)
    {   
        $category->delete();

        return redirect('/admin/categories')->with('message', 'Category succesfully deleted!');
    }
}
