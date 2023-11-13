<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
        <title>Document</title>
        @vite('resources/css/app.css')
        @stack('styles')
        @stack('head-scripts')
    </head>

    <body>
        <header>
            @include('layouts.navbar')
        </header>
        @yield('body')

        @vite('resources/js/app.js')

        @include('layouts.footer')

        @stack('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.js" integrity="sha512-MiIhpeQSr5AO2P1c/3vME/XhtuoDMIH/qtCHusokwCgsjVLzSKaNiNYEeDM1PhFpi6HLuocZmaZ21R0MS+rEyw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </body>

</html>
