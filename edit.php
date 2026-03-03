<?php
include "db.php";
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow">
                <div class="card-header bg-warning">
                    <h4 class="mb-0">Edit User</h4>
                </div>

                <div class="card-body">

                    <form action="update.php" method="POST">

                        <input type="hidden" name="id" value="<?= $user['id'] ?>">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" name="fname" 
                                       value="<?= htmlspecialchars($user['fname']) ?>" 
                                       class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="lname" 
                                       value="<?= htmlspecialchars($user['lname']) ?>" 
                                       class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="address" 
                                      class="form-control" 
                                      rows="3"><?= htmlspecialchars($user['address']) ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Country</label>
                            <input type="text" name="country" 
                                   value="<?= htmlspecialchars($user['country']) ?>" 
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" 
                                   value="<?= htmlspecialchars($user['username']) ?>" 
                                   class="form-control" required>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="list.php" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-success">
                                Update User
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>