<?php
include ('../header.php');
include ("../include/connect_db.php");

// Check if user_id is set
$user_id = isset($_GET['cmrId']) ? $_GET['cmrId'] : null;

// Initialize variables
$get_ip_address = $_SESSION["cmrId"]; // This is used for both fetching cart and deleting items
$invoice_number = mt_rand();
$status = 'pending';
$total_price = 0;
$total_quantity = 0;

// Calculate total price and count product
$cart_query_price = "SELECT tbl_cart.*, tbl_product.productName, tbl_product.price
                    FROM `tbl_cart` 
                    INNER JOIN tbl_product ON tbl_cart.productId = tbl_product.productId
                    WHERE tbl_cart.cmrId = '$get_ip_address'";
$result_price = mysqli_query($conn, $cart_query_price);

if ($result_price) {
    while ($row_price = mysqli_fetch_assoc($result_price)) {
        $product_id = $row_price['productId'];
        $product_name = $row_price['productName'];
        $quantity = $row_price['quantity'];
        $product_price = $row_price['price'];
        $total_price += $product_price * $quantity;
        $total_quantity += $quantity;

        // Insert individual products into tbl_order
        $insert_orders = "INSERT INTO `tbl_order` (cmrId, productId, productName, quantity, price, date, order_status, invoice_number) 
                          VALUES ('$user_id', '$product_id', '$product_name', '$quantity', '$product_price', NOW(), '$status', '$invoice_number')";
        $result_query = mysqli_query($conn, $insert_orders);
        if ($result_query) {
            echo "<script>alert('Order was submitted successfully');</script>";
            echo "<script>window.open('profile.php', '_self');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    }
}

// Insert pending orders and delete items from cart
$get_cart = "SELECT * FROM `tbl_cart` WHERE cmrId = '$get_ip_address'";
$run_cart = mysqli_query($conn, $get_cart);

while ($get_item_quantity = mysqli_fetch_assoc($run_cart)) {
    $quantity = $get_item_quantity['quantity'];
    $product_id = $get_item_quantity['productId'];

    // Insert pending orders into tbl_order_status
    $insert_pending_orders = "INSERT INTO `tbl_order_status` (cmrId, productId, invoice_number, quantity, order_status) 
                              VALUES ('$user_id', '$product_id', '$invoice_number', '$quantity', '$status')";
    if (!mysqli_query($conn, $insert_pending_orders)) {
        echo "Error inserting pending order: " . mysqli_error($conn);
    }
}

// Delete items from cart
$empty_cart = "DELETE FROM `tbl_cart` WHERE cmrId = '$get_ip_address'";
if (!mysqli_query($conn, $empty_cart)) {
    echo "Error emptying cart: " . mysqli_error($conn);
} 
// else {
//     echo "Cart emptied successfully";
// }

// Close the database connection
mysqli_close($conn);

include ('../footer.php');
?>
