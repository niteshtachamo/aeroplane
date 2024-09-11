<?php
// $dynamicTitle = "Search";
include ("header.php");
include ('function/commonfunction.php');

// Check if the search keyword is set
$user_search_data_value = "";
if (isset($_GET['search_keyword'])) {
    $user_search_data_value = $_GET['search_keyword'];
}

?>

<section class="search-section section-gaps">
    <div class="container">
        <div class="row g-5">
            <?php
            search_product();   
            ?>
        </div>
    </div>
</section>

<?php include ("footer.php"); ?>