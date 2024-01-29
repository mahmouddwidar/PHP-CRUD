<?php
if (isset($_GET['id']) && !empty(trim($_GET['id']))) {
    include 'config.php';

    mysqli_select_db($conn, $dbname );

    $prepareSql = "SELECT user_id, user_name, user_email, user_gender, mail_status FROM users WHERE user_id = ?";

    if($stmt = mysqli_prepare($conn, $prepareSql)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        $param_id = trim($_GET["id"]);

        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                $name = $row["user_name"];
                $email = $row["user_email"];
                $gender = $row["user_gender"];
                $mail = ($row["mail_status"] == "yes") ? "You will recieve e-mail from us" : "You will not recieve e-mail from us";
            } else{
                echo "URL doesn't contain valid id paramete";
                exit();
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    mysqli_stmt_close($stmt);
    
    mysqli_close($conn);

} else {
    echo "Error: no id";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./npm/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>View Record</title>
</head>
<body class=" bg-secondary text-white">
    <div class="container d-flex justify-content-center mt-5">
        <div class="row w-75">
            <p class="h2 mb-4">View Record</p>
            
            <p class="h6">Name</p>
            <p><?php echo $name?></p>

            <p class="h6">Email</p>
            <p><?php echo $email?></p>

            <p class="h6">Gender</p>
            <p><?php echo $gender?></p>

            <p><?php echo $mail?></p>

            <a href="show.php" class="btn btn-primary w-25">Back</a>
        </div>
    </div>
<script src="./npm/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>