<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Visitor Management')</title>
    <link rel="icon" href="{{ asset('images/deskapp-logo-svg.png') }}">
    {{-- @vite(['resources/css/app.css','resources/js/app.js']) --}}

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        #loading-icon {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.998);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid rgb(5, 122, 85);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="font-sans antialiased">

    <div id="loading-icon">
        <div class="spinner"></div>
    </div>

    <div class="min-h-screen bg-gray-100">

        @include('layouts.navigation')

        {{-- <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset --}}

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        @livewireScripts
    </div>

    <script>
        let loadingTimeout;

        window.addEventListener('beforeunload', function() {
            loadingTimeout = setTimeout(function() {
                document.getElementById('loading-icon').style.display = 'flex';
            }, 500); // Wait 300ms before showing the loading icon
        });

        window.addEventListener('load', function() {
            clearTimeout(loadingTimeout);
            document.getElementById('loading-icon').style.display = 'none';
        });
    </script>
</body>

</html>
