<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
    </x-slot>

    <div class="container mx-auto sm:ml-64 p-6 mt-16">
        @if (session('success'))
            <div class="bg-green-200 text-green-900 p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-4 m-4">
            <h2 class="text-2xl font-bold mb-4 text-green-800">Visitor List</h2>
            <a href="{{ route('visitors.export') }}"
                class="bg-green-600 hover:bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg transition duration-300 ease-in-out">
                Download CSV
            </a>
        </div>
        <div class="w-full overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow-lg overflow-hidden">
                <thead class="bg-green-100">
                    <tr>
                        <th class="py-3 px-6 text-left text-green-800 font-semibold">Unique ID</th>
                        <th class="py-3 px-6 text-left text-green-800 font-semibold">Name</th>
                        <th class="py-3 px-6 text-left text-green-800 font-semibold">Phone</th>
                        <th class="py-3 px-6 text-left text-green-800 font-semibold">Check In</th>
                        <th class="py-3 px-6 text-left text-green-800 font-semibold">Check Out</th>
                        <th class="py-3 px-6 text-left text-green-800 font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($visitors as $visitor)
                        <tr class="border-b hover:bg-green-50 transition duration-200 ease-in-out">
                            <td class="px-6 py-4 text-gray-700">{{ $visitor->unique_id }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $visitor->name }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $visitor->phone ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $visitor->check_in }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $visitor->check_out ?? 'Not checked out' }}</td>
                            <td class="px-6 py-4 flex space-x-2">
                                <!-- Details Button -->
                                <a href="{{ route('visitor.show', $visitor->unique_id) }}"
                                    class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg shadow-lg transition duration-300 ease-in-out">
                                    Details
                                </a>

                                <!-- Check Out Button -->
                                {{-- Uncomment the following block if you want to allow check out --}}
                                {{-- @if (is_null($visitor->check_out)) --}}
                                {{-- <form method="POST" action="{{ route('visitor.checkout', $visitor->id) }}">
                                @csrf
                                <button type="submit" class="bg-green-600 hover:bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg transition duration-300 ease-in-out">
                                    Check Out
                                </button>
                            </form>
                        {{-- @else --}}
                                {{-- <button class="bg-gray-300 text-gray-500 px-4 py-2 rounded-lg" disabled>
                                Checked Out
                            </button>
                        {{-- @endif --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <div class="mt-4">
            {{ $visitors->links() }}
        </div>
    </div>

    <script>
        function openVisitorDetails(id, name, phone, checkIn, checkOut, purpose, meet) {
            document.getElementById('visitorId').textContent = id;
            document.getElementById('visitorName').textContent = name;
            document.getElementById('visitorPhone').textContent = phone || 'N/A';
            document.getElementById('visitorCheckIn').textContent = checkIn;
            document.getElementById('visitorCheckOut').textContent = checkOut || 'Not checked out';
            document.getElementById('visitorPurpose').textContent = purpose || 'N/A';
            document.getElementById('visitorMeet').textContent = meet || 'N/A';

            document.getElementById('visitorDetailsModal').style.display = 'block';
        }
    </script>
</x-app-layout>
