@extends('layouts.app')
@section('title', 'All Posts')

@section('content')

<div class="offset-2 mb-5 pl-3">
    <h3>Posts List</h3>     
</div>
<div class="offset-1">
<div class="row">
    <div class="col-6 offset-1">

        <h3>&laquo;{{ $post->title }}&raquo;</h3>
        
        <div class="d-flex offset-1">
            <h4>Categories :</h4>
            @foreach ($postCategories as $category)
                <ul style="list-style: none">
                    <a class="font-weight-bold" href="/category/{{ $category->category->id }}"> {{ $category->category->categoryname }} </a>
                </ul>
            @endforeach
    
        </div>             

        <article class="mt-2 mb-3">
            <span class="pl-5">
                <strong>
                    {{ ucfirst(substr($post->text, 0, 200)) }} <span>...</span>
                </strong> 
            </span>          
        </article>
        
        @if ($post->image_path != 'image')
            <img src="{{ asset('images/' . $post->image_path) }}" class="imgs mb-5" alt="Image">    
        @endif

        {{-- Edit/Delete --}}
        <span class="offset-1 float-right ">
            @if (auth()->user())
                <a class="btn btn-warning rounded-sm mb-3" href="/admin/{{ $post->id }}/edit"> Edit post&nbsp;&raquo;&raquo;</a>
                <form action="/admin/{{ $post->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger rounded-sm" type="submit" onclick="return confirm('Are you sure?')">Delete post</button>
                </form>
            @endif 
        </span>
        

        <div class="row pl-3">
            <div class="form-group">
    
                <form action="/comment/{{ $post->id }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input class="form-control col-3 mb-3" type="text" name="name" placeholder="Name..." value="{{ old('name') }}">
                    
                    <textarea class="form-control" name="text" id="text" cols="120" rows="4"></textarea>
    
                    <div>
                        <button class="btn btn-primary form-control mt-3 mb-5 col-3 pl-3" type="submit">Comment</button>
                    </div>
    
                    {{-- Validation --}}
                    <div class="text-danger text-center font-weight-bold">{{ $errors->first('name') }}</div>
                    <div class="text-danger text-center font-weight-bold">{{ $errors->first('text') }}</div>
    
                </form> 

            </div>
        </div>

      

        <div class="mt-2 mb-3">
            @foreach ($post->Comments as $comment)
                @if ($comment->accepted)

                    <div class="row col-12">
                        <p class="font-weight-bold">
                            <span class="text-primary py-5 col-3">{{ $post->created_at->format('d:i/d-m-y');}}</span>
                            {{ $comment->name }} : &nbsp;&nbsp;&nbsp; {{ $comment->text }}
                        </p>   
                    </div>

                @endif
            @endforeach
        </div>

    </div>
</div>            
</div>
@endsection