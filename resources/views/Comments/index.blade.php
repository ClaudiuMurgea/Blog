@extends('layouts.app')
@section('title', 'All pending comments')

@section('content')

<div class="offset-2">
    
    <h3>List of all pending comments</h3>

    <table class="table stripped mt-5">

        <thead>
            <tr>
                <td>  Name  </td>
                <td> Comment</td>                   
                <td>  Post  </td>
                <td> Accept </td>
                <td> Remove </td>
            </tr>
        </thead>

        <tbody>
            @foreach ($comments as $comment)
                @if (!$comment->accepted)
                    <tr>
                        <td> {{ $comment->name }}        </td>                       
                        <td> {{ $comment->text }}        </td>
                        <td> {{ $comment->post->title }} </td>

                        <td>                
                            <form action="/admin/comment/{{ $comment->id }}" method="POST">
                            @csrf   
                            @method('PATCH')
                                <button class="btn btn-warning rounded-sm" type="submit" onclick="return confirm('Are you sure?')">Accept</button>
                            </form>
                        </td>
                        
                        <td>                
                            <form action="/admin/comment/{{ $comment->id }}" method="POST">
                            @csrf   
                            @method('PATCH')
                                <button class="btn btn-danger rounded-sm" type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach 
        </tbody>

    </table>

</div>

@endsection