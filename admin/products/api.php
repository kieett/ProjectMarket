<?php
header('Content-Type: application/json'); 
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

$servername = "localhost";
$username = "admin000";
$password = "123";
$dbname = "quanly_sieuthi";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'fetch':
        $category = $_GET['category'] ?? '';
        $query = "SELECT * FROM sanpham";
        if ($category) {
            $query .= " WHERE phanloai = '$category'";
        }
        $result = $conn->query($query);
        $sanpham = [];
        while ($row = $result->fetch_assoc()) {
            $sanpham[] = $row;
        }
        echo json_encode($sanpham);
        break;

    case 'add':
        // Thêm sản phẩm mới
        $ten = $conn->real_escape_string($_POST['name']);
        $gianhap = (float)$_POST['purchasePrice'];
        $giacu = (float)$_POST['oldPrice'];
        $giaban = (float)$_POST['salePrice'];
        $soluong = (int)$_POST['quantity'];
        $donvi = $conn->real_escape_string($_POST['DV']);
        $phanloai = $conn->real_escape_string($_POST['category']);
        $date = $_POST['date']; 

        // Xử lý ảnh
        $imagePath = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $targetDir = "uploads/";
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true); 
            }
            $imageFileName = time() . '_' . basename($_FILES['image']['name']);
            $targetFile = $targetDir . $imageFileName;
        
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $imagePath = $targetFile; 
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Tải lên file thất bại']);
                exit;
            }
        }

        // Chèn dữ liệu vào cơ sở dữ liệu
        if ($conn->query("INSERT INTO sanpham (ten, gianhap,giacu, giaban, soluong, donvi, phanloai, date, image) VALUES ('$ten', $gianhap, $giacu, $giaban, $soluong, '$donvi', '$phanloai', '$date','$imagePath')") === TRUE) {
            $MaSP = $conn->insert_id;
            echo json_encode(['status' => 'success', 'id' => $MaSP, 'name' => $ten, 'purchase_price' => $gianhap, 'old_price'=>$giacu, 'sale_price' => $giaban, 'quantity' => $soluong, 'DV'=>$donvi, 'category' => $phanloai, 'date' => $date]);
        } else {
            echo json_encode(['status' => 'error', 'message' => $conn->error]);
        }
        break;

    case 'delete':
        // Xóa sản phẩm
        $MaSP = (int)$_GET['id'];
        $stmt = $conn->prepare("DELETE FROM sanpham WHERE MaSP = ?");
        $stmt->bind_param("i", $MaSP);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }
        break;

    case 'update':
            $MaSP = (int)$_POST['id'];
            $ten = $conn->real_escape_string($_POST['name']);
            $gianhap = (float)$_POST['purchasePrice'];
            $giacu = (float)$_POST['oldPrice'];
            $giaban = (float)$_POST['salePrice'];
            $soluong = (int)$_POST['quantity'];
            $donvi = $conn->real_escape_string($_POST['DV']);
            $phanloai = $conn->real_escape_string($_POST['category']);
            $date = $_POST['date'];
        
            $imagePath = '';
        
            $result = $conn->query("SELECT image FROM sanpham WHERE MaSP = $MaSP");
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $oldImagePath = $row['image']; 
            }
        
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $targetDir = "uploads/";
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true); 
                }
        
                $imageFileName = time() . '_' . basename($_FILES['image']['name']);
                $targetFile = $targetDir . $imageFileName;
        
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $imagePath = $targetFile; 
        
                    if (!empty($oldImagePath) && $oldImagePath !== 'default-image.jpg' && file_exists($oldImagePath)) {
                        unlink($oldImagePath); 
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Tải lên file thất bại']);
                    exit; 
                }
            } else {
                $imagePath = $oldImagePath;
            }
        
            $updateQuery = "UPDATE sanpham SET ten = '$ten', gianhap = $gianhap, giacu=$giacu, giaban = $giaban, soluong = $soluong, donvi='$donvi', phanloai = '$phanloai', date = '$date', image = '$imagePath' WHERE MaSP = $MaSP";
        
            if ($conn->query($updateQuery) === TRUE) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => $conn->error]);
            }
            break;
        
    default:
        echo json_encode(['status' => 'invalid action']);
        break;
}

$conn->close();
?>
