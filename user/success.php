<?php
include ('../header.php');
include ("../include/connect_db.php");
@session_start();


if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    $invoice_number = $_POST['invoice_number'];
    $amount = $_POST['amount'];
    $payment_mode = $_POST['payment_mode'];

    $insert_query = "INSERT INTO `tbl_user_payments` (order_id, invoice_number, amount, payment_mode) 
                         VALUES ('$order_id', '$invoice_number', '$amount', '$payment_mode')";
        $result = mysqli_query($conn, $insert_query);

    // Update the order status to complete
    $update_order = "UPDATE `tbl_order` SET order_status = 'complete' WHERE id = $order_id";
    $result_order = mysqli_query($conn, $update_order);

    if ($result_order) {
        echo "<script>alert('Payment successful! Your order is complete.')</script>";
        echo "<script>window.open('profile.php?user_order', '_self')</script>";
    } else {
        echo "<h1 class='heading'>Error occurred while updating your order status</h1>";
        echo "<p>Please try again later.</p>";
        echo "<p>Error message: " . mysqli_error($conn) . "</p>";
    }
}
?>

<section class="py-5 margin-top-header text-center">
    <div class="container">
        <h1 class="heading">Payment Successful</h1>
        <p>Your payment was successful and your order has been completed.</p>
        <a href="profile.php?user_order" class="btn read-more mt-4">View Order</a>
    </div>
</section>

<?php include ("../footer.php"); ?>
