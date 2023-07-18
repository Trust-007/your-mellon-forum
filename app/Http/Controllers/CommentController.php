<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    public function create(Post $post) {
        return view('comments.create', ['post' => $post]);
    }

    public function store(Post $post, Request $request) {
       $formFields = $request->validate([
          'text' => 'required',
       ]);

       $formFields['post_id'] = $post->id;
       $formFields['user_id'] = auth()->user()->id;
       $formFields['creation_date'] = date('Y-m-d');
       $formFields['editing_date'] = date('Y-m-d');

       Comment::create($formFields);

       return redirect('/posts/'.$post->id);
    }

    public function show(Post $post, Comment $comment) {
        return view('comments.show', ['comment' => $comment, 'post' => $post]);
    }

    public function edit(Post $post, Comment $comment) { 
        return view('comments.edit', ['comment' => $comment, 'post' => $post]);
    }

    public function update(Post $post, Comment $comment, Request $request) { 
        if(auth()->user()->id == $comment->user_id) {
            $formFields = $request->validate([
                'text' => 'required',
            ]);
    
            $formFields['post_id'] = $post->id;
            $formFields['user_id'] = auth()->user()->id;
            $formFields['editing_date'] = date('Y-m-d');
    
            $comment->update($formFields);
    
            return redirect('/posts/'.$post->id);
        }
    }

    public function destroy(Post $post, Comment $comment) {
        if(auth()->user()->id == $comment->user_id) {
          $comment->delete();
        
          return redirect('/posts/'.$post->id)->with('message', 'Comment Deleted');
        }
    }
}
