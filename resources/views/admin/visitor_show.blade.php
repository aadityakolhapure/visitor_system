<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
    </x-slot>

    <!-- Container for Visitor Details -->
    <div class="container sm:ml-64 p-6 mt-16">
        <div class="container mx-auto m-6">
            <!-- Page Title -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-green-800">Visitor Details</h2>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="md:flex md:items-start space-y-4 md:space-y-0 md:space-x-6">
                    <!-- Visitor Photo -->
                    <div class="md:w-1/3 w-full">
                        <img src="{{ asset('storage/' . $visitor->photo) }}" alt="{{ $visitor->name }}" class="w-full h-auto rounded-lg shadow-md">
                    </div>
            
                    <!-- Visitor Information -->
                    <div class="md:w-2/3 w-full">
                        <p class="mb-2 text-gray-700"><strong>Name:</strong> {{ $visitor->name }}</p>
                        <p class="mb-2 text-gray-700"><strong>Phone Number:</strong> {{ $visitor->phone ?? 'N/A' }}</p>
                        <p class="mb-2 text-gray-700"><strong>Check In:</strong> {{ $visitor->check_in }}</p>
                        <p class="mb-2 text-gray-700"><strong>Check Out:</strong> {{ $visitor->check_out ?? 'Not checked out' }}</p>
                        <p class="mb-2 text-gray-700"><strong>Purpose:</strong> {{ $visitor->purpose }}</p>
                        <p class="mb-2 text-gray-700"><strong>Whom to Meet:</strong> {{ $visitor->meet }}</p>
                        <p class="mb-4 text-gray-700"><strong>Unique ID:</strong> {{ $visitor->unique_id }}</p>

                        <!-- Action Buttons -->
                        <div class="flex space-x-4">
                            <!-- Download PDF Button -->
                            <a href="{{ route('visitor.id-card', $visitor->id) }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                                Download PDF
                            </a>

                            <!-- Delete Button with Confirmation -->
                            <form action="{{ route('admin.visitor.destroy', $visitor->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out" 
                                        onclick="return confirm('Are you sure you want to delete this visitor?')">
                                    Delete
                                </button>
                            </form>
                            
                            <!-- Back to Visitors List -->
                            <a href="{{ route('admin.visitors1') }}" class="inline-block bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                                Back to Visitors List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
