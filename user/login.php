<?php
// Start the session and include necessary files
include('../include/connect_db.php');

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($email) || empty($password)) {
        $msg = "<span class='error'>Fields must not be empty!</span>";
    } else {
        $query = "SELECT * FROM tbl_customer WHERE email = '$email' AND pass = '$password'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $value = mysqli_fetch_assoc($result);
            session_start();
            $_SESSION['cuslogin'] = true;
            $_SESSION['cmrId'] = $value['id'];
            $_SESSION['cmrName'] = $value['name'];

            // Redirect before any output
            header("Location: http://localhost/aeroplane/user/profile.php");
            exit();
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
                <div class="form-group">
                    <input type="submit" name="login" value="Login" class="btn btn-primary">
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
