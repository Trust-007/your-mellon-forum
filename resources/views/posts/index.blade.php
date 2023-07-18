<x-layout>
  <h1>Posts</h1>
  @include('partials._search')
  @unless ($posts->count() == 0)
      <ul>
        @foreach ($posts as $post)
          <li>
            <h4><a href="/posts/{{$post->id}}">{{$post->title}}</a></h4>
            <p>{{$post->text}}</p>
            <p>Created on: {{$post->creation_date}}</p>
            <p>by: {{$post->user->name}}</p>
        </li>
        @endforeach
      </ul>
  @endunless
  <a href="/posts/create">New Post</a>
</x-layout>