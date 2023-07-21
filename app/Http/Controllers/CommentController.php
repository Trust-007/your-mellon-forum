<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Mail\CommentEmailAlert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    public function index(Post $post) {
        $postWithComments = Post::with('comments')->find($post->id);
        $comments = $postWithComments->comments;
        return response()->json($comments);
    }

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

       $comment = Comment::create($formFields);

       if($post->user_id != auth()->user()->id) {
          $user = User::find($post->user_id);
          Mail::to($user->email)->send(new CommentEmailAlert($user));
       }
       if( $request->is('api/*')){ 
         return response()->json(['message' => 'Comment created successfully', 'data' =>$comment], 201);
       }else {
        return redirect('/posts/'.$post->id);
       }
    }

    public function show(Post $post, Comment $comment, Request $request) {
        if( $request->is('api/*')){ 
            return response()->json($comment);
        }else {
            return view('comments.show', ['comment' => $comment, 'post' => $post]);
        }
        
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
            $formFields['editing_date'] = date('Y-m-d');
    
            $comment->update($formFields);
    
            if( $request->is('api/*')){  
               return response()->json(['message' => 'Comment updated successfully']);
            }else {
               return redirect('/posts/'.$post->id);
            }
        }
    }

    public function destroy(Post $post, Comment $comment, Request $request) {
        if(auth()->user()->id == $comment->user_id) {
          $comment->delete();
        
          if( $request->is('api/*')){  
            return response()->json(['message' => 'Comment deleted successfully']);
          } else {
            return redirect('/posts/'.$post->id)->with('message', 'Comment Deleted');
          }
        }
    }
}
