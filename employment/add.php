<?php
require_once "../connections/db_connect5.php";
require_once "employ_record.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employment History</title>

    <link rel="stylesheet" href="../style/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style/style-custom/style.css">
</head>

<body class="bg-light" style="font-family: 'Roboto', sans-serif;">

    <div class="container py-5">
        <div class="card border-0 shadow-lg rounded-4 mx-auto" style="max-width: 1100px;">
            <div class="card-body p-4 p-md-5">

                <div class="text-left mb-4">
                    <h2 class="fw-bold text-danger">Employment History</h2>
                    <p class="text-muted mb-0">Please fill out all required fields</p>
                </div>

                <?php if (isset($_GET['error']) && $_GET['error'] === 'duplicate'): ?>
                <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
                    <strong>Duplicate Record Detected!</strong> An employment record for this person at the same company with the same start date already exists.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>

                <form method="POST" action="add.php" id="addForm">

                    <div class="mb-5">
                        <h5 class="fw-bold border-bottom pb-2 mb-4 text-danger">Employment Details</h5>

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Select Person *</label>
                                <select name="personal_id" class="form-control rounded-3" required>
                                    <option value="">Select Person</option>
                                    <?php
                                $stmt = $db->query("SELECT id, First_name, Last_name FROM id");
                                while ($person = $stmt->fetch()) {
                                ?>
                                    <option value="<?= $person['id'] ?>">
                                        <?= $person['First_name'] . ' ' . $person['Last_name'] ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Company Name *</label>
                                <input type="text" class="form-control rounded-3" name="company_name" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Position *</label>
                                <input type="text" class="form-control rounded-3" name="position" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Start Date *</label>
                                <input type="date" class="form-control rounded-3" name="start_date" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">End Date *</label>
                                <input type="date" class="form-control rounded-3" name="end_date" required>
                            </div>

                        </div>
                    </div>

                    <div class="text-left mt-4">
                        <button type="submit" name="add" class="btn btn-danger px-5 py-2 rounded-pill me-2">
                            Submit
                        </button>

                        <button type="reset" class="btn btn-outline-secondary px-5 py-2 rounded-pill">
                            Reset
                        </button>
                    </div>

                </form>

                <div class="text-left mt-4">
                    <a href="index.php" class="fw-semibold text-decoration-none text-danger">
                        View Records
                    </a>
                </div>

            </div>
        </div>
    </div>

    <script>
    const warnFields = ['company_name','start_date'];
    const dupWarning = document.createElement('div');
    dupWarning.className = 'alert alert-warning rounded-3 mt-2 d-none';
    dupWarning.id = 'dupWarn';
    dupWarning.innerHTML = '<strong>Heads up!</strong> Please verify this is not a duplicate employment entry for the same company and start date.';

    const submitBtn = document.querySelector('[name="add"]');
    submitBtn.closest('.text-left').insertBefore(dupWarning, submitBtn.closest('.text-left').firstChild);

    warnFields.forEach(f => {
        const el = document.querySelector('[name="'+f+'"]');
        if(el) el.addEventListener('blur', checkAllFilled);
    });
    document.querySelector('[name="personal_id"]').addEventListener('change', checkAllFilled);

    function checkAllFilled(){
        const personOk = document.querySelector('[name="personal_id"]')?.value !== '';
        const allFilled = warnFields.every(f => document.querySelector('[name="'+f+'"]')?.value.trim() !== '');
        document.getElementById('dupWarn').classList.toggle('d-none', !(personOk && allFilled));
    }
    </script>
</body>