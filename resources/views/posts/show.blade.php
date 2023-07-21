<x-layout>
    
        <a href="/posts">back</a>
        <div class="post-show">
            <div class="post-info">
                <h4>{{$post->title}}</h4>
                <p class="post-text">{{$post->text}}</p>
                <p>Created: {{$post->creation_date}}</p>
                <p>by: {{$post->user->name}}</p>
            </div>
            <div class="comments">
                @unless($comments->count() == 0)
                    <ul>
                        @foreach ($comments as $comment) 
                        <li>
                            <a href="/posts/{{$post->id}}/comments/{{$comment->id}}">
                                <p>{{$comment->text}}</p>
                                <p>Author: {{$comment->user->name}}</p>
                            </a>    
                        </li>
                        @endforeach
                    </ul>
                    
                @else
                <p>No comment made</p>
                <div class="post-update-delete">
                        @auth()
                            @if(auth()->user()->id == $post->user_id)
                                <form method="POST" action="/posts/{{$post->id}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="auth-btn">Delete Post</button>
                                </form>
                                <a href="/posts/{{$post->id}}/edit" class="auth-btn">Update Post</a>
                            @endif    
                        @endauth
                </div>
                
                @endunless

                
                <a href="/posts/{{$post->id}}/comments/create" class="add-comment">Add Comment</a>
            </div>
        </div>
   
    
</x-layout>