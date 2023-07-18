<x-layout>
    <h1>Sign Up</h1>
    <form method="POST" action="/users" class="container">
      @csrf
      <label for="name"> Name</label>
      <input type="text" name="name" value="{{old('name')}}">
      @error('name')
      <p>{{$message}}</p>
      @enderror
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
      <label for="password_confirmation">Password Confirmation</label>
      <input type="password" name="password_confirmation">
      @error('password_confirm')
      <p>{{$message}}</p>
      @enderror
      <br>
      <button type="submit">Register</button>
    </form>
  </x-layout>