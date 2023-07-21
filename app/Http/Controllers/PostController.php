<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index(Request $request) {
        if( $request->is('api/*')){
            return response()->json(Post::orderBy('created_at', 'desc')->filter(request(['search']))->get());
        }else{
            return view('posts.index', ['posts' => Post::orderBy('created_at', 'desc')->filter(request(['search']))->get()]);
        }
    }

    public function show(Request $request, Post $post) {
        if( $request->is('api/*')){
            return response()->json($post);
        } else {
            return view('posts.show', ['post' => $post, 'comments' => $post->comments]);
        }
    }

    public function create() {
        return view('posts.create');
    }

    public function store(Request $request) {
      $formFields = $request->validate([
        'title' => 'required',
        'text' => 'required'
      ]);

      $formFields['creation_date'] = date('Y-m-d');
      $formFields['user_id'] = auth()->id();

      Post::create($formFields);
      
      if( $request->is('api/*')){
         return response()->json(['message' => 'Post Created Successfully'], 201);
      }else {
          return redirect('/posts');
      }
    }

    public function edit(Post $post) {
       return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, Post $post) {
        if($post->user_id == auth()->user()->id) { 
            if ($post->comments()->count() == 0 && auth()->user()->id == $post->user_id) {
                $formFields = $request->validate([
                'title' => 'required',
                'text' => 'required',
                ]);
            
                $post->update($formFields);
                if( $request->is('api/*')){
                    return response()->json(['message' => 'Post has been updated successfully']);
                }else {
                    return redirect('/posts/'.$post->id)->with('message', 'Post Edited');
                }
            

            } else {
                if( $request->is('api/*')){
                    return response()->json(['message' => 'Post cannot be modified']);
                }
                return back();
            }
        }
        
    }

    public function destroy(Post $post, Request $request) {
        if($post->user_id == auth()->user()->id) { 
            if ($post->comments()->count() == 0 && auth()->user()->id == $post->user_id) {
                $post->delete();
                if( $request->is('api/*')){
                    return response()->json(['message' => 'Post Deleted']);
                } else {
                    return redirect('/posts')->with('message', 'Post Deleted');
                }
            }
        } else {
            if( $request->is('api/*')){
                return response()->json(['message' => 'Post cannot be Deleted']);
            }
            return back();
        }
        
    }
}
