<?php
include('header1.php');
include('../include/connect_db.php');

if (isset($_POST['insert_product'])) {
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_description = mysqli_real_escape_string($conn, $_POST['product_description']);
    $select_tags = mysqli_real_escape_string($conn, $_POST['select_brands']);
    $select_categories = mysqli_real_escape_string($conn, $_POST['select_categories']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $product_in_store = mysqli_real_escape_string($conn, $_POST['product_in_store']);

    // File Upload
    $product_image = $_FILES['product_image']['name'];
    $product_image_temp = $_FILES['product_image']['tmp_name'];
    $uploaded_image = "uploads/" . $product_image;

    // Move uploaded file to 'uploads/' directory
    if (move_uploaded_file($product_image_temp, "../uploads/" . $product_image)) {
        // Insert product query
        $sql = "INSERT INTO `tbl_product`(`productName`, `catId`, `brandId`, `body`, `price`, `image`, `product_in_store`, `date`) 
        VALUES ('$product_name', '$select_categories', '$select_tags', '$product_description', '$product_price', '$uploaded_image', '$product_in_store', NOW())";

        // Execute query and check for success
        $res = mysqli_query($conn, $sql);
        if (!$res) {
            echo "Error: " . mysqli_error($conn) . "<br>";
        } else {
            echo "<script>alert('Product inserted successfully');</script>";
        }
    } else {
        echo "Error uploading image.";
    }
}
?>
    

<section class="insert-product">
    <div class="container">
        <div class="main-title center">
            <h1 class="title">Insert product</h1>
        </div>
        <div class="insert_product w-50 m-auto pt-5">
            <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="product_name">Product name <span class="required">*</span></label>
                    <input type="text" id="product_name" required name="product_name" class="form-control" />
                    <small id="product_name_error" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="product_description">Product description <span class="required">*</span></label>
                    <input type="text" id="product_description" required name="product_description" class="form-control" />
                    <small id="product_description_error" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="brands">Brands</label>
                    <select name="select_brands" class="form-control">
                        <option value="">Select tags</option>
                        <?php
                        $sql = "SELECT * FROM `tbl_brand`";
                        $res = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($res)) {
                            echo "<option value='" . $row['brandId'] . "'>" . $row['brandName'] . "</option>";
                        }
                        ?>
                    </select>
                    <small id="select_brands_error" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="categories">Categories</label>
                    <select name="select_categories" class="form-control">
                        <option value="">Select categories</option>
                        <?php
                        $sql = "SELECT * FROM `tbl_category`";
                        $res = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($res)) {
                            echo "<option value='" . $row['catId'] . "'>" . $row['catName'] . "</option>";
                        }
                        ?>
                    </select>
                    <small id="select_categories_error" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="product_price">Product price <span class="required">*</span></label>
                    <input type="text" id="product_price" required name="product_price" class="form-control" />
                    <small id="product_price_error" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="product_image">Product image <span class="required">*</span></label>
                    <input type="file" name="product_image" required class="form-control">
                    <small id="product_image_error" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="product_in_store">Product quantity in store <span class="required">*</span></label>
                    <input type="number" id="product_in_store" required name="product_in_store" class="form-control" />
                    <small id="product_in_store_error" class="text-danger"></small>
                </div>

                <input type="submit" class="btn btn-primary" name="insert_product" value="Insert Product">
            </form>
        </div>
    </div>
</section>

<script>
function validateForm() {
    var isValid = true;

    var productName = document.getElementById('product_name').value;
    var productDescription = document.getElementById('product_description').value;
    var productPrice = document.getElementById('product_price').value;
    var productInStore = document.getElementById('product_in_store').value;

    var specialChars = /^[A-Za-z\s!@#$%^&*()_+=\[\]{};:'",.<>?]+$/;
    var pricePattern = /^[0-9]+(\.[0-9]{1,2})?$/;
    var quantityPattern = /^[1-9]\d*$/;

    // Product Name Validation
    var productNameError = document.getElementById('product_name_error');
    if (productName.trim() === '' || !productName.match(specialChars) || /\d/.test(productName)) {
        productNameError.textContent = "Product name can only contain letters, special characters, and spaces but must not be numeric-only";
        isValid = false;
    } else {
        var wordCount = productName.trim().split(/\s+/).length;
        if (wordCount < 3) {
            productNameError.textContent = "Product name must be at least 3 words long";
            isValid = false;
        } else {
            productNameError.textContent = "";
        }
    }

    // Product Description Validation
    var productDescriptionError = document.getElementById('product_description_error');
    if (productDescription.trim() === '' || !productDescription.match(specialChars) || /\d/.test(productDescription)) {
        productDescriptionError.textContent = "Product description can only contain letters, special characters, and spaces but must not be numeric-only";
        isValid = false;
    } else if (productDescription.length < 10 || productDescription.length > 200) {
        productDescriptionError.textContent = "Product description must be between 10 and 200 characters long";
        isValid = false;
    } else {
        productDescriptionError.textContent = "";
    }

    // Product Price Validation
    var productPriceError = document.getElementById('product_price_error');
    if (!productPrice.match(pricePattern)) {
        productPriceError.textContent = "Product price must be a positive number";
        isValid = false;
    } else {
        productPriceError.textContent = "";
    }

    // Product Quantity Validation
    var productInStoreError = document.getElementById('product_in_store_error');
    if (!productInStore.match(quantityPattern)) {
        productInStoreError.textContent = "Product quantity in store must be a positive integer";
        isValid = false;
    } else {
        productInStoreError.textContent = "";
    }

    return isValid;
}

// Add real-time validation event listeners
document.getElementById('product_name').addEventListener('input', function () {
    var productName = document.getElementById('product_name').value;
    var productNameError = document.getElementById('product_name_error');
    var specialChars = /^[A-Za-z0-9\s!@#$%^&*()_+=\[\]{};:'",.<>?]+$/;

    if (productName.trim() === '' || !productName.match(specialChars)) {
        productNameError.textContent = "Product name can only contain letters, numbers, special characters, and spaces";
    } else {
        var letterCount = (productName.match(/[A-Za-z]/g) || []).length;
        if (/^\d+$/.test(productName)) {
            productNameError.textContent = "Product name cannot be numeric-only";
        } else if (letterCount < 3) {
            productNameError.textContent = "Product name must contain at least 3 letters";
        } else {
            productNameError.textContent = "";
        }
    }
});

document.getElementById('product_description').addEventListener('input', function () {
    var productDescription = document.getElementById('product_description').value;
    var productDescriptionError = document.getElementById('product_description_error');
    var specialChars = /^[A-Za-z\s!@#$%^&*()_+=\[\]{};:'",.<>?]+$/;

    if (productDescription.trim() === '' || !productDescription.match(specialChars) || /\d/.test(productDescription)) {
        productDescriptionError.textContent = "Product description can only contain letters, special characters, and spaces but must not be numeric-only";
    } else if (productDescription.length < 10 || productDescription.length > 200) {
        productDescriptionError.textContent = "Product description must be between 10 and 200 characters long";
    } else {
        productDescriptionError.textContent = "";
    }
});
</script>

<?php 
include('footer1.php');

?>