<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12 sm:ml-64 mt-14">
        <div class="bg-white shadow rounded-lg p-6 w-full max-w-md mx-auto">
            <h2 class="text-xl font-semibold text-green-600 mb-4">User Details</h2>
            
            <div class="text-gray-700 mb-4">
                <p><span class="font-bold">Name:</span> {{ $user->name }}</p>
                <p><span class="font-bold">Email:</span> {{ $user->email }}</p>
                <p><span class="font-bold">Department:</span> {{ $user->department->name ?? 'N/A' }}</p>
            </div>
    
            <!-- Edit button -->
            <div x-data="{ open: false }" @keydown.escape.prevent.stop="open = false" @click.outside="open = false">
                <button type="button" @click="open = ! open" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">
                    Edit User
                </button>
    
                <!-- Edit Modal -->
                <div x-show="open" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        
                        <!-- Background overlay -->
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                        
                        <!-- Modal container -->
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                        
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                
                                <!-- Edit user form -->
                                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                                    @csrf
                                    @method('PUT')
    
                                    <div class="mb-4">
                                        <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                                        <input type="text" name="name" id="name"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                               value="{{ $user->name }}" required>
                                    </div>
    
                                    <div class="mb-4">
                                        <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                                        <input type="email" name="email" id="email"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                               value="{{ $user->email }}" required>
                                    </div>
    
                                    <div class="mb-4">
                                        <label for="department_id" class="block text-gray-700 font-bold mb-2">Department</label>
                                        <select name="department_id" id="department_id"
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                required>
                                            <option value="">Select a Section</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}" {{ $user->department_id == $department->id ? 'selected' : '' }}>
                                                    {{ $department->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
    
                                    {{-- <div class="mb-4">
                                        <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                                        <input type="password" name="password" id="password"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>
    
                                    <div class="mb-4">
                                        <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Confirm Password</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>
     --}}
                                    <div class="flex items-center justify-between">
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                            Update User
                                        </button>
                                        <button type="button" @click="open = false" class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>










