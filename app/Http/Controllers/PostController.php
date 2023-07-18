<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index(Request $request) {
        if( $request->is('api/*')){
            return response()->json(Post::all()->sortBy('created_at'));
        }else{
            return view('posts.index', ['posts' => Post::latest()->filter(request(['search']))->simplePaginate(4)]);
        }
    }

    public function show(Request $request, Post $post) {
        if( $request->is('api/*')){
            return response()->json($post);
        } else {
            return view('posts.show', ['post' => $post]);
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

      return redirect('/posts');
    }

    public function edit(Post $post) {
       return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, Post $post) {
        if ($post->comments()->count() == 0) {
            $formFields = $request->validate([
            'title' => 'required',
            'text' => 'required',
            ]);
        
            $post->update($formFields);

            return redirect('/posts/'.$post->id)->with('message', 'Post Edited');

        } else {
            return back();
        }
        
    }

    public function destroy(Post $post) {
        if ($post->comments()->count() == 0) {
           $post->delete();
        }
       return redirect('/posts')->with('message', 'Post Deleted');
    }
}
