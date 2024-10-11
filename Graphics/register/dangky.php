<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);
ini_set('error_log', 'C:/xampp/htdocs/website-py/Graphics/register/php_errors.log');

$servername = "localhost";
$username = "admin000";
$password = "123";
$dbname = "quanly_sieuthi";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Kết nối thất bại: " . $conn->connect_error]));
} else {
    error_log("Kết nối database thành công");
}

$conn->autocommit(TRUE);

error_log("POST data: " . print_r($_POST, true));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = []; 
    
    $taikhoan = trim($_POST['taiKhoan'] ?? '');
    $matkhau = trim($_POST['matKhau'] ?? '');
    $confirmPassword = trim($_POST['xacNhanMatKhau'] ?? '');
    $name = trim($_POST['hoTen'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $address = trim($_POST['diaChi'] ?? '');
    $sdt = trim($_POST['soDienThoai'] ?? '');

    // Kiểm tra các trường bắt buộc
    if (empty($taikhoan)) {
        $errors['taiKhoan'] = 'Tài khoản không được để trống';
    }
    if (empty($name)) {
        $errors['hoTen'] = 'Họ tên không được để trống';
    }
    if (empty($email)) {
        $errors['email'] = 'Email không được để trống';
    }
    if (empty($address)) {
        $errors['diaChi'] = 'Địa chỉ không được để trống';
    }
    if (empty($sdt)) {
        $errors['soDienThoai'] = 'Số điện thoại không được để trống';
    }
    if (empty($taikhoan)) {
        $errors['taiKhoan'] = 'Tài khoản không được để trống';
    }
    if (empty($matkhau)) {
        $errors['matKhau'] = 'Mật khẩu không được để trống';
    }
    if (empty($confirmPassword)) {
        $errors['xacNhanMatKhau'] = 'Vui lòng xác nhận lại mật khẩu';
    }

    // Kiểm tra mật khẩu khớp nhau
    if ($matkhau !== $confirmPassword) {
        $errors['xacNhanMatKhau'] = 'Mật khẩu không khớp';
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email không hợp lệ';
    }

    // Validate số điện thoại
    if (!preg_match('/^[0-9]{10,11}$/', $sdt)) {
        $errors['soDienThoai'] = 'Số điện thoại không hợp lệ';
    }

    // Kiểm tra tài khoản đã tồn tại
    $sqlCheck = "SELECT * FROM customer WHERE taikhoan = ?";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->bind_param("s", $taikhoan);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();
    
    if ($resultCheck->num_rows > 0) {
        $errors['taiKhoan'] = 'Tài khoản đã tồn tại.';
    }

    if (!empty($errors)) {
        echo json_encode(["success" => false, "errors" => $errors]);
        exit();
    }

    
    $sql = "INSERT INTO customer (name, email, address, sdt, taikhoan, matkhau) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo json_encode(["success" => false, "message" => "Lỗi trong quá trình chuẩn bị truy vấn."]);
        exit();
    }

    $stmt->bind_param("ssssss", $name, $email, $address, $sdt, $taikhoan, $matkhau);
    
  
    if ($stmt->execute()) {
        $last_id = $conn->insert_id; 
        error_log("Chèn dữ liệu thành công. ID: $last_id");
        echo json_encode(["success" => true, "message" => "Đăng ký thành công!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Lỗi: Không thể chèn dữ liệu vào cơ sở dữ liệu."]);
    }
    
    $stmt->close();
}
$conn->close();
?>
