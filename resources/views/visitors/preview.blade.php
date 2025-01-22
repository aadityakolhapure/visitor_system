<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/deskapp-logo-svg.png') }}">
    <title>Visitor Preview</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom animation for the container */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Button hover effects */
        .btn {
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .btn:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-lg overflow-hidden md:max-w-2xl p-8 fade-in">
        <h2 class="text-3xl font-bold mb-6 text-center text-gray-700">Visitor Details</h2>
        <div class="mb-6">
            <img src="{{ asset('storage/' . $visitor->photo) }}" alt="{{ $visitor->name }}" class="w-full h-auto rounded-lg shadow-md mb-4">
        </div>
        <div class="space-y-2">
            <p class="text-lg"><strong>Name:</strong> <span class="text-gray-600">{{ $visitor->name }}</span></p>
            <p class="text-lg"><strong>Member Count:</strong> <span class="text-gray-600">{{ $visitor->member_count }}</span></p>
            <p class="text-lg"><strong>Phone Number:</strong> <span class="text-gray-600">{{ $visitor->phone }}</span></p>
            <p class="text-lg"><strong>Whom to Meet:</strong> <span class="text-gray-600">{{ $visitor->meetUser ? $visitor->meetUser->name : 'N/A' }}</span></p>
            <p class="text-lg"><strong>Purpose:</strong> <span class="text-gray-600">{{ $visitor->purpose }}</span></p>
            <p class="text-lg"><strong>Unique ID:</strong> <span class="text-gray-600">{{ $visitor->unique_id }}</span></p>
        </div>

        @if($visitor->member_count > 0)
            <div class="mt-6">
                <h3 class="text-xl font-bold mb-2 text-gray-700">Additional Members</h3>
                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Member</th>
                            <th class="py-2 px-4 border-b">Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($visitor->member1)
                            <tr>
                                <td class="py-2 px-4 border-b">Member 1</td>
                                <td class="py-2 px-4 border-b">{{ $visitor->member1 }}</td>
                            </tr>
                        @endif
                        @if($visitor->member2)
                            <tr>
                                <td class="py-2 px-4 border-b">Member 2</td>
                                <td class="py-2 px-4 border-b">{{ $visitor->member2 }}</td>
                            </tr>
                        @endif
                        @if($visitor->member3)
                            <tr>
                                <td class="py-2 px-4 border-b">Member 3</td>
                                <td class="py-2 px-4 border-b">{{ $visitor->member3 }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        @endif

        <div class="flex justify-between mt-6">
            <a href="{{ route('visitor.id-card', $visitor->id) }}" class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                Download PDF
            </a>
            <button onclick="window.print()" class="btn bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow">
                Print
            </button>
        </div>
    </div>
</body>
</html>
