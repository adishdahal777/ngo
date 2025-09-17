<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NGO Connect</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('styles')
</head>

<body class="antialiased">

    @if (session('error'))
        <div class="p-4 mb-4 text-red-800 bg-red-100 border border-red-400 rounded">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    @yield('scripts')
</body>

</html>
