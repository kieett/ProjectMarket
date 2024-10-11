<?php
session_start();
$username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'User';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siêu Thị</title>
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style></style>
</head>
<body>
    <header>
        <a href="#"><img src="imgs/logo.png" alt="Logo"></a>
        <div class="search-bar">
            <input type="text" placeholder="Tìm kiếm sản phẩm, thương hiệu...">
            <button type="submit"  aria-label="Tìm kiếm"> <i class="fas fa-search"></i> </button>
        </div>
      
        <div class="location-bar">
            <input type="text" placeholder="Giao Hàng">
            <button type="submit" aria-label="Vị trí"> <i class="fas fa-map-marker-alt"></i> </button>
        </div>

        <div class="nav-links">
            <a href="#" class="cart" id="cart-btn">Giỏ Hàng (0)</a>
        </div>
        <!-- Modal Giỏ Hàng -->
        <div id="cart-modal" class="cart-modal">
            <div class="cart-content">
                <span class="close">&times;</span>
                <h2>Giỏ Hàng</h2>
                <ul id="cart-items"></ul>
                <p>Tổng tiền: <span id="total-price">0</span> VND</p>
                <button id="checkout-button">Thanh toán</button>
            </div>
        </div>

        <div class="nguoidung">
            <button class="login-user"><i class="fas fa-user"></i><?php echo $username; ?></button>
            <div class="user-dropdown">
                <a href="user/GDuser.html">Tài khoản của tôi</a>
                <a href="#">Đơn hàng</a>
                <a href="php/logout.php">Đăng xuất</a>
            </div>
        </div>
   
    </header>

    <nav> 
    <button class="menu" id="menuButton"><i class="fa fa-bars"></i></button>
        <div class="button01">
            <button class="News" onclick="window.location.href='http://localhost/website-py/news/Tin tức.html'"> <i class="fas fa-bell"></i> Tin tức mới</button>
        </div>
        <button class="contact-btn">
            <i class="fas fa-headset"></i>
            Liên hệ
            <div class="contact-info">
              <p>Gọi tới số điện thoại dưới đây để được tư vấn thêm:</p>
              <p><strong>0899729688</strong></p>
            </div>
          </button>
    </nav>
    <div class="menu-content" id="menuContent">
        <h3>Danh mục sản phẩm</h3>
        <a href="#san-pham-khuyen-mai">Sản phẩm khuyến mãi</a>
        <a href="#san-pham-dong-lanh">Sản phẩm đông lạnh</a>
        <a href="#thuc-pham-tuoi-song">Thực phẩm tươi sống</a>
        <a href="#hoaqua-raucu">Hoa quả & Rau củ</a>
        <a href="#do-uong">Đồ uống</a>
        <a href="#do-kho">Đồ khô</a>
        <a href="#banhkeo-sua">Bánh kẹo & Sữa</a>
        <a href="#do-dung-ca-nhan">Đồ dùng cá nhân</a>
        <a href="#do-gia-dung">Đồ gia dụng</a>
        <a href="#ve-sinh-nha-cua">Vệ sinh nhà cửa</a>
        </div>
    <div class="container">
        <div class="slideshow-container">
            <div class="slides">
                <img src="https://giadinh.mediacdn.vn/296230595582509056/2024/3/4/1-17095312832791809476845.jpg" alt="">
            </div>
            <div class="slides">
                <img src="https://marketingai.mediacdn.vn/wp-content/uploads/2021/12/sp-closeup2.jpeg" alt="">
            </div>
            <div class="slides">
                <img src="https://www.laysvietnam.com/wp-content/uploads/2021/06/Lays_KV-END-FRAME.jpg" alt="">
            </div>
            <div class="slides">
                <img src="https://www.vinamilk.com.vn/sua-tuoi-vinamilk/wp-content/uploads/2016/06/EN_PC_FM100_Banner-nhan-hang.jpg" alt="">
            </div>
            <div class="slides">
                <img src="https://img.riokupon.com/upload/images/2024/07/15/cd64edff0fa5e2ade48cec6293bb1d4e.jpg" alt="">
            </div>
            <!-- Nút điều hướng -->
            <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
            <a class="next" onclick="changeSlide(1)">&#10095;</a>
        </div>
        <div class="dot-container">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
            <span class="dot" onclick="currentSlide(4)"></span>
            <span class="dot" onclick="currentSlide(5)"></span>
        </div>
        <br>
        <article id="san-pham-khuyen-mai">
            <div class="head">
                <div class="tieude">
                    <a>Sản Phẩm Khuyến Mãi</a>   
                </div>
            </div>
            <div class="SPKM-list">
                <?php                    
                    require_once  'php/getProducts.php';
                    require_once  'php/displayProduct01.php';
                    $category = "SPKM"; 
                    $products = getProductsByCategory($category);
                    
                    foreach ($products as $product) {
                        displayProduct($product);
                    }
                ?>
            </div>
        </article>

        <article id="san-pham-dong-lanh">
            <div class="head">
                <div class="tieude">
                    <a href="#">Sản Phẩm Đông Lạnh</a>   
                </div>
            </div>
            <div class="SPDL-list">
            <?php                    
                    require_once  'php/getProducts.php';
                    require_once 'php/displayProduct02.php';
                    $category = "SPDL"; 
                    $products = getProductsByCategory($category);
                    
                    foreach ($products as $product) {
                        displayProductSPDL($product);
                    }
                ?>
            </div>
        </article>

        <article id="thuc-pham-tuoi-song">
            <div class="head">
                <div class="tieude">
                    <a href="#">Thực Phẩm Tươi Sống</a>   
                </div>
            </div>
            <div class="SPTS-list">
                <div class="SPTS-item">
                    <img src="https://hcm.fstorage.vn/images/2023/03/premium-thit-heo-xay-dac-biet-20230320020052.jpeg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Thịt heo xay 500gam</h3>
                        <p class="ĐonVi">ĐVT: Khay</p>
                        <p class="Gia"> Giá: 100.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="SPTS-item">
                    <img src="https://hcm.fstorage.vn/images/2022/162428208072710281592-kg-meat-deli-duui-heo-(s)-og.jpg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Sườn heo 500gam</h3>
                        <p class="ĐonVi">ĐVT: Khay</p>
                        <p class="Gia"> Giá: 100.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="SPTS-item">
                    <img src="https://hcm.fstorage.vn/images/2022/162428208170310281597-kg-meat-deli-chon-giu-heo-ru%CC%81t-xuong-(s)-og.jpg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Thịt nọng heo 450gam</h3>
                        <p class="ĐonVi">ĐVT: Khay</p>
                        <p class="Gia"> Giá: 100.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="SPTS-item">
                    <img src="https://hcm.fstorage.vn/images/2022/162428207946410617959-kg-giu-lua-meatdeli-500g-og.jpg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Ba chỉ heo 350gam</h3>
                        <p class="ĐonVi">ĐVT: Khay</p>
                        <p class="Gia"> Giá: 100.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="SPTS-item">
                    <img src="https://hcm.fstorage.vn/images/2022/dui-toi-ga-3f.jpg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Đùi gà 3S 500gam</h3>
                        <p class="ĐonVi">ĐVT: Khay</p>
                        <p class="Gia"> Giá: 100.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="SPTS-list hidden">
                    <div class="SPTS-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2022/ba-chi-bo-cat-lat-new-zealand-khay-250g.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Ba chỉ bò New Zealand</h3>
                            <p class="ĐonVi">ĐVT: Khay</p>
                            <p class="Gia">Giá: 100.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart " onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="SPTS-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2022/gau-bo-my-cat-lat-acefoods-500g.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Gầu bò Mỹ thái lát</h3>
                            <p class="ĐonVi">ĐVT: Khay</p>
                            <p class="Gia">Giá: 100.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart " onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="SPTS-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2023/08/z2124914105773_b25ab420c6b8c67c59b6a11dc2d31478-20230809024050.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Cá basa tươi 1kg</h3>
                            <p class="ĐonVi">ĐVT: Con</p>
                            <p class="Gia">Giá: 100.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart " onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="SPTS-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2022/rau-bach-tuoc-ntf-dong-lanh-300g.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Râu bạch tuộc 300gam</h3>
                            <p class="ĐonVi">ĐVT: Con</p>
                            <p class="Gia">Giá: 100.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart " onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="SPTS-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2022/kg-phu-quoc.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Tôm sú tươi Hải Phòng 1kg</h3>
                            <p class="ĐonVi">ĐVT: Hộp</p>
                            <p class="Gia">Giá: 100.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart " onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                                   
                </div>
                <button class="SHowmore" onclick="SHowMore()">Hiển thị thêm</button>
            </div>
        </article>

        <article id="hoaqua-raucu">
            <div class="head">
                <div class="tieude">
                    <a href="#">Hoa Quả & Rau Củ</a>   
                </div>
            </div>
            <div class="Hoaqua-list">
                <div class="Hoaqua-item">
                    <img src="https://hcm.fstorage.vn/images/2022/162428532073510054624-kg-co-du-tuoi-mv-og.jpg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Cà chua Đà Lạt 500gam</h3>
                        <p class="ĐonVi">ĐVT: Khay</p>
                        <p class="Gia"> Giá: 50.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="Hoaqua-item">
                    <img src="https://hcm.fstorage.vn/images/2022/162427263937810054670-kg-bap-cai-trang-dl-l1-vineco-og.jpg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Bắp cải tím 300gam</h3>
                        <p class="ĐonVi">ĐVT: Khay</p>
                        <p class="Gia"> Giá: 13.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="Hoaqua-item">
                    <img src="https://hcm.fstorage.vn/images/2022/cai-bo-xoi-wineco-goi-300g_fa468060-04ec-45b7-9851-0fa2ce70d51b-og.jpg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Cải bó xôi 300gam</h3>
                        <p class="ĐonVi">ĐVT: Gói</p>
                        <p class="Gia"> Giá: 20.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="Hoaqua-item">
                    <img src="https://hcm.fstorage.vn/images/2022/rau-mam-cai-ngot_89e225a4-748a-4b71-9e65-1d2c54c2027d-og.jpg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Rau mầm cải ngọt 100g</h3>
                        <p class="ĐonVi">ĐVT: Hộp</p>
                        <p class="Gia"> Giá: 15.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="Hoaqua-item">
                    <img src="https://hcm.fstorage.vn/images/2022/gia-do-wineco-300g_30d1ca80-a65f-45af-b099-154e806a4be4-og.jpg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Giá đỗ 300gam</h3>
                        <p class="ĐonVi">ĐVT: Gói</p>
                        <p class="Gia"> Giá: 8.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="Hoaqua-list hidden">
                    <div class="Hoaqua-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2022/4.1_9446aa97-5151-4fe9-8f46-3ec8f19c5c8b-og.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Dưa lưới ruột vàng</h3>
                            <p class="ĐonVi">ĐVT: Quả</p>
                            <p class="Gia">Giá: 75.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart " onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="Hoaqua-itemhidden"style="display: none;">
                        <img src="https://storage.googleapis.com/teko-gae.appspot.com/media/image/2020/9/24/20200924_1c7a444d-0fce-48bb-b0a6-3c05002f801b.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Dưa hấu không hạt 2.5KG</h3>
                            <p class="ĐonVi">ĐVT: Gói</p>
                            <p class="Gia">Giá: 65.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart " onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="Hoaqua-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2022/162428165402310053991-g1-nam-mo-yoshimoto-nou-khay-150g-og.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Nấm kim châm</h3>
                            <p class="ĐonVi">ĐVT: Gói</p>
                            <p class="Gia">Giá: 12.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart " onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="Hoaqua-itemhidden"style="display: none;">
                        <img src="https://tmp.phongvu.vn/wp-content/uploads/2020/08/10053953-e1596710585282.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Bí đỏ tròn 1KG</h3>
                            <p class="ĐonVi">ĐVT: Quả</p>
                            <p class="Gia">Giá: 23.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart " onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="Hoaqua-itemhidden"style="display: none;">
                        <img src="https://tmp.phongvu.vn/wp-content/uploads/2020/11/Chanh-leo-chanh-d%C3%A2y-500g_1-e1604290813734.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Chanh leo (chanh dây) 1KG</h3>
                            <p class="ĐonVi">ĐVT: Khay</p>
                            <p class="Gia">Giá: 45.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart " onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div>       
                </div>
                <button class="MORE" onclick="SHowMore()">Hiển thị thêm</button>
            </div>
        </article>

        <article id="do-uong">
            <div class="head">
                <div class="tieude">
                    <a href="#">Đồ Uống</a>   
                </div>
            </div>
            <div class="Douong-list">
                <div class="Douong-item">
                    <img src="https://hcm.fstorage.vn/images/2022/tra-sua-dai-loan-mr-brown-chai-580ml.jpg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Trà sữa đài loan Mr Brown chai 580ml</h3>
                        <p class="ĐonVi">ĐVT: Chai</p>
                        <p class="Gia"> Giá: 23.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="Douong-item">
                    <img src="https://hcm.fstorage.vn/images/2023/09/sting-dau-330-t24-20230914043300.png" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Thùng 24 chai nước tăng lực Sting hương dâu tây 330ml</h3>
                        <p class="ĐonVi">ĐVT: Thùng</p>
                        <p class="Gia"> Giá: 255.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="Douong-item">
                    <img src="https://hcm.fstorage.vn/images/2023/09/1-bhx-thung-sting-vang-24-chai_330ml-tet-20230914042758.png" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Thùng 24 chai nước tăng lực nhân sâm Sting 330ml</h3>
                        <p class="ĐonVi">ĐVT: Thùng</p>
                        <p class="Gia"> Giá: 236.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="Douong-item">
                    <img src="https://hcm.fstorage.vn/images/2022/162428253412810011222-cha-nuoc-khoong-lavie-nap-the-thao-750ml-og.jpg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Nước khoáng thiên nhiên LaVie 1.5L</h3>
                        <p class="ĐonVi">ĐVT: Chai</p>
                        <p class="Gia"> Giá: 10.200 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="Douong-item">
                    <img src="https://hcm.fstorage.vn/images/2023/09/revive-500-l6-20230911104318.png" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Nước uống Isotonic 7 Up Revive 500ml</h3>
                        <p class="ĐonVi">ĐVT: Chai</p>
                        <p class="Gia"> Giá: 10.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                
                <div class="Douong-list hidden">
                    <div class="Douong-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2022/162428423469710012821-hop-g%C3%A0-ta-huynh-de-benh-minh-og.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Cà phê hòa tan 3in1 G7 hộp 288gam</h3>
                            <p class="ĐonVi">ĐVT: Hộp</p>
                            <p class="Gia">Giá: 65.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="Douong-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2023/09/10012783-20230922065527.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Cà phê hòa tan 3 trong 1 Nescafé hộp 340gam</h3>
                            <p class="ĐonVi">ĐVT: Hộp</p>
                            <p class="Gia">Giá: 71.200 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="Douong-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2022/f232813ae78dd3c362f1115dc0073260-20221014094049-og.png" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Bia 333 Export thùng 24 lon x 330ml</h3>
                            <p class="ĐonVi">ĐVT: Thùng</p>
                            <p class="Gia">Giá: 285.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="Douong-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2023/03/strongbow-dau-do-lon-le-20230307062438.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Nước táo lên men Strongbow vị dâu đỏ 330ml</h3>
                            <p class="ĐonVi">ĐVT: Lon</p>
                            <p class="Gia">Giá: 19.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="Douong-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2023/03/strongbow-tao-lon-le-20230307061956.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Nước ép lên men vị táo Strongbow Gold 330ml</h3>
                            <p class="ĐonVi">ĐVT: Lon</p>
                            <p class="Gia">Giá: 19.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div>                
                </div>
                <button class="Hienthi" onclick="SHowMore()">Hiển thị thêm</button>
            </div>
        </article>

        <article id="do-kho">
            <div class="head">
                <div class="tieude">
                    <a href="#">Đồ Khô</a>   
                </div>
            </div>
            <div class="Dokho-list">
                <div class="Dokho-item">
                    <img src="https://hcm.fstorage.vn/images/2022/162427258927910007361-hop-ho%C3%A0nh-thonh-tum-thit-dac-biet-vissan-200g-og.jpg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Heo hầm Vissan hộp <br>150gam</h3>
                        <p class="ĐonVi">ĐVT: Hộp</p>
                        <p class="Gia"> Giá: 30.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="Dokho-item">
                    <img src="https://hcm.fstorage.vn/images/2022/caoboi-masan-thit-vien-al-xot-ca-200gt30-caoboi-masan-thit-vien-al-xot-ca-200gt30_e6682438-4c3f-446d-9530-cb0a4cadaea1-og.jpg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Thịt viên Heo Cao Bồi Masan hộp 200g</h3>
                        <p class="ĐonVi">ĐVT: Hộp</p>
                        <p class="Gia"> Giá: 32.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="Dokho-item">
                    <img src="https://hcm.fstorage.vn/images/2022/miwon-rong-bien-gion-tron-hai-san-30gt30_7492c934-a92d-46cc-b438-51a9dde1ad1b-og.jpg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Rong Biển Giòn Trộn Hải Sản gói 30gam</h3>
                        <p class="ĐonVi">ĐVT: Gói</p>
                        <p class="Gia"> Giá: 41.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div> 
                <div class="Dokho-item">
                    <img src="https://hcm.fstorage.vn/images/2023/05/botnang-400g-copy-20230526075538.png" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Bột năng đa dụng Meizan gói 400gam</h3>
                        <p class="ĐonVi">ĐVT: Gói</p>
                        <p class="Gia"> Giá: 12.500 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="Dokho-item">
                    <img src="https://hcm.fstorage.vn/images/2023/04/ngoc-nuong-gao-st-25-dac-san-3kg-vns-1--20230426095943.png" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Gạo Ngọc Nương ST 25 đặc sản 3KG</h3>
                        <p class="ĐonVi">ĐVT: Gói</p>
                        <p class="Gia"> Giá: 104.700 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                
                <div class="Dokho-list hidden">
                    <div class="Dokho-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2023/08/10141091-20230831064215.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Tokpokki Hàn Quốc vị chua ngọt hộp 105gam</h3>
                            <p class="ĐonVi">ĐVT: Hộp</p>
                            <p class="Gia">Giá: 34.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="Dokho-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2022/162427281480910007984-g1-choo-thit-bam-vifon-gui-70g-og.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Cháo thịt bằm Vifon gói 70gam</h3>
                            <p class="ĐonVi">ĐVT: Gói</p>
                            <p class="Gia">Giá: 9.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="Dokho-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2022/162427539911710008076-t-do-choi-dat-nan-regis-726e-2-og.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Thùng 30 gói mì ăn Ba Miền 65gam</h3>
                            <p class="ĐonVi">ĐVT: Thùng</p>
                            <p class="Gia">Giá: 101.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="Dokho-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2023/08/lau-tu-soi-20230815031729.png" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">OMACHI Lẩu tự sôi bắp bò riêu cua</h3>
                            <p class="ĐonVi">ĐVT: Hộp</p>
                            <p class="Gia">Giá: 106.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="Dokho-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2022/vifon-mi-xao-phu-gia-tuong-den-90g-t18_f2cc29a5-e8a2-44c3-afa3-3d9bdeda27f8-og.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Mì xào tương đen Vifon hộp 90gam</h3>
                            <p class="ĐonVi">ĐVT: Hộp</p>
                            <p class="Gia">Giá: 12.700 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div>               
                </div>
                <button class="HienThi" onclick="SHowMore()">Hiển thị thêm</button>
            </div>
        </article>

        <article id="banhkeo-sua">
            <div class="head">
                <div class="tieude">
                    <a href="#">Bánh Kẹo & Sữa</a>   
                </div>
            </div>
            <div class="BKS-list">
                <div class="BKS-item">
                    <img src="https://hcm.fstorage.vn/images/2023/07/banh-c-est-bon-5p-ga-20230727093315.jpg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Bánh Bông Lan Ăn Sáng C'est Bon Sợi Thịt Gà</h3>
                        <p class="ĐonVi">ĐVT: Gói</p>
                        <p class="Gia"> Giá: 22.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="BKS-item">
                    <img src="https://hcm.fstorage.vn/images/2023/12/10013614-20231213071925.png" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Bánh bông lan cuốn vị dâu Solite hộp 360g</h3>
                        <p class="ĐonVi">ĐVT: Hộp</p>
                        <p class="Gia"> Giá: 51.300 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="BKS-item">
                    <img src="https://hcm.fstorage.vn/images/2024/05/screenshot_20-20240504085839.png" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">CUSTAS Bánh bông lan tiramisu 276gam</h3>
                        <p class="ĐonVi">ĐVT: Hộp</p>
                        <p class="Gia"> Giá: 60.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="BKS-item">
                    <img src="https://hcm.fstorage.vn/images/2022/poca-snack-muc-lan-muoi-ot-75g-t40_60be4056-c699-4a50-8096-5a6650a9bf0c-og.jpg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Snack mực lăn muối ớt Poca gói 75gam</h3>
                        <p class="ĐonVi">ĐVT: Gói</p>
                        <p class="Gia"> Giá: 10.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="BKS-item">
                    <img src="https://hcm.fstorage.vn/images/2022/39g_f93f1025-e31f-47de-866a-66fcddaac736-og.jpg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Snack tôm cay đặc biệt Oishi gói 45gam</h3>
                        <p class="ĐonVi">ĐVT: Gói</p>
                        <p class="Gia"> Giá:4.600 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                
                <div class="BKS-list hidden">
                    <div class="BKS-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2022/162428592113210014733-g1-bonh-trong-nuong-tum-cay-an-nhion-gui-60g-og.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Kẹo sữa caramen Alpenliebe gói 120gam</h3>
                            <p class="ĐonVi">ĐVT: Gói</p>
                            <p class="Gia">Giá: 15.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="BKS-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2022/9535454281758-og.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Kẹoo Kopiko Capuchiano Coffe 140gam</h3>
                            <p class="ĐonVi">ĐVT: Gói</p>
                            <p class="Gia">Giá: 16.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="BKS-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2022/162428538183010405642-g6-bia-budweiser-thung-24-lon-x-330ml-og.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Sữa tiệt trùng Bringrae Hương dưa lưới 200ml</h3>
                            <p class="ĐonVi">ĐVT: Lốc</p>
                            <p class="Gia">Giá: 110.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="BKS-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2022/10005342g4.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Sữa KUN vị cacao lúa mạch hộp 110ml</h3>
                            <p class="ĐonVi">ĐVT: Lốc</p>
                            <p class="Gia">Giá: 20.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="BKS-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2023/08/10005357-20230829032341.jpeg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Sữa tươi tiệt trùng ít đường Vinamilk 180ml</h3>
                            <p class="ĐonVi">ĐVT: Lốc</p>
                            <p class="Gia">Giá: 33.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div>          
                </div>
                <button class="hienThi" onclick="SHowMore()">Hiển thị thêm</button>
            </div>
        </article>

        <article id="do-dung-ca-nhan">
            <div class="head">
                <div class="tieude">
                    <a href="#">Đồ Dùng Cá Nhân</a>   
                </div>
            </div>
            <div class="DDCN-list">
                <div class="DDCN-item">
                    <img src="https://hcm.fstorage.vn/images/2024/06/8934839134068_1-20240611072213.png" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">CLOSEUP KDR WhiteNow BlueSapphire 100g</h3>
                        <p class="ĐonVi">ĐVT: Tuýp</p>
                        <p class="Gia"> Giá: 68.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="DDCN-item">
                    <img src="https://hcm.fstorage.vn/images/2023/04/ingredient-1-1--20230403093121.jpg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Kem đánh răng P/S bakingsoda&hươngthảo</h3>
                        <p class="ĐonVi">ĐVT: Tuýp</p>
                        <p class="Gia"> Giá: 49.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div> 
                <div class="DDCN-item">
                    <img src="https://hcm.fstorage.vn/images/2023/08/listerine-20230816092422.jpeg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Nước súc miệng diệt khuẩn ListerineCoolMint 750ml</h3>
                        <p class="ĐonVi">ĐVT: Chai</p>
                        <p class="Gia"> Giá: 169.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div> 
                <div class="DDCN-item">
                    <img src="https://hcm.fstorage.vn/images/2023/03/cm_kv_adapt-20230329081132.jpg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Dầu gội Clear Men Cool Sport bạc hà 630gam</h3>
                        <p class="ĐonVi">ĐVT: Chai</p>
                        <p class="Gia"> Giá: 180.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div> 
                <div class="DDCN-item">
                    <img src="https://hcm.fstorage.vn/images/2024/01/10016873-20240125021124.jpg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Dầu gội cao cấp Romano classic 380gam</h3>
                        <p class="ĐonVi">ĐVT: Chai</p>
                        <p class="Gia"> Giá: 89.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                
                <div class="DDCN-list hidden">
                    <div class="DDCN-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2023/04/10020131-kotex-bvs-style-luoi-sieu-tham-smc-8-goi-20230405064038.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Băng vệ sinh Kotex Style siêu mỏng cánh 8 miếng</h3>
                            <p class="ĐonVi">ĐVT: Gói</p>
                            <p class="Gia">Giá: 21.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="DDCN-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2023/09/10020358-20230926095946.png" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Bông tai Niva túi zipper 100 que</h3>
                            <p class="ĐonVi">ĐVT: Gói</p>
                            <p class="Gia">Giá: 10.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="DDCN-itemhidden"style="display: none;">
                        <img src="https://media.shoptretho.com.vn/upload/image/product/20230417/khau-trang-carbon-than-hoat-tinh-4-lop-dr-mask-30c-hop.png" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Khẩu trang Dr.Mask 4D gói 5c</h3>
                            <p class="ĐonVi">ĐVT: Gói</p>
                            <p class="Gia">Giá: 20.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="DDCN-itemhidden"style="display: none;">
                        <img src="https://vanphongphamvistaco.com/upload/images/nuoc-rua-tay-lifebuoy-500gr-1195.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Nước rửa tay Lifebuoy chai 500gam</h3>
                            <p class="ĐonVi">ĐVT: Chai</p>
                            <p class="Gia">Giá: 76.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="DDCN-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2023/11/10017422-enchanteur-sua-tam-charming-650g-20231101030802.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Sữa tắm Enchanteur Charming 650gam</h3>
                            <p class="ĐonVi">ĐVT: Chai</p>
                            <p class="Gia">Giá: 196.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div>           
                </div>
                <button class="hienthi" onclick="SHowMore()">Hiển thị thêm</button>
            </div>
        </article>

        <article id="do-gia-dung">
            <div class="head">
                <div class="tieude">
                    <a href="#">Đồ Gia Dụng</a>   
                </div>
            </div>
            <div class="DGD-list">
                <div class="DGD-item">
                    <img src="https://hcm.fstorage.vn/images/2022/162428346329910628091-cai-bo-chan-ga-goi-chan-jasmine-160*200-vp76-og.jpg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Thùng rác nắp lật Inochi<br> 5L</h3>
                        <p class="ĐonVi">ĐVT: Cái</p>
                        <p class="Gia"> Giá: 125.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="DGD-item">
                    <img src="https://hcm.fstorage.vn/images/2022/tham-len-hinh-thu-day.jpg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Thảm len dày hình thú AP 40x60</h3>
                        <p class="ĐonVi">ĐVT: Cái</p>
                        <p class="Gia"> Giá: 190.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="DGD-item">
                    <img src="https://hcm.fstorage.vn/images/2023/09/8-20230907103241.png" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Chảo Cookplus Stone Lock&Lock 28cm (Đen)</h3>
                        <p class="ĐonVi">ĐVT: Cái</p>
                        <p class="Gia"> Giá: 800.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="DGD-item">
                    <img src="https://hcm.fstorage.vn/images/2022/26996670136350-og.jpg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Chảo trơn chống dính Sunhouse CT26 - 26cm</h3>
                        <p class="ĐonVi">ĐVT: Cái</p>
                        <p class="Gia"> Giá: 200.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="DGD-item">
                    <img src="https://hcm.fstorage.vn/images/2022/bo-noi-inox-5-day-sunhouse-shg788.jpg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Bộ nồi inox 5 đáy Sunhouse SHG788</h3>
                        <p class="ĐonVi">ĐVT: Bộ</p>
                        <p class="Gia"> Giá: 920.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                
                <div class="DGD-list hidden">
                    <div class="DGD-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2023/02/hop-thuc-pham-hokkaido-tron-1500ml.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Hộp thực phẩm Hokkaido tròn 1500ml</h3>
                            <p class="ĐonVi">ĐVT: Cái</p>
                            <p class="Gia">Giá: 53.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="DGD-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2022/khay-dung-vat-dung-nha-bep-inomata-4518.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Khay đựng vật dụng nhà bếp Inomata 4518</h3>
                            <p class="ĐonVi">ĐVT: Cái</p>
                            <p class="Gia">Giá: 35.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="DGD-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2023/08/10136845-20230829072005.jpeg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Vợt muỗi SUNHOUSE SHE-S800</h3>
                            <p class="ĐonVi">ĐVT: Cái</p>
                            <p class="Gia">Giá: 168.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="DGD-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2022/eveready-pin-hd-1015-bp4-size-aa_a121b870-0712-4d15-9bdd-e1e88aa35b5e-og.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Pin Eveready HD 1015 BP4AA</h3>
                            <p class="ĐonVi">ĐVT: Vỉ</p>
                            <p class="Gia">Giá: 23.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="DGD-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2022/binh-nuoc-cao-cap-biwa-1-2l.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Bình nước cao cấp Inochi Biwa 1.2L</h3>
                            <p class="ĐonVi">ĐVT: Cái</p>
                            <p class="Gia">Giá: 135.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div>    
                </div>
                <button class="More" onclick="SHowMore()">Hiển thị thêm</button>
            </div>
        </article>

        <article id="ve-sinh-nha-cua">
            <div class="head">
                <div class="tieude">
                    <a href="#">Vệ Sinh Nhà Cửa</a>   
                </div>
            </div>
            <div class="VS-list">
                <div class="VS-item">
                    <img src="https://hcm.fstorage.vn/images/2022/sap-thom-glade-huong-hoa-lai-180g-xanh-la-cay-_abaa238b-55e8-4af2-91ff-1c8fe65d1b7c-og.jpg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Sáp thơm Glade hương hoa lài 180gam</h3>
                        <p class="ĐonVi">ĐVT: Hộp</p>
                        <p class="Gia"> Giá: 55.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="VS-item">
                    <img src="https://hcm.fstorage.vn/images/2022/sap-thom-glade-huong-hoa-180g-hong-_e3dd2931-734d-4ddb-a793-3011555a003e-og.jpg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Sáp thơm Glade hương cỏ hoa 180gam</h3>
                        <p class="ĐonVi">ĐVT: Hộp</p>
                        <p class="Gia"> Giá: 55.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="VS-item">
                    <img src="https://hcm.fstorage.vn/images/2022/xit-phong-glade-huong-lavender-280ml-20221007080632-og.jpg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Xịt phòng Glade hương lavender 280ml</h3>
                        <p class="ĐonVi">ĐVT: Chai</p>
                        <p class="Gia"> Giá: 55.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="VS-item">
                    <img src="https://hcm.fstorage.vn/images/2022/tui-rac-tien-dung-co-quai-54-70cm.jpg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Túi rác tiện dụng (có quai) 54*70cm</h3>
                        <p class="ĐonVi">ĐVT: CUộn</p>
                        <p class="Gia"> Giá: 20.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="VS-item">
                    <img src="https://hcm.fstorage.vn/images/2022/nuoc-thong-tac-da-nang-goodcare-chai-1kg.jpg" alt="" class="product-image">
                    <div class="ThongtinSP">
                        <h3 class="Ten">Nước thông tắc đa năng Goodcare chai 1KG</h3>
                        <p class="ĐonVi">ĐVT: Chai</p>
                        <p class="Gia"> Giá: 69.000 đ</p>
                        <div class="quantity-control" style="display:none;">
                            <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                            <span class="quantity">1</span>
                            <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                    </div>
                </div>
                
                <div class="VS-list hidden">
                    <div class="VS-itemhidden"style="display: none;">
                        <img src="https://ptphucthinh.com/wp-content/uploads/2017/08/choi-quet-nha-long-co.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Chổi cỏ cán nhựa quét nhà</h3>
                            <p class="ĐonVi">ĐVT: Cái</p>
                            <p class="Gia">Giá: 26.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="VS-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2022/ban-chai-nha-tam-aisen-th001.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Bàn chải nhà tắm Aisen</h3>
                            <p class="ĐonVi">ĐVT: Cái</p>
                            <p class="Gia">Giá: 70.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="VS-itemhidden"style="display: none;">
                        <img src="https://hcm.fstorage.vn/images/2022/bo-lau-nha-starplus-ms03.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Bộ lau nhà Starplus MS03</h3>
                            <p class="ĐonVi">ĐVT: Bộ</p>
                            <p class="Gia">Giá: 420.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="VS-itemhidden"style="display: none;">
                        <img src="https://khohangtieudung.vn/wp-content/uploads/2022/05/vim-diet-khuan.jpg" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Nước tẩy rửa bồn cầu Vim</h3>
                            <p class="ĐonVi">ĐVT: Chai</p>
                            <p class="Gia">Giá: 37.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div> 
                    <div class="VS-itemhidden"style="display: none;">
                        <img src="https://bizweb.dktcdn.net/100/299/021/products/8934868162407-1670207031972.jpg?v=1670902223273" alt="" class="product-image">
                        <div class="ThongtinSP">
                            <h3 class="Ten">Nước lau sàn Sunlight 997ml</h3>
                            <p class="ĐonVi">ĐVT: Chai</p>
                            <p class="Gia">Giá: 33.000 đ</p>
                            <div class="quantity-control" style="display:none;">
                                <button class="decrease" onclick="changeQuantity(this, -1)">-</button>
                                <span class="quantity">1</span>
                                <button class="increase" onclick="changeQuantity(this, 1)">+</button>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(this)">Thêm vào giỏ</button>
                        </div>
                    </div>         
                </div>
                <button class="more" onclick="SHowMore()">Hiển thị thêm</button>
            </div>
        </article>
        

    </div>
    
    <script src="index.js"></script>
       
    <footer>
        @Copyringt 2024
    </footer>
</body>
</html>
