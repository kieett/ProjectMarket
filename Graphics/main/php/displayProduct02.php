<?php
 function displayProductSPDL($product) {
    ?>
    <div class="SPDL-item">
        <img src="http://localhost/website-py/admin/products/<?php echo $product['image']; ?>" alt="<?php echo $product['ten']; ?>" class="product-image">  
        <div class="ThongtinSP">
            <h3 class="Ten"><?php echo $product['ten']; ?></h3>
            <p class="ĐonVi">ĐVT: <?php echo $product['donvi']; ?></p>
            <p class="Gia">Giá: <?php echo number_format($product['giaban'], 0, ',', '.'); ?> đ</p>
            <div class="quantity-control" style="display:none;">
                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                <span class="quantity">1</span>
                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
            </div>
            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
        </div>
    </div>
    <?php
}
?>