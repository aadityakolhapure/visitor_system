<div class="flex items-center justify-center mb-4 rounded bg-gray-50 dark:bg-gray-800">
    <div class="w-full p-4">
        <h2 class="text-xl font-bold mb-4">Recent Visitors</h2>
        <div class="w-full overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Phone</th>
                        <th scope="col" class="px-6 py-3">Purpose</th>
                        <th scope="col" class="px-6 py-3">Meet</th>
                        <th scope="col" class="px-6 py-3">Check In</th>
                        <th scope="col" class="px-6 py-3">Check Out</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($visitors as $visitor)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">{{ $visitor->unique_id }}</td>
                            <td class="px-6 py-4">{{ $visitor->name }}</td>
                            <td class="px-6 py-4">{{ $visitor->phone ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ $visitor->purpose }}</td>
                            <td class="px-6 py-4">{{ $visitor->meet }}</td>
                            <td class="px-6 py-4">{{ $visitor->check_in }}</td>
                            <td class="px-6 py-4">{{ $visitor->check_out ?? 'Not checked out' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
