<?php 
session_start(); // Ensure session is started

// Check if admin is not logged in
if (!isset($_SESSION['adminname'])) {
    header('Location: login.php'); // Redirect to login page
    exit(); // Ensure no further script execution after the redirect
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="http://localhost/aeroplane/css/bootstrap.css">
    <link rel="stylesheet" href="http://localhost/aeroplane/css/all.css">
    <link rel="stylesheet" href="./style1.css">
</head>

<body>
    <header class="admin-header">
        <div class="logo">
            <a href="index.php">Admin Panel</a>
        </div>
        <nav class="nav-links">
            <ul>
                <li>
                    <a href="index.php">
                        <span class="text">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="text">Insert</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="insert_product.php">Insert Product</a></li>
                        <li><a href="insert_category.php">Insert Categories</a></li>
                        <li><a href="insert_brands.php">Insert brands</a></li>
                    </ul>
                </li>
                <li>
                    <a href="view_products.php">
                        <span class="text">View Products</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="text">Order</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="listorders.php">All Orders</a></li>
                        <li><a href="list_payment.php">All Payments</a></li>
                        <li><a href="list_user.php">List Users</a></li>
                    </ul>
                </li>
                <li>
                    <a href="feedback.php">
                        <span class="text">Feedback</span>
                    </a>
               
        </nav>
        <div class="profile">
            <span class="admin-name">Admin</span>
            <!-- <div class="profile-pic">
                <img src="" alt="Admin">
            </div> -->
            <a href="logout.php" class="logout">Logout</a>
        </div>
    </header>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"
        integrity="sha512-X/YkDZyjTf4wyc2Vy16YGCPHwAY8rZJY+POgokZjQB2mhIRFJCckEGc6YyX9eNsPfn0PzThEuNs+uaomE5CO6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function () {
            // Toggle the submenu on click
            $('.nav-links > ul > li > a').click(function (e) {
                // Prevent default action only for sub-menu toggling
                if ($(this).siblings('.sub-menu').length > 0) {
                    e.preventDefault();
                    var $subMenu = $(this).siblings('.sub-menu');
                    $('.sub-menu').not($subMenu).slideUp(); // Close other open submenus
                    $subMenu.slideToggle();
                }
            });

            // Close the submenu when clicking outside
            $(document).click(function (e) {
                if (!$(e.target).closest('.nav-links').length) {
                    $('.sub-menu').slideUp();
                }
            });
        });
    </script>
</body>

</html>
