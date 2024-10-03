<x-app-layout>
    <x-slot name="header">
        {{-- Removed header text for a cleaner look --}}
    </x-slot>

    <div class="container mx-auto sm:ml-64 p-6 mt-16">
        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Page Title and Actions -->
        <div class="flex justify-between items-center mb-8 mt-8 p-4 bg-white shadow-md rounded-lg">
            <h2 class="text-2xl font-bold text-green-700">Visitor List</h2>

            <!-- Download CSV Button -->
            <a href="{{ route('admin.visitors.export') }}" class="bg-green-600 hover:bg-green-500 text-white px-4 py-2 rounded-lg shadow-md transition duration-300">
                Download CSV
            </a>
        </div>

        <!-- Search Bar -->
        <div class="mb-4">
            <input type="text" id="searchInput" placeholder="Search visitors..." class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>

        <!-- Visitor Table -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
            <table id="visitorTable" class="min-w-full table-auto leading-normal text-left">
                <thead>
                    <tr class="bg-green-100 text-green-900">
                        <th class="py-2 px-4 font-semibold">Unique ID</th>
                        <th class="py-2 px-4 font-semibold">Name</th>
                        <th class="py-2 px-4 font-semibold">Phone</th>
                        <th class="py-2 px-4 font-semibold">Check In</th>
                        <th class="py-2 px-4 font-semibold">Check Out</th>
                        <th class="py-2 px-4 font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($visitors as $visitor)
                        <tr class="border-b border-gray-200 hover:bg-green-50 transition duration-200">
                            <td class="px-4 py-2">{{ $visitor->unique_id }}</td>
                            <td class="px-4 py-2">{{ $visitor->name }}</td>
                            <td class="px-4 py-2">{{ $visitor->phone ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $visitor->check_in }}</td>
                            <td class="px-4 py-2">{{ $visitor->check_out ?? 'Not checked out' }}</td>
                            <td class="px-4 py-2 flex space-x-2">
                                <!-- Details Button -->
                                <a href="{{ route('admin.visitor.show', $visitor->unique_id) }}"
                                    class="bg-green-600 hover:bg-green-500 text-white px-4 py-2 rounded-lg shadow-md transition duration-300">
                                    Details
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-end">
            {{ $visitors->links('pagination::tailwind') }}
        </div>
    </div>

    <script>
        // Search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const table = document.getElementById('visitorTable');
            const rows = table.getElementsByTagName('tr');

            searchInput.addEventListener('keyup', function() {
                const searchTerm = searchInput.value.toLowerCase();

                for (let i = 1; i < rows.length; i++) {
                    let found = false;
                    const cells = rows[i].getElementsByTagName('td');

                    for (let j = 0; j < cells.length; j++) {
                        const cellText = cells[j].textContent.toLowerCase();

                        if (cellText.includes(searchTerm)) {
                            found = true;
                            break;
                        }
                    }

                    rows[i].style.display = found ? '' : 'none';
                }
            });
        });
    </script>
</x-app-layout>

<!-- Additional CSS for Design -->
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        padding: 0.75rem;
    }

    th {
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.05rem;
    }

    td {
        font-size: 0.95rem;
    }

    tr:hover {
        background-color: #f0f9f4; /* Light green hover effect */
    }

    .shadow-md {
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    /* Button Transition */
    a {
        transition: transform 0.3s ease;
    }

    a:hover {
        transform: translateY(-2px);
    }
</style>