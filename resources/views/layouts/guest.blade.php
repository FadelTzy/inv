<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Fortuna') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        
        <script src="{{asset('build/assets/app.a1dd5ee6.js')}}"></script>
        <link rel="stylesheet" href="{{asset('build/assets/app.91652374.css')}}">

        {{-- @vite(['public/build/assets/app.974a9ebd.css', 'public/build/assets/app.a1dd5ee6.js']) --}}
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
