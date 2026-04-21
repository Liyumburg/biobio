<?php
require '../personal_info/connections/db_connect5.php';

// Fetch all pending records from temp_person
$stmt = $db->prepare("SELECT * FROM temp_person ORDER BY id DESC");
$stmt->execute();
$pendingData = $stmt->fetchAll();

// Build a lookup of duplicates: check each temp record against the id table
$duplicateIds = [];
foreach ($pendingData as $row) {
    $dupCheck = $db->prepare("SELECT COUNT(*) FROM id WHERE First_name = ? AND Last_name = ? AND DOB = ?");
    $dupCheck->execute([$row['First_name'], $row['Last_name'], $row['DOB']]);
    if ((int)$dupCheck->fetchColumn() > 0) {
        $duplicateIds[] = $row['id'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Acceptance</title>
    <link rel="stylesheet" href="../personal_info/style/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.min.css">
    <style>
        body { font-family: 'Roboto', sans-serif; background: #f8f9fa; }
        .badge-pending {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffc107;
            border-radius: 20px;
            padding: 4px 12px;
            font-size: 0.78rem;
            font-weight: 600;
        }
        .badge-duplicate {
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
            border-radius: 20px;
            padding: 3px 10px;
            font-size: 0.72rem;
            font-weight: 700;
        }
        tr.is-duplicate { background-color: #fff5f5 !important; }
        .table thead th { vertical-align: middle; font-size: 0.85rem; }
        .table tbody td { font-size: 0.85rem; vertical-align: middle; }
        .avatar-initials {
            width: 36px; height: 36px;
            background: #dc3545;
            color: #fff;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.8rem;
            margin-right: 6px;
        }
    </style>
</head>
<body>

<div class="container-fluid py-5">

    <div class="mb-3">
        <a href="index.php" class="btn btn-outline-secondary">Main Records</a>
    </div>

    <div class="text-center mb-4">
        <h1 class="fw-bold text-danger">Pending Registrations</h1>
        <p class="text-muted">Review and accept submitted personal info records</p>
    </div>

    <?php if (empty($pendingData)): ?>
    <div class="alert alert-success text-center py-4" role="alert">
        <h5 class="mb-1">✅ No pending records</h5>
        <p class="mb-0 text-muted">All submissions have been processed.</p>
    </div>
    <?php else: ?>

    <!-- Summary badge -->
    <div class="mb-3 d-flex gap-2 align-items-center flex-wrap">
        <span class="badge-pending">
            📋 <?= count($pendingData) ?> Pending Record<?= count($pendingData) > 1 ? 's' : '' ?>
        </span>
        <?php if (!empty($duplicateIds)): ?>
        <span class="badge-duplicate">
            ⚠️ <?= count($duplicateIds) ?> Possible Duplicate<?= count($duplicateIds) > 1 ? 's' : '' ?> — already in system
        </span>
        <?php endif; ?>
    </div>

    <div class="card border-0 shadow-lg rounded-4 mb-5">
        <div class="card-body p-4">
            <div class="table-responsive text-nowrap">
                <table id="pendingTable" class="table table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Sex</th>
                            <th>DOB</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>City</th>
                            <th>Province</th>
                            <th>Marital Status</th>
                            <th>Date Submitted</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pendingData as $i => $row): 
                            $isDup = in_array($row['id'], $duplicateIds);
                        ?>
                        <tr class="<?= $isDup ? 'is-duplicate' : '' ?>">
                            <td><?= $i + 1 ?></td>
                            <td class="text-start">
                                <span class="avatar-initials">
                                    <?= strtoupper(substr($row['First_name'], 0, 1) . substr($row['Last_name'], 0, 1)) ?>
                                </span>
                                <?= htmlspecialchars(strtoupper($row['Last_name'])) ?>,
                                <?= htmlspecialchars(strtoupper($row['First_name'])) ?>
                                <?= htmlspecialchars(strtoupper($row['Middle_name'])) ?>
                                <?= $row['Suffix'] ? htmlspecialchars($row['Suffix']) : '' ?>
                                <?php if ($isDup): ?>
                                <br><span class="badge-duplicate ms-1">⚠️ Duplicate</span>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($row['Sex']) ?></td>
                            <td><?= htmlspecialchars($row['DOB']) ?></td>
                            <td><?= htmlspecialchars($row['Email_address']) ?></td>
                            <td><?= htmlspecialchars($row['Mobile_number']) ?></td>
                            <td><?= htmlspecialchars(strtoupper($row['City'])) ?></td>
                            <td><?= htmlspecialchars(strtoupper($row['Province'])) ?></td>
                            <td><?= htmlspecialchars($row['Marital_status']) ?></td>
                            <td>
                                <?= isset($row['created_at'])
                                    ? date('M d, Y', strtotime($row['created_at']))
                                    : '<span class="text-muted">—</span>' ?>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <!-- Accept button -->
                                    <a href="../personal_info/accept.php?id=<?= $row['id'] ?>"
                                       class="btn btn-success btn-sm rounded-pill px-3"
                                       onclick="return confirm('Accept this record and send email to <?= htmlspecialchars(addslashes($row['Email_address'])) ?>?')">
                                       Accept
                                    </a>

                                    <!-- Reject / Delete button -->
                                    <a href="../personal_info/decline.php?id=<?= $row['id'] ?>"
                                       class="btn btn-danger btn-sm rounded-pill px-3"
                                       onclick="return confirm('Decline this record and send email to <?= htmlspecialchars(addslashes($row['Email_address'])) ?>?')">
                                       Decline
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php endif; ?>
</div>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.3.7/js/dataTables.min.js"></script>
<script>
    new DataTable('#pendingTable', {
        pageLength: 10,
        order: [[0, 'desc']]
    });
</script>

</body>
</html>