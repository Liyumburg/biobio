<?php
require_once "../connections/db_connect5.php";
require 'educ_record.php';

$Record = new Classes\educ_record($db);

$row = null;
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $row = $Record->view($id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Educational Record</title>

    <link rel="stylesheet" href="../style/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style/style-custom/style.css">
</head>

<body class="bg-light" style="font-family: 'Roboto', sans-serif;">

    <div class="container py-5">

        <div class="card border-0 shadow-lg rounded-4 mx-auto" style="max-width: 1000px;">
            <div class="card-body p-4 p-md-5">

                <div class="text-left mb-4">
                    <h2 class="fw-bold text-warning">Educational Background</h2>
                    <p class="text-muted mb-0">Record Preview</p>
                </div>

                <form>

                    <div class="mb-5">
                        <h5 class="fw-bold border-bottom pb-2 mb-4 text-warning">Educational Details</h5>
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Personal ID</label>
                                <input type="text" class="form-control rounded-3 bg-white" disabled
                                    value="<?= isset($row['personal_id']) ? $row['personal_id'] : '' ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Level</label>
                                <input type="text" class="form-control rounded-3 bg-white" disabled
                                    value="<?= isset($row['level']) ? $row['level'] : '' ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">School Name</label>
                                <input type="text" class="form-control rounded-3 bg-white" disabled
                                    value="<?= isset($row['school_name']) ? $row['school_name'] : '' ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Course</label>
                                <input type="text" class="form-control rounded-3 bg-white" disabled
                                    value="<?= isset($row['course']) ? $row['course'] : '' ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Year of Passing</label>
                                <input type="text" class="form-control rounded-3 bg-white" disabled
                                    value="<?= isset($row['year_passing']) ? $row['year_passing'] : '' ?>">
                            </div>

                        </div>
                    </div>

                </form>

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