<?php
require_once "../connections/db_connect5.php";
require_once "Record.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Record</title>
    <link rel="stylesheet" href="./style/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style/style-custom/style.css">
</head>

<body class="bg-light" style="font-family: 'Roboto', sans-serif;">

    <div class="container py-5">
        <div class="card border-0 shadow-lg rounded-4 mx-auto" style="max-width: 1100px;">
            <div class="card-body p-4 p-md-5">

                <div class="text-center mb-4">
                    <h2 class="fw-bold">Individual Information Sheet</h2>
                    <p class="text-muted mb-0">Please fill out all required fields</p>
                </div>

                <?php if (isset($_GET['error']) && $_GET['error'] === 'duplicate'): ?>
                <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
                    <strong>Duplicate Record Detected!</strong> A person with the same First Name, Last Name, and Date of Birth already exists in the system. Please verify the information before submitting.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>

                <form method="POST" action="add.php" id="addForm">

                    <div class="mb-5">
                        <h5 class="fw-bold border-bottom pb-2 mb-4">Personal Details</h5>
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Last Name *</label>
                                <input type="text" class="form-control rounded-3" name="Last_name"
                                    placeholder="Ex: Dela Cruz" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">First Name *</label>
                                <input type="text" class="form-control rounded-3" name="First_name"
                                    placeholder="Ex: Juan" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Middle Name *</label>
                                <input type="text" class="form-control rounded-3" name="Middle_name"
                                    placeholder="Ex: Marquez" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Suffix</label>
                                <input type="text" class="form-control rounded-3" name="Suffix"
                                    placeholder="Ex: Jr. / Sr. / III.">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Date of Birth *</label>
                                <input type="date" class="form-control rounded-3" name="DOB" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Gender *</label>
                                <input type="text" class="form-control rounded-3" name="Gender" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <h5 class="fw-bold border-bottom pb-2 mb-4">Contact Information</h5>
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Mobile Number *</label>
                                <input type="text" class="form-control rounded-3" name="Mobile_number"
                                    placeholder="Ex: 09123456789" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email Address *</label>
                                <input type="text" class="form-control rounded-3" name="Email_address"
                                    placeholder="Ex: samplemail@gmail.com" required>
                            </div>

                        </div>
                    </div>

                    <div class="mb-5">
                        <h5 class="fw-bold border-bottom pb-2 mb-4">Address</h5>
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Street *</label>
                                <input class="form-control rounded-3" name="Street" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Barangay *</label>
                                <input class="form-control rounded-3" name="Barangay" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">City/Municipality *</label>
                                <input class="form-control rounded-3" name="City" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Province *</label>
                                <input class="form-control rounded-3" name="Province" required>
                            </div>

                        </div>
                    </div>

                    <div class="mb-5">
                        <h5 class="fw-bold border-bottom pb-2 mb-4">Other Details</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Languages Known *</label>
                                <input type="text" class="form-control rounded-3" name="Languages" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Marital Status *</label>
                                <input type="text" class="form-control rounded-3" name="Marital_status" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Religion *</label>
                                <input type="text" class="form-control rounded-3" name="Religion" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Hobbies *</label>
                                <input type="text" class="form-control rounded-3" name="Hobbies" required>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" name="add" class="btn btn-primary px-5 py-2 rounded-pill me-2">
                            Submit
                        </button>
                        <button type="reset" class="btn btn-outline-secondary px-5 py-2 rounded-pill">
                            Reset
                        </button>
                    </div>

                </form>

                <div class="text-center mt-4">
                    <a href="index.php" class="fw-semibold text-decoration-none">
                        Return to Records
                    </a>
                </div>

            </div>
        </div>
    </div>

    <script>
    // Inline duplicate warning: highlight if name+DOB combo looks already filled
    const warnFields = ['Last_name','First_name','DOB'];
    const dupWarning = document.createElement('div');
    dupWarning.className = 'alert alert-warning rounded-3 mt-2 d-none';
    dupWarning.id = 'dupWarn';
    dupWarning.innerHTML = '<strong>Heads up!</strong> Please double-check that this person is not already registered before submitting.';

    document.querySelector('form').insertBefore(dupWarning, document.querySelector('[name="add"]').closest('.text-center'));

    warnFields.forEach(f => {
        const el = document.querySelector('[name="'+f+'"]');
        if(el) el.addEventListener('blur', checkAllFilled);
    });

    function checkAllFilled(){
        const allFilled = warnFields.every(f => document.querySelector('[name="'+f+'"]')?.value.trim() !== '');
        document.getElementById('dupWarn').classList.toggle('d-none', !allFilled);
    }
    </script>
</body>

</html>