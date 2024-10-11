<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "admin000";
$password = "123";
$dbname = "quanly_sieuthi";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Kết nối thất bại: " . $conn->connect_error]));
}

$data = $_POST;
$taikhoan = $_SESSION['username'];

// Xử lý ảnh nếu có tải lên
$newImgName = null;
if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
    $img = $_FILES['img'];
    $imgName = $img['name'];
    $imgTmpName = $img['tmp_name'];
    $imgSize = $img['size'];
    $imgError = $img['error'];

    if ($imgSize > 10000000) {
        echo json_encode(['success' => false, 'message' => 'Dung lượng file tối đa 10 MB.']);
        exit();
    }

    $imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png'];
    if (!in_array($imgExt, $allowed)) {
        echo json_encode(['success' => false, 'message' => 'Định dạng file không hợp lệ.']);
        exit();
    }

    $newImgName = uniqid('', true) . "." . $imgExt;
    $imgDestination = 'uploads/' . $newImgName;

    if (!file_exists('uploads')) {
        mkdir('uploads', 0777, true);
    }

    move_uploaded_file($imgTmpName, $imgDestination);
}

// Nếu người dùng không tải lên ảnh, lấy ảnh hiện tại từ cơ sở dữ liệu
if ($newImgName === null) {
    $stmt = $conn->prepare("SELECT img FROM customer WHERE taikhoan = ?");
    $stmt->bind_param("s", $taikhoan);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $newImgName = $user['img']; 
    }
    $stmt->close();
}


$stmt = $conn->prepare("UPDATE customer SET name = ?, address = ?, email = ?, sdt = ?, img = ? WHERE taikhoan = ?");
$stmt->bind_param("ssssss", $data['name'], $data['address'], $data['email'], $data['sdt'], $newImgName, $taikhoan);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Cập nhật không thành công.']);
}

$stmt->close();
$conn->close();
?>
