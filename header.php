<?php

@session_start();
include('include/connect_db.php');
$user_name = isset($_SESSION['cmrName']) ? $_SESSION['cmrName'] : null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>avilax</title>
    <link rel="stylesheet" href="http://localhost/aeroplane/css/bootstrap.css">
    <link rel="stylesheet" href="http://localhost/aeroplane/css/all.css">
    <link rel="stylesheet" href="http://localhost/aeroplane/css/animate.css">
    <link rel="stylesheet" href="http://localhost/aeroplane/css/splide.min.css">
    <link rel="stylesheet" href="http://localhost/aeroplane/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap"
        rel="stylesheet">

</head>

<body>
    <header class="site-header">
        <div class="top-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-3">
                        <div class="site-logo">
                            <a href="http://localhost/aeroplane/index.php" title="">
                                <img src="./image/logomero.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="search_box">
                            <form class="searchForm" action="http://localhost/aeroplane/search.php" method="get">
                                <div class="form-wrap position-relative">
                                    <div class="form-group">
                                        <label for="search-product" class="sr-only">Search Products</label>
                                        <input name="search_keyword" class="searchInput" type="search"
                                            placeholder="Search for Products">
                                        <div id="suggestionsList" class="suggestions-list"></div>

                                    </div>
                                    <div class="form-group submit">
                                        <input type="submit" value="Submit" name="search_product">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="header-right">
                            <div class="shopping_cart">
                                <div class="cart">
                                    <a href="http://localhost/aeroplane/cart.php" title="View my shopping cart">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="login">
                                <?php
                                if (!$user_name) {
                                    echo "<a href='http://localhost/aeroplane/user/login.php' class='btn-box primary-btn'>Login</a>";
                                } else {
                                    echo "<a href='http://localhost/aeroplane/user/logout.php' class='btn-box primary-btn'>Logout</a>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-header">
            <nav>
                <div class="container">
                    <div class="nav-bar">
                        <ul class="primary-menu">
                            <li>
                                <a href="http://localhost/aeroplane/index.php" title="">Home</a>
                            </li>
                            <li>
                                <a href="http://localhost/aeroplane/product.php" title="">Our product</a>
                            </li>
                            <?php
                            if ($user_name) {
                                echo "<li><a href='http://localhost/aeroplane/user/profile.php' title=''>Profile</a></li>";
                            }
                            ?>
                            <li>
                                <a href="http://localhost/aeroplane/contact.php" title="">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>