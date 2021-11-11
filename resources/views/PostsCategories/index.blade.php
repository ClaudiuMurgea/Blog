@extends('layouts.app')
@section('title', 'All Posts')

@section('content')

<div class="offset-2 pl-4 mb-5">
    <h3>Choose categories for each post</h3>     
</div>

@foreach ($posts as $post)

<div class="row">    
    <div class="col-6 offset-3">
        <h3>&laquo;{{ $post->title }}&raquo;</h3> 

        @if ($post->image_path != 'image')
            <img src="{{ asset('images/' . $post->image_path) }}" class="col-3" alt="Image">    
        @endif

        <a class="offset-2 pl-3 btn btn-primary pr-3" href="/admin/postcategory/{{ $post->id }}">Select categories</a>

        <div class="d-flex">
            <article class="mt-2 mb-3">
                <span class="pl-5">
                    <strong> {{ $post->text }}lorem Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatum iure officiis, deleniti dolore nostrum obcaecati saepe voluptatem sint quia illum necessitatibus maxime, quo, vitae aperiam dolor nemo ducimus doloremque nihil! Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur hic in dignissimos quidem non itaque, rerum molestiae modi dolore minima expedita dolor debitis facilis incidunt id vero sapiente. Cumque, temporibus! </strong> 
                </span>          
            </article>
        </div>              

        <hr class="mb-5" style="border-block-color: lightblue">
    </div>
            
</div>
      
@endforeach

@endsection