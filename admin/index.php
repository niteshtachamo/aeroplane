<?php 
include ('../include/connect_db.php');

include('header1.php');


// Fetch total products
$sql_sales = "SELECT SUM(price) AS total_sales FROM tbl_order WHERE order_status = 'complete'";
$result_sales = mysqli_query($conn, $sql_sales);

$totalSales = 0;
if ($result_sales) {
    $row_sales = mysqli_fetch_assoc($result_sales);
    if ($row_sales) {
        $totalSales = $row_sales['total_sales'];
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

// Fetch total user/ customer
$sql_users = "SELECT COUNT(*) AS total_users FROM tbl_customer";
$result_users = mysqli_query($conn, $sql_users);

$totalUsers = 0;
if ($result_users) {
    $row_users = mysqli_fetch_assoc($result_users);
    if ($row_users) {
        $totalUsers = $row_users['total_users'];
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

// Fetch total contact feeedback
$sql_feedback = "SELECT COUNT(*) AS total_feedback FROM tbl_contact";
$result_feedback = mysqli_query($conn, $sql_feedback);

$totalFeedback = 0;
if ($result_feedback) {
    $row_feedback = mysqli_fetch_assoc($result_feedback);
    if ($row_feedback) {
        $totalFeedback = $row_feedback['total_feedback'];
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

// Fetch total order stattus complete
$sql_pending = "SELECT COUNT(*) AS total_pending FROM tbl_order WHERE order_status = 'pending'";
$result_pending = mysqli_query($conn, $sql_pending);

$total_pending = 0;
if ($result_pending) {
    $row_pending = mysqli_fetch_assoc($result_pending);
    if ($row_pending) {
        $total_pending = $row_pending['total_pending'];
    }
}

// Fetch total order
$sql_order = "SELECT COUNT(*) AS total_order FROM tbl_order";
$result_order = mysqli_query($conn, $sql_order);

$totalorder = 0;
if ($result_order) {
    $row_order = mysqli_fetch_assoc($result_order);
    if ($row_order) {
        $totalorder = $row_order['total_order'];
    }
} else {
    echo "Error: " . mysqli_error($conn);
}


// Fetch total products
$sql_product = "SELECT COUNT(*) AS total_product FROM tbl_product";
$result_product = mysqli_query($conn, $sql_product);

$totalproduct = 0;
if ($result_product) {
    $row_product = mysqli_fetch_assoc($result_product);
    if ($row_product) {
        $totalproduct = $row_product['total_product'];
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

// Fetch total complete orders
$sql_complete = "SELECT COUNT(*) AS total_complete FROM tbl_order WHERE admin_status = 'complete'";
$result_complete = mysqli_query($conn, $sql_complete);

$total_complete = 0;
if ($result_complete) {
    $row_complete = mysqli_fetch_assoc($result_complete);
    if ($row_complete) {
        $total_complete = $row_complete['total_complete'];
    }
}

?>
<section class="admin-section">
    <div class="container">
        <div class="stats">
            <div class="stat-card">
                <h3>Total Users</h3>
                <p>
                    <span><?php echo $totalUsers; ?></span>
                </p>
            </div>
            <div class="stat-card">
                <h3>Total Orders</h3>
                <p>
                    <span><?php echo $totalorder; ?></span>
                </p>
            </div>
            <div class="stat-card">
                <h3>Total Products</h3>
                <p>
                    <span><?php echo $totalproduct; ?></span>
                </p>
            </div>
            <div class="stat-card">
                <h3>Pending Requests</h3>
                <p>
                    <span><?php echo $total_pending; ?></span>
                </p>
            </div>
        </div>

       
</section>
<?php 
include('footer1.php');

?>
