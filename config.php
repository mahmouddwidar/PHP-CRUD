<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'day4';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);

if(!$conn) {
    die("Coouldn't Connect: ".mysqli_error($conn));
}
?>