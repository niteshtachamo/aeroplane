<?php
@session_start();
include ('../header.php');
include ("../include/connect_db.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';


// Function to generate a random verification code
function generateVerificationCode()
{
    return rand(100000, 999999); // Generates a 6-digit code
}

// Create a new instance of the PHPMailer class
$mail = new PHPMailer();

// Set up SMTP configuration
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'alishpawn00@gmail.com';
$mail->Password = 'lupfmoliqmhqwumu';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$errors = []; // Define an empty array to store errors

if (isset($_POST['user_register'])) {
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $conform_user_password = isset($_POST['conform_user_password']) ? $_POST['conform_user_password'] : '';
    $user_address = $_POST['user_address'];
    $user_phone = $_POST['user_contact'];

    // Check if email already exists
    $existing_email_query = "SELECT * FROM tbl_customer WHERE email = '$user_email'";
    $existing_email_result = mysqli_query($conn, $existing_email_query);
    if (mysqli_num_rows($existing_email_result) > 0) {
        // Email already exists, display error message
        echo "<script>alert('Email is already registered. Please use a different email address.')</script>";
    } else {    
        $verification_code = generateVerificationCode();
        // Handle file upload
        if (!empty($_FILES['user_image']['name'])) {
            $user_image = $_FILES['user_image']['name'];
            $user_image_temp = $_FILES['user_image']['tmp_name'];
            $target_path = "./user_image/$user_image";
            move_uploaded_file($user_image_temp, $target_path);
        } else {
            $user_image = ""; // Set default value if no image is uploaded
        }

        // Insert the user data into the database
        $insert_query = "INSERT INTO `tbl_customer`(`name`, `email`, `pass`, `user_image`, `address`, `phone`, `verification_code`) 
                         VALUES ('$user_name', '$user_email', '$user_password', '$user_image', '$user_address', '$user_phone', '$verification_code')";
        $result = mysqli_query($conn, $insert_query);

        if ($result) {
            $mail->setFrom('alishpawn00@gmail.com', 'Newari shop');
            $mail->addAddress($user_email, $user_name);
            $mail->Subject = 'Verify your email address for registration';
            $mail->isHTML(true);
            $mail->Body = "Please use the following verification code to verify your email address: <strong>$verification_code</strong><br>Enter the code on the following page: <a href='http://localhost/aeroplane/user/verify_email_click.php?code=$verification_code'>Verify Email</a>";

            if (!$mail->send()) {
                // Display error message if email sending fails
                echo "<script>alert('Failed to send verification email.')</script>";
            } else {
                // Display success message if email sending succeeds
                echo "<script>alert('Registration successful. Please check your email to verify your account.')</script>";
                echo "<script>window.open('verify_email.php', '_self')</script>";
            }
        } else {
            echo "<script>alert('Failed to register user.')</script>";
        }
    }
}
?>

<section class="login-user section-gaps">
    <div class="container">
        <h4 class="heading">New Registration Form</h4>
        <form id="registrationForm" action="" method="post" enctype="multipart/form-data">
            <div class="row pb-5">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="user_name">Username <span class="required">*</span></label>
                        <input type="text" id="user_name" name="user_name" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="user_email">Email <span class="required">*</span></label>
                        <input type="email" id="user_email" name="user_email" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="user_image">Profile Image (optional)</label>
                        <input type="file" id="user_image" name="user_image" class="form-input form-control">
                    </div>
                    <div class="form-group">
                        <label for="user_password">Password <span class="required">*</span></label>
                        <input type="password" id="user_password" name="user_password" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="conform_user_password">Confirm Password <span class="required">*</span></label>
                        <input type="password" id="conform_user_password" name="conform_user_password" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="user_address">Address <span class="required">*</span></label>
                        <input type="text" id="user_address" name="user_address" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="user_contact">Phone <span class="required">*</span></label>
                        <input type="tel" id="user_contact" name="user_contact" class="form-input" required>
                    </div>
                    <div>
                        <input type="submit" value="Register" class="btn btn-primary" name="user_register">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="login.php" class="text-danger">Login</a></p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<?php include ('../footer.php'); ?>
