@extends('layouts.app') <!-- Assuming you're using a layout file -->

@section('content')
<section class="flex items-center justify-center flex-1" style="background: linear-gradient(135deg, rgba(134, 0, 140, 0.5), rgba(0, 0, 118, 1));">
    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
        <!-- Main Heading -->
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
            Visitor Registration System
        </h1>
        <!-- Subheading -->
        <p class="mb-8 text-lg font-normal text-gray-200 lg:text-xl sm:px-16 lg:px-48">
            Welcome to our Visitor Management System. Please enter your details to register your visit and ensure secure access.
        </p>

        <!-- Form or CTA for visitors -->
        <form action="{{ route('visitor.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <input type="text" name="name" placeholder="Enter your name" class="px-4 py-2 rounded-md w-full" required>
            </div>
            <div>
                <input type="email" name="email" placeholder="Enter your email" class="px-4 py-2 rounded-md w-full" required>
            </div>
            <div>
                <textarea name="purpose" rows="4" placeholder="Purpose of visit" class="px-4 py-2 rounded-md w-full" required></textarea>
            </div>
            <div>
                <button type="submit" class="rounded-md bg-teal-500 px-5 py-3 text-white font-medium transition hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-400 dark:focus:ring-teal-700">
                    Register Visit
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
