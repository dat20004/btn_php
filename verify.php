<?php
session_start();
require 'connect.php'; // Kết nối CSDL

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $code = $_POST['code'];

    // Lấy email từ session
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
    } else {
        echo "Không tìm thấy email.";
        exit();
    }

    // Tạo kết nối PDO
    global $conn;

    // Kiểm tra mã xác nhận
    $stmt = $conn->prepare("SELECT verification_code, expires_at FROM users WHERE email = :email ORDER BY created_at DESC LIMIT 1");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $verification = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($verification) {
        // Kiểm tra mã xác nhận và thời gian
        if (trim($verification['verification_code']) == trim($code) && strtotime($verification['expires_at']) > time()) {
            // Cập nhật trạng thái xác minh
            $stmt = $conn->prepare("UPDATE users SET state = 'Active' WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            // Lưu thông báo xác nhận vào session
            $_SESSION['verificationMessage'] = "Mã xác nhận hợp lệ! Tài khoản đã được xác minh.";
            $_SESSION['redirectPage'] = "login.php";  // Trang đăng nhập sau khi xác minh thành công

            // Chuyển hướng tới trang thông báo
            header("Location: success_message.php");
            exit();
        } else {
            // Trường hợp mã không hợp lệ hoặc hết hạn
            $_SESSION['verificationMessage'] = "Mã xác nhận không hợp lệ hoặc đã hết hạn.";
            $_SESSION['redirectPage'] = "send_verification_email.php";  // Trang gửi lại mã xác nhận
            header("Location: success_message.php");
            exit();
        }
    } else {
        echo "Không tìm thấy mã xác nhận cho email này.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhập mã xác nhận</title>
</head>
<body>

    <form method="POST">
        <label for="code">Mã xác nhận:</label>
        <input type="text" name="code" required>
        <button type="submit">Xác nhận</button>
    </form>

</body>
</html>
