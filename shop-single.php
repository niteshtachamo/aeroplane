<?php 
include('header.php');
include('include/connect_db.php');

if (isset($_POST["shop_single_add_to_cart"])) {
    if (!isset($_SESSION["cmrId"])) {
        echo "<script>alert('Please log in to add items to the cart');</script>";
        echo "<script>window.open('./user/login.php','_self');</script>";
        exit();
    }

    $get_product_id = mysqli_real_escape_string($conn, $_GET['id']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $userid = mysqli_real_escape_string($conn, $_SESSION["cmrId"]);

    // Check if the product is already in the user's cart
    $sql = "SELECT * FROM tbl_cart WHERE cmrId = '$userid' AND productId = '$get_product_id'";
    $result = mysqli_query($conn, $sql);
    $num_of_rows = mysqli_num_rows($result);

    // Retrieve product details from the database
    $product_in_store = 0;
    $product_name = '';
    $product_image = '';
    $product_price = 0;

    $query_store = "SELECT product_in_store, productName, image, price FROM tbl_product WHERE productId = '$get_product_id'";
    $result_store = mysqli_query($conn, $query_store);
    if ($row_store = mysqli_fetch_assoc($result_store)) {
        $product_in_store = $row_store['product_in_store'];
        $product_name = $row_store['productName'];
        $product_image = $row_store['image'];
        $product_price = $row_store['price'];
    }

    if ($num_of_rows > 0) {
        echo "<script>alert('Item already in cart');</script>";
    } else {
        if ($quantity > $product_in_store) {
            echo "<script>alert('You have exceeded the quantity in store');</script>";
        } else {
            // Insert into cart table
            $insert_query = "INSERT INTO tbl_cart (cmrId, productId, productName, image, price, quantity) VALUES ('$userid', '$get_product_id', '$product_name', '$product_image', '$product_price', '$quantity')";
            $result_query = mysqli_query($conn, $insert_query);

            if ($result_query) {
                echo "<script>alert('Item added to cart successfully');</script>";
            } else {
                echo "<script>alert('Error adding item to cart');</script>";
            }
        }
    }
}

if (isset($_GET['id'])) {
    $product_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch product details
    $sql_query = "SELECT tbl_product.*, tbl_brand.brandName, tbl_category.catName 
                  FROM tbl_product 
                  INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
                  INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
                  WHERE tbl_product.productId = '$product_id'";

    $result = mysqli_query($conn, $sql_query);
    if ($row = mysqli_fetch_assoc($result)) {
        $product_id = $row['productId'];
        $product_name = $row['productName'];
        $product_description = $row['body'];
        $product_price = $row['price'];
        $product_image = $row['image'];
        $brand_name = $row['brandName'];
        $cat_name = $row["catName"];
        $product_in_store = $row['product_in_store'];
    } else {
        echo "<p>Product not found.</p>";
        exit();
    }
}
?>
<!-- header -->

<section class="product-detail-section section-gaps">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="product-image">
                    <img src='<?php echo $product_image; ?>' class="img-cover" alt='<?php echo $product_name; ?>'>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-details">
                    <h1 class="title"><?php echo $product_name; ?></h1>
                    <div class='price-tag'>
                        <ins><span class='price-symbol'>Rs.</span><span><?php echo $product_price; ?></span></ins>
                    </div>
                    <div class="cat">
                        <p>Category: <span><?php echo $cat_name; ?></span></p>
                    </div>
                    <div class="brand">
                        <p>Brand: <span><?php echo $brand_name; ?></span></p>
                    </div>
                    <div class='product-price-input product-box-list'>
                        <form action='' method='post'>
                            <?php
                            if ($product_in_store <= 0) {
                                echo "<span class='out-of-stock'>Out of stock</span>";
                            } else {
                                echo "<div class='product-number position-relative d-flex'>
                                        <div class='d-xl-none product-btn plus'>+</div>
                                        <input type='number' name='quantity' min='1' max='{$product_in_store}' value='1' class='quantity-product'>
                                        <div class='d-xl-none product-btn minus'>-</div>
                                      </div>
                                      <input type='submit' name='shop_single_add_to_cart' value='ADD TO CART' class='read-more'>";
                            }
                            ?>
                        </form>
                    </div>
                    <hr>
                    <div class="product-desc">
                        <h2>Product Details</h2>
                        <p><?php echo $product_description; ?></p>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- footer -->
<?php 
include('footer.php');
?>
