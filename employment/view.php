<?php
require_once "../connections/db_connect5.php";
require 'employ_record.php';

$employ_record = new Classes\employ_record($db);

$row = null;
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $row = $employ_record->view($id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Employment Record</title>

    <link rel="stylesheet" href="../style/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style/style-custom/style.css">
</head>

<body class="bg-light" style="font-family: 'Roboto', sans-serif;">

    <div class="container py-5">
        <div class="card border-0 shadow-lg rounded-4 mx-auto" style="max-width: 1000px;">
            <div class="card-body p-4 p-md-5">

                <div class="text-left mb-4">
                    <h2 class="fw-bold text-warning">Employment History</h2>
                    <p class="text-muted mb-0">Record Preview</p>
                    <h5 class="fw-bold border-bottom pb-2 mb-4 text-warning mt-4">Educational Details</h5>
                </div>

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Personal ID</label>
                        <input type="text" class="form-control bg-white" disabled
                            value="<?= $row['personal_id'] ?? '' ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Company Name</label>
                        <input type="text" class="form-control bg-white" disabled
                            value="<?= $row['company_name'] ?? '' ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Position</label>
                        <input type="text" class="form-control bg-white" disabled value="<?= $row['position'] ?? '' ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Start Date</label>
                        <input type="date" class="form-control bg-white" disabled
                            value="<?= $row['start_date'] ?? '' ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">End Date</label>
                        <input type="date" class="form-control bg-white" disabled value="<?= $row['end_date'] ?? '' ?>">
                    </div>

                </div>

                <div class="text-left mt-4">
                    <a href="index.php" class="btn btn-outline-warning rounded-pill px-4 fw-semibold">
                        Return to Records
                    </a>
                </div>

            </div>
        </div>
    </div>

</body>

</html>