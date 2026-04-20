<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <?php include 'libraries.php'; ?>
</head>

<body class="bg-light" style="font-family: 'Roboto', sans-serif;">

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-dark" href="#">Biodata Records</a>
        </div>
    </nav>

    <!-- landing content -->
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold">Welcome!</h1>
                <p class="lead text-muted">Manage your personal, educational, and employment records.</p>
        </div>

        <div class="row g-4 justify-content-center">

            <div class="col-md-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title">Personal Info</h5>
                        <p class="card-text text-muted">Add, edit or view personal profiles</p>
                        <a href="personal_info/add.php" class="btn btn-danger mt-3">Go</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title">Education</h5>
                        <p class="card-text text-muted">Manage educational background</p>
                        <a href="educational/index.php" class="btn btn-danger mt-3">Go</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title">Employment</h5>
                        <p class="card-text text-muted">Track job history entries</p>
                        <a href="employment/index.php" class="btn btn-danger mt-3">Go</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title">View All Records</h5>
                        <p class="card-text text-muted">View all registered records</p>
                        <a href="view_records/index.php" class="btn btn-danger mt-3">Go</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>