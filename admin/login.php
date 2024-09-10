<?php
// Start session
session_start();

// Handle login
if (isset($_POST['login'])) {
    include('../include/connect_db.php'); // Database connection file
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if the admin exists
    $query = "SELECT * FROM tbl_admin WHERE adminEmail = '$email'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Verify password
        if ($password == $row['adminPassword']) {
            $_SESSION['adminname'] = $email;
            header('Location: index.php'); // Redirect to dashboard
        } else {
            $msg = "Incorrect password!";
        }
    } else {
        $msg = "Username not found!";
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style1.css"> <!-- Link to your CSS file -->
</head>
<body>
    <section class="login-section">
        <div class="container">
            <div class="login-form">
                <h2>Admin Login</h2>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="login" value="Login">
                    </div>
                    <?php if (isset($msg)) echo "<p class='error-msg'>$msg</p>"; ?>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
