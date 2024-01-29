<?php
include 'config.php';

$createDbQuery = "CREATE DATABASE IF NOT EXISTS $dbname";
$createRetval = mysqli_query($conn, $createDbQuery);

if (!$createRetval) {
    die('Could not create database: ' . mysqli_error($conn));
}

mysqli_select_db($conn, $dbname);

$tableDbQuery = "CREATE TABLE IF NOT EXISTS users (user_id INT NOT NULL AUTO_INCREMENT,
user_name VARCHAR(20) NOT NULL,
user_email VARCHAR(50) NOT NULL,
user_gender VARCHAR(1) NOT NULL,
mail_status VARCHAR(20) NOT NULL,
primary key (user_id))";

$tableRetval = mysqli_query($conn, $tableDbQuery );

if(! $tableRetval ) {
    die('Could not create table: ' . mysqli_error($conn));
}

$nameErr = $emailErr = $genderErr = "";
$userName = $userEmail = $userGender = "";
$mailStatus = 'no';

if (empty($_REQUEST["name"])) {
    $nameErr = "Name is required";
} else {
    $userName = trim($_REQUEST["name"]);
}

if(empty($_REQUEST['email'])) {
    $emailErr = "Email is required";
} else {
    $userEmail = trim($_REQUEST['email']);
}

if(empty($_REQUEST['gender'])) {
    $genderErr = "Gender is required";
} else {
    $userGender = trim($_REQUEST['gender']);
}

if(isset($_REQUEST['agree'])) {
    $mailStatus = "yes";
}

// check if update or insert
$sql = '';
if(isset($_GET["id"]) && !empty($_GET["id"])) {
    $id = trim($_GET['id']);
    $sql = "UPDATE users SET user_name='$userName', user_email='$userEmail', user_gender='$userGender', mail_status='$mailStatus' WHERE user_id=$id";

} else {
    $sql = "INSERT INTO users(user_name, user_email, user_gender, mail_status)
                    VALUES ('$userName', '$userEmail', '$userGender', '$mailStatus')";
}

if (isset($_REQUEST['submit'])) {
    if ((isset($_REQUEST['name']) && $_REQUEST['name'] != '') && (isset($_REQUEST['email']) && $_REQUEST['email'] != '') && isset($_REQUEST['gender'])) {
        $insertRetval = mysqli_query($conn, $sql);
        echo "<h5 class='added w-50 shadow mx-auto py-2 px-1 mt-4 text-center'>User Added to Database</h5>";
    
        if(! $insertRetval ) {
            die('Could not insert to table: ' . mysqli_error($conn));
        }
    }
}

if(isset($_GET["id"]) && !empty($_GET["id"])) {
    $userOldData = "SELECT user_name, user_email, user_gender, mail_status FROM users WHERE user_id = $id";
    $userOldResult = mysqli_query($conn, $userOldData);
    $row = mysqli_fetch_assoc($userOldResult);
    $userName = $row["user_name"];
    $userEmail = $row["user_email"];
    $userGender = $row["user_gender"];
    $mailStatus = $row["mail_status"];
    mysqli_close($conn);
    if(!$userOldResult || mysqli_num_rows($userOldResult) != 1) {
        echo "URL doesn't contain valid id parameter";
        exit();
    }
}
?>