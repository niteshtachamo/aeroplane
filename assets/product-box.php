<div class='product-box'>
    <a href='shop-single.php?id=<?php echo $product_id; ?>'>
        <div class='image'>
            <img src='<?php echo $product_image; ?>' class="img-cover" alt='<?php echo $product_name; ?>'>
            <?php 
            if ($product_in_store <= 0 || $product_in_store == 1) { 
                echo "<div class='sale-btn'>
                        <span class=''>out of stock</span>
                    </div>"; 
            } 
            ?>
        </div>
        <div class='content'>
            <h4 class='title'><?php echo $product_name; ?></h4>
            <div class='price-tag'>
                <ins><span class='price-symbol'>Rs.</span><span><?php echo $product_price; ?></span></ins>
            </div>
        </div>
        <div class="btn-wrap">
            <span class="btn-box text-btn">view product</span>
        </div>
    </a>
</div>
