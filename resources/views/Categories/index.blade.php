@extends('layouts.app')
@section('title', 'All categories')

@section('content')

<div class="d-flex row offset-2 col-8">
    <h3>List of all Categories</h3>
<div class="offset-3 pl-4 mt-5"> <a class="btn btn-primary" href="/admin/category/create">Add category</a> </div>

    <table class="table stripped">

        <thead>
            <tr>
                <td>  Name  </td>                  
                <td>  Edit  </td>
                <td> Delete </td>
            </tr>
        </thead>

        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>
                        <a href="/admin/category/{{ $category->id }}"> {{ $category->categoryname }} </a>
                    </td>
                    <td><a class="btn btn-warning rounded-sm" href="/admin/category/{{ $category->slug }}">Edit&raquo;&raquo;</a></td>
                    <td>                
                        <form action="/admin/category/{{ $category->id }}" method="POST">
                            @csrf   
                            @method('DELETE')
                                <button class="btn btn-danger rounded-sm" type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach 
        </tbody>

    </table>
    
</div>

@endsection