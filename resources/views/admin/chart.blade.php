<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Visitor Graph') }}
        </h2>
        @section('title', 'Report')
    </x-slot>

    <div class="py-12 sm:ml-64 mt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mb-4">
                    <div id="chartNavigation" class="mb-4"></div>
                    <form action="{{ route('admin.visitor.graph') }}" method="GET" class="flex items-center">
                        <label for="year" class="mr-2">Select Year:</label>
                        <select name="year" id="year" class="form-select rounded-md shadow-sm"
                            onchange="this.form.submit()">
                            @foreach ($years as $yearOption)
                                <option value="{{ $yearOption }}" {{ $year == $yearOption ? 'selected' : '' }} class="form-select rounded-md shadow-sm">
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
        // Global variables to store chart instances and current view state
        let currentChart, currentYear, currentMonth, currentDay;
        const chartColors = {
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
        };

        // Function to show loading indicator
        function showLoading() {
            const canvas = document.getElementById('visitorChart');
            canvas.style.opacity = '0.5';
            // Add a loading spinner here if desired
        }

        // Function to hide loading indicator
        function hideLoading() {
            const canvas = document.getElementById('visitorChart');
            canvas.style.opacity = '1';
            // Remove loading spinner here if added
        }

        // Function to create chart configuration
        function createChartConfig(labels, data, title, xAxisLabel, onClick = null) {
            return {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Number of Visitors',
                        data: data,
                        backgroundColor: chartColors.backgroundColor,
                        borderColor: chartColors.borderColor,
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
                                text: xAxisLabel
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: title
                        }
                    },
                    onClick: onClick
                }
            };
        }

        // Function to create or update chart
        function createOrUpdateChart(labels, data, title, xAxisLabel, onClick = null) {
            const ctx = document.getElementById('visitorChart').getContext('2d');
            if (currentChart) {
                currentChart.destroy();
            }
            currentChart = new Chart(ctx, createChartConfig(labels, data, title, xAxisLabel, onClick));
        }

        // Function to create the initial year chart
        function createYearChart(labels, data, year) {
            currentYear = year;
            currentMonth = null;
            currentDay = null;
            createOrUpdateChart(
                labels,
                data,
                `Visitor Count for Year ${year}`,
                'Month',
                (event, elements) => {
                    if (elements.length > 0) {
                        const clickedMonth = elements[0].index + 1;
                        fetchMonthData(year, clickedMonth);
                    }
                }
            );
            updateNavigation();
        }

        // Function to fetch and display month data
        function fetchMonthData(year, month) {
            showLoading();
            fetch(`/admin/visitor-graph/${year}/${month}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    displayMonthChart(data.labels, data.data, year, month);
                })
                .catch(error => {
                    console.error('Error fetching month data:', error);
                    alert('Failed to fetch month data. Please try again.');
                })
                .finally(hideLoading);
        }

        // Function to display month chart
        function displayMonthChart(labels, data, year, month) {
            currentYear = year;
            currentMonth = month;
            currentDay = null;
            createOrUpdateChart(
                labels,
                data,
                `Visitor Count for ${getMonthName(month)} ${year}`,
                'Day',
                (event, elements) => {
                    if (elements.length > 0) {
                        const clickedDay = elements[0].index + 1;
                        fetchDayData(year, month, clickedDay);
                    }
                }
            );
            updateNavigation();
        }

        // Function to fetch and display day data
        function fetchDayData(year, month, day) {
            showLoading();
            fetch(`/admin/visitor-graph/${year}/${month}/${day}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    displayDayChart(data.labels, data.data, year, month, day);
                })
                .catch(error => {
                    console.error('Error fetching day data:', error);
                    alert('Failed to fetch day data. Please try again.');
                })
                .finally(hideLoading);
        }

        // Function to display day chart
        function displayDayChart(labels, data, year, month, day) {
            currentYear = year;
            currentMonth = month;
            currentDay = day;
            createOrUpdateChart(
                labels,
                data,
                `Visitor Count for ${getMonthName(month)} ${day}, ${year}`,
                'Hour'
            );
            updateNavigation();
        }

        // Helper function to get month name
        function getMonthName(month) {
            const monthNames = ["January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];
            return monthNames[month - 1];
        }

        // Function to update navigation buttons
        function updateNavigation() {
            const navContainer = document.getElementById('chartNavigation');
            navContainer.innerHTML = '';

            if (currentMonth) {
                const backButton = document.createElement('button');
                backButton.textContent = 'Back to Year View';
                backButton.onclick = () => createYearChart(yearLabels, yearData, currentYear);
                navContainer.appendChild(backButton);
            }

            if (currentDay) {
                const backButton = document.createElement('button');
                backButton.textContent = '| Back to Month View (Year: ' + currentYear + ')';
                backButton.onclick = () => fetchMonthData(currentYear, currentMonth);
                navContainer.appendChild(backButton);
            }
        }

        // Initialize the year chart when the page loads
        let yearLabels, yearData;
        document.addEventListener('DOMContentLoaded', () => {
            yearLabels = @json($labels);
            yearData = @json($data);
            const year = @json($year);
            createYearChart(yearLabels, yearData, year);
        });
    </script>
</x-app-layout>
