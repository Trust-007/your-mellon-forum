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
            <h3>Your Mellon Forum</h3>
            <ul class="authenticate">
                <li><a href="">Sign Up</a></li>
                <li><a href="">Login</a></li>
            </ul>
        </nav>
    </header>
    <main>{{$slot}}</main>
</body>
</html>