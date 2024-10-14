<x-app-layout>
    <div class="py-12">
        <div class="sm:ml-64">
            <div class="p-4 mt-8 space-y-6">
                <!-- Welcome Alert -->
                <div class="flex items-center p-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-5 h-5 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <div>
                        <span class="font-medium">Welcome, {{ Auth::user()->name }}!</span>
                    </div>
                </div>

                <!-- Visitor Check-out Form -->
                <div class="w-full mx-auto bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-bold mb-4">Visitor Check-out</h2>
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4"
                            role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('visitors.checkout') }}">
                        @csrf
                        <div class="mb-6">
                            <label for="unique_id" class="block text-gray-700 text-sm font-bold mb-2">Unique ID:</label>
                            <input type="text" id="unique_id" name="unique_id" required
                                class="shadow-sm border border-gray-300 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring focus:border-green-500">
                        </div>
                        <div class="flex items-center justify-end">
                            <button type="submit"
                                class="bg-gradient-to-r from-green-500 to-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 hover:from-green-600 hover:to-green-800 transition-all">
                                Check-out
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Visitors Table -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold">Recent Visitors</h2>
                        {{-- <input type="text" id="search" placeholder="Search Visitors..." class="p-2 border border-gray-400 rounded-lg focus:ring focus:border-green-500" oninput="searchTable()"> --}}
                    </div>
                    <div class="w-full overflow-x-auto">
                        <table
                            class="w-full text-sm text-left text-gray-700 dark:text-gray-300 shadow-lg rounded-lg overflow-hidden">
                            <thead
                                class="text-xs font-semibold text-gray-900 uppercase bg-green-100 dark:bg-gray-700 dark:text-gray-400 sticky top-0 z-10">
                                <tr>
                                    <th scope="col" class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">
                                        ID</th>
                                    <th scope="col" class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">
                                        Name</th>
                                    <th scope="col" class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">
                                        Phone</th>
                                    <th scope="col" class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">
                                        Check In</th>
                                    <th scope="col" class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">
                                        Check Out</th>
                                    <th scope="col" class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">
                                        Whom to meet</th>
                                    <th scope="col" class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">
                                        Action</th>

                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800">
                                @foreach ($visitors as $visitor)
                                    <tr
                                        class="border-b border-gray-200 dark:border-gray-700 hover:bg-green-50 dark:hover:bg-gray-700 transition-all">
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            {{ $visitor->unique_id }}</td>
                                        <td class="px-6 py-4">{{ $visitor->name }}</td>
                                        <td class="px-6 py-4">{{ $visitor->phone ?? 'N/A' }}</td>
                                        <td class="px-6 py-4">{{ $visitor->check_in }}</td>
                                        <td class="px-6 py-4">{{ $visitor->check_out ?? 'Not checked out' }}</td>
                                        <td class="px-6 py-4">{{ $visitor->meetUser ? $visitor->meetUser->name : 'N/A' }}</td>
                                        <td class="px-6 py-4">
                                            <button
                                                onclick="openVisitorDetails('{{ $visitor->unique_id }}', '{{ $visitor->name }}', '{{ $visitor->phone }}', '{{ $visitor->check_in }}', '{{ $visitor->check_out }}', '{{ $visitor->purpose }}', '{{ $visitor->meetUser ? $visitor->meetUser->name : 'N/A' }}', '{{ asset('storage/' . $visitor->photo) }}')"
                                                class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded">
                                                Details
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Visitor Details Modal -->
                <!-- Visitor Details Modal -->
                <div id="visitorDetailsModal"
                    class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
                    <div
                        class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-lg bg-white transform transition-transform scale-95">
                        <div class="text-center">
                            <h3 class="text-lg font-medium text-gray-900">Visitor Details</h3>
                            <div class="mt-2 px-4 py-3">
                                <img id="visitorImage" src="" alt="Visitor Photo"
                                    class="w-full h-auto mb-4 rounded-lg">
                                <p class="text-sm text-gray-500">
                                    <strong>ID:</strong> <span id="visitorId" class="text-gray-800 text-lg"></span><br>
                                    <strong>Name:</strong> <span id="visitorName"></span><br>
                                    <strong>Phone:</strong> <span id="visitorPhone"></span><br>
                                    <strong>Check In:</strong> <span id="visitorCheckIn"></span><br>
                                    <strong>Check Out:</strong> <span id="visitorCheckOut"></span><br>
                                    <strong>Purpose:</strong> <span id="visitorPurpose"></span><br>
                                    <strong>Meeting With:</strong> <span id="visitorMeet"></span><br>
                                </p>
                            </div>
                            <div class="items-center px-4 py-3">
                                <button onclick="closeModal()"
                                    class="px-4 py-2 bg-green-500 text-white font-medium rounded-lg hover:bg-green-700 w-full">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function openVisitorDetails(uniqueId, name, phone, checkIn, checkOut, purpose, meet, photoUrl) {
            document.getElementById('visitorId').textContent = uniqueId;
            document.getElementById('visitorName').textContent = name;
            document.getElementById('visitorPhone').textContent = phone || 'N/A';
            document.getElementById('visitorCheckIn').textContent = checkIn || 'Not available';
            document.getElementById('visitorCheckOut').textContent = checkOut || 'Not checked out';
            document.getElementById('visitorPurpose').textContent = purpose || 'N/A';
            document.getElementById('visitorMeet').textContent = meet || 'N/A';
            document.getElementById('visitorImage').src = photoUrl;
            document.getElementById('visitorDetailsModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('visitorDetailsModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
