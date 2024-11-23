<?php
@session_start();
include('../include/connect_db.php');

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($email) || empty($password)) {
        $msg = "<span class='error'>Fields must not be empty!</span>";
    } else {
        // Fetch user details based on email and password
        $query = "SELECT * FROM tbl_customer WHERE email = '$email' AND pass = '$password'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        $row = mysqli_num_rows($result);

        if ($row > 0) {
            $row_data = mysqli_fetch_assoc($result);

            if ($row_data['email_verified']) { // Check if email is verified
                $_SESSION['cuslogin'] = true;
                $_SESSION['cmrId'] = $row_data['id'];
                $_SESSION['cmrName'] = $row_data['name'];

                echo "<script>alert('Login successfully')</script>";
                echo "<script>window.open('profile.php','_self')</script>";
            } else {
                echo "<script>alert('Please verify your email before logging in')</script>";
                echo "<script>window.open('login.php','_self')</script>";
            }
        } else {
            $msg = "<span class='error'>Email or Password not matched!</span>";
        }
    }
}
include('../header.php');
?>



<section class="login-section section-gaps">
    <div class="container">
        <div class="w-50 m-auto">
            <form action="" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required class="form-control">
                </div>
                <div class="form-group d-flex align-items-center gap-3">
                    <input type="submit" name="login" value="Login" class="w-25 btn btn-primary">
                    <button class="btn btn-warning text-capitalize"><a href="verify_email.php">verify email</a></button>
                </div>
                <?php if (isset($msg)) echo $msg; ?>
            </form>
            <div class="text-center mt-3">
                <p>Don't have an account? <a href="user_registration.php">Register here</a></p>
            </div>
        </div>
    </div>
</section>


<?php 
include('../footer.php');
?>
