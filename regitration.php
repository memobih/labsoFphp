<?php
require_once "auth.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registration - ITI System</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="list.php text-primary">ITI System</a>
        <div class="d-flex align-items-center">
            <?php if (isLoggedIn()): ?>
                <span class="text-light me-3">Welcome, <strong><?= htmlspecialchars(getLoggedInUser()) ?></strong></span>
                <a href="logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-outline-light btn-sm">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-start mb-3">
                    <a href="list.php" class="text-decoration-none">&larr; Back to List</a>
                </div>

                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">User Registration Form</h4>
                    </div>

                    <div class="card-body">

                        <form action="done.php" method="post" enctype="multipart/form-data">

                            <!-- First & Last Name -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">First Name</label>
                                    <input type="text" name="fname" id="fname" class="form-control" required>
                                    <div class="invalid-feedback" id="fname_error"></div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" name="lname" id="lname" class="form-control" required>
                                    <div class="invalid-feedback" id="lname_error"></div>
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" id="address" class="form-control" rows="3"></textarea>
                                <div class="invalid-feedback" id="address_error"></div>
                            </div>

                            <!-- Country -->
                            <div class="mb-3">
                                <label class="form-label">Country</label>
                                <select name="country" id="country" class="form-select">
                                    <option value="">Select Country</option>
                                    <option value="Egypt">Egypt</option>
                                    <option value="USA">USA</option>
                                </select>
                                <div class="invalid-feedback" id="country_error"></div>
                            </div>

                            <!-- Gender -->
                            <div class="mb-3">
                                <label class="form-label d-block">Gender</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gender_male"
                                        value="Male">
                                    <label class="form-check-label">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gender_female"
                                        value="Female">
                                    <label class="form-check-label">Female</label>
                                </div>
                            </div>

                            <!-- Skills -->
                            <div class="mb-3">
                                <label class="form-label d-block">Skills</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="skills[]" id="skill_php"
                                        value="PHP">
                                    <label class="form-check-label">PHP</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="skills[]" id="skill_mysql"
                                        value="MySQL">
                                    <label class="form-check-label">MySQL</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="skills[]" id="skill_j2se"
                                        value="J2SE">
                                    <label class="form-check-label">J2SE</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="skills[]" id="skill_pgsql"
                                        value="PostgreSQL">
                                    <label class="form-check-label">PostgreSQL</label>
                                </div>
                            </div>

                            <!-- Username & Password -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="username" id="username" class="form-control" required>
                                    <div class="invalid-feedback" id="username_error"></div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" required>
                                    <div class="invalid-feedback" id="password_error"></div>
                                </div>
                            </div>

                            <!-- Department -->
                            <div class="mb-3">
                                <label class="form-label">Department</label>
                                <input type="text" name="department" id="department" value="OpenSource"
                                    class="form-control" readonly>
                            </div>

                            <!-- Verification Code -->
                            <?php $code = rand(10000, 99999); ?>

                            <div class="alert alert-secondary">
                                <strong>Verification Code:</strong> <?php echo $code; ?>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Please insert the code above</label>
                                <input type="text" name="user_code" id="user_code" class="form-control" required>
                                <div class="invalid-feedback" id="user_code_error"></div>
                                <input type="hidden" name="real_code" value="<?php echo $code; ?>">
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between">
                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                <input type="hidden" name="MAX_FILE_SIZE" value="2097152">
                                <div class="mb-3">
                                    <label class="form-label" for="profile_pic">Profile Picture</label>
                                    <input type="file" name="profile_pic" id="profile_pic" class="form-control"
                                        accept="image/jpeg,image/png">
                                    <div class="invalid-feedback" id="profile_pic_error"></div>
                                </div>
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
    <script src="validation.js"></script>

</body>

</html>