<x-layout>
    <div class="form-page">
        <a href="/posts/{{$post->id}}">back</a>
        <h1>Add Comment</h1>
        <form method="POST" action="/posts/{{$post->id}}/comments/store" class="form-container">
            @csrf
            <label for="text">Text</label>
            <textarea type="text" name="text" cols="10" rows="10">
                {{old('text')}}
            </textarea>    
            @error('text')
            <p>{{$message}}</p>
            @enderror
            
            <br>
            <button type="submit">Create Comment</button>
        </form>
    </div>
</x-layout>