<!DOCTYPE html>
<html lang="en">

<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $Record->delete((int)$_POST['delete']);
    header('Location: index.php');
    exit;
}
?>

<head>
    <meta charset="UTF-8">
    <title>Employment Records</title>
    <link rel="stylesheet" href="../style/bootstrap-5.3.8-dist/css/bootstrap.min.css">
</head>
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.min.css">

<body class="bg-light" style="font-family: 'Roboto', sans-serif;">

    <div class="container-fluid py-5">

        <div class="mb-3">
            <a href="../index.php" class="btn btn-outline-secondary">Home</a>
        </div>

        <div class="text-left mb-4 px-3">
            <h1 class="fw-bold text-danger">Employment History</h1>
            <p class="text-muted">Employment Records List</p>
        </div>

        <div class="d-flex justify-content-start px-3 mb-4">
            <a href="add.php" class="btn btn-danger text-white px-4 py-2 rounded-pill shadow-sm">
                + Add New Record
            </a>
        </div>

        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="recordsTable" class="table table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Employment ID</th>
                                <th>Personal ID</th>
                                <th>Company Name</th>
                                <th>Position</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($data as $row) { ?>
                            <tr>
                                <td><?= strtoupper($row['employment_id']) ?></td>
                                <td><?= strtoupper($row['personal_id']) ?></td>
                                <td><?= strtoupper($row['company_name']) ?></td>
                                <td><?= strtoupper($row['position']) ?></td>
                                <td><?= strtoupper($row['start_date']) ?></td>
                                <td><?= strtoupper($row['end_date']) ?></td>

                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="view.php?id=<?= $row['employment_id'] ?>"
                                            class="btn btn-outline-success btn-sm rounded-pill px-3">
                                            View
                                        </a>

                                        <a href="edit.php?id=<?= $row['employment_id'] ?>"
                                            class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                            Edit
                                        </a>

                                        <form method="POST" style="display:inline;">
                                            <button type="submit" name="delete" value="<?= $row['employment_id'] ?>"
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