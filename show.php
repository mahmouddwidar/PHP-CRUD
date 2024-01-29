<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./npm/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./npm/node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <title>Users Details</title>
    <style>
        i:hover {
            color: #3f51b5 !important;
        }
    </style>
</head>
<body>
    <div class="row w-75 mx-auto">
        <div class="container d-flex justify-content-between p-4">
            <p class="h2 d-inline">Users Details</p>
            <a href="index.php" class="btn btn-success pt-2"><i class="bi bi-plus-lg"></i> Add New User</a>
        </div>
    </div>
    <script src="./npm/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
include 'config.php';

$selectQuery = "SELECT user_id, user_name, user_email, user_gender, mail_status FROM users";
mysqli_select_db($conn,$dbname);

$result = mysqli_query($conn, $selectQuery);

if(! $result ) {
    die('Could not get data: ' . mysqli_error($conn));
}

if(mysqli_num_rows($result) > 0) {
    echo '
    <table class="table table-striped w-75 mx-auto mb-5">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Gender</th>
        <th scope="col">Mail Status</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
    ';
    while ($row = mysqli_fetch_assoc($result)) {
        echo "
        <tr>
        <th scope='row'>{$row['user_id']}</th>
            <td>{$row['user_name']}</td>
            <td>{$row['user_email']}</td>
            <td>{$row['user_gender']}</td>
            <td>{$row['mail_status']}</td>
        ";
            echo "<td>";
            echo '<a href="read.php?id='. $row['user_id'] .'" class="me-3" title="View Record" data-toggle="tooltip"><i class="bi bi-eye-fill" style="color:blue;"></i></a>';
            echo '<a href="index.php?id='. $row['user_id'] .'" class="me-3" title="Update Record" data-toggle="tooltip"><i class="bi bi-pencil-square" style="color:blue;"></i></a>';
            echo '<a href="delete.php?id='. $row['user_id'] .'" title="Delete Record" data-toggle="tooltip"><i class="bi bi-trash" style="color:blue;"></i></a>';
            echo "</td>";
        echo "</tr>";
    }
    echo "
    </tbody>
    </table>";
} else {
    echo "<h2 class='mx-auto w-25 text-center mt-5'>0 results</h2>";
}
?>