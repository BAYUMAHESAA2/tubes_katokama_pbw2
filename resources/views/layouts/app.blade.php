<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body class="d-flex flex-column min-vh-100"> <!-- Tambahkan class Flexbox -->

        <div class="flex-grow-1"> <!-- Div utama untuk konten -->
            @include('layouts.navigation')

            <!-- Page Content -->
            <main class="pt-4">
                {{ $slot }}
            </main>
        </div>

        @include('layouts.footer') <!-- Footer tetap di bawah -->
        
    </body>
</html>
