@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dashboard CRM</h1>
        <div>
            <canvas id="statusChart" width="400" height="200"></canvas>
        </div>
    </div>

    <script>
        // Chart.js script to render the chart
        var ctx = document.getElementById('statusChart').getContext('2d');
        var counts = @json($counts); // Convert PHP array to JSON

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: Object.keys(counts),
                datasets: [{
                    label: 'Customer Status',
                    data: Object.values(counts),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
