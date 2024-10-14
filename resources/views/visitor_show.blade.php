<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
    </x-slot>


    <div class=" sm:ml-64 p-6 mt-16">
        <div class="container mx-auto m-6">
            <h2 class="text-2xl font-bold mb-4">Visitor Details</h2>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex flex-col md:flex-row items-start md:items-center">
                    <!-- Visitor Photo -->
                    <div class="md:w-1/3 w-full">
                        <img src="{{ asset('storage/' . $visitor->photo) }}" alt="{{ $visitor->name }}" class="w-full h-auto mb-4 md:mb-0 md:mr-4 rounded-lg">
                    </div>
            
                    <!-- Visitor Information -->
                    <div class="md:w-2/3 w-full ml-5">
                        {{-- <p><strong>Name:</strong> {{ $visitor->name }}</p>
                        <p><strong>Phone Number:</strong> {{ $visitor->phone ?? 'N/A' }}</p>
                        <p><strong>Check In:</strong> {{ $visitor->check_in }}</p>
                        <p><strong>Check Out:</strong> {{ $visitor->check_out ?? 'Not checked out' }}</p>
                        <p><strong>Purpose:</strong> {{ $visitor->purpose }}</p>
                        <p><strong>Whom to Meet:</strong> {{ $visitor->meet }}</p>
                        <p><strong>Unique ID:</strong> {{ $visitor->unique_id }}</p> --}}

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
            
                        <!-- Add a back button -->
                        <a href="{{ route('visitor.id-card', $visitor->id) }}" class="inline-block bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded mr-4">
                            Download PDF
                        </a>
                        
                        <form action="{{ route('visitor.destroy', $visitor->id) }}" method="POST" class="mt-4 inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 mr-2" 
                                    onclick="return confirm('Are you sure you want to delete this visitor?')">
                                Delete
                            </button>
                        </form>
                        <a href="{{ route('visitors') }}" class="inline-block mt-4 px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-700">
                            Back to Visitors List
                        </a>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
