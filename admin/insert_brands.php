<?php
include ('../include/connect_db.php');
include("header1.php");

// Handle brand deletion
if (isset($_POST['delete_brands'])) {
    $brand_id = mysqli_real_escape_string($conn, $_POST['brandId']);
    $delete_query = "DELETE FROM tbl_brand WHERE brandId = $brand_id";
    $delete_result = mysqli_query($conn, $delete_query);
    if ($delete_result) {
        echo "<script>alert('Brand deleted successfully');</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Handle brand insertion
if (isset($_POST['insert_brands'])) {
    $brands_name = mysqli_real_escape_string($conn, $_POST['brands']);

    // Check if brand already exists
    $check_query = "SELECT * FROM tbl_brand WHERE brandName = '$brands_name'";
    $check_result = mysqli_query($conn, $check_query);
    $number = mysqli_num_rows($check_result);

    if ($number > 0) {
        echo "<script>alert('Brand is already in the database');</script>";
    } else {
        // Insert new brand
        $insert_query = "INSERT INTO tbl_brand (brandName) VALUES ('$brands_name')";
        $insert_result = mysqli_query($conn, $insert_query);

        if (!$insert_result) {
            echo "Error: " . mysqli_error($conn) . "<br>";
        } else {
            echo "<script>alert('$brands_name has been inserted successfully');</script>";
        }
    }
}
?>

<section class="insert-brands">
    <div class="container">
        <div class="main-title center">
            <h1 class="title">Insert Brands</h1>
        </div>
        <div class="row pt-5">
            <div class="col-6">
                <div>
                    <table class="table table-bordered">
                        <thead>
                            <th>Id</th>
                            <th>Brand Name</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                            $select = "SELECT * FROM tbl_brand";
                            $result = mysqli_query($conn, $select);

                            while ($data = mysqli_fetch_array($result)) { ?>
                                <tr>
                                    <td><?= $data["brandId"] ?></td>
                                    <td><?= $data["brandName"] ?></td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="brandId" value="<?= $data['brandId']; ?>">
                                            <button type="submit" name="delete_brands" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this brand?')">Delete</button>
                                            <a class="text-white text-decoration-none btn btn-success btn-sm"
                                                href="edit_brand.php?edit_brand=<?= $data['brandId'] ?>">Edit</a>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-6">
                <div>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="brands">Add Brand: <span class="required">*</span></label>
                            <input type="text" name="brands" class="form-control" required>
                        </div>
                        <input type="submit" value="Insert Value" class="btn btn-primary" name="insert_brands">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
