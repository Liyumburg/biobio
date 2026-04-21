<?php
require_once '../connections/db_connect5.php';

// Query to count sex from the 'id' table
$stmt = $db->prepare("SELECT Sex, COUNT(*) AS total FROM id GROUP BY Sex");
$stmt->execute();
$results = $stmt->fetchAll();

// Prepare data for Chart.js
$labels = [];
$counts = [];

foreach ($results as $row) {
    $labels[] = strtoupper($row['Sex']);
    $counts[] = (int)$row['total'];
}

// Convert to JSON for use in JavaScript
$labelsJson = json_encode($labels);
$countsJson = json_encode($counts);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sex Distribution Chart</title>
    <link rel="stylesheet" href="./style/bootstrap-5.3.8-dist/css/bootstrap.min.css">

    <!-- Chart.js CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
</head>
<body class="bg-light">

<div class="container py-5">

    <div class="mb-3">
        <a href="index.php" class="btn btn-outline-secondary">← Back</a>
    </div>

    <h1 class="fw-bold text-danger text-center mb-1">Sex Distribution Chart</h1>
   

    <div class="row justify-content-center g-4">


        <!-- Bar Chart -->
        <div class="col-md-5">
            <div class="card border-0 shadow-lg rounded-4 p-4">
                <h5 class="fw-semibold text-center mb-3">Bar Chart</h5>
                <canvas id="barChart"></canvas>
            </div>
        </div>

    </div>

    <!-- Summary Table -->
    <div class="row justify-content-center mt-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg rounded-4 p-4">
                <h5 class="fw-semibold text-center mb-3">Summary</h5>
                <table class="table table-bordered text-center">
                    <thead class="table-danger">
                        <tr>
                            <th>Sex</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $row): ?>
                        <tr>
                            <td><?= strtoupper($row['Sex']) ?></td>
                            <td><?= $row['total'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    const labels = <?= $labelsJson ?>;
    const counts = <?= $countsJson ?>;

    const colors = [
        'rgba(220, 53, 69, 0.8)',   // red (male)
        'rgba(13, 110, 253, 0.8)',  // blue (female)
        'rgba(25, 135, 84, 0.8)',   // green (others)
        'rgba(255, 193, 7, 0.8)',   // yellow
    ];

    // BAR CHART
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Number of Records',
                data: counts,
                backgroundColor: colors,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });
</script>

</body>
</html>
