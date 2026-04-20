<?php
require_once '../connections/db_connect5.php';
require_once 'Record.php';

use Classes\Record;

$record = new Record($db);

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = (int)$_GET['id'];
$row = $record->view($id);

if (!$row) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['update'])) {
    $record->update($id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Record</title>
    <link rel="stylesheet" href="./style/bootstrap-5.3.8-dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-lg rounded-4 mx-auto" style="max-width: 1000px;">
        <div class="card-body p-5">

            <div class="mb-4">
                <h2 class="fw-bold text-danger">Edit Individual Information</h2>
                <p class="text-muted">Update Record</p>
            </div>

            <!-- IMPORTANT: enctype -->
            <form method="POST" enctype="multipart/form-data">

                <!-- PERSONAL DETAILS -->
                <h5 class="fw-bold border-bottom pb-2 mb-4 text-danger">Personal Details</h5>
                <div class="row g-3">

                    <!-- IMAGE -->
                    <div class="col-md-12">
                        <label class="form-label">Profile Image</label>

                        <!-- preview -->
                        <?php if(!empty($row['uploads'])): ?>
                            <img src="./uploads/<?= $row['uploads']; ?>" 
                                 class="mb-2 rounded shadow"
                                 style="width:120px;">
                        <?php endif; ?>

                        <input type="file" class="form-control" name="per_img">

                        <!-- KEEP OLD IMAGE -->
                        <input type="hidden" name="old_img" value="<?= $row['uploads']; ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="Last_name"
                            value="<?= $row['Last_name'] ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" name="First_name"
                            value="<?= $row['First_name'] ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Middle Name</label>
                        <input type="text" class="form-control" name="Middle_name"
                            value="<?= $row['Middle_name'] ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Suffix</label>
                        <input type="text" class="form-control" name="Suffix"
                            value="<?= $row['Suffix'] ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" name="DOB"
                            value="<?= $row['DOB'] ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Gender</label>
                        <input type="text" class="form-control" name="Gender"
                            value="<?= $row['Gender'] ?>">
                    </div>
                </div>

                <!-- CONTACT -->
                <h5 class="fw-bold border-bottom pb-2 mt-5 mb-4 text-danger">Contact Information</h5>
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" name="Mobile_number"
                            value="<?= $row['Mobile_number'] ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="Email_address"
                            value="<?= $row['Email_address'] ?>" required>
                    </div>
                </div>

                <!-- ADDRESS -->
                <h5 class="fw-bold border-bottom pb-2 mt-5 mb-4 text-danger">Address</h5>
                <div class="row g-3">

                    <div class="col-md-6">
                        <input class="form-control" name="Street"
                            value="<?= $row['Street'] ?>" placeholder="Street">
                    </div>

                    <div class="col-md-6">
                        <input class="form-control" name="Barangay"
                            value="<?= $row['Barangay'] ?>" placeholder="Barangay">
                    </div>

                    <div class="col-md-6">
                        <input class="form-control" name="City"
                            value="<?= $row['City'] ?>" placeholder="City">
                    </div>

                    <div class="col-md-6">
                        <input class="form-control" name="Province"
                            value="<?= $row['Province'] ?>" placeholder="Province">
                    </div>
                </div>

                <!-- OTHER -->
                <h5 class="fw-bold border-bottom pb-2 mt-5 mb-4 text-danger">Other Details</h5>
                <div class="row g-3">

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="Religion"
                            value="<?= $row['Religion'] ?>" placeholder="Religion">
                    </div>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="Languages"
                            value="<?= $row['Languages'] ?>" placeholder="Languages">
                    </div>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="Hobbies"
                            value="<?= $row['Hobbies'] ?>" placeholder="Hobbies">
                    </div>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="Marital_status"
                            value="<?= $row['Marital_status'] ?>" placeholder="Marital Status">
                    </div>
                </div>

                <!-- BUTTON -->
                <div class="mt-5">
                    <button type="submit" name="update"
                        class="btn btn-danger rounded-pill px-5">
                        Update
                    </button>

                    <a href="index.php"
                        class="btn btn-outline-danger rounded-pill px-4">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

</body>
</html>