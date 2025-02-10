<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title', 'Voting')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            background-color: #f0f1f2;
        }
    </style>

</head>

<body>

    <main>
        @yield('content')
    </main>

</body>

</html>
