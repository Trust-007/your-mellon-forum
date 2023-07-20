<x-layout>
    <div class="form-page">
        <a href="/posts">back</a>
        <h1>Create a new Post</h1>
        <form method="POST" action="/posts/store" class="form-container">
            @csrf
            <label for="title">Title</label>
            <input type="text" name="title" value="{{old('title')}}">
            @error('title')
            <p>{{$message}}</p>
            @enderror
            <label for="text">Text</label>
            <textarea type="text" name="text" cols="10" rows="10">
                {{old('text')}}
            </textarea>    
            @error('text')
            <p>{{$message}}</p>
            @enderror
            
            <br>
            <button type="submit">Create Post</button>
        </form>
    </div>
</x-layout>