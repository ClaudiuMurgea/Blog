@extends('layouts.app')
@section('title', 'Create Post')

@section('content')

<div class="row">
    <div class="offset-2 pl-5">
        <h3>Create Category</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-4 offset-4 form-group">
        
        <form action="/admin/category" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="category">Category Name</label>
            <input class="form-control" type="text" name="category-name" value="{{ old('category') }}">

            <div>
                <button class="btn btn-primary mt-5 form-control" type="submit">Create Category</button>
            </div>

            {{-- Validation --}}
            <div class="text-danger text-center font-weight-bold">{{ $errors->first('category-name') }}</div>

        </form>
        
    </div>
</div>

@endsection