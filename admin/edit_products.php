<?php
include('header1.php');
include('../include/connect_db.php');

// Initialize variables with default values to avoid warnings
$product_name = '';
$product_description = '';
$tag_id = '';
$category_id = '';
$product_image_1 = '';
$product_price = '';

// Check if 'edit_product' is set in the URL
if (isset($_GET['edit_product'])) {
    $edit_id = $_GET['edit_product'];

    // Fetch product data from the database
    $get_data = "SELECT * FROM `tbl_product` WHERE productId ='$edit_id'";
    $result_data = mysqli_query($conn, $get_data);

    if ($row = mysqli_fetch_assoc($result_data)) {
        // Populate the form with the product data
        $product_name = $row['productName'];
        $product_description = $row['body'];
        $tag_id = $row['brandId'];
        $category_id = $row['catId'];
        $product_image_1 = $row['image'];
        $product_price = $row['price'];
    }
}

// Handle form submission for updating the product
if (isset($_POST['update_product'])) {
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $tag_id = $_POST['select_tags'];
    $category_id = $_POST['select_categories'];
    $product_price = $_POST['product_price'];

    // Handle file upload
    $product_image_1_name = $_FILES['product_image_1']['name'];
    $product_image_1_tmp = $_FILES['product_image_1']['tmp_name'];

    if ($product_image_1_name) {
        // Upload the new image
        $product_image_1_path = "./product_images/" . $product_image_1_name;
        move_uploaded_file($product_image_1_tmp, $product_image_1_path);
    } else {
        // Use existing image if no new one is uploaded
        $product_image_1_name = $product_image_1;
    }

    // Escape special characters in user inputs
    $product_name = mysqli_real_escape_string($conn, $product_name);
    $product_description = mysqli_real_escape_string($conn, $product_description);
    $tag_id = mysqli_real_escape_string($conn, $tag_id);
    $category_id = mysqli_real_escape_string($conn, $category_id);
    $product_price = mysqli_real_escape_string($conn, $product_price);
    $product_image_1_name = mysqli_real_escape_string($conn, $product_image_1_name);

    // Update product query
    $update_product = "UPDATE `tbl_product` SET 
        productName='$product_name', 
        body='$product_description', 
        brandId='$tag_id', 
        catId='$category_id', 
        price='$product_price', 
        image='$product_image_1_name' 
        WHERE productId='$edit_id'";

    // Execute the query and handle success or error
    $result_update = mysqli_query($conn, $update_product);

    if ($result_update) {
        echo "<script>alert('Product updated successfully');</script>";
        echo "<script>window.location.href='index.php?view_products';</script>";
    } else {
        echo "Error: " . mysqli_error($conn); // Display SQL error if any
    }
}
?>

<section class="edit-product w-50 m-auto section-gaps">
    <div class="container">
        <div class="title text-center">
            <h1 class="heading">Edit Product</h1>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" id="product_name" name="product_name" class="form-control" value="<?php echo htmlspecialchars($product_name, ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="form-group">
                <label for="product_description">Product Description</label>
                <input type="text" id="product_description" name="product_description" class="form-control" value="<?php echo htmlspecialchars($product_description, ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="form-group">
                <label for="select_tags">Tags</label>
                <select name="select_tags" id="select_tags" class="form-control">
                    <option value="">Select Tags</option>
                    <?php
                    // Fetch all tags
                    $sql = "SELECT * FROM `tbl_brand`";
                    $res = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($res)) {
                        echo "<option value='" . htmlspecialchars($row['brandId'], ENT_QUOTES, 'UTF-8') . "'";
                        if ($row['brandId'] == $tag_id) {
                            echo " selected";
                        }
                        echo ">" . htmlspecialchars($row['brandName'], ENT_QUOTES, 'UTF-8') . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="select_categories">Categories</label>
                <select name="select_categories" id="select_categories" class="form-control">
                    <option value="">Select Categories</option>
                    <?php
                    // Fetch all categories
                    $sql = "SELECT * FROM `tbl_category`";
                    $res = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($res)) {
                        echo "<option value='" . htmlspecialchars($row['catId'], ENT_QUOTES, 'UTF-8') . "'";
                        if ($row['catId'] == $category_id) {
                            echo " selected";
                        }
                        echo ">" . htmlspecialchars($row['catName'], ENT_QUOTES, 'UTF-8') . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="product_price">Product Price</label>
                <input type="text" id="product_price" name="product_price" class="form-control" value="<?php echo htmlspecialchars($product_price, ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="form-group">
                <label for="product_image_1">Product Image</label>
                <div class="d-flex">
                    <input type="file" name="product_image_1" id="product_image_1" class="form-control">
                    <img class="product-image" src="http://localhost/aeroplane/<?php echo htmlspecialchars($product_image_1, ENT_QUOTES, 'UTF-8'); ?>" alt="">
                </div>
            </div>

            <input type="submit" class="btn btn-primary" name="update_product" value="Update Product">
        </form>
    </div>
</section>
