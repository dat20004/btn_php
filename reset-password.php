<?php
// Kết nối cơ sở dữ liệu
include 'connect.php'; 

// Lấy token từ URL
$token = $_GET['token'];

// Kiểm tra token
$result = $conn->query("SELECT * FROM users WHERE reset_token='$token' AND reset_expires > NOW()");

if ($result->num_rows > 0) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $newPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
        
        // Cập nhật mật khẩu và xóa token
        $conn->query("UPDATE users SET password='$newPassword', reset_token=NULL, reset_expires=NULL WHERE reset_token='$token'");
        
        echo "Mật khẩu của bạn đã được khôi phục.";
    }
} else {
    echo "Liên kết khôi phục mật khẩu không hợp lệ hoặc đã hết hạn.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại mật khẩu</title>
</head>
<body>
    <h3>Đặt lại mật khẩu mới</h3>
    <form action="" method="POST">
        <div class="form-group">
            <label for="password">Mật khẩu mới</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật mật khẩu</button>
    </form>
</body>
</html>
