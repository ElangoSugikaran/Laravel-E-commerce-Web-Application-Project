<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Custom CSS for background animation -->
        <style>

            h2 {
                text-align: center;   /* Center the text */
                font-size: 36px;      /* Increase the font size */
                font-weight: 700;     /* Increase the font weight */
                margin-top: 20px;     /* Optional: Add some margin at the top */
                color: #333;          /* Optional: Change text color */
            }

            /* Set the background container */
            .animated-bg {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(45deg, rgb(57, 57, 170), transparent);
                z-index: -1;
                overflow: hidden;
            }

            /* Animation */
            .animated-bg:before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: radial-gradient(circle, rgba(255,255,255,0.3) 15%, transparent 20%), 
                            radial-gradient(circle, rgba(255,255,255,0.1) 15%, transparent 20%);
                background-size: 200px 200px;
                background-position: 0 0, 100px 100px;
                animation: move-bg 15s linear infinite;
            }

            @keyframes move-bg {
                0% {
                    background-position: 0 0, 100px 100px;
                }
                100% {
                    background-position: 100px 100px, 0 0;
                }
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
    <!-- Animated background container -->
     <div class="animated-bg">

        <!-- Form container -->
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-transparent relative">
            <div>
                <h2>@yield('title')</h2>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>

    </div>
    </body>
</html>

