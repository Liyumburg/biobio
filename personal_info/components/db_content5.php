<!DOCTYPE html>
<html lang="en">

<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $Record->delete(intval($_POST['delete']));
    header('Location: index.php');
    exit;
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Information Records</title>
    <link rel="stylesheet" href="./style/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.min.css">
</head>

<body class="bg-light" style="font-family: 'Roboto', sans-serif;">

    <div class="container-fluid py-5">

        <div class="mb-3">
            <a href="../index.php" class="btn btn-outline-secondary">Home</a>
        </div>

        <div class="text-left mb-4">
            <h1 class="fw-bold mb-2 text-danger text-center">Personal Profile</h1>
            <p class="text-muted text-center">Individual Information Sheet Records</p>
        </div>

        <div class="d-flex justify-content-start mb-3">
            <a href="add.php" class="btn btn-danger px-4 py-2 rounded-pill fw-semibold shadow-sm text-white ">
                + Add New Record
            </a>
        </div>

            <div class="d-flex justify-content-start mb-3">
            <a href="accept_list.php" class="btn btn-danger px-4 py-2 rounded-pill fw-semibold shadow-sm text-white ">
                View Temporary Records
            </a>
        </div>

        <div class="card border-0 shadow-lg rounded-4 mb-5">
            <div class="card-body p-4">

                <div class="table-responsive text-nowrap">
                    <table id="recordsTable" class="table table-hover align-middle text-center">
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
                                <td><?= $row['id'] ?></td>
                                <td><?= strtoupper($row['Last_name']) ?></td>
                                <td><?= strtoupper($row['First_name']) ?></td>
                                <td><?= strtoupper($row['Middle_name']) ?></td>
                                <td><?= strtoupper($row['Suffix']) ?></td>
                                <td><?= $row['DOB'] ?></td>
                                <td><?= strtoupper($row['Gender']) ?></td>
                                <td><?= strtoupper($row['Email_address']) ?></td>
                                <td><?= strtoupper($row['Province']) ?></td>
                                <td><?= strtoupper($row['City']) ?></td>
                                <td><?= strtoupper($row['Barangay']) ?></td>
                                <td><?= strtoupper($row['Street']) ?></td>
                                <td><?= strtoupper($row['Mobile_number']) ?></td>
                                <td><?= strtoupper($row['Languages']) ?></td>
                                <td><?= strtoupper($row['Marital_status']) ?></td>
                                <td><?= strtoupper($row['Religion']) ?></td>
                                <td><?= strtoupper($row['Hobbies']) ?></td>

                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="view.php?id=<?= $row['id'] ?>"
                                            class="btn btn-outline-success btn-sm rounded-pill px-3">View</a>

                                        <a href="edit.php?id=<?= $row['id'] ?>"
                                            class="btn btn-outline-primary btn-sm rounded-pill px-3">Edit</a>

                                        <form method="POST" style="display:inline;">
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.3.7/js/dataTables.min.js"></script>
<script>
let table = new DataTable('#recordsTable');
</script>
</script>
    	

</html>