<x-layout>
  <h1>Posts</h1>
  @unless ($posts->count() == 0)
      <ul>
        @foreach ($posts as $post)
          <li>
            <h4><a href="/posts/{{$post->id}}">{{$post->title}}</a></h4>
            <p>{{$post->text}}</p>
            <p>Created: {{$post->creation_date}}</p>
        </li>
        @endforeach
      </ul>
  @endunless
  <a href="/posts/create">New Post</a>
</x-layout>