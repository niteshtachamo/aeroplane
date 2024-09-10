<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_shop";
$conn = mysqli_connect($servername, $username, $password, $database);
;
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    // echo "<script>console.log('Connected Successfully')</script>";
}
?>