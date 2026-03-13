<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User - ITI System</title>
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

            <div class="card shadow">
                <div class="card-header bg-warning">
                    <h4 class="mb-0">Edit User</h4>
                </div>

                <div class="card-body">
                    <form action="index.php?controller=user&action=edit&id=<?= htmlspecialchars($user['id']) ?>" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">

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
                            <input type="text" name="username" id="username"
                                   value="<?= htmlspecialchars($user['username']) ?>" 
                                   class="form-control" required>
                            <div class="invalid-feedback" id="username_error"></div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Department</label>
                            <input type="text" name="department" id="department"
                                   value="<?= htmlspecialchars($user['department']) ?>" 
                                   class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" id="password"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label d-block">Profile Picture</label>
                            <?php if ($user['profile_pic']): ?>
                                <img src="<?= htmlspecialchars($user['profile_pic']) ?>" class="rounded shadow-sm mb-2" width="80" height="80" style="object-fit: cover;">
                            <?php endif; ?>
                            <input type="file" name="profile_pic" id="profile_pic" class="form-control" accept="image/jpeg,image/png">
                            <div class="invalid-feedback" id="profile_pic_error"></div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="index.php?controller=user&action=index" class="btn btn-secondary">Cancel</a>
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
<script src="validation.js"></script>
</body>
</html>
