<?php
$servername = "localhost";
$username = "admin000";
$password = "123";
$dbname = "quanly_sieuthi";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
function getCategories($conn) {
    $result = $conn->query("SELECT DISTINCT phanloai FROM sanpham");
    $categories = [];
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row['phanloai'];
    }
    return $categories;
}
$categories = getCategories($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Siêu Thị</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Quản Lý Siêu Thị</h1>
    </header>

    <main>
        <section id="products">
            <h2>Danh Sách Sản Phẩm</h2>
            <label for="category-filter">Chọn Phân Loại:</label>
            <select id="category-filter" onchange="filterProducts()">
                <option value="">Tất cả</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category; ?>"><?= $category; ?></option>
                <?php endforeach; ?>
            </select>
        
            <table id="productTable">
                <thead>
                    <tr>
                        <th>Ảnh Sản Phẩm</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Giá Nhập</th>
                        <th>Giá Cũ</th>
                        <th>Giá Bán</th>
                        <th>Số Lượng</th>
                        <th>Đơn Vị</th>
                        <th>Phân Loại</th>
                        <th>Ngày Nhập</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                
                </tbody>
            </table>
        </section>

        <section id="add-product">
            <h2>Thêm Sản Phẩm</h2>
          
            <form onsubmit="addProduct(event)" enctype="multipart/form-data">
                
                <label for="product-name">Tên Sản Phẩm:</label><br>
                <input type="text" id="product-name" required><br>
                
                <label for="product-price">Giá Nhập:</label><br>
                <input type="number" id="product-price" required><br>

                <label for="product-old-price">Giá Cũ:</label><br>
                <input type="number" id="product-old-price" ><br>
                
                <label for="product-sale-price">Giá Bán:</label><br>
                <input type="number" id="product-sale-price" required><br>

                <label for="product-quantity">Số Lượng:</label><br>
                <input type="number" id="product-quantity" required><br>

                <label for="product-Donvi">Đơn vị:</label><br>
                <input type="text" id="product-Donvi" required><br>

                <label for="product-category">Phân Loại:</label><br>
                <input type="text" id="product-category" required><br>

                <label for="product-date">Ngày Nhập:</label><br>
                <input type="date" id="product-date" required><br>

                <div style="margin-top:5px; transform: translateX(23%);">
                    <label for="product-image">Ảnh Sản Phẩm:</label><br>
                    <input type="file" id="product-image" accept="image/*"><br>
                </div>

                <div class="nut" style="display: flex; gap: 10px; margin-top: 10px;">
                    <button type="submit">Thêm Sản Phẩm</button>
                    <button type="button" id="update-button" style="display:none;">Cập Nhật</button>
                </div>

                <div style="margin-left: 30%; transform: translate(-10%,-150%); display: flex; align-items: center;">
                    <img id="current-product-image" src="" alt="Current Image" style="width: 200px; height: 200px; border: 1px solid #ccc; border-radius: 4px;">
                </div>
            </form>
           

        </section>
    </main>

    <footer>
        <p>2024 Quản Lý Siêu Thị</p>
    </footer>

    <script>
        let currentEditRow = null; 

        function fetchProducts() {           
            fetch(`api.php?action=fetch`)
                .then(response => response.json())
                .then(products => {
                    const table = document.getElementById('productTable').getElementsByTagName('tbody')[0];
                    table.innerHTML = ''; 
                    products.forEach(product => {
                        const newRow = table.insertRow();
                        newRow.setAttribute('data-id', product.MaSP);
                        const imageUrl = product.image ? product.image : 'default-image'; 
                        newRow.innerHTML = `
                            <td><img src="${imageUrl}" alt="Product Image" style="width: 80px; height: 80px;"></td>
                            <td>${product.ten}</td>
                            <td>${product.gianhap} VNĐ</td>
                            <td>${product.giacu} VNĐ</td>
                            <td>${product.giaban} VNĐ</td>
                            <td>${product.soluong}</td>
                            <td>${product.donvi}</td>
                            <td>${product.phanloai}</td>
                            <td>${product.date}</td>
                            <td>
                                <button onclick="editProduct(this)">Sửa</button>
                                <button onclick="deleteProduct(${product.MaSP})">Xóa</button>
                            </td>
                        `;
                    });
                })
                .catch(error => {
                    console.error('Lỗi khi lấy sản phẩm:', error);
                });
        }

        function filterProducts() {
            const selectedCategory = document.getElementById('category-filter').value;
            console.log("Phân loại đã chọn:", selectedCategory); 

            fetch(`api.php?action=fetch&category=${encodeURIComponent(selectedCategory)}`)
                .then(response => response.json())
                .then(products => {
                    const table = document.getElementById('productTable').getElementsByTagName('tbody')[0];
                    table.innerHTML = ''; 
                    products.forEach(product => {
                        const newRow = table.insertRow();
                        newRow.setAttribute('data-id', product.MaSP);
                        const imageUrl = product.image ? product.image : 'default-image.jpg'; 
                        newRow.innerHTML = `
                            <td><img src="${imageUrl}" alt="Product Image" style="width: 80px; height: 80px;"></td>
                            <td>${product.ten}</td>
                            <td>${product.gianhap} VNĐ</td>
                            <td>${product.giacu} VNĐ</td>
                            <td>${product.giaban} VNĐ</td>
                            <td>${product.soluong}</td>
                            <td>${product.donvi}</td>
                            <td>${product.phanloai}</td>
                            <td>${product.date}</td>
                            <td>
                                <button onclick="editProduct(this)">Sửa</button>
                                <button onclick="deleteProduct(${product.MaSP})">Xóa</button>
                            </td>
                        `;
                    });
                })
                .catch(error => {
                    console.error('Lỗi khi lọc sản phẩm:', error);
                });
        }

        function addProduct(event) {
        event.preventDefault();

        const formData = new FormData();
        formData.append('name', document.getElementById('product-name').value);
        formData.append('purchasePrice', document.getElementById('product-price').value);
        formData.append('oldPrice', document.getElementById('product-old-price').value);
        formData.append('salePrice', document.getElementById('product-sale-price').value);
        formData.append('quantity', document.getElementById('product-quantity').value);
        formData.append('DV', document.getElementById('product-Donvi').value);
        formData.append('category', document.getElementById('product-category').value);
        formData.append('date', document.getElementById('product-date').value);
        formData.append('image', document.getElementById('product-image').files[0]); 

        fetch('api.php?action=add', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(product => {
            if (product.status === 'success') {
                console.log('Sản phẩm được thêm:', product);
                fetchProducts();
                resetForm();
            } else {
                alert('Có lỗi xảy ra: ' + product.message);
            }
        })
        .catch(error => {
            console.error('Lỗi:', error);
            alert('Có lỗi xảy ra khi thêm sản phẩm');
        });
        }

        function resetForm() {
            document.getElementById('product-name').value = '';
            document.getElementById('product-price').value = '';
            document.getElementById('product-old-price').value = '';
            document.getElementById('product-sale-price').value = '';
            document.getElementById('product-quantity').value = '';
            document.getElementById('product-Donvi').value = '';
            document.getElementById('product-category').value = '';
            document.getElementById('product-date').value = '';
            
            document.getElementById('update-button').style.display = 'none'; 
            currentEditRow = null; 
        }

        function deleteProduct(MaSP) {
            if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này?")) {
                fetch(`api.php?action=delete&id=${MaSP}`, {
                    method: 'DELETE'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        fetchProducts();
                    } else {
                        alert('Có lỗi xảy ra khi xóa sản phẩm');
                    }
                })
                .catch(error => {
                    console.error('Lỗi:', error);
                });
            }
        }

        function editProduct(button) {
            const row = button.parentElement.parentElement;
            const imageCell = row.cells[0].querySelector('img').src; 
            const nameCell = row.cells[1];
            const purchasePriceCell = row.cells[2];
            const oldPriceCell = row.cells[3];
            const salePriceCell = row.cells[4];
            const quantityCell = row.cells[5];
            const DVCell = row.cells[6];
            const categoryCell = row.cells[7];
            const dateCell = row.cells[8];

            document.getElementById('product-name').value = nameCell.textContent;
            document.getElementById('product-price').value = purchasePriceCell.textContent.replace(' VNĐ', '');
            document.getElementById('product-old-price').value = oldPriceCell.textContent.replace(' VNĐ', '');
            document.getElementById('product-sale-price').value = salePriceCell.textContent.replace(' VNĐ', '');
            document.getElementById('product-quantity').value = quantityCell.textContent;
            document.getElementById('product-Donvi').value =DVCell.textContent;
            document.getElementById('product-category').value = categoryCell.textContent;
            document.getElementById('product-date').value = dateCell.textContent;

            document.getElementById('current-product-image').src = imageCell; 

            currentEditRow = row;

            const updateButton = document.getElementById('update-button');
            updateButton.style.display = 'block'; 
            updateButton.onclick = () => updateProduct(row);
        }

        function updateProduct(row) {
            const updatedName = document.getElementById('product-name').value;
            const updatedPurchasePrice = document.getElementById('product-price').value;
            const updatedOldPrice = document.getElementById('product-old-price').value;
            const updatedSalePrice = document.getElementById('product-sale-price').value;
            const updatedQuantity = document.getElementById('product-quantity').value;
            const updatedDonvi = document.getElementById('product-Donvi').value;
            const updatedCategory = document.getElementById('product-category').value;
            const date = document.getElementById('product-date').value;

            const productId = row.dataset.id;

            const formData = new FormData();
            formData.append('id', productId); 
            formData.append('name', updatedName);
            formData.append('purchasePrice', updatedPurchasePrice);
            formData.append('oldPrice', updatedOldPrice);
            formData.append('salePrice', updatedSalePrice);
            formData.append('quantity', updatedQuantity);
            formData.append('DV', updatedDonvi);
            formData.append('category', updatedCategory);
            formData.append('date', date);

            const imageFile = document.getElementById('product-image').files[0];
            if (imageFile) {
                formData.append('image', imageFile); 
            }

            fetch('api.php?action=update&id=' + productId, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(result => {
                console.log(result);
                if (result.status === 'success') {
                    row.cells[1].textContent = updatedName;
                    row.cells[2].textContent = updatedPurchasePrice + ' VNĐ';
                    row.cells[3].textContent = updatedOldPrice + ' VNĐ';
                    row.cells[4].textContent = updatedSalePrice + ' VNĐ';
                    row.cells[5].textContent = updatedQuantity;
                    row.cells[6].textContent = updatedDonvi;
                    row.cells[7].textContent = updatedCategory;
                    row.cells[8].textContent = date;

                    if (imageFile) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            row.cells[0].querySelector('img').src = e.target.result; 
                        };
                        reader.readAsDataURL(imageFile);
                    }

                    resetForm();
                } else {
                    alert('Có lỗi xảy ra khi cập nhật sản phẩm: ' + result.message);
                }
            })
            .catch(error => {
                console.error('Lỗi:', error);
                alert('Có lỗi xảy ra khi cập nhật sản phẩm');
            });
        }

        fetchProducts();
    </script>
</body>
</html>
