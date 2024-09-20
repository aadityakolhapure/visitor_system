<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
    </x-slot>


    <div class="container mx-auto sm:ml-64 p-4 mt-16">
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold mb-4">Visitor Details</h2>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex flex-col md:flex-row items-start md:items-center">
                    <!-- Visitor Photo -->
                    <div class="md:w-1/3 w-full">
                        <img src="{{ asset('storage/' . $visitor->photo) }}" alt="{{ $visitor->name }}" class="w-full h-auto mb-4 md:mb-0 md:mr-4 rounded-lg">
                    </div>
            
                    <!-- Visitor Information -->
                    <div class="md:w-2/3 w-full ml-5">
                        <p><strong>Name:</strong> {{ $visitor->name }}</p>
                        <p><strong>Phone Number:</strong> {{ $visitor->phone ?? 'N/A' }}</p>
                        <p><strong>Check In:</strong> {{ $visitor->check_in }}</p>
                        <p><strong>Check Out:</strong> {{ $visitor->check_out ?? 'Not checked out' }}</p>
                        <p><strong>Purpose:</strong> {{ $visitor->purpose }}</p>
                        <p><strong>Whom to Meet:</strong> {{ $visitor->meet }}</p>
                        <p><strong>Unique ID:</strong> {{ $visitor->unique_id }}</p>
            
                        <!-- Add a back button -->
                        <a href="{{ route('visitor.id-card', $visitor->id) }}" class="inline-block bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded mr-4">
                            Download PDF
                        </a>
                        <a href="{{ route('visitors') }}" class="inline-block mt-4 px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-700">
                            Back to Visitors List
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
