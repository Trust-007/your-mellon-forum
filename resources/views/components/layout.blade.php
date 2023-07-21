<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href={{ URL::asset('css/style.css'); }}  rel="stylesheet" type="text/css"/>
    <title>Your Mellon Forum</title>
</head>
<body>
    <header>
        <nav>
            <h3><a href="/">Your Mellon Forum</a></h3>
            @auth()
               <div class="logged-in">
                <h4>Welcome {{auth()->user()->name}}</h4>
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="auth-btn">Logout</button>
                </form>
               </div>
            @else  
                <ul class="authenticate">
                    <li class="auth-btn"><a href="/register">Sign Up</a></li>
                    <li class="auth-btn"><a href="/login">Login</a></li>
                </ul>
            @endauth
        </nav>
    </header>
    <main>{{$slot}}</main>
    <x-flash-message />
</body>
</html>