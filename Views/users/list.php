<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php?controller=user&action=index">ITI System</a>
        <div class="d-flex align-items-center">
            <span class="text-light me-3">Welcome, <strong><?= htmlspecialchars($loggedInUser) ?></strong></span>
            <a href="index.php?controller=auth&action=logout" class="btn btn-outline-danger btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">All Registered Users</h2>
        <a href="index.php?controller=auth&action=register" class="btn btn-primary d-flex align-items-center">
            <span class="me-2">+</span> Add New User
        </a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Country</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($users) > 0): ?>
                            <?php foreach($users as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars($user['id']) ?></td>
                                <td>
                                    <?php if ($user['profile_pic']): ?>
                                        <img src="<?= htmlspecialchars($user['profile_pic']) ?>" class="rounded-circle" width="40" height="40" style="object-fit: cover; border: 2px solid #ddd;">
                                    <?php else: ?>
                                        <div class="rounded-circle bg-secondary d-inline-block text-white" style="width: 40px; height: 40px; line-height: 40px;">?</div>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($user['fname'] . " " . $user['lname']) ?></td>
                                <td><?= htmlspecialchars($user['country']) ?></td>
                                <td>
                                    <a href="index.php?controller=user&action=show&id=<?= htmlspecialchars($user['id']) ?>" class="btn btn-info btn-sm">View</a>
                                    <a href="index.php?controller=user&action=edit&id=<?= htmlspecialchars($user['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="index.php?controller=user&action=delete&id=<?= htmlspecialchars($user['id']) ?>" class="btn btn-danger btn-sm"
                                       onclick="return confirm('Are you sure you want to delete this user?');">
                                       Delete
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-muted">No users found.</td>
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
