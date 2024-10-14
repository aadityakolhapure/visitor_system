<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}
    @section('title', 'Admin Dashboard')
    <div class="py-12">


    

        <div class=" sm:ml-64">
            <div class="p-4 mt-8">
                {{-- <div class="flex items-center p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">Welcome!</span> {{ Auth::user()->name }}
                    </div>
                </div> --}}

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <!-- Visitor Chart -->
                    <div class="col-span-2 bg-white p-6 rounded-lg shadow-lg border border-gray-200 transform transition-transform duration-300 ease-in-out hover:scale-105 animate-fadeIn">
                        <h2 class="text-lg font-semibold mb-4 text-green-700">Visitor Statistics</h2>
                        <div class="relative bg-gradient-to-r p-4 rounded-lg shadow-inner">
                            {{-- <div class="absolute inset-0 flex items-center justify-center">
                                <span class="text-gray-400 text-sm animate-pulse">Loading chart...</span>
                            </div> --}}
                            <canvas id="visitorChart" class="block w-full h-64"></canvas>
                        </div>
                    </div>
                
                    <!-- Quick Stats -->
                    <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200 transform transition-transform duration-300 ease-in-out hover:scale-105 animate-fadeIn delay-200">
                        <h2 class="text-lg font-semibold mb-4 text-green-700">Quick Stats</h2>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-2">
                                    <span class="text-green-600">
                                        <!-- Optional Icon -->
                                    </span>
                                    <span class="text-sm text-gray-600">Total Visitors:</span>
                                </div>
                                <span class="font-bold text-green-600 text-lg animate-pulse" id="totalVisitors">Loading...</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-2">
                                    <span class="text-green-600">
                                        <!-- Optional Icon -->
                                    </span>
                                    <span class="text-sm text-gray-600">This Month:</span>
                                </div>
                                <span class="font-bold text-green-600 text-lg animate-pulse" id="thisMonthVisitors">Loading...</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-2">
                                    <span class="text-green-600">
                                        <!-- Optional Icon -->
                                    </span>
                                    <span class="text-sm text-gray-600">Today:</span>
                                </div>
                                <span class="font-bold text-green-600 text-lg animate-pulse" id="todayVisitors">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Add the following CSS for animations -->
                <style>
                    .animate-fadeIn {
                        opacity: 0;
                        transform: translateY(20px);
                        animation: fadeIn 0.5s forwards ease-out;
                    }
                
                    .animate-fadeIn.delay-200 {
                        animation-delay: 0.2s;
                    }
                
                    @keyframes fadeIn {
                        to {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    }
                
                    .animate-pulse {
                        animation: pulse 1.5s infinite;
                    }
                
                    @keyframes pulse {
                        0% {
                            opacity: 0.5;
                        }
                        50% {
                            opacity: 1;
                        }
                        100% {
                            opacity: 0.5;
                        }
                    }
                </style>
                

                <!-- Visitors Table -->
                <div class="flex items-center justify-center mb-4 rounded bg-gray-50 dark:bg-gray-800 transform transition-transform duration-300 ease-in-out hover:scale-105 animate-fadeIn delay-200">
                    <div class="w-full p-4">
                        <div class="flex flex-row justify-between mb-4">
                            <h2 class="text-xl font-bold text-green-700">Recent Visitors</h2>
                        </div>
                
                        <div class="w-full overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-600 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-green-100 dark:bg-green-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 rounded-tl-lg">ID</th>
                                        <th scope="col" class="px-6 py-3">Name</th>
                                        <th scope="col" class="px-6 py-3">Phone</th>
                                        <th scope="col" class="px-6 py-3">Check In</th>
                                        <th scope="col" class="px-6 py-3">Check Out</th>
                                        <th scope="col" class="px-6 py-3 rounded-tr-lg">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($visitors as $index => $visitor)
                                        @if ($index < 5) <!-- Limit the number of visitors displayed to 5 -->
                                            <tr class="bg-white border-b hover:bg-green-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-green-900">
                                                <td class="px-6 py-4">{{ $visitor->unique_id }}</td>
                                                <td class="px-6 py-4">{{ $visitor->name }}</td>
                                                <td class="px-6 py-4">{{ $visitor->phone ?? 'N/A' }}</td>
                                                <td class="px-6 py-4">{{ $visitor->check_in }}</td>
                                                <td class="px-6 py-4">{{ $visitor->check_out ?? 'Not checked out' }}</td>
                                                <td class="px-6 py-4">
                                                    <button 
                                                        onclick="openVisitorDetails('{{ $visitor->unique_id }}', '{{ $visitor->name }}', '{{ $visitor->phone }}','{{$visitor->member_count}}', '{{ $visitor->check_in }}', '{{ $visitor->check_out }}', '{{ $visitor->purpose }}', '{{ $visitor->meetUser ? $visitor->meetUser->name : 'N/A' }}', '{{ asset('storage/' . $visitor->photo) }}')"
                                                        class="bg-green-600 hover:bg-green-500 text-white p-2 rounded-lg transition duration-300 ease-in-out">
                                                        Details
                                                    </button>
                                                </td>
                                            

                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- Additional styling for table and green theme -->
                <style>
                    table {
                        border-collapse: separate;
                        border-spacing: 0;
                        border-radius: 0.5rem;
                        overflow: hidden;
                    }
                
                    thead th {
                        text-align: center;
                        padding: 0.75rem;
                        font-weight: bold;
                    }
                
                    tbody tr:hover {
                        background-color: #e6f4ea; /* Light green hover effect */
                    }
                
                    tbody td {
                        text-align: center;
                        padding: 0.75rem;
                    }
                
                    button {
                        outline: none;
                        cursor: pointer;
                    }
                </style>
                

            </div>
        </div>
    </div>

    <div id="visitorDetailsModal"
        class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden m-4">
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
                        <strong>Members Count:</strong> <span id="memberCount"></span><br>
                        <strong>Check In:</strong> <span id="visitorCheckIn"></span><br>
                        <strong>Check Out:</strong> <span id="visitorCheckOut"></span><br>
                        <strong>Purpose:</strong> <span id="visitorPurpose"></span><br>
                        <strong>Meeting With:</strong> <span id="visitorMeet"></span><br>
                    </p>
                </div>
                <div class="items-center px-4 py-3">
                    <button onclick="closeModal()"
                        class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-700">
                        Close
                    </button>
                </div>
            </div>
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/admin/visitor-stats')
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('visitorChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'Number of Visitors',
                                data: data.visitors,
                                borderColor: 'rgb(75, 192, 192)',
                                tension: 0.1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Number of Visitors'
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Month'
                                    }
                                }
                            }
                        }
                    });
                });
        });

        let visitorChart;

        function updateQuickStats() {
            fetch('/admin/quick-stats')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('totalVisitors').textContent = data.totalVisitors;
                    document.getElementById('thisMonthVisitors').textContent = data.thisMonthVisitors;
                    document.getElementById('todayVisitors').textContent = data.todayVisitors;
                });
        }

        function updateChart() {
            // ... (keep existing chart update logic) ...
        }

        function updateDashboard() {
            updateQuickStats();
            updateChart();
        }

        // Initial update
        updateDashboard();

        // Update every 60 seconds
        setInterval(updateDashboard, 60000);
    </script>


    
    <script>
        function openVisitorDetails(uniqueId, name, phone,member_count, checkIn, checkOut, purpose, AdminMeetUser, photoUrl) {
            // Set the visitor details in the modal
            document.getElementById('visitorId').textContent = uniqueId;
            document.getElementById('visitorName').textContent = name;
            document.getElementById('visitorPhone').textContent = phone || 'N/A';
            document.getElementById('memberCount').textContent = member_count || 'N/A';
            document.getElementById('visitorCheckIn').textContent = checkIn || 'Not available';
            document.getElementById('visitorCheckOut').textContent = checkOut || 'Not checked out';
            document.getElementById('visitorPurpose').textContent = purpose || 'N/A';
            document.getElementById('visitorMeet').textContent = AdminMeetUser || 'N/A';

            // Set the visitor image in the modal
            document.getElementById('visitorImage').src = photoUrl;

            // Show the modal by removing the 'hidden' class
            document.getElementById('visitorDetailsModal').classList.remove('hidden');
        }

        function closeModal() {
            // Hide the modal by adding the 'hidden' class
            document.getElementById('visitorDetailsModal').classList.add('hidden');
        }

        // chart


        const options = {
            chart: {
                height: "100%",
                maxWidth: "100%",
                type: "area",
                fontFamily: "Inter, sans-serif",
                dropShadow: {
                    enabled: false,
                },
                toolbar: {
                    show: false,
                },
            },
            tooltip: {
                enabled: true,
                x: {
                    show: false,
                },
            },
            fill: {
                type: "gradient",
                gradient: {
                    opacityFrom: 0.55,
                    opacityTo: 0,
                    shade: "#1C64F2",
                    gradientToColors: ["#1C64F2"],
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                width: 6,
            },
            grid: {
                show: false,
                strokeDashArray: 4,
                padding: {
                    left: 2,
                    right: 2,
                    top: 0
                },
            },
            series: [{
                name: "New users",
                data: [6500, 6418, 6456, 6526, 6356, 6456],
                color: "#1A56DB",
            }, ],
            xaxis: {
                categories: ['01 February', '02 February', '03 February', '04 February', '05 February', '06 February',
                    '07 February'
                ],
                labels: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
            },
            yaxis: {
                show: false,
            },
        }

        if (document.getElementById("area-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("area-chart"), options);
            chart.render();
        }
    </script>



</x-app-layout>
