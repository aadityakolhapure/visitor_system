<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New User') }}
        </h2> --}}
    </x-slot>

    <div class="container mx-auto sm:ml-64 p-6 mt-16">
        {{-- Success message --}}
        @if (session('success'))
            <div class="bg-green-200 text-white p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Add New User Form --}}
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4 text-green-600">Add New User</h2>
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                
                {{-- Name field --}}
                <div class="mb-4">
                    <label for="name" class="block text-green-700 text-sm font-bold mb-2">Name</label>
                    <input type="text" name="name" id="name" class="shadow appearance-none border border-green-400 rounded w-full py-2 px-3 text-green-900 leading-tight focus:outline-none focus:shadow-outline focus:border-green-600" placeholder="Enter user name" required>
                </div>

                {{-- Email field --}}
                <div class="mb-4">
                    <label for="email" class="block text-green-700 text-sm font-bold mb-2">Email</label>
                    <input type="email" name="email" id="email" class="shadow appearance-none border border-green-400 rounded w-full py-2 px-3 text-green-900 leading-tight focus:outline-none focus:shadow-outline focus:border-green-600" placeholder="Enter user email" required>
                </div>

                {{-- Department field (Dropdown) --}}
                <div class="mb-4">
                    <label for="department_id" class="block text-green-700 text-sm font-bold mb-2">Section</label>
                    <select name="department_id" id="department_id" class="shadow appearance-none border border-green-400 rounded w-full py-2 px-3 text-green-900 leading-tight focus:outline-none focus:shadow-outline focus:border-green-600" required>
                        <option value="">Select a Section</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Password field --}}
                <div class="mb-4">
                    <label for="password" class="block text-green-700 text-sm font-bold mb-2">Password</label>
                    <input type="password" name="password" id="password" class="shadow appearance-none border border-green-400 rounded w-full py-2 px-3 text-green-900 leading-tight focus:outline-none focus:shadow-outline focus:border-green-600" placeholder="Enter user password" required>
                </div>

                {{-- Password confirmation --}}
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-green-700 text-sm font-bold mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="shadow appearance-none border border-green-400 rounded w-full py-2 px-3 text-green-900 leading-tight focus:outline-none focus:shadow-outline focus:border-green-600" placeholder="Confirm user password" required>
                </div>

                {{-- Submit button --}}
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Add User
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
