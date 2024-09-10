<?php
include ('../include/connect_db.php');
include("header1.php");


if (isset($_POST['delete_category'])) {
    $category_id = $_POST['catId'];
    $delete_query = "DELETE FROM tbl_category WHERE catId  = $category_id";
    $delete_result = mysqli_query($conn, $delete_query);
    if ($delete_result) {
        // Tag deleted successfully
        // Redirect or display a success message
    } else {
        // Error deleting category
        echo "Error: " . mysqli_error($conn);
    }
}
if (isset($_POST['insert_category'])) {
    $category_name = $_POST['category'];

    $check_query = "SELECT * FROM tbl_category WHERE catName = '$category_name'";
    $check_result = mysqli_query($conn, $check_query);
    $number = mysqli_num_rows($check_result);

    if ($number > 0) {
        echo "<script>alert('Tag is already in the database');</script>";
    } else {
        $insert_query = "INSERT INTO tbl_category (catName) VALUES ('$category_name')";
        $insert_result = mysqli_query($conn, $insert_query);

        if (!$insert_result) {
            echo "Error: " . mysqli_error($conn) . "<br>";
        } else {
            echo "<script>console.log('$category_name is inserted')</script>";
        }
    }
}
?>

<section class="insert-category">
    <div class="container">
        <div class="main-title center">
            <h1 class="title">Insert categories</h1>
        </div>
        <div class="row pt-5">
            <div class="col-6">
                <div>
                    <table class="table table-bordered">
                        <thead>
                            <th>Id</th>
                            <th>Category Name</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                            $select = "SELECT * FROM  `tbl_category`";
                            $result = mysqli_query($conn, $select);

                            while ($data = mysqli_fetch_array($result)) { ?>
                                <tr>
                                    <td><?= $data["catId"] ?></td>
                                    <td><?= $data["catName"] ?></td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="catId" value="<?php echo $data['catId']; ?>">
                                            <button type="submit" name="delete_category" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                            <a class="text-white text-decoration-none btn btn-success btn-sm"
                                                href="edit_categories.php?edit_categories=<?php echo $data["catId"] ?>">Edit</a>
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
                            <label for="category">Add category: <span class="required">*</span></label>
                            <input type="text" name="category" class="form-control">
                        </div>
                        <input type="submit" value="Insert Value" class="btn btn-primary" name="insert_category">
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>