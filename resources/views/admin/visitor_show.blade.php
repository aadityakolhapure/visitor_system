<x-app-layout>
    <x-slot name="header">
        @section('title', 'Visitor Details')
    </x-slot>

    <!-- Container for Visitor Details -->
    <div class="container sm:ml-64 p-6 mt-16">
        <div class="mx-auto space-y-6">
            <!-- Page Title -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-green-800">Visitor Details</h2>
            </div>

            <!-- Visitor Details Section -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="md:flex md:items-start space-y-6 md:space-y-0 md:space-x-8">
                    <!-- Visitor Photo -->
                    <div class="md:w-1/3 w-full">
                        <img src="{{ asset('storage/' . $visitor->photo) }}" alt="{{ $visitor->name }}" class="w-full h-auto rounded-lg shadow-md object-cover">
                    </div>

                    <!-- Visitor Information -->
                    <div class="md:w-2/3 w-full space-y-4">
                        <div>
                            <h3 class="text-xl font-bold text-green-700">Visitor Information</h3>
                            
                        </div>
                        <div class="space-y-2">
                            <p class="text-gray-700 font-bold"><strong class="text-green-700">ID:</strong> {{ $visitor->unique_id }}</p>
                            <p class="text-gray-700"><strong class="text-green-700">Name:</strong> {{ $visitor->name }}</p>
                            <p class="text-gray-700"><strong class="text-green-700">Phone Number:</strong> {{ $visitor->phone ?? 'N/A' }}</p>
                            <p class="text-gray-700"><strong class="text-green-700">Member Count:</strong> {{ $visitor->member_count ?? 'N/A' }}</p>
                            <p class="text-gray-700"><strong class="text-green-700">Check In:</strong> {{ $visitor->check_in }}</p>
                            <p class="text-gray-700"><strong class="text-green-700">Check Out:</strong> {{ $visitor->check_out ?? 'Not checked out' }}</p>
                            <p class="text-gray-700"><strong class="text-green-700">Purpose:</strong> {{ $visitor->purpose }}</p>
                            <p class="text-gray-700"><strong class="text-green-700">Whom to Meet:</strong> {{ $visitor->meetUser ? $visitor->meetUser->name : 'N/A' }}</p>
                            {{-- <p class="text-gray-700"><strong class="text-green-700">Unique ID:</strong> {{ $visitor->unique_id }}</p> --}}
                        </div>

                        <!-- Additional Members -->
                        @if ($visitor->member_count > 0)
                            <div class="mt-6">
                                <h3 class="text-xl font-bold text-green-700 mb-2">Additional Members</h3>
                                <table class="min-w-full bg-white border border-gray-300 text-center">
                                    <thead>
                                        <tr class="bg-green-100 text-green-900">
                                            <th class="py-2 px-4 border-b">Member</th>
                                            <th class="py-2 px-4 border-b">Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($visitor->member1)
                                            <tr>
                                                <td class="py-2 px-4 border-b">Member 1</td>
                                                <td class="py-2 px-4 border-b">{{ $visitor->member1 }}</td>
                                            </tr>
                                        @endif
                                        @if ($visitor->member2)
                                            <tr>
                                                <td class="py-2 px-4 border-b">Member 2</td>
                                                <td class="py-2 px-4 border-b">{{ $visitor->member2 }}</td>
                                            </tr>
                                        @endif
                                        @if ($visitor->member3)
                                            <tr>
                                                <td class="py-2 px-4 border-b">Member 3</td>
                                                <td class="py-2 px-4 border-b">{{ $visitor->member3 }}</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-3">
                            <!-- Download PDF Button -->
                            <a href="{{ route('visitor.id-card', $visitor->id) }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-md transition duration-300">
                                Download PDF
                            </a>

                            <!-- Delete Button with Confirmation -->
                            <form action="{{ route('admin.visitor.destroy', $visitor->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this visitor?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded shadow-md transition duration-300">
                                    Delete
                                </button>
                            </form>

                            <!-- Back to Visitors List -->
                            <a href="{{ route('admin.visitors1') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded shadow-md transition duration-300">
                                Back to Visitors List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
