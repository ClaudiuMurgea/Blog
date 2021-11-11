@extends('layouts.app')
@section('title', 'Edit category')

@section('content')

<div class="col-11">
    <div class="col-3 offset-5 form-group pl-5">

        <form action="/admin/category/{{ $category->id }}" method="POST">
            @csrf
            @method('PATCH')
            
            <input class="form-control font-weight-bold mb-5 mt-5 text-center" type="text" name="category-name" value="{{ $category->categoryname }}">

            <button class="form-control btn btn-success" type="submit">Edit Category</button>

            {{-- Validation --}}
            <div class="text-danger text-center font-weight-bold">{{ $errors->first('category-name') }}</div>        
            
        </form>
    </div>
</div>

@endsection