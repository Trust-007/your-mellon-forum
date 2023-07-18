<x-layout>
    <div class="form-page">
        <h1>Update Post</h1>
        <form method="POST" action="/posts/{{$post->id}}" class="form-container">
            @csrf
            @method('PUT')
            <label for="title">Title</label>
            <input type="text" name="title" value="{{$post->title}}">
            @error('title')
            <p>{{$message}}</p>
            @enderror
            <label for="text">Text</label>
            <textarea type="text" name="text" cols="10" rows="10">
                {{$post->text}}
            </textarea>    
            @error('text')
            <p>{{$message}}</p>
            @enderror
            
            <br>
            <button type="submit">Update Post</button>
        </form>
    </div>
</x-layout>