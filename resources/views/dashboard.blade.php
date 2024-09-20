<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
    </x-slot>

    <div class="py-12">
      


  
  <div class=" sm:ml-64">
   
    <div class="p-4 mt-8">
        <div class="flex items-center p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
              <span class="font-medium">Welcome!</span> {{ Auth::user()->name }}
            </div>
        </div>

        <div class="w-full mx-auto bg-white rounded-xl shadow-md overflow-hidden p-8 m-4">
            <h2 class="text-2xl font-bold mb-6">Visitor Check-out</h2>
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <form method="POST" action="{{ route('visitors.checkout') }}">
                @csrf
                <div class="mb-4">
                    <label for="unique_id" class="block text-gray-700 text-sm font-bold mb-2">Unique ID:</label>
                    <input type="text" id="unique_id" name="unique_id" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Check-out
                    </button>
                   
                </div>
            </form>
        </div>

        
        <!-- Visitors Table -->
        <div class="flex items-center justify-center mb-4 rounded bg-gray-50 dark:bg-gray-800">
            <div class="w-full p-4">
                <div class="flex flex-row justify-between">
                    <div><h2 class="text-xl font-bold mb-4">Recent Visitors</h2></div>
                
                    <div class="flex justify-end mb-4 text-xl">
                        <input type="text" id="search" placeholder="Search Visitors..." class="p-2 border border-gray-500 rounded-lg " oninput="searchTable()">
                    </div>
                </div>
                
                <div class="w-full overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">ID</th>
                                <th scope="col" class="px-6 py-3">Name</th>
                                <th scope="col" class="px-6 py-3">Phone</th>
                                <th scope="col" class="px-6 py-3">Check In</th>
                                <th scope="col" class="px-6 py-3">Check Out</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($visitors as $visitor)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">{{ $visitor->unique_id }}</td>
                                    <td class="px-6 py-4">{{ $visitor->name }}</td>
                                    <td class="px-6 py-4">{{ $visitor->phone ?? 'N/A' }}</td>
                                    {{-- <td class="px-6 py-4">{{ $visitor->purpose }}</td>
                                    <td class="px-6 py-4">{{ $visitor->meet }}</td> --}}
                                    <td class="px-6 py-4">{{ $visitor->check_in }}</td>
                                    <td class="px-6 py-4">{{ $visitor->check_out ?? 'Not checked out' }}</td>
                                    <td class="px-6 py-4">   <button onclick="openVisitorDetails('{{ $visitor->unique_id }}', '{{ $visitor->name }}', '{{ $visitor->phone }}', '{{ $visitor->check_in }}', '{{ $visitor->check_out }}', '{{ $visitor->purpose }}', '{{ $visitor->meet }}', '{{ asset('storage/' . $visitor->photo) }}')" 
                                        class="bg-blue-700 hover:bg-blue-500 text-gray-200 p-2 border rounded-ls">
                                    Details
                                </button></td>

                                </tr>
                            @endforeach

                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
       
    </div>
  </div>
</div>

<div id="visitorDetailsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden m-4">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Visitor Details</h3>
            <div class="mt-2 px-7 py-3">
                <!-- Updated img element with the correct ID -->
                <img id="visitorImage" src="" alt="Visitor Photo" class="w-full h-auto mb-4 rounded-md">
                <p class="text-sm text-gray-500 item-start">
                    <strong>ID:</strong> <span id="visitorId" class="text-gray-800 text-bold text-lg"></span><br>
                    <strong>Name:</strong> <span id="visitorName"></span><br>
                    
                    <strong>Phone:</strong> <span id="visitorPhone"></span><br>
                    <strong>Check In:</strong> <span id="visitorCheckIn"></span><br>
                    <strong>Check Out:</strong> <span id="visitorCheckOut"></span><br>
                    <strong>Purpose:</strong> <span id="visitorPurpose"></span><br>
                    <strong>Meeting With:</strong> <span id="visitorMeet"></span><br>
                </p>
            </div>
            <div class="items-center px-4 py-3">
                <button onclick="closeModal()" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-700">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>



<script>
function openVisitorDetails(uniqueId, name, phone, checkIn, checkOut, purpose, meet, photoUrl) {
    // Set the visitor details in the modal
    document.getElementById('visitorId').textContent = uniqueId;
    document.getElementById('visitorName').textContent = name;
    document.getElementById('visitorPhone').textContent = phone || 'N/A';
    document.getElementById('visitorCheckIn').textContent = checkIn || 'Not available';
    document.getElementById('visitorCheckOut').textContent = checkOut || 'Not checked out';
    document.getElementById('visitorPurpose').textContent = purpose || 'N/A';
    document.getElementById('visitorMeet').textContent = meet || 'N/A';
    
    // Set the visitor image in the modal
    document.getElementById('visitorImage').src = photoUrl;

    // Show the modal by removing the 'hidden' class
    document.getElementById('visitorDetailsModal').classList.remove('hidden');
}

function closeModal() {
    // Hide the modal by adding the 'hidden' class
    document.getElementById('visitorDetailsModal').classList.add('hidden');
}


</script>


  
</x-app-layout>
