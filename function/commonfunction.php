<?php 

// display limited product
function displayProducts($limit)
{
    global $conn;
    $sql_query = "SELECT * FROM `tbl_product` LIMIT {$limit}";
    $result = mysqli_query($conn, $sql_query);

    while ($row = mysqli_fetch_assoc($result)) {
        $product_id = $row['productId'];
        $product_name = $row['productName'];
        $product_price = $row['price'];
        $product_image = $row['image'];
        $product_in_store = $row['product_in_store'];

        // Output HTML code to display product
        echo "<div class='col-lg-3 col-sm-6'>";
        include('./assets/product-box.php');
        echo "</div>";
    }
}

// display all product

function allproduct($start, $limit)
{
    global $conn;
    $sql_query = "SELECT * FROM `tbl_product` LIMIT $start, $limit";
    $result = mysqli_query($conn, $sql_query);

    while ($row = mysqli_fetch_assoc($result)) {
        $product_id = $row['productId'];
        $product_name = $row['productName'];
        $product_price = $row['price'];
        $product_image = $row['image'];
        $product_in_store = $row['product_in_store'];

        echo "<div class='col-lg-3 col-sm-6'>";
            include('./assets/product-box.php');
        echo "</div>";
    }
}

function search_product()
{
    global $conn;

    // Check if the search keyword is set
    if (isset($_GET['search_keyword']) && !empty($_GET['search_keyword'])) {
        $user_search_data_value = $_GET['search_keyword'];

        // Escape the search keyword to prevent SQL injection
        $search_keyword = '%' . mysqli_real_escape_string($conn, $user_search_data_value) . '%';

        // Construct the SQL query
        $search_product_query = "
            SELECT p.* 
            FROM tbl_product p
            INNER JOIN tbl_brand b ON p.brandId  = b.brandId 
            INNER JOIN tbl_category c ON p.catId  = c.catId 
            WHERE c.catName LIKE ? OR b.brandName LIKE ? OR p.productName LIKE ?";

        // Prepare the statement
        $stmt = mysqli_prepare($conn, $search_product_query);
        mysqli_stmt_bind_param($stmt, 'sss', $search_keyword, $search_keyword, $search_keyword);

        // Execute the query
        mysqli_stmt_execute($stmt);
        $result_query = mysqli_stmt_get_result($stmt);

        // Check if there are any search results
        if (mysqli_num_rows($result_query) == 0) {
            echo "<div class='content'>
                    <h4 class='heading'>No search Results</h4>
                    <p>There are no products matching your query</p>
                    <div class='search_box search-result'>
                        <form class='searchForm' action='http://localhost/aeroplane/search.php' method='get'>
                            <div class='form-wrap position-relative'>
                                <div class='form-group'>
                                    <label for='search-product' class='sr-only'>Search Products</label>
                                    <input  name='search_keyword' class='searchInput' type='search'
                                    placeholder='Search for Products'>
                                    <div id='suggestionsList' class='suggestions-list'></div>

                                </div>
                                <div class='form-group submit'>
                                    <input type='submit' value='Submit' name='search_product'>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>";
        }
         else {
            while ($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['productId'];
                $product_name = $row['productName'];
                $product_price = $row['price'];
                $product_image = $row['image'];
                $product_in_store = $row['product_in_store'];

                // Output HTML code to display product
                echo "<div class='col-lg-3 col-sm-6'>";
                include('./assets/product-box.php');
            echo "</div>";
            }
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<div class='content'>
                <h4 class='heading'>No search Results</h4>
                <p>Please enter a search keyword.</p>
                <div class='search_box search-result'>
                    <form class='searchForm' action='http://localhost/aeroplane/search.php' method='get'>
                        <div class='form-wrap position-relative'>
                            <div class='form-group'>
                                <label for='search-product' class='sr-only'>Search Products</label>
                                <input  name='search_keyword' class='searchInput' type='search'
                                placeholder='Search for Products'>
                                <div id='suggestionsList' class='suggestions-list'></div>

                            </div>
                            <div class='form-group submit'>
                                <input type='submit' value='Submit' name='search_product'>
                            </div>
                        </div>
                    </form>
                </div>
            </div>";
    }
}



?>