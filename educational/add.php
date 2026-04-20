<?php
require_once "../connections/db_connect5.php";
require_once "educ_record.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Educational Background</title>

    <link rel="stylesheet" href="../style/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style/style-custom/style.css">
</head>

<body class="bg-light" style="font-family: 'Roboto', sans-serif;">

    <div class="container py-5">
        <div class="card border-0 shadow-lg rounded-4 mx-auto" style="max-width: 1100px;">
            <div class="card-body p-4 p-md-5">

                <div class="text-left mb-4">
                    <h2 class="fw-bold text-danger">Educational Background</h2>
                    <p class="text-muted mb-0">Please fill out all required fields</p>
                </div>

                <?php if (isset($_GET['error']) && $_GET['error'] === 'duplicate'): ?>
                <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
                    <strong>Duplicate Record Detected!</strong> An educational record for this person at the selected level already exists. Each person may only have one record per education level (Elementary, High School, College).
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>

                <form method="POST" action="add.php" id="addForm">

                    <div class="mb-5">
                        <h5 class="fw-bold border-bottom pb-2 mb-4 text-danger">Education Details</h5>

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
                                <label class="form-label fw-semibold">Level *</label>
                                <select name="level" class="form-control rounded-3" required>
                                    <option value="">Select Level</option>
                                    <option value="Elementary">Elementary</option>
                                    <option value="Highschool">Highschool</option>
                                    <option value="College">College</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">School Name *</label>
                                <input type="text" class="form-control rounded-3" name="school_name" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Course</label>
                                <input type="text" class="form-control rounded-3" name="course">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Year of Passing *</label>
                                <input type="number" class="form-control rounded-3" name="year_passing" required>
                            </div>

                        </div>
                    </div>

                    <div class="text-left mt-4">
                        <button type="submit" name="add" class="btn btn-danger px-5 py-2 rounded-pill me-2 text-white">
                            Submit
                        </button>

                        <button type="reset" class="btn btn-outline-danger px-5 py-2 rounded-pill">
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
    // Warn if same person+level is selected
    const personSel = document.querySelector('[name="personal_id"]');
    const levelSel  = document.querySelector('[name="level"]');

    const dupWarning = document.createElement('div');
    dupWarning.className = 'alert alert-warning rounded-3 mt-2 d-none';
    dupWarning.id = 'dupWarn';
    dupWarning.innerHTML = '<strong>Heads up!</strong> This person may already have a record at this education level. The form will be blocked if a duplicate is found upon submission.';

    levelSel.closest('.col-md-6').appendChild(dupWarning);

    [personSel, levelSel].forEach(el => el.addEventListener('change', checkDuplicate));

    function checkDuplicate(){
        const show = personSel.value !== '' && levelSel.value !== '';
        document.getElementById('dupWarn').classList.toggle('d-none', !show);
    }
    </script>
</body>