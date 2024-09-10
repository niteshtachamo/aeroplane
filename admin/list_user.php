<?php

include("header1.php");
include ("../include/connect_db.php");

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    // echo  "Order ID: ". $user_id;

    $delete_query = "DELETE FROM `tbl_customer` WHERE id = $user_id";
    $result = mysqli_query($conn, $delete_query);
    if ($result) {
        echo "<script>alert('delete successfully')</script>";
    }
}

?>

<section class="section-gaps list-order">
    <div class="container">

        <?php
        $get_user = "SELECT * FROM `tbl_customer`";
        $result = mysqli_query($conn, $get_user);
        $row = mysqli_num_rows($result);

        if ($row == 0) {
            echo "<h1 class='heading text-center'>No User Found!</h1>";
        } else {
            echo "
        <h3 class='text-center heading'>All user</h3>
            
            <table class='table table-bordered mt-5'>
                    <thead>
                        <tr>
                            <th>S .No</th>
                            <th>User name</th>
                            <th>User email</th>
                            <th>User image</th>
                            <th>User address</th>
                            <th>user mobile</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>";

            $number = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $user_id = $row['id'];
                $user_name = $row['name'];
                $user_email = $row['email'];
                $user_image = $row['user_image'];
                $user_address = $row['address'];
                $user_mobile = $row['phone'];
                $number++;

                echo "
                <tr class='text-center'>
                    <td data-label='S. No'>$number</td>
                    <td data-label='User name'>$user_name</td>
                    <td data-label='User email'>$user_email</td>
                    <td data-label='User image'><img src='../user_area/user_image/$user_image' height='100' width='100' alt='$user_name'/></td>
                    <td data-label='User address'>$user_address</td>
                    <td data-label='User mobile'>$user_mobile</td>
                    <td data-label='Delete'>
                        <a href='list_user.php?user_id=$user_id' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this user?')\">Delete</a>
                    </td>
                </tr>
                ";
            }


            echo "</tbody></table>";
        }
        ?>

    </div>
</section>

<?php include("footer1.php");?>