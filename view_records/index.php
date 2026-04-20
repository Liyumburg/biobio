<?php
require_once '../connections/db_connect5.php';

$stmt1 = $db->prepare("SELECT * FROM id");
$stmt1->execute();
$personalData = $stmt1->fetchAll();

$stmt2 = $db->prepare("SELECT * FROM educational_background");
$stmt2->execute();
$educationData = $stmt2->fetchAll();

$stmt3 = $db->prepare("SELECT * FROM employment_history");
$stmt3->execute();
$employmentData = $stmt3->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>All Records</title>

    <link rel="stylesheet" href="../style/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style/style-custom/style.css">
</head>

<body class="bg-light" style="font-family: 'Roboto', sans-serif;">

    <div class="container-fluid py-5">

      <div class="mb-3">
            <a href="../index.php" class="btn btn-outline-secondary">Home</a>
        </div>
        
        <div class="text-left mb-4">
            <h1 class="fw-bold text-danger">Personal Records</h1>
            <p class="text-muted">Complete Personal Information List</p>
        </div>

        <div class="card shadow rounded-4 mb-5">
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-light text-nowrap">
                        <tr>
                            <th>ID</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Suffix</th>
                            <th>DOB</th>
                            <th>Gender</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Province</th>
                            <th>City</th>
                            <th>Barangay</th>
                            <th>Street</th>
                            <th>Languages</th>
                            <th>Marital Status</th>
                            <th>Religion</th>
                            <th>Hobbies</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($personalData as $p) { ?>
                        <tr>
                            <td><?= $p['id'] ?></td>
                            <td><?= $p['Last_name'] ?></td>
                            <td><?= $p['First_name'] ?></td>
                            <td><?= $p['Middle_name'] ?></td>
                            <td><?= $p['Suffix'] ?></td>
                            <td><?= $p['DOB'] ?></td>
                            <td><?= $p['Gender'] ?></td>
                            <td><?= $p['Mobile_number'] ?></td>
                            <td><?= $p['Email_address'] ?></td>
                            <td><?= $p['Province'] ?></td>
                            <td><?= $p['City'] ?></td>
                            <td><?= $p['Barangay'] ?></td>
                            <td><?= $p['Street'] ?></td>
                            <td><?= $p['Languages'] ?></td>
                            <td><?= $p['Marital_status'] ?></td>
                            <td><?= $p['Religion'] ?></td>
                            <td><?= $p['Hobbies'] ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-left mb-4">
            <h1 class="fw-bold text-danger">Educational Background</h1>
            <p class="text-muted">Educational Records List</p>
        </div>

        <div class="card shadow rounded-4 mb-5">
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Education ID</th>
                            <th>Personal ID</th>
                            <th>Level</th>
                            <th>School Name</th>
                            <th>Course</th>
                            <th>Year Passing</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($educationData as $e) { ?>
                        <tr>
                            <td><?= $e['education_id'] ?></td>
                            <td><?= $e['personal_id'] ?></td>
                            <td><?= $e['level'] ?></td>
                            <td><?= $e['school_name'] ?></td>
                            <td><?= $e['course'] ?></td>
                            <td><?= $e['year_passing'] ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-left mb-4">
            <h1 class="fw-bold text-danger">Employment History</h1>
            <p class="text-muted">Employment Records List</p>
        </div>

        <div class="card shadow rounded-4">
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Employment ID</th>
                            <th>Personal ID</th>
                            <th>Company Name</th>
                            <th>Position</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employmentData as $emp) { ?>
                        <tr>
                            <td><?= $emp['employment_id'] ?></td>
                            <td><?= $emp['personal_id'] ?></td>
                            <td><?= $emp['company_name'] ?></td>
                            <td><?= $emp['position'] ?></td>
                            <td><?= $emp['start_date'] ?></td>
                            <td><?= $emp['end_date'] ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>

</html>