<?php
require_once '../connections/db_connect5.php';
require_once 'educ_record.php';

use Classes\educ_record;



if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$row = $educ_record->view($id);

if (!$row) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['update'])) {
    $educ_record->update($id);
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
                    <h2 class="fw-bold text-warning">Edit Educational Background</h2>
                    <p class="text-muted mb-0">Update Record</p>
                </div>

                <form method="POST">

                    <div class="mb-5">
                        <h5 class="fw-bold border-bottom pb-2 mb-4 text-warning">Educational Details</h5>
                        <div class="row g-3">

        
                            <!-- test -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Personal ID</label>
                                <input type="text" class="form-control" name="personal_id"
                                    disabled value="<?= $row['personal_id'] ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Level</label>
                                <input type="text" class="form-control" name="level"
                                     value="<?= $row['level'] ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">School Name</label>
                                <input type="text" class="form-control" name="school_name"
                                     value="<?= $row['school_name'] ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Course</label>
                                <input type="text" class="form-control" name="course"
                                     value="<?= $row['course'] ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Year of Passing</label>
                                <input type="text" class="form-control" name="year_passing"
                                     value="<?= $row['year_passing'] ?>">
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