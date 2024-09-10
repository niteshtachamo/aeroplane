<?php
include ('../include/connect_db.php');
include("header1.php");

if (isset($_GET['edit_categories'])) {
    $cat_id = $_GET['edit_categories'];

    $select_query = "SELECT * FROM tbl_category WHERE catId =$cat_id";
    $result = mysqli_query($conn, $select_query);
    $row = mysqli_fetch_assoc($result);
    $cat_name = $row['catName'];
}

if (isset($_POST['update_category'])) {
    $cat_id = $_GET['edit_categories'];
    $cat_name = $_POST['edit_category'];

    // Escaping special characters to prevent SQL injection
    // $cat_name = mysqli_real_escape_string($conn, $cat_name);

    $update_query = "UPDATE tbl_category SET catName='$cat_name' WHERE 	catId =$cat_id";
    $result = mysqli_query($conn, $update_query);

    if ($result) {
        echo "<script>alert('Category is updated')</script>";
    } else {
        echo "<script>alert('Error')</script>";
    }
}

?>

<section class="section-gaps edit-categories">
    <div class="container">
        <h1 class="heading text-center mb-5">Edit categories</h1>
        <form action="" method="post" class=" m-auto w-50">
            <div class="form-group">
                <label for="edit_category">Edit category</label>
                <input type="text" name="edit_category" value="<?php echo $cat_name ?>" class="form-control"
                    id="edit_category">
            </div>
            <input type="submit" name="update_category" value="Update Category" class="btn btn-success">
        </form>
    </div>
</section>