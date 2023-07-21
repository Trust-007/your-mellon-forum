<x-layout>
    <a href="/posts/{{$post->id}}">back</a>
    <div class="post-show">
        <h4>{{$comment->text}}</h4>
        <p>by: {{$comment->user->name}}</p>
        @if(auth()->user()->id == $comment->user_id) 
            <div class="post-update-delete">
                <a href="/posts/{{$post->id}}/comments/{{$comment->id}}/edit" class="auth-btn">Update</a>
                <form method="POST" action="/posts/{{$post->id}}/comments/{{$comment->id}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="auth-btn">Delete</button>
                </form>
            </div>
        @endif
    </div>
</x-layout>