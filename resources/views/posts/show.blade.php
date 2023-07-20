<x-layout>
    <a href="/posts">back</a>
    <div>
        <h4>{{$post->title}}</h4>
        <p>{{$post->text}}</p>
        <p>Created: {{$post->creation_date}}</p>
    </div>
    <div>
        @unless($comments->count() == 0)
            <ul>
                @foreach ($comments as $comment) 
                <li>
                    <a href="/posts/{{$post->id}}/comments/{{$comment->id}}">
                      <p>{{$comment->text}}</p>
                       <p>{{$comment->user->name}}</p>
                    </a>    
                </li>
                @endforeach
            </ul>
            
        @else
           <p>No comment made</p>
           <div>
                @auth()
                    @if(auth()->user()->id == $post->user_id)
                        <form method="POST" action="/posts/{{$post->id}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete Post</button>
                        </form>
                        <a href="/posts/{{$post->id}}/edit">Update Post</a>
                    @endif    
                @endauth
           </div>
           
        @endunless

        
        <a href="/posts/{{$post->id}}/comments/create">Add Comment</a>
    </div>
    
</x-layout>