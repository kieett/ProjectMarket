<?php
session_start();
ob_start();
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

// Xử lý đổi mật khẩu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        echo json_encode(['success' => false, 'message' => 'Mật khẩu không khớp.']);
        exit();
    }

    $taikhoan = $_SESSION['username'];

    // Cập nhật mật khẩu trong cơ sở dữ liệu
    $stmt = $conn->prepare("UPDATE customer SET matkhau = ? WHERE taikhoan = ?");
    $stmt->bind_param("ss", $new_password, $taikhoan);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Đổi mật khẩu thành công.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Đổi mật khẩu không thành công.']);
    }

    $stmt->close();
    $conn->close(); 
    exit(); 
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi Mật Khẩu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1f1f1f;
            color: white;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 400px;
            margin: auto;
            background-color: #222;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }
        input[type="password"], input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
            background-color: #333;
            color: white;
        }
        button {
            background-color: red;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-top: 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        #message {
            margin-top: 15px;
            color: green; 
            display: none; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Đổi Mật Khẩu</h2>
        <form method="POST" id="changePasswordForm">
            <label for="new_password">Mật khẩu mới</label>
            <input type="password" id="new_password" name="new_password" required>
            
            <label for="confirm_password">Xác nhận mật khẩu mới</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <label for="showPassword">
                <input type="checkbox" id="showPassword" onclick="togglePassword()"> Hiển thị mật khẩu
            </label><br>

            <button type="submit">Đổi Mật Khẩu</button>
        </form>
        <div id="message"></div>
    </div>
    <script>
        document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            fetch('change_password.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                document.getElementById('message').innerText = data.message;
                document.getElementById('message').style.display = 'block';
                if (data.success) {
                    document.getElementById('changePasswordForm').reset();
                    setTimeout(function() {
                        document.getElementById('message').style.display = 'none'; 
                    }, 2000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('message').innerText = 'Có lỗi xảy ra. Vui lòng thử lại.';
                document.getElementById('message').style.display = 'block'; 
            });
        });

        function togglePassword() {
            var matKhau = document.getElementById('new_password');
            var confirm_password = document.getElementById('confirm_password');
            var showPassword = document.getElementById('showPassword');
            if (showPassword.checked) {
                matKhau.type = "text"; 
                confirm_password.type = "text";
            } else {
                matKhau.type = "password"; 
                confirm_password.type = "password";
            }
        }
    </script>
</body>
</html>
