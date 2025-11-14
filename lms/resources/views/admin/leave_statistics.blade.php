<!DOCTYPE html>
<html>
<head>
    <title>Leave Statistics Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* General Page Styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f6fa;
            margin: 0;
            padding: 0;
            color: #2c3e50;
        }

        /* Sidebar */
        aside {
            width: 220px;
            background-color: #2f3640;
            color: #f5f6fa;
            min-height: 100vh;
            padding: 20px 15px;
            position: fixed;
        }

        aside h3 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 20px;
            font-weight: 600;
        }

        aside nav ul {
            list-style: none;
            padding: 0;
        }

        aside nav ul li {
            margin-bottom: 15px;
        }

        aside nav ul li a {
            color: #dcdde1;
            text-decoration: none;
            display: block;
            padding: 10px 12px;
            border-radius: 6px;
            transition: 0.3s;
        }

        aside nav ul li a:hover {
            background-color: #718093;
            color: #fff;
        }

        aside nav ul li a.active {
            background-color: #44bd32;
            color: #fff;
        }

        /* Main content */
        main {
            margin-left: 240px;
            padding: 30px;
        }

        h1 {
            font-size: 26px;
            margin-bottom: 15px;
        }

        .download-btn {
            background: #44bd32;
            color: #fff;
            padding: 10px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            display: inline-block;
            margin-bottom: 25px;
            transition: 0.3s;
        }

        .download-btn:hover {
            background: #4cd137;
        }

        /* Chart Card */
        .chart-card {
            background: #fff;
            padding: 18px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            margin-bottom: 30px;
            max-width: 650px;
        }

        .chart-card h2 {
            font-size: 18px;
            margin-bottom: 12px;
            color: #2f3640;
        }

        /* Reduce chart height for compact view */
        canvas {
            max-height: 220px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            main {
                margin-left: 0;
                padding: 20px;
            }
            .chart-card {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<aside>
    <h3>Admin Dashboard</h3>
    <nav>
        <ul>
            <li><a href="#" class="active">🏠 Dashboard</a></li>
            <li><a href="{{route('admin.allusers')}}">👤 All Users</a></li>
            <li><a href="#">⚙️ Settings</a></li>
            <li><a href="{{route('admin.leave.stats')}}">Reports</a></li>
        </ul>
    </nav>
</aside>

<main>
    <h1>📊 Leave Statistics</h1>

    <!-- Download Button -->
    <a href="{{ route('admin.leave.report') }}" class="download-btn">⬇️ Download Leave Report (PDF)</a>

    <!-- Leave Count by Type -->
    <div class="chart-card">
        <h2>Leave Count by Type</h2>
        <canvas id="typeChart"></canvas>
    </div>

    <!-- Leave Count by Month -->
    <div class="chart-card">
        <h2>Leave Count by Month</h2>
        <canvas id="monthChart"></canvas>
    </div>
</main>

<script>
    // PHP Data to JS
    var leaveTypes = @json($leaveByType->pluck('leave_type'));
    var leaveTypeTotals = @json($leaveByType->pluck('total'));

    var months = @json($leaveByMonth->pluck('month'));
    var monthTotals = @json($leaveByMonth->pluck('total'));

    // Pie Chart for Leave Types
    new Chart(document.getElementById('typeChart'), {
        type: 'pie',
        data: {
            labels: leaveTypes,
            datasets: [{
                data: leaveTypeTotals,
                backgroundColor: ['#44bd32','#718093','#e84118','#00a8ff','#8c7ae6','#fbc531'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { font: { size: 12 } }
                }
            }
        }
    });

    // Bar Chart for Leaves per Month
    new Chart(document.getElementById('monthChart'), {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Leaves',
                data: monthTotals,
                backgroundColor: '#00a8ff'
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 12 } } },
                y: { grid: { color: '#dcdde1' }, ticks: { font: { size: 12 }, beginAtZero: true } }
            }
        }
    });
</script>

</body>
</html>
