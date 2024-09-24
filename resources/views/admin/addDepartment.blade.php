<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
    </x-slot>

    <div class="container sm:ml-64 p-6 mt-16">
        <div class="container mx-auto m-6">
            <!-- Container for Adding Department Form -->
            <div class="max-w-4xl mx-auto mb-8">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Add Section</h2>
                    <form action="{{ route('admin.departments.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="departmentName" class="block text-sm font-medium text-gray-700">Department Name</label>
                            <input type="text" id="departmentName" name="name"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                placeholder="Enter Section name" required>
                        </div>
                        <div>
                            <button type="submit"
                                class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Add Section
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Container for Listing Departments -->
            <div class="max-w-4xl mx-auto">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Section List</h2>
                    <div class="overflow-x-auto">
                        @if($departments->isNotEmpty())
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            ID
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Setion Name
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($departments as $department)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $department->id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $department->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            
                                            <form action="{{ route('admin.departments.destroy', $department->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this department?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-center text-gray-500">No departments found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>