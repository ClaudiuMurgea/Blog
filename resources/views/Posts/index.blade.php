@extends('layouts.app')
@section('title', 'Published Posts')

@section('content')




<div class="row mt-5">
    <div class="col-8 offset-1">

        <div class="">
            <h2>Posts List</h2>     
        </div>
        
        @foreach ($posts as $post)

            <h2 class="text-center my-5"> 
                <a href={{ route('post.show', $post->slug) }}> {{ $post->title }} </a>
            </h2>             

            <article class="mt-2 mb-3">
                <span class="pl-5">
                    <strong>
                        {{ ucfirst(substr($post->text, 0, 200)) }} 
                        @if( (strlen($post->text)) > 200)
                            <span>...</span>
                        @endif
                    </strong>  
                </span>          
            </article>

            <hr class="mb-5" style="border-block-color: lightblue">
       
        @endforeach
    </div>

    <div class="col-2 offset-1">

        <h2 class="mb-5">Categories List</h2>

        @foreach ($categories as $category)
            <ul style="list-style: none">
                <a class="font-weight-bold" href={{ route('category.show', $category->slug) }}> {{ $category->categoryname }} </a>
            </ul>
        @endforeach

    </div>
</div>            

@endsection