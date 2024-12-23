<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Talent Professional Program</title>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #4267B2;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .title {
            font-size: 6rem;
            font-weight: 700;
            margin-bottom: 2rem;
            color: #fff;
        }

        .links>a {
            text-decoration: none;
            color: #fff;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-transform: uppercase;
            background-color: #4267B2;
            border-radius: 5px;
            padding: 10px 20px;
            margin: 10px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 150ms ease-in-out;
        }

        .links>a:hover {
            background-color: #365492;
            transform: translateY(-2px);
            box-shadow: 0 7px 10px -1px rgba(0, 0, 0, 0.1), 0 3px 6px -1px rgba(0, 0, 0, 0.06);
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="title">Talent Professional Program</h1>

        <div class="links">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/home') }}" class="btn btn-primary">Home</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</body>

</html>
