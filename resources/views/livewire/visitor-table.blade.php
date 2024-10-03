<div class="overflow-x-auto bg-white rounded-lg shadow-lg">
    <table class="min-w-full table-auto leading-normal text-left">
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
                            class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md transition duration-300">
                            Details
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="py-3 px-4">
        {{ $visitors->links() }}
    </div>
</div>
