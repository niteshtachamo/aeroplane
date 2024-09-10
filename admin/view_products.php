<?php
include ("../include/connect_db.php");
include('header1.php');

// Handle product deletion
if (isset($_GET['delete_product'])) {
    $delete_product_id = $_GET['delete_product'];
    
    // SQL query to delete the product
    $delete_query = "DELETE FROM `tbl_product` WHERE `productId` = '$delete_product_id'";
    
    // Execute the query
    if (mysqli_query($conn, $delete_query)) {
        echo "<script>alert('Product deleted successfully');</script>";
        echo "<script>window.location.href='view_products.php';</script>"; // Redirect to refresh the page
    } else {
        echo "<script>alert('Error deleting product');</script>";
    }
}

// Fetch products from the database
$get_product = "SELECT * FROM `tbl_product`";
$result = mysqli_query($conn, $get_product);
$number = 1; // Initialize the number counter
?>

<section class="">
    <div class="container">
        <div class="title text-center">
            <h1 class="heading">View Products</h1>
        </div>
        <table class="table table-bordered mt-5">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Title</th>
                    <th>Product Image</th>
                    <th>Product Price</th>
                    <th>Total Sold</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Quantity Left</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $product_id = $row['productId'];
                    $product_title = $row['productName'];
                    $product_image = $row['image'];
                    $product_price = $row['price'];
                    $product_in_store = $row['product_in_store'];

                    // Query to get the count of sold orders for this product
                    $get_count = "SELECT COALESCE(SUM(quantity), 0) AS total_orders FROM `order_status` WHERE product_id = '$product_id' AND order_status = 'complete' ";
                    $result_count = mysqli_query($conn, $get_count);
                    if ($result_count) {
                        $row_count = mysqli_fetch_assoc($result_count);
                        $total_orders = $row_count['total_orders'];
                    } else {
                        $total_orders = 0;
                        echo "Error fetching total orders for product ID: $product_id <br>";
                    }

                    // Calculate the quantity remaining in store
                    $quantity_remaining = $product_in_store;
 
                    ?>
                    <tr class='text-center'>
                        <td><?php echo $number; ?></td>
                        <td><?php echo $product_title; ?></td>
                        <td><img src='../<?php echo $product_image; ?>' alt='Product Image' style='width: 100px; height: auto;'></td>
                        <td><?php echo $product_price; ?></td>
                        <td><?php echo $total_orders; ?></td>
                        <td><a href='edit_products.php?edit_product=<?php echo $product_id ?>' class='btn btn-success'>Edit</a></td>
                        <td><a href='view_products.php?delete_product=<?php echo $product_id ?>' class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a></td>
                        <td><?php echo $quantity_remaining; ?></td>
                    </tr>
                    <?php
                    $number++;
                } ?>
            </tbody>
        </table>
    </div>
</section>

<?php mysqli_close($conn); // Close the database connection ?>
</body>
</html>
