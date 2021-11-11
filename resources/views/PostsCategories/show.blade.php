@extends('layouts.app')
@section('title', 'All Posts')

@section('content')

<div class="offset-1 pl-4 mb-5">
    <h3>Choose categories for each post</h3>     
</div>

<div class="row">    
    <div class="col-6 offset-1">

        <h3>&laquo;{{ $post->title }}&raquo;</h3> 

        @if ($post->image_path != 'image')
            <img src="{{ asset('images/' . $post->image_path) }}" class="imgs" alt="Image">    
        @endif

        <div class="d-flex">
            <article class="mt-2 mb-3">
                <span class="pl-5">
                    <strong> {{ $post->text }}lorem Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatum iure officiis, deleniti dolore nostrum obcaecati saepe voluptatem sint quia illum necessitatibus maxime, quo, vitae aperiam dolor nemo ducimus doloremque nihil! Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur hic in dignissimos quidem non itaque, rerum molestiae modi dolore minima expedita dolor debitis facilis incidunt id vero sapiente. Cumque, temporibus! </strong> 
                </span>          
        </article>

    </div>              
</div>
    
<div class="col-2 offset-2 py-5 pl-5">
    <div class="form-group">

        <form action="/admin/postcategories/{{ $post->id }}" method="POST">
            @csrf
            
            <label class="py-5 offset-3 font-weight-bold text-primary"  for="categories">Select Category</label>
            
            <select class="form-control" name="categories[]" id="categories" multiple>
                    
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ in_array($category->id, $postCategories) ? 'selected' : ''}} > {{ $category->categoryname  }}</option>                
                @endforeach

            </select>

            <button class="btn btn-primary form-control mt-3" type="submit">Select</button>

            <form action="/admin/postcategory/{{ $post->id }}" method="POST">
                @csrf 
                @method('DELETE')
    
                <button class="btn btn-danger form-control mt-3" type="submit">Deselect</button>
            </form>
        
            {{-- Validation --}}
            <div class="text-danger text-center font-weight-bold">{{ $errors->first('categories') }}</div>
        </form>

    </div>
</div>      

@endsection