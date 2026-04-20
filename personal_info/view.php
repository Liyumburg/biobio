<?php
require 'Record.php';

$Record = new Classes\Record($db);
$data = $Record->getAll();

$row = null;
if (isset($_GET['id'])) {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $row = $Record->view($_GET['id']); }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Record</title>
    <link rel="stylesheet" href="./style/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style/style-custom/style.css">
</head>

<body class="bg-light" style="font-family: 'Roboto', sans-serif;">

    <div class="container py-5">

        <div class="card border-0 shadow-lg rounded-4 mx-auto" style="max-width: 1000px;">
            <div class="card-body p-4 p-md-5">

                <div class="text-left mb-4">
                    <h2 class="fw-bold text-danger">Individual Information Sheet</h2>
                    <p class="text-muted mb-0">Record Preview</p>
                </div>

                <form>

                    <div class="mb-5">
                        <h5 class="fw-bold border-bottom pb-2 mb-4 text-danger">Personal Details</h5>
                        <div class="row g-3">


                            <div class="col-md-12">
                                 <img src="./uploads/<?= $row['uploads']; ?>" 
                                class="img-fluid"
                                alt="profile"
                                style="max-width: 220px;">
                            </div>

                      

                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Last Name</label>
                                <input type="text" class="form-control rounded-3 bg-white" name="Last_name" required
                                    disabled value="<?= isset($row['Last_name']) ? $row['Last_name'] : '' ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">First Name</label>
                                <input type="text" class="form-control rounded-3 bg-white" name="First_name" required
                                    disabled value="<?= isset($row['First_name']) ? $row['First_name'] : '' ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Middle Name</label>
                                <input type="text" class="form-control rounded-3 bg-white" name="Middle_name" required
                                    disabled value="<?= isset($row['Middle_name']) ? $row['Middle_name'] : '' ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Suffix</label>
                                <input type="text" class="form-control rounded-3 bg-white" name="Suffix " disabled
                                    value="<?= isset($row['Suffix']) ? $row['Suffix'] : '' ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Date of Birth</label>
                                <input type="date" class="form-control rounded-3 bg-white" name="DOB" disabled
                                    value="<?= isset($row['DOB']) ? $row['DOB'] : '' ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Gender</label>
                                <input type="text" class="form-control rounded-3 bg-white" name="Gender" disabled
                                    value="<?= isset($row['Gender']) ? $row['Gender'] : '' ?>">
                            </div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <h5 class="fw-bold border-bottom pb-2 mb-4 text-danger">Contact Information</h5>
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Mobile Number</label>
                                <input type="text" class="form-control rounded-3 bg-white" name="Mobile_number" required
                                    disabled value="<?= isset($row['Mobile_number']) ? $row['Mobile_number'] : '' ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email Address</label>
                                <input type="text" class="form-control rounded-3 bg-white" name="Email_address" required
                                    disabled value="<?= isset($row['Email_address']) ? $row['Email_address'] : '' ?>">
                            </div>

                        </div>
                    </div>

                    <div class="mb-5">
                        <h5 class="fw-bold border-bottom pb-2 mb-4 text-danger">Address</h5>
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Street</label>
                                <input class="form-control rounded-3 bg-white" name="Street" required disabled
                                    value="<?= isset($row['Street']) ? $row['Street'] : '' ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Barangay</label>
                                <input class="form-control rounded-3 bg-white" name="Barangay" required disabled
                                    value="<?= isset($row['Barangay']) ? $row['Barangay'] : '' ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">City</label>
                                <input class="form-control rounded-3 bg-white" name="City" required disabled
                                    value="<?= isset($row['City']) ? $row['City'] : '' ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Province</label>
                                <input class="form-control rounded-3 bg-white" name="Province" required disabled
                                    value="<?= isset($row['Province']) ? $row['Province'] : '' ?>">
                            </div>

                        </div>
                    </div>

                    <div class="mb-5">
                        <h5 class="fw-bold border-bottom pb-2 mb-4 text-danger">Other Details</h5>
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Religion</label>
                                <input type="text" class="form-control rounded-3 bg-white" name="Religion" required
                                    disabled value="<?= isset($row['Religion']) ? $row['Religion'] : '' ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Languages</label>
                                <input type="text" class="form-control rounded-3 bg-white" name="Languages" required
                                    disabled value="<?= isset($row['Languages']) ? $row['Languages'] : '' ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Hobbies</label>
                                <input type="text" class="form-control rounded-3 bg-white" name="Hobbies" required
                                    disabled value="<?= isset($row['Hobbies']) ? $row['Hobbies'] : '' ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Marital Status</label>
                                <input type="text" class="form-control rounded-3 bg-white" name="Marital_status"
                                    disabled value="<?= isset($row['Marital_status']) ? $row['Marital_status'] : '' ?>">
                            </div>
                        </div>
                    </div>

                </form>

                <div class="text-left mt-4">
                    <a href="index.php" class="btn btn-outline-warning rounded-pill px-4 fw-semibold bg-danger text-white">
                        Return to Records
                    </a>
                </div>

            </div>
        </div>

    </div>

</body>

</html>