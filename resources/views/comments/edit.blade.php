<x-layout>
    <div class="form-page">
        
        <a href="/posts/{{$post->id}}/comments/{{$comment->id}}">back</a>
        <h1>Edit Comment</h1>
        <form method="POST" action="/posts/{{$post->id}}/comments/{{$comment->id}}" class="form-container">
            @csrf
            @method('PUT')
            <label for="text">Text</label>
            <textarea type="text" name="text" cols="10" rows="10">
                {{$comment->text}}
            </textarea>    
            @error('text')
            <p>{{$message}}</p>
            @enderror
            
            <br>
            <button type="submit">Comment</button>
        </form>
    </div>
</x-layout>