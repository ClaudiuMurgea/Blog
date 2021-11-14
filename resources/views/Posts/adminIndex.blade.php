@extends('layouts.app')
@section('title', 'All Posts')

@section('content')

<div class="offset-1 mb-5 pl-4">
    <h3>Posts List</h3>     
</div>

<div class="row">
    <div class="col-8 offset-1">
        
        @foreach ($posts as $post)

            <h2 class="text-center my-5"> 
                <a href="/{{ $post->slug }}"> {{ $post->title }} </a>
            </h2>
                
            @if ($post->published)
                <h3 class="float-right">
                    Published 
                </h3>
            @else
                <h3 class="float-right">
                    Draft    
                </h3>
            @endif          

            <article class="mt-2 mb-3">
                <span class="pl-5">
                    <strong> 
                        {{ ucfirst(substr($post->text, 0, 200)) }} <span>...</span> 
                    </strong> 
                </span>          
            </article>

            <hr class="mb-5" style="border-block-color: lightblue">
       
        @endforeach
    </div>

    <div class="col-2 offset-1">

        <h3 class="mb-4">Categories List</h3>

        @foreach ($categories as $category)
            <ul style="list-style: none">
                <a class="font-weight-bold" href={{ route('category.show', $category->slug) }}> {{ $category->categoryname }} </a>
            </ul>
        @endforeach

    </div>
</div>            

@endsection