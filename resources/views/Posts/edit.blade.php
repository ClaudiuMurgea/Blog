@extends('layouts.app')
@section('title', 'Create Post')

@section('content')

<div class="row">
    <div class="offset-2 pl-5">
        <h3>Create Post</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-4 offset-4 form-group">

        <form action="/admin/{{ $post->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <label for="title">Title</label>
            <input class="form-control" type="text" name="title" value="{{ $post->title }}">

            <label for="text">Text</label>
            <textarea class="form-control mb-5" name="text" id="text" cols="30" rows="10" value="{{ old('text') }}">{{ $post->text }}</textarea>

            <select class="form-control"  name="published" id="published">
                <option value="" disabled class="text-center"> Select type </option>
                <option class="text-center" value="1" {{ $post->published == 1 ? 'selected' : ''}}>Published</option>
                <option class="text-center" value="0" {{ $post->published != 1 ? 'selected' : ''}}>Draft</option>
            </select>

            
            <input class="offset-5 mt-5" type="file" name="image" value="{{ old('image') }}">

            
            <div>
                <button class="btn btn-primary mt-5 form-control" type="submit">Edit Post</button>
            </div>

            <hr/>
            <div>        
                <select class="form-control" name="categories[]" id="categories" multiple>
                        
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ in_array($category->id, $postCategories) ? 'selected' : ''}} > {{ $category->categoryname  }}</option>                
                    @endforeach

                </select>
            </div>

            {{-- Validation --}}
            <div class="text-danger text-center font-weight-bold">{{ $errors->first('title') }}</div>
            <div class="text-danger text-center font-weight-bold">{{ $errors->first('text') }}</div>
            <div class="text-danger text-center font-weight-bold">{{ $errors->first('categories') }}</div>

        </form>

    </div>
</div>

@endsection