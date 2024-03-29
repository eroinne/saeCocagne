<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
        <link rel="icon" type="image/x-icon" href="{{asset('images/jardin.ico')}}">
        <title>Jardin de cocagne</title>
        @vite('resources/css/app.css')
        @stack('styles')
        @stack('head-scripts')
    </head>

    <body class="min-h-full">

        <header>
                @include('layouts.navbar')
        </header>
        @yield('body')

        @vite('resources/js/app.js')

        @include('layouts.footer')

        <style>
            [x-cloak] { display: none !important; }
        </style>

        @stack('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.js" integrity="sha512-MiIhpeQSr5AO2P1c/3vME/XhtuoDMIH/qtCHusokwCgsjVLzSKaNiNYEeDM1PhFpi6HLuocZmaZ21R0MS+rEyw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </body>


</html>
