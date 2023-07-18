<x-layout>
    <a href="/posts/{{$post->id}}">back</a>
    <h2>{{$comment->text}}</h2>
    <p>by: {{$comment->user->name}}</p>
    @if(auth()->user()->id == $comment->user_id) 
        <div>
            <a href="/posts/{{$post->id}}/comments/{{$comment->id}}/edit">Update Comment</a>
            <form method="POST" action="/posts/{{$post->id}}/comments/{{$comment->id}}">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </div>
    @endif
</x-layout>