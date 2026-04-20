<?php
require_once '../connections/db_connect5.php';
require_once 'employ_record.php';

use Classes\employ_record;

$employ_record = new employ_record($db);

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$row = $employ_record->view($id);

if (!$row) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['update'])) {
    $employ_record->update($id);
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
                    <h2 class="fw-bold text-warning">Edit Employment History</h2>
                    <p class="text-muted mb-0">Update Record</p>
                </div>

                <form method="POST">

                    <div class="mb-5">
                        <h5 class="fw-bold border-bottom pb-2 mb-4 text-warning">Educational Details</h5>
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Personal ID</label>
                                <input type="text" class="form-control" name="personal_id"
                                    disabled value="<?= $row['personal_id'] ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Company Name</label>
                                <input type="text" class="form-control" name="company_name"
                                     value="<?= $row['company_name'] ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Position</label>
                                <input type="text" class="form-control" name="position"
                                     value="<?= $row['position'] ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Start Date</label>
                                <input type="text" class="form-control" name="start_date"
                                     value="<?= $row['start_date'] ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">End Date</label>
                                <input type="text" class="form-control" name="end_date"
                                     value="<?= $row['end_date'] ?>">
                            </div>
                            <!-- end test -->

                        </div>
                    </div>
                    <!-- BUTTONS -->
                    <div class="text-left mt-5">
                        <button type="submit" name="update"
                            class="btn btn-warning text-white rounded-pill px-5">
                            Update
                        </button>

                        <a href="index.php"
                            class="btn btn-outline-warning rounded-pill px-4">
                            Cancel
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>

</body>

</html>