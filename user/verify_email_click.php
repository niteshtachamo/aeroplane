<?php
include('../include/connect_db.php');

// Retrieve verification code from URL parameters
$verification_code = $_GET['code'];

// Verify the code against the database
$query = "SELECT * FROM tbl_customer WHERE verification_code = '$verification_code'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    // Update user's email verification status
    $update_query = "UPDATE tbl_customer SET email_verified = 1 WHERE verification_code = '$verification_code'";
    mysqli_query($conn, $update_query);
    echo "Your email has been successfully verified.";
} else {
    echo "Invalid verification code.";
}
?>