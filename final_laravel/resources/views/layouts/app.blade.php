<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="LBJ Jewlery Luxury"/>
    <title>LBJ</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="manifest" href="/site.webmanifest">
    @vite('resources/css/app.css')

    <style>
        @import url("https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap");
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');

        body {
            font-family: "DM Sans", sans-serif;
        }
        
        #fontgucci {
            font-family: "Playfair Display", serif;
        }

        .col {
            width: 92.5%;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
   
</head>
<body>
    <x-header />

    @yield('content')

    <x-footer />
    @section('scripts')
    <script src="{{ asset('js/menu.js') }}"></script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-J7QBN2WL4D"></script>
<script>
    // OLD code is: src/scripts/gganalytics.js
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());
    gtag('config', 'G-J7QBN2WL4D');
</script>

<!-- Additional scripts customized for specific screens -->
@yield('script')

</body>
</html>
