<?php
include ('../header.php');
include ("../include/connect_db.php");
@session_start();

// Check if the user is logged in and has a name set in the session
if (!isset($_SESSION['cmrName'])) {
    echo "User not logged in or no name set.";
    exit();
}

// Fetch user details from the session
$username = $_SESSION['cmrName'];

?>

<section class="section-gaps profile-section">
    <div class="container">
        <div class="row">
            <div class="col-3">
                <ul class="navbar-nav shadow p-3">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <h4 class="title">Your Profile</h4>
                        </a>
                    </li>

                    <?php
                    // Fetch user image from the database
                    $user_image_query = "SELECT * FROM `tbl_customer` WHERE Name = '$username'";
                    $result_image = mysqli_query($conn, $user_image_query);
                    
                    // Check if a valid result was returned
                    if ($result_image && mysqli_num_rows($result_image) > 0) {
                        $row_image = mysqli_fetch_array($result_image);
                        $user_image = $row_image['user_image'];

                        echo "
                        <li class='nav-item'>
                            <div class='image user-image'>
                                <img src='./user_image/$user_image' alt='$username'>
                            </div>
                        </li>";
                    } else {
                        // Handle case where the user image is not found
                        echo "<li class='nav-item'>User image not found.</li>";
                    }
                    ?>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php?edit_account"><span>Edit account</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php?user_order"><span>My order</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php?delete_account"><span>Delete account</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><span>Log out</span></a>
                    </li>
                </ul>
            </div>
            <div class="col-9">
                <?php
                // Display the correct section based on the query parameter
                if (isset($_GET['edit_account'])) {
                    include ('edit_account.php');
                } else if (isset($_GET['user_order'])) {
                    include ('user_order.php');
                } else if (isset($_GET['delete_account'])) {
                    include ('delete_account.php');
                } else {
                    echo '<div class="main-title center">';
                    echo '<h1 class="title">Welcome to your profile, ' . htmlspecialchars($username, ENT_QUOTES, 'UTF-8') . '</h1>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</section>

<?php include ("../footer.php"); ?>
