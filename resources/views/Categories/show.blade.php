@extends('layouts.app')
@section('title',  $category->categoryname . ' Posts')

@section('content')

<div class="offset-1 mb-5">

    <h3>Posts List</h3>

    @if (auth()->user())
        <a href="/admin/post/create">Add new post</a>
    @endif

</div>

@foreach ($postsForCategories as $post)
    
    <h2 class="text-center"> 
        <a href="/{{ $post->post->id }}"> {{ $post->post->title }} </a>
    </h2>

    <div class="row">
        
        <div class="col-8 offset-2">
            
            <article class="mt-2 mb-3">
                <span class="pl-5 font-weight-bold"> {{ substr($post->post->text, 0, 100) }} </span>          
            </article>
            
            <hr style="border-block-color: lightblue">
            
        </div>

    </div>
                
@endforeach

@endsection