<?php 
include('header.php');
include('include/connect_db.php');
@session_start(); // Start the session

if (!isset($_SESSION["cmrId"])) {
    echo "<script>alert('You need to log in to view your cart.'); window.location.href = 'user/login.php';</script>";
    exit();
}

$cmrId = mysqli_real_escape_string($conn, $_SESSION["cmrId"]);

// Fetch cart details
$cart_query = "SELECT cd.productId, cd.quantity, p.image, p.price, p.productName, p.product_in_store
               FROM tbl_cart cd 
               JOIN tbl_product p ON cd.productId = p.productId
               WHERE cd.cmrId = '$cmrId'";
$run_cart = mysqli_query($conn, $cart_query);

$total = 0;

// Check for remove product action
if (isset($_GET['remove_product'])) {
    $product_id_to_remove = mysqli_real_escape_string($conn, $_GET['remove_product']);
    if (isset($_GET['confirm_delete'])) {
        $sql = "DELETE FROM tbl_cart WHERE productId = '$product_id_to_remove' AND cmrId = '$cmrId'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['cart_updated'] = true;
            header("Location: {$_SERVER['PHP_SELF']}");
            exit();
        } else {
            echo "<script>alert('Failed to delete product.');</script>";
        }
    }
}

// Check for update cart action
if (isset($_POST['update_cart'])) {
    $quantities = $_POST['qty'];
    foreach ($quantities as $product_id => $quantity) {
        $quantity = mysqli_real_escape_string($conn, $quantity);
        $update_cart_query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE productId = '$product_id' AND cmrId = '$cmrId'";
        $update_result = mysqli_query($conn, $update_cart_query);
        if (!$update_result) {
            echo "<script>alert('Failed to update quantity.');</script>";
        }
    }
    $_SESSION['cart_updated'] = true;
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}

// Check if cart was updated
$cart_updated = isset($_SESSION['cart_updated']) ? $_SESSION['cart_updated'] : false;
unset($_SESSION['cart_updated']); // Reset flag

?>

<section class='cart-section section-gaps'>
    <div class='container'>

        <?php if (mysqli_num_rows($run_cart) == 0) { ?>
            <!-- Display message when the cart is empty -->
            <section class='section-gap'>
                <div class='container'>
                    <h2 class='heading underline center text-center'>Your shopping cart is empty.</h2>
                    <p class='lead text-center'>Add some products to your cart before proceeding. You can also browse our collection of items or visit our shop page for more options.</p>
                </div>
            </section>
        <?php } else { ?>

        <div id='cart-notice' class='notice <?php echo $cart_updated ? 'updated' : ''; ?>'>
            <div class='update-message'>
                <i class='fa-solid fa-circle-check'></i>
                <span>Cart updated.</span>
            </div>
        </div>
        <form id='cart-form' action='' method='post'>
            <table class='cart-list table table-bordered mb-5'>
                <thead>
                    <tr>
                        <th class='product-remove'></th>
                        <th class='product-thumbnail'>Image</th>
                        <th class='product-name'>Product Name</th>
                        <th class='product-price'>Price</th>
                        <th class='product-quantity'>Quantity</th>
                        <th class='product-subtotal'>Total</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                if (mysqli_num_rows($run_cart) > 0) {
                    while ($row_cart = mysqli_fetch_array($run_cart)) {
                        $pro_id = $row_cart['productId'];
                        $quantity = $row_cart['quantity'];
                        $image = $row_cart['image'];
                        $price = $row_cart['price'];
                        $product_name = $row_cart['productName'];
                        $product_in_store = $row_cart['product_in_store'];

                        echo "<tr>
                                <td class='product-remove'>
                                    <a href='{$_SERVER['PHP_SELF']}?remove_product=$pro_id&confirm_delete' onclick='return confirm(\"Are you sure you want to delete this product?\")'>x</a>
                                </td>
                                <td class='product-thumbnail'>
                                    <img src='$image' alt='$product_name'>
                                </td>
                                <td class='product-name'>
                                    $product_name
                                </td>
                                <td class='product-price'>
                                    <span class='price-symbol'>Rs.</span> $price
                                </td>
                                <td class='product-quantity'>
                                    <input type='number' min='1' max='$product_in_store' value='$quantity' class='quantity-product' name='qty[$pro_id]' onchange='validateQuantity(this)'>
                                </td>
                                <td class='product-subtotal'>
                                    <span class='price-symbol'>Rs.</span> " . ($price * $quantity) . "
                                </td>
                            </tr>";
                        $total += ($price * $quantity);
                    }
                }
                ?>

                <tr class=" border-0">
                    <td class='text-end pt-5 border-0' colspan='6'>
                        <input id='update-cart-btn' type='submit' name='update_cart' class='btn w-auto read-more checkout-btn' value='Update Cart'>
                    </td> 
                </tr> 
                </tbody>
            </table>
            <div class='cart-collaterals margin-bottom-cart'>
                <div class='row justify-content-end'>
                    <div class='col-sm-6'>
                        <h2 class='heading underline'>Cart totals</h2>
                        <table>
                            <tbody>
                                <tr class='cart-subtotal'>
                                    <th>Subtotal</th>
                                    <td><span class='price-symbol'>Rs.</span> <?php echo $total; ?></td>
                                </tr>
                                <tr class='order-total'>
                                    <th>Total</th>
                                    <td><strong><span class='price-symbol'>Rs.</span> <?php echo $total; ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class='proceed-to-checkout'>
                            <a href='./user/order.php?cmrId=<?php echo $cmrId; ?>' class='btn btn-primary mt-4 read-more checkout-btn'>Proceed to checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php } ?>
    </div>
</section>

<?php 
include('footer.php');
?>

<script>
    function validateQuantity(input) {
        let maxQty = parseInt(input.getAttribute('max'));
        if (parseInt(input.value) > maxQty) {
            alert('Cannot exceed available stock (' + maxQty + ')');
            input.value = maxQty; // Set the quantity to maximum allowed
        }
    }

    // Check if the cart was updated
    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('cart-notice').classList.contains('updated')) {
            setTimeout(function() {
                document.getElementById('cart-notice').classList.remove('updated');
            }, 3000); // Hide the notice after 3 seconds
        }
    });
</script>

<style>
    .btn.active {
        background-color: #007bff; 
        color: white;
    }
    .notice {
        display: none;
    }
    .notice.updated {
        background-color: #d4edda; 
        border-color: #c3e6cb;    
        display: block;
    }
</style>
