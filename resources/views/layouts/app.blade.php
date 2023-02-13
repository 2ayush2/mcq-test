<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title") | MCQ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href={{ asset('css/app.css') }} />
</head>

<body class="bg-gray-200">
    <nav class="p-6 bg-white flex justify-between mb-6">
        <ul class="flex items-center">
            <li>
                <a href="/" class="p-3">Home</a>
            </li>
            @auth
            <li>
                <a href="{{ route('qbank.list') }}" class="p-3">Question Bank</a>
            </li>
            <li>
                <a href="{{ route('questions.list') }}" class="p-3">Question Sets</a>
            </li>
            @endauth
        </ul>

        <ul class="flex items-center">
            @auth
            <li>
                <a href="" class="p-3">{{ auth()->user()->name }}</a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="post" class="p-3 inline">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
            @endauth

            @guest
            <li>
                <a href="{{ route('login') }}" class="p-3">Login</a>
            </li>
            <li>
                <a href="{{ route('register') }}" class="p-3">Register</a>
            </li>
            @endguest
        </ul>
    </nav>
    <div class="container">
        @yield('content')
    </div>
</body>

</html>