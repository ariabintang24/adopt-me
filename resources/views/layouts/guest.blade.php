<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Adopt Me</title>

    <link rel="icon" href="{{ asset('logo-adoptme.png') }}">

    <!-- Poppins Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100 antialiased">

    <div class="min-h-screen flex items-center justify-center px-6">

        <div class="w-full max-w-2xl bg-white shadow-lg rounded-xl p-10">

            {{ $slot }}

        </div>

    </div>

</body>

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
</style>

</html>
