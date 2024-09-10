<?php
include ("include/connect_db.php");

if (isset($_GET['search_keyword'])) {
    $search_keyword = $_GET['search_keyword'];

    // Escape the search keyword to prevent SQL injection
    $search_keyword = '%' . mysqli_real_escape_string($conn, $search_keyword) . '%';

    // Construct the SQL query to fetch matching results
    $query = "
            SELECT p.productName 
            FROM tbl_product p
            WHERE p.productName LIKE ?
            LIMIT 10";

    // Prepare and execute the statement
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $search_keyword);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Generate the suggestion list
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='suggestion-item'>" . htmlspecialchars($row['productName']) . "</div>";
        }
    } else {
        echo "<div class='suggestion-item'>No suggestions found</div>";
    }

    mysqli_stmt_close($stmt);
}
?>
