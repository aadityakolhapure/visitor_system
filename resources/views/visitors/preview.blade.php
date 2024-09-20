<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Preview</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl p-8">
        <h2 class="text-2xl font-bold mb-6">Visitor Details</h2>
        <div class="mb-4">
            <img src="{{ asset('storage/' . $visitor->photo) }}" alt="{{ $visitor->name }}" class="w-full h-auto mb-4">
            <p><strong>Name:</strong> {{ $visitor->name }}</p>
            <p><strong>Email:</strong> {{ $visitor->email }}</p>
            <p><strong>Purpose:</strong> {{ $visitor->purpose }}</p>
            <p><strong>Unique ID:</strong> {{ $visitor->unique_id }}</p>
        </div>
        <div class="flex justify-between">
            <a href="{{ route('visitor.download', $visitor->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Download PDF
            </a>
            <button onclick="window.print()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Print
            </button>
        </div>
    </div>
</body>
</html>