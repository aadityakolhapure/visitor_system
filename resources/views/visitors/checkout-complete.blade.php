<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-out Complete</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl p-8">
        <h2 class="text-2xl font-bold mb-6">Check-out Complete</h2>
        <div class="mb-4">
            <p><strong>Name:</strong> {{ $visitor->name }}</p>
            <p><strong>Unique ID:</strong> {{ $visitor->unique_id }}</p>
            <p><strong>Check-in Time:</strong> {{ $visitor->check_in->format('Y-m-d H:i:s') }}</p>
            <p><strong>Check-out Time:</strong> {{ $visitor->check_out->format('Y-m-d H:i:s') }}</p>
            <p><strong>Duration:</strong> {{ $visitor->check_in->diffForHumans($visitor->check_out, true) }}</p>
        </div>
        <div class="flex justify-center">
            <a href="{{ route('visitor.checkout.form') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Back to Check-out
            </a>
        </div>
    </div>
</body>
</html>