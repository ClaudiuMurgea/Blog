@extends('layouts.app')
@section('title', 'All pending comments')

@section('content')
    
<h3 class="mt-5 pl-5">List of all pending comments</h3>

<table class="table stripped mt-5">

    <thead>
        <tr>
            <td class="col-2 pl-5">  Name  </td>
            <td class="col-6"> Comment</td>                   
            <td class="pl-5">  Post Title</td>
            <td> Accept </td>
            <td> Remove </td>
        </tr>
    </thead>

    <tbody>
        @foreach ($comments as $comment)
            @if (!$comment->accepted)
                <tr>

                    <td class="col-2 pl-5"> {{ $comment->name }}        </td>                       
                    <td class="col-6"> {{ $comment->text }}        </td>
                    <td class="pl-5"> {{ $comment->post->title }} </td>

                    <td>                
                        <form action={{ route('comment.update', $comment->id) }} method="POST">
                        @csrf   
                        @method('PATCH')
                            <button class="btn btn-warning rounded-sm" type="submit" onclick="return confirm('Are you sure?')">Accept</button>
                        </form>
                    </td>
                    
                    <td>                
                        <form action={{ route('comment.destroy', $comment->id) }} method="POST">
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
@endsection