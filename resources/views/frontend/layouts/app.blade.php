<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Adopt Me</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800">

    @include('frontend.components.navbar')

    <main>
        @yield('content')
    </main>

    @include('frontend.components.footer')

</body>

</html>
