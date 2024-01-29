<?php
if(isset($_GET["id"]) && !empty($_GET["id"])) {
    $id = trim($_GET['id']);
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'day4';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);

    if(!$conn) {
        die("Coouldn't Connect: ".mysqli_error($conn));
    }

    mysqli_select_db($conn, $dbname);
    
    $deleteQuery = "DELETE FROM users WHERE user_id = ?";

    if($stmt = mysqli_prepare($conn, $deleteQuery)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

} else {
    echo "Error: There's no ID";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./npm/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Delete User</title>
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="card p-0">
            <div class="card-header bg-warning">
                Delete User
            </div>
            <div class="card-body">
                <h5 class="card-title">Are You Sure?</h5>
                <p class="card-text">You will delete user with id = <?php echo $id;?></p>
                <a href="show.php" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
<script src="./npm/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>