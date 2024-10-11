<?php

function displayProduct($product) {
    $isDiscounted = $product['giacu'] > 0;
    $discountPercent = 0;

    if ($isDiscounted) {
        $discountPercent = round((($product['giacu'] - $product['giaban']) / $product['giacu']) * 100);
    }
    ?>
    <div class="SPKM-item">
        <?php if ($isDiscounted) { ?>
            <div class="discount-badge">-<?php echo $discountPercent; ?>%</div>
        <?php } ?>
        <img src="http://localhost/website-py/admin/products/<?php echo $product['image']; ?>" alt="<?php echo $product['ten']; ?>" class="product-image">
        <div class="ThongtinSP">
            <h3 class="Ten"><?php echo $product['ten']; ?></h3>
            <p class="ĐonVi">ĐVT: <?php echo $product['donvi']; ?></p>
            <p class="Gia">
                <span class="Hientai"><?php echo number_format($product['giaban'], 0, ',', '.'); ?> đ</span>
                <?php if ($isDiscounted) { ?>
                    <span class="Cu" style="text-decoration: line-through;"><?php echo number_format($product['giacu'], 0, ',', '.'); ?> đ</span>
                <?php } ?>
            </p>
            <div class="action-container">
                <div class="quantity-control" style="display:none;">
                    <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                    <span class="quantity">1</span>
                    <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                </div>
                <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
            </div>
        </div>
    </div>
    <?php
}                    
?>
