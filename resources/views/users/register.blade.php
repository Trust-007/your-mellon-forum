<x-layout>
    <div class="form-page">
        <h1>Sign Up</h1>
        <form method="POST" action="/users" class="form-container">
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
        <button type="submit">Sign up</button>
        </form>
        <p class="signup-login">Already have an account? <a href="/login">Login</a></p>
    </div>
  </x-layout>