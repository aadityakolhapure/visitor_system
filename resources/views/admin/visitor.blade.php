<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
    </x-slot>

    <div class="container mx-auto sm:ml-64 p-6 mt-16">
        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-200 text-white p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Page Title and Search Form -->
        <div class="flex justify-between items-center mb-6 mt-8 p-4">
            <h2 class="text-2xl font-bold">Visitor List</h2>
            
            <!-- Search Form -->
            <form action="{{ route('show.visitors1') }}" method="GET" class="flex items-center">
                <input type="text" name="search" placeholder="Search users..." class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ request('search') }}">
                <button type="submit" class="ml-4 px-4 py-2 bg-gray-800 text-white rounded-md">Search</button>
            </form>

            <!-- Download CSV Button -->
            <a href="{{ route('admin.visitors.export') }}" class="bg-green-500 hover:bg-green-400 text-white px-4 py-2 rounded-lg ml-4">
                Download CSV
            </a>
        </div>

        <!-- Visitor Table -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg ">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr class="bg-gray-300">
                        <th class="py-2 px-4 text-left font-semibold text-gray-700">Unique ID</th>
                        <th class="py-2 px-4 text-left font-semibold text-gray-700">Name</th>
                        <th class="py-2 px-4 text-left font-semibold text-gray-700">Phone</th>
                        <th class="py-2 px-4 text-left font-semibold text-gray-700">Check In</th>
                        <th class="py-2 px-4 text-left font-semibold text-gray-700">Check Out</th>
                        <th class="py-2 px-4 text-left font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($visitors as $visitor)
                        <tr class="border-b border-gray-200 hover:bg-gray-100 transition duration-200">
                            <td class="px-4 py-2">{{ $visitor->unique_id }}</td>
                            <td class="px-4 py-2">{{ $visitor->name }}</td>
                            <td class="px-4 py-2">{{ $visitor->phone ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $visitor->check_in }}</td>
                            <td class="px-4 py-2">{{ $visitor->check_out ?? 'Not checked out' }}</td>
                            <td class="px-4 py-2 flex space-x-2">
                                <!-- Details Button -->
                                <a href="{{ route('admin.visitor.show', $visitor->unique_id) }}" 
                                    class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg shadow-lg transition duration-300 ease-in-out">
                                    Details
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $visitors->links() }}
        </div>
    </div>

    <script>
        // Modal handling or any additional JavaScript functionality
    </script>
</x-app-layout>
