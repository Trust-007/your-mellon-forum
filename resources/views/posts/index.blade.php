<x-layout>
  <div class="post-index">
    <h1>Posts</h1>
    @include('partials._search')
    @unless ($posts->count() == 0)
        <ul>
          @foreach ($posts as $post)
            <li>
              <a href="/posts/{{$post->id}}">
                <div class="post-details">
                  <h4>{{$post->title}}</h4>
                  <p>{{$post->text}}</p>
                </div>
                <div class="extra">
                  <p>Created on: {{$post->creation_date}}</p>
                  <p>by: {{$post->user->name}}</p>
                </div>
              </a>
          </li>
          @endforeach
        </ul>
    @endunless
    <a href="/posts/create" class="new-post">New Post</a>
 </div>
</x-layout>