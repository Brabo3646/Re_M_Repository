<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $title }}</title>
        <link rel="stylesheet" href='{{ asset("/css/" . "$stylesheet") }}'>
        @isset($stylesheet2)
        <link rel="stylesheet" href='{{ asset("/css/" . "$stylesheet2") }}'>
        @endisset
        <!--Breezeのスクリプトのみ許可-->
        @vite(['resources/js/app.js'])
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    </head>
    <body class>
        <div>
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header>
                    <div>
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
