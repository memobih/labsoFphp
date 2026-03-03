<?php
$data = json_decode(file_get_contents("data.json"), true);
$id = $_GET['id'];
$user = $data[$id];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>

    <!-- Bootstrap 5 -->
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

                        <input type="hidden" name="id" value="<?= $id ?>">

                        <!-- First & Last Name -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" name="fname" 
                                       value="<?= $user['fname'] ?>" 
                                       class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="lname" 
                                       value="<?= $user['lname'] ?>" 
                                       class="form-control" required>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="address" 
                                      class="form-control" 
                                      rows="3"><?= $user['address'] ?></textarea>
                        </div>

                        <!-- Country -->
                        <div class="mb-3">
                            <label class="form-label">Country</label>
                            <input type="text" name="country" 
                                   value="<?= $user['country'] ?>" 
                                   class="form-control">
                        </div>

                        <!-- Username -->
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" 
                                   value="<?= $user['username'] ?>" 
                                   class="form-control" required>
                        </div>

                        <!-- Buttons -->
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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>