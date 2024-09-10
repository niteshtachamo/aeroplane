<?php
include ('../header.php');
include ("../include/connect_db.php");
@session_start();

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $select_data = "SELECT * FROM `tbl_order` WHERE id = $order_id";
    $query_select = mysqli_query($conn, $select_data);
    $row_fetch = mysqli_fetch_assoc($query_select);
    $invoice_number = $row_fetch['invoice_number'];
    $amount_due = $row_fetch['price'];
}

if (isset($_POST["conform_payment"])) {
    $invoice_number = $_POST['invoice_number'];
    $amount = $_POST['amount'];
    $payment_mode = $_POST['payment_mode'];

    if ($payment_mode == "Cash on delivery") {
        $insert_query = "INSERT INTO `tbl_user_payments` (order_id, invoice_number, amount, payment_mode) 
                         VALUES ('$order_id', '$invoice_number', '$amount', '$payment_mode')";
        $result = mysqli_query($conn, $insert_query);

        if ($result) {
            echo "<script>alert('Successfully completed the payment');</script>";
            echo "<script>window.open('profile.php?user_order', '_self');</script>";
        } else {
            echo "<h1 class='heading'>Error occurred while processing your payment</h1>";
            echo "<p>Please try again later.</p>";
            echo "<p>Error message: " . mysqli_error($conn) . "</p>";
        }

        $update_order = "UPDATE `tbl_order` SET order_status = 'complete' WHERE id = $order_id";
        $result_order = mysqli_query($conn, $update_order);

    

    } elseif ($payment_mode == "Stripe") {
        echo "<script>window.location.href='stripe_payment.php?order_id=$order_id';</script>";
        exit;
    }
}
?>

<section class="py-5 margin-top-header text-center">
    <div class="container">
        <h1 class="heading">Confirm Payment</h1>
        <form id="paymentForm" action="" method="post">
            <!-- Invoice Number -->
            <div class="form-outline mt-4 w-50 m-auto">
                <input readonly type="text" class="form-control w-50 m-auto" value="<?php echo $invoice_number?>" name="invoice_number">
            </div>

            <!-- Amount Due -->
            <div class="form-outline mt-4 w-50 m-auto">
                <label for="amount">Amount</label>
                <input readonly type="text" class="form-control w-50 m-auto" value="<?php echo $amount_due ?>" name="amount">
            </div>

            <!-- Payment Mode Selection -->
            <div class="form-outline mt-4 w-50 m-auto">
                <select name="payment_mode" class="form-select w-50 m-auto" id="paymentMode" required>
                    <option value="">Select a payment option</option>
                    <option value="Cash on delivery">Cash on Delivery</option>
                    <option value="Stripe">Card</option>
                </select>
            </div>

            <!-- Confirm Payment Button -->
            <div class="w-50 m-auto">
                <input type="submit" class="btn btn-primary mt-4 w-50 m-auto" value="Confirm" name="conform_payment">
            </div>
        </form>
    </div>
</section>

<?php include ("../footer.php"); ?>

<script>
document.getElementById('paymentForm').addEventListener('submit', function(event) {
    var paymentMode = document.getElementById('paymentMode').value;

    // Check if a valid payment mode is selected
    if (paymentMode === '') {
        event.preventDefault(); // Prevent form submission
        alert('Please select a valid payment option.');
    } else if (paymentMode === 'Stripe') {
        event.preventDefault(); // Prevent form submission
        window.location.href = 'stripe_payment.php?order_id=<?php echo $order_id; ?>';
    }
});
</script>
