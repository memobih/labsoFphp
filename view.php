<?php
$data = json_decode(file_get_contents("data.json"), true);
$id = $_GET['id'];

$user = $data[$id];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Details</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">User Details</h4>
                </div>

                <div class="card-body">

                    <ul class="list-group list-group-flush">

                        <li class="list-group-item">
                            <strong>Name:</strong>
                            <?= $user['fname'] . " " . $user['lname'] ?>
                        </li>

                        <li class="list-group-item">
                            <strong>Address:</strong>
                            <?= $user['address'] ?>
                        </li>

                        <li class="list-group-item">
                            <strong>Country:</strong>
                            <?= $user['country'] ?>
                        </li>

                        <li class="list-group-item">
                            <strong>Gender:</strong>
                            <?= $user['gender'] ?>
                        </li>

                        <li class="list-group-item">
                            <strong>Skills:</strong>
                            <?= !empty($user['skills']) ? implode(", ", $user['skills']) : "No skills selected" ?>
                        </li>

                        <li class="list-group-item">
                            <strong>Username:</strong>
                            <?= $user['username'] ?>
                        </li>

                        <li class="list-group-item">
                            <strong>Department:</strong>
                            <?= $user['department'] ?>
                        </li>

                    </ul>

                    <div class="mt-4 text-end">
                        <a href="list.php" class="btn btn-secondary">Back</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>