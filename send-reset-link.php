<?php
include 'connect.php'; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    
    // Kiểm tra email có tồn tại không
    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    
    if ($result->num_rows > 0) {
        // Tạo token và thời gian hết hạn
        $token = bin2hex(random_bytes(50));
        $expireTime = date('Y-m-d H:i:s', strtotime('+1 hour'));
        
        // Lưu token vào cơ sở dữ liệu
        $conn->query("UPDATE users SET reset_token='$token', reset_expires='$expireTime' WHERE email='$email'");
        
        // Tạo liên kết khôi phục
        $resetLink = "http://yourwebsite.com/reset-password.php?token=$token";
        
        // Gửi email
        $subject = "Khôi phục mật khẩu của bạn";
        $message = "Nhấn vào liên kết sau để khôi phục mật khẩu của bạn: $resetLink";
        $headers = "From: no-reply@yourwebsite.com";

        if (mail($email, $subject, $message, $headers)) {
            echo "Liên kết khôi phục mật khẩu đã được gửi tới email của bạn.";
        } else {
            echo "Đã xảy ra lỗi khi gửi email.";
        }
    } else {
        echo "Email không tồn tại trong hệ thống.";
    }
}
?>?>