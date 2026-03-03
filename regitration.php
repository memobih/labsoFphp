<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">User Registration Form</h4>
                </div>

                <div class="card-body">

                    <form action="done.php" method="post">

                        <!-- First & Last Name -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" name="fname" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="lname" class="form-control" required>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control" rows="3"></textarea>
                        </div>

                        <!-- Country -->
                        <div class="mb-3">
                            <label class="form-label">Country</label>
                            <select name="country" class="form-select">
                                <option value="">Select Country</option>
                                <option value="Egypt">Egypt</option>
                                <option value="USA">USA</option>
                            </select>
                        </div>

                        <!-- Gender -->
                        <div class="mb-3">
                            <label class="form-label d-block">Gender</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="Male">
                                <label class="form-check-label">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="Female">
                                <label class="form-check-label">Female</label>
                            </div>
                        </div>

                        <!-- Skills -->
                        <div class="mb-3">
                            <label class="form-label d-block">Skills</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="skills[]" value="PHP">
                                <label class="form-check-label">PHP</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="skills[]" value="MySQL">
                                <label class="form-check-label">MySQL</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="skills[]" value="J2SE">
                                <label class="form-check-label">J2SE</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="skills[]" value="PostgreSQL">
                                <label class="form-check-label">PostgreSQL</label>
                            </div>
                        </div>

                        <!-- Username & Password -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>

                        <!-- Department -->
                        <div class="mb-3">
                            <label class="form-label">Department</label>
                            <input type="text" name="department" value="OpenSource" 
                                   class="form-control" readonly>
                        </div>

                        <!-- Verification Code -->
                        <?php $code = rand(10000,99999); ?>

                        <div class="alert alert-secondary">
                            <strong>Verification Code:</strong> <?php echo $code; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Please insert the code above</label>
                            <input type="text" name="user_code" class="form-control" required>
                            <input type="hidden" name="real_code" value="<?php echo $code; ?>">
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>