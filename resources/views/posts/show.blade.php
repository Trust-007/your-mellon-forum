<x-layout>
    <a href="/posts">back</a>
    <div>
        <h4>{{$post->title}}</h4>
        <p>{{$post->text}}</p>
        <p>Created: {{$post->creation_date}}</p>
    </div>
    <div>
        @unless($post->comments()->count() == 0)
            <ul>
                @foreach ($post->comments() as $comment) 
                <li>
                    {{$comment->text}}
                </li>
                @endforeach
            </ul>
        @else
           <p>No comment made</p>
        @endunless
           <form method="POST" action="/posts/{{$post->id}}">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
           </form>
            <a href="/posts/{{$post->id}}/edit">Update</a>
            <a href="/comments/create">Add Comment</a>
    </div>
    
</x-layout>