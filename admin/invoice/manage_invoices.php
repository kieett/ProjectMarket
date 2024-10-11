<?php

$servername = "localhost"; 
$username = "admin000"; 
$password = "123"; 
$dbname = "quanly_sieuthi"; 

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lưu hóa đơn vào cơ sở dữ liệu
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $maHD = $_POST['maHD'];
    $maSP = $_POST['maSP'];
    $uid = $_POST['uid'];
    $tongTien = $_POST['tongTien'];
    $trangThai = $_POST['trangThai'];
    $ngayNhap = date('Y-m-d'); // Ngày hiện tại
    $note = $_POST['note'];

    $sql = "INSERT INTO hoadon (MaHD, MaSP, uid, tongtien, trangthai, ngaynhap, note) VALUES ('$maHD', '$maSP', '$uid', '$tongTien', '$trangThai', '$ngayNhap', '$note')";

    if ($conn->query($sql) === TRUE) {
        echo "Hóa đơn đã được lưu thành công";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

// Lấy danh sách hóa đơn từ cơ sở dữ liệu
$sql = "SELECT * FROM hoadon";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Xuất dữ liệu cho mỗi hàng
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['MaHD'] . "</td>
                <td>" . $row['MaSP'] . "</td>
                <td>" . $row['uid'] . "</td>
                <td>" . $row['tongtien'] . "</td>
                <td>" . $row['trangthai'] . "</td>
                <td>" . $row['ngaynhap'] . "</td>
                <td>" . $row['note'] . "</td>
                <td>
                    <button onclick='editInvoice(\"" . $row['MaHD'] . "\")'>Sửa</button>
                    <button onclick='deleteInvoice(\"" . $row['MaHD'] . "\")'>Xóa</button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='8'>Không có hóa đơn nào</td></tr>";
}

$conn->close();
?>
