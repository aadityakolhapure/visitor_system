<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">

    <title>@yield('title', 'Visitor Management')</title>
    <link rel="icon" href="{{ asset('images/deskapp-logo-svg.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>
<body class="bg-gray-100">

    <nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('images/login_logo.png') }}" class="h-10" alt="Logo" style="height: 80px; width: 400px">
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse m-3">
                @if (Route::has('login'))
                    <div class="flex justify-center">
                        @auth
                            <!-- Dashboard Button -->
                            <a href="{{ url('/dashboard') }}"
                                class="rounded-md bg-blue-500 px-5 py-3 text-white font-medium transition hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-700 mr-5">
                                Dashboard
                            </a>
                        @else
                            <!-- Login Button -->
                            <a href="{{ route('login') }}"
                                class="rounded-md bg-blue-800 px-5 py-3 text-white font-medium transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 dark:bg-blue-700 dark:hover:bg-blue-600">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <!-- Register Button -->
                                <a href="{{ route('register') }}"
                                    class="rounded-md bg-blue-500 px-5 py-3 text-white font-medium transition hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-700 ml-5 hide">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <!-- Add your navigation items here -->
                </ul>
            </div>
        </div>
    </nav>

    <section class="flex items-center justify-center flex-1 h-screen" style="background: linear-gradient(135deg, rgba(134, 0, 140, 0.5), rgba(0, 0, 118, 1));">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 animate__animated animate__fadeIn">
            <!-- Main Heading -->
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
                Manage <span class="text-teal-300">Visitor Access</span> Seamlessly
            </h1>
            <!-- Subheading -->
            <p class="mb-8 text-lg font-normal text-gray-200 lg:text-xl sm:px-16 lg:px-48">
                Welcome to our Visitor Management System, designed to efficiently track, register, and monitor visitor activity.
                Our system ensures secure and hassle-free visitor management for your organization.
            </p>

            <!-- Action Buttons -->
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
                <!-- Visitor Button -->
                <a href="{{ url('/visitor') }}"
                    class="rounded-md bg-teal-500 px-5 py-3 text-white font-medium transition hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-400 dark:focus:ring-teal-700 animate__animated animate__pulse animate__delay-1s">
                    Visitor
                </a>
            </div>
        </div>
    </section>

    <footer class="fixed bottom-0 left-0 z-20 w-full p-4 bg-white border-t border-gray-200 shadow md:flex md:items-center md:justify-between md:p-6 dark:bg-gray-800 dark:border-gray-600">
        <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a href="https://flowbite.com/" class="hover:underline">Flowbite™</a>. All Rights Reserved.</span>
        <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
            <li>
                <a href="#" class="hover:underline me-4 md:me-6">About</a>
            </li>
            <li>
                <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
            </li>
            <li>
                <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
            </li>
            <li>
                <a href="#" class="hover:underline">Contact</a>
            </li>
        </ul>
    </footer>
</body>
</html>
