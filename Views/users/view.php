<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Details - ITI System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-start mb-3">
                <a href="index.php?controller=user&action=index" class="text-decoration-none">&larr; Back to List</a>
            </div>

            <div class="card-body text-center">
                <div class="mb-4">
                    <?php if ($user['profile_pic']): ?>
                        <img src="<?= htmlspecialchars($user['profile_pic']) ?>" class="rounded-circle shadow" width="120"
                            height="120" style="object-fit: cover; border: 4px solid #fff;">
                    <?php else: ?>
                        <div class="rounded-circle bg-secondary d-inline-block text-white shadow"
                            style="width: 120px; height: 120px; line-height: 120px; font-size: 3rem;">?</div>
                    <?php endif; ?>
                </div>
                <h3 class="fw-bold"><?= htmlspecialchars($user['fname'] . " " . $user['lname']) ?></h3>
                <p class="text-muted">@<?= htmlspecialchars($user['username']) ?></p>
                <hr>
                <div class="text-start">

                    <ul class="list-group list-group-flush">

                        <li class="list-group-item">
                            <strong>Name:</strong>
                            <?= htmlspecialchars($user['fname'] . " " . $user['lname']) ?>
                        </li>

                        <li class="list-group-item">
                            <strong>Address:</strong>
                            <?= htmlspecialchars($user['address']) ?>
                        </li>

                        <li class="list-group-item">
                            <strong>Country:</strong>
                            <?= htmlspecialchars($user['country']) ?>
                        </li>

                        <li class="list-group-item">
                            <strong>Gender:</strong>
                            <?= htmlspecialchars($user['gender']) ?>
                        </li>

                        <li class="list-group-item">
                            <strong>Skills:</strong>
                            <?= !empty($user['skills']) ? htmlspecialchars($user['skills']) : "No skills selected" ?>
                        </li>

                        <li class="list-group-item">
                            <strong>Username:</strong>
                            <?= htmlspecialchars($user['username']) ?>
                        </li>

                        <li class="list-group-item">
                            <strong>Department:</strong>
                            <?= htmlspecialchars($user['department']) ?>
                        </li>

                    </ul>

                </div>

                <div class="mt-4 text-center">
                    <a href="index.php?controller=user&action=edit&id=<?= htmlspecialchars($user['id']) ?>" class="btn btn-warning px-4">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
