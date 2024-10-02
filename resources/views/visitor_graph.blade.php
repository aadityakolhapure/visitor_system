<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Visitor Graph') }}
        </h2>
    </x-slot>

    <div class="py-12 sm:ml-64 mt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mb-4">
                    <form action="{{ route('visitor.graph') }}" method="GET" class="flex items-center">
                        <label for="year" class="mr-2">Select Year:</label>
                        <select name="year" id="year" class="form-select rounded-md shadow-sm" onchange="this.form.submit()">
                            @foreach($years as $yearOption)
                                <option value="{{ $yearOption }}" {{ $year == $yearOption ? 'selected' : '' }}>
                                    {{ $yearOption }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <canvas id="visitorChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('visitorChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Number of Visitors',
                    data: @json($data),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
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
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Visitor Count for Year ' + @json($year)
                    }
                }
            }
        });
    </script>
</x-app-layout>