<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 1) {
    header('Location: http://localhost/website-py/Graphics/login/Dangnhap.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Trị Viên</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <aside class="w-64 bg-red-800 text-white p-6">
            <h1 class="text-2xl font-bold mb-8">Bảng quản lý</h1>
            <nav>
                <ul>
                    <li class="mb-4"><a href="#general" class="hover:text-blue-300" style="font-weight: bold;">Thông Tin Chung</a></li>
                    <li class="mb-4"><a href="http://localhost/website-py/admin/products/sanpham.php" class="hover:text-blue-300" style="font-weight: bold;">Quản Lý Sản Phẩm</a></li>
                    <li class="mb-4"><a href="http://localhost/website-py/admin/nhanvien/index.html" class="hover:text-blue-300" style="font-weight: bold;">Quản Lý Nhân Viên</a></li>
                    <li class="mb-4"><a href="#invoices" class="hover:text-blue-300" style="font-weight: bold;">Hóa Đơn</a></li>
                    <li class="mb-4"><a href="#income" class="hover:text-blue-300" style="font-weight: bold;">Thu Nhập</a></li>
                </ul>
            </nav>
        </aside>

        <main class="flex-1 p-8 overflow-y-auto">

            <section id="general" class="mb-12">
                <h2 class="text-2xl font-bold mb-6">Thông tin tổng quan</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold mb-2">Số lượng sản phẩm</h3>
                        <p class="text-3xl font-bold text-blue-600">0</p> 
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold mb-2">Số lượng nhân viên</h3>
                        <p class="text-3xl font-bold text-green-600" id="employee-count">0</p> 
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold mb-2">Tổng số hóa đơn</h3>
                        <p class="text-3xl font-bold text-purple-600">789</p>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold mb-2">Tổng thu nhập</h3>
                        <p class="text-3xl font-bold text-yellow-600">$987,654</p>
                    </div>
                </div>
            </section>

        </main>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
    // lấy tổng số lượng sản phẩm
    fetch('tongsp.php')
        .then(response => response.json())
        .then(data => {
            
            if (data.total_quantity !== undefined) {
                const totalProductsEl = document.querySelector('.text-3xl'); 
                totalProductsEl.textContent = data.total_quantity; 
            } else {
                console.error('Không thể lấy tổng số lượng sản phẩm.');
            }
        })
        .catch(error => {
            console.error('CÓ lỗi xảy ra', error);
        });

    });
    // Cập nhật số lượng nhân viên
    updateEmployeeCount();
    function updateEmployeeCount() {
        const employees = JSON.parse(localStorage.getItem('employees')) || [];
        document.getElementById("employee-count").innerText = employees.length;
    }
    </script>

</body>
</html>