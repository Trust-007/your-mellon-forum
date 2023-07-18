<x-layout>
    <h1>Login</h1>
    <form method="POST" action="/users/authenticate" class="container">
      @csrf
      <label for="email">Email</label>
      <input type="email" name="email" value="{{old('email')}}">
      @error('email')
      <p>{{$message}}</p>
      @enderror
      <label for="password">Password</label>
      <input type="password" name="password">
      @error('password')
      <p>{{$message}}</p>
      @enderror
      <br>
      <button type="submit">Login</button>
    </form>
  </x-layout>