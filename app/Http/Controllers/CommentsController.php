<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Comment;
use App\Models\Post;

class CommentsController extends Controller
{   
    public function __construct ()
    {
        $this->middleware('auth')->except('index', 'create', 'store');
    }

    public function index ()
    {   
        $comments = Comment::all();

        return view('Comments.index', compact('comments'));
    }

    public function edit (Post $post) 
    {   
        return view('Comments.create', compact('post'));
    }

    public function store (Request $request, $postID)
    {   
        $comment = request()->validate([
            'name' => 'required',
            'text' => 'required|min:2'
        ]);

        $comment = new Comment();
        $comment->name = $request->input('name');
        $comment->text = $request->input('text');
        $comment->post_id = $postID;
        $comment->save();

        return redirect('/')->with('message', 'Succes! Comment is pending for aproval!');
    }

    public function update (Request $request, Comment $comment)
    {
        $comment = Comment::where('id', $comment->id)->update([
            'accepted' => 1
        ]);
        
        return redirect('/admin/comments')->with('message', 'Comment accepted!');
    }

    public function destroy (Comment $comment)
    {
        $comment->delete();

        return redirect('/admin/comments')->with('message', 'Comment succesfully deleted!');
    }
}
