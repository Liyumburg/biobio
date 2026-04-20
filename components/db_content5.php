<!DOCTYPE html>
<html lang="en">

<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $Record->delete(intval  ($_POST['delete']));
    header('Location: index.php');
    exit;
}

if (isset($_GET['id'])) {
    $row = $Record->view($_GET['id']); }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Information Records</title>
    <link rel="stylesheet" href="./style/bootstrap-5.3.8-dist/css/bootstrap.min.css">
</head>

<body class="bg-light" style="font-family: 'Roboto', sans-serif;">

    <div class="container-fluid py-5">

        <div class="text-center mb-4">
            <h1 class="fw-bold mb-2">Personal Profile</h1>
            <p class="text-muted">Individual Information Sheet Records</p>
        </div>

        <div class="d-flex justify-content-end mb-4">
            <a href="add.php" class="btn btn-primary px-4 py-2 rounded-pill fw-semibold shadow-sm">
                + Add New Record
            </a>
        </div>

        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-body p-4">

                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Suffix</th>
                                <th>DOB</th>
                                <th>Gender</th>
                                <th>Email Address</th>
                                <th>Province</th>
                                <th>City/Municipal</th>
                                <th>Brgy</th>
                                <th>Street</th>
                                <th>Mobile No</th>
                                <th>Language</th>
                                <th>Marital Status</th>
                                <th>Religion</th>
                                <th>Hobbies</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($data as $row) { ?>
                            <tr>
                                <td class="fw-semibold"><?= strtoupper($row['id']) ?></td>
                                <td><?= strtoupper($row['Last_name']) ?></td>
                                <td><?= strtoupper($row['First_name']) ?></td>
                                <td><?= strtoupper($row['Middle_name']) ?></td>
                                <td><?= strtoupper($row['Suffix']) ?></td>
                                <td><?= strtoupper($row['DOB']) ?></td>
                                <td><?= strtoupper($row['Gender']) ?></td>
                                <td><?= strtoupper($row['Mobile_number']) ?></td>
                                <td><?= strtoupper($row['Email_address']) ?></td>
                                <td><?= strtoupper($row['Province']) ?></td>
                                <td><?= strtoupper($row['City']) ?></td>
                                <td><?= strtoupper($row['Barangay']) ?></td>
                                <td><?= strtoupper($row['Street']) ?></td>
                                <td><?= strtoupper($row['Languages']) ?></td>
                                <td><?= strtoupper($row['Marital_status']) ?></td>
                                <td><?= strtoupper($row['Religion']) ?></td>
                                <td><?= strtoupper($row['Hobbies']) ?></td>



                                <td>
                                    <div class="d-flex flex-wrap justify-content-center gap-1">
                                        <a href="view.php?id=<?= $row['id'] ?>"
                                            class="btn btn-outline-success btn-sm rounded-pill px-3">
                                            View
                                        </a>

                                        <a href="edit.php?id=<?= $row['id'] ?>"
                                            class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                            Edit
                                        </a>

                                        <form method="POST" style="display: inline-block;"
                                            onsubmit="return confirm('Are you sure you want to delete this?')">
                                            <button type="submit" name="delete" value="<?= $row['id'] ?>"
                                                class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>

</body>

</html>