<?php
include('header.php');
include('function/commonfunction.php');

$limit = 4; // Number of products per page

// Fetch total number of products
$sql = "SELECT COUNT(productId) AS total FROM tbl_product";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_products = $row['total'];

// Calculate total pages
$total_pages = ceil($total_products / $limit);

// Get current page from URL, default to 1 if not set
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($page < 1)
    $page = 1;
if ($page > $total_pages)
    $page = $total_pages;

$start = ($page - 1) * $limit;

?>
<!-- header -->


<section class="product-section section-gaps">
    <div class="container">
        <div class="main-title center">
            <h1 class="title">our product</h1>
        </div>
        <div class="row g-xl-5 g-4 ">
            <?php
            allproduct($start, $limit);
            ?>
        </div>

        <!-- Pagination -->
        <ul class="pagination">
            <li>
                <a href="?page=<?php echo max(1, $page - 1); ?>" class="page-numbers prev">
                    < </a>
            </li>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li>
                    <?php if ($i == $page): ?>
                        <span class="page-numbers current"><?php echo $i; ?></span>
                    <?php else: ?>
                        <a href="?page=<?php echo $i; ?>" class="page-numbers"><?php echo $i; ?></a>
                    <?php endif; ?>
                </li>
            <?php endfor; ?>
            <li>
                <a href="?page=<?php echo min($total_pages, $page + 1); ?>" class="page-numbers next">></a>
            </li>
        </ul>
    </div>
</section>

<!-- footer -->
<?php include('footer.php') ?>