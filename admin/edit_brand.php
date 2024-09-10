<?php
include ('../include/connect_db.php');
include("header1.php");

if (isset($_GET['edit_brand'])) {
    $brand_id = $_GET['edit_brand'];

    $select_query = "SELECT * FROM tbl_brand WHERE brandId =$brand_id";
    $result = mysqli_query($conn, $select_query);
    $row = mysqli_fetch_assoc($result);
    $brand_name = $row['brandName'];
}

if (isset($_POST['update_brand'])) {
    $brand_id = $_GET['edit_brand'];
    $brand_name = $_POST['edit_brand'];

    // Escaping special characters to prevent SQL injection
    // $cat_name = mysqli_real_escape_string($conn, $cat_name);

    $update_query = "UPDATE tbl_brand SET brandName='$brand_name' WHERE brandId=$brand_id";
    $result = mysqli_query($conn, $update_query);

    if ($result) {
        echo "<script>alert('brand is updated')</script>";
    } else {
        echo "<script>alert('Error')</script>";
    }
}

?>

<section class="section-gaps edit-brand">
    <div class="container">
        <div class="main-title center">
            <h1 class="title">Edit brand</h1>
        </div>
        <form action="" method="post" class=" m-auto w-50">
            <div class="form-group">
                <label for="edit_category">Edit brand</label>
                <input type="text" name="edit_brand" value="<?php echo $brand_name ?>" class="form-control" id="edit_brand">
            </div>
            <input type="submit" name="update_brand" value="Update brand" class="btn btn-success">
        </form>
    </div>
</section>