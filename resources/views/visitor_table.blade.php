<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
    </x-slot>


    <div class="container mx-auto sm:ml-64 p-6 mt-16">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold mb-4">Visitor List</h2>
            <a href="{{ route('visitors.export') }}"
                class="bg-green-500 hover:bg-green-400 text-white px-4 py-2 rounded-lg m-3">
                Download CSV
            </a>
        </div>
        <form method="GET" action="{{ route('visitors') }}" class="mb-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Visitors..." 
                   class="p-2 border border-gray-300 rounded-lg">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 ml-2">
                Search
            </button>
        </form>
        
        



        <table class="min-w-full bg-white  leading-normal" style="border: 2px; border-radius:5px">
            <thead>
                <tr class="bg-gray-300" style="border: 2px; border-radius:5px">
                    <th class="py-2">Unique ID</th>
                    <th class="py-2">Name</th>
                    <th class="py-2">Phone</th>
                    <th class="py-2">Check In</th>
                    <th class="py-2">Check Out</th>
                    <th class="py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($visitors as $visitor)
                    <tr class="border-b">
                        <td class="px-6 py-4">{{ $visitor->unique_id }}</td>
                        <td class="px-6 py-4">{{ $visitor->name }}</td>
                        <td class="px-6 py-4">{{ $visitor->phone ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $visitor->check_in }}</td>
                        <td class="px-6 py-4">{{ $visitor->check_out ?? 'Not checked out' }}</td>
                        <td class="px-6 py-4 flex space-x-2">
                            <!-- Details Button -->
                            <a href="{{ route('visitor.show', $visitor->unique_id) }}"
                                class="bg-blue-700 hover:bg-blue-500 text-white px-4 py-2 rounded-lg transition duration-300 ease-in-out shadow-lg">
                                Details
                            </a>

                            <!-- Check Out Button -->
                            @if (is_null($visitor->check_out))
                                <form method="POST" action="{{ route('visitor.checkout', $visitor->id) }}">
                                    @csrf
                                    <button type="submit"
                                        class="bg-green-500 hover:bg-green-400 text-white px-4 py-2 rounded-lg transition duration-300 ease-in-out shadow-lg">
                                        Check Out
                                    </button>
                                </form>
                            @else
                            @endif
                        </td>


                    </tr>
                @endforeach
            </tbody>
        </table>
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
