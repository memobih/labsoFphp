<?php
$data = json_decode(file_get_contents("data.json"), true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Users</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">All Registered Users</h2>
        <a href="regitration.php" class="btn btn-primary">+ Add New User</a>
    </div>

    <div class="card shadow">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Country</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($data)): ?>
                            <?php foreach($data as $index => $user): ?>
                            <tr>
                                <td><?= $index ?></td>
                                <td><?= $user['fname'] . " " . $user['lname'] ?></td>
                                <td><?= $user['country'] ?></td>
                                <td>
                                    <a href="view.php?id=<?= $index ?>" class="btn btn-info btn-sm">View</a>
                                    <a href="edit.php?id=<?= $index ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="delete.php?id=<?= $index ?>" class="btn btn-danger btn-sm"
                                       onclick="return confirm('Are you sure you want to delete this user?');">
                                       Delete
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-muted">No users found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>