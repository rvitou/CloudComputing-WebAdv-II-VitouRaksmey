@extends('layouts.public')

@section('title', 'Global Currency Statistics')

@section('content')
    <div class="container py-5">
        <h1 class="text-center mb-5">Global Currency Statistics</h1>

        <div class="row mb-5">
            <div class="col-md-6">
                <div class="card shadow-sm rounded-lg h-100">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Total Users</h3>
                        <p class="display-4 text-center font-weight-bold">{{ $totalUsers }}</p>
                        <p class="text-center text-muted">Registered users on the platform.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm rounded-lg h-100">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Archive Overview</h3>
                        <div class="row">
                            <div class="col-6 text-center">
                                <p class="display-4 font-weight-bold">{{ $totalCurrencyItems }}</p>
                                <p class="text-muted">Total Notes & Coins</p>
                            </div>
                            <div class="col-6 text-center">
                                <p class="display-4 font-weight-bold">{{ $totalCountriesWithCurrencies }}</p>
                                <p class="text-muted">Countries in Archive</p>
                            </div>
                        </div>
                        <p class="text-center text-muted mt-3">Comprehensive data from our global archive.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-6">
                <div class="card shadow-sm rounded-lg h-100">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">User Gender Distribution</h3>
                        <div class="chart-container">
                            <canvas id="genderChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm rounded-lg h-100">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Top Countries by Users</h3>
                        <div class="chart-container">
                            <canvas id="countryChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-12">
                <div class="card shadow-sm rounded-lg h-100">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">New Currency Additions & Updates (Last 30 Days)</h3>
                        <div class="chart-container">
                            <canvas id="additionsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm rounded-lg mb-5">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">Understanding Our Data</h3>
                <p class="text-muted text-center">
                    These visual summaries are designed to give a quick overview of the archive's scope and activity. High numbers of new additions signify active growth, while a balanced collection distribution reflects our commitment to global representation. Data is updated regularly to provide the most current insights into our community and the currency world.
                </p>
            </div>
        </div>
    </div>
@endsection

{{-- REMOVED: @section('styles') block --}}

@section('scripts')
    {{-- Include Chart.js library --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data passed from Laravel Controller
            const totalUsers = {{ $totalUsers }};
            const genderData = @json($genderData);
            const countryDistribution = @json($countryDistribution);
            const newCurrencyAdditionsData = @json($newCurrencyAdditionsData);

            // --- Gender Distribution Pie Chart ---
            const genderCtx = document.getElementById('genderChart').getContext('2d');
            new Chart(genderCtx, {
                type: 'pie',
                data: {
                    labels: Object.keys(genderData),
                    datasets: [{
                        data: Object.values(genderData),
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.8)', // Blue for Male
                            'rgba(255, 99, 132, 0.8)', // Red for Female
                            'rgba(75, 192, 192, 0.8)', // Green for Other
                            'rgba(255, 206, 86, 0.8)'  // Yellow for Prefer not to say
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        title: {
                            display: false,
                            text: 'User Gender Distribution'
                        }
                    }
                }
            });

            // --- Top Countries by Users Bar Chart ---
            const countryCtx = document.getElementById('countryChart').getContext('2d');
            new Chart(countryCtx, {
                type: 'bar',
                data: {
                    labels: Object.keys(countryDistribution),
                    datasets: [{
                        label: 'Number of Users',
                        data: Object.values(countryDistribution),
                        backgroundColor: 'rgba(153, 102, 255, 0.8)', // Purple
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        },
                        title: {
                            display: false,
                            text: 'Top Countries by Users'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Users'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Country'
                            },
                            ticks: {
                                autoSkip: true,
                                maxRotation: 45,
                                minRotation: 0
                            }
                        }
                    }
                }
            });

            // --- New Currency Additions & Updates Line Chart ---
            const additionsCtx = document.getElementById('additionsChart').getContext('2d');
            new Chart(additionsCtx, {
                type: 'line',
                data: {
                    labels: newCurrencyAdditionsData.labels,
                    datasets: [
                        {
                            label: 'New Notes',
                            data: newCurrencyAdditionsData.new_notes,
                            borderColor: 'rgba(255, 159, 64, 1)', // Orange
                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'Updates',
                            data: newCurrencyAdditionsData.updates,
                            borderColor: 'rgba(54, 162, 235, 1)', // Blue
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            tension: 0.3,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: false,
                            text: 'Currency Additions & Updates'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Count'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Days Ago'
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
