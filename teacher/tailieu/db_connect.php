<?php
// Cấu hình thông tin kết nối với cơ sở dữ liệu
$servername = "localhost"; // Tên máy chủ, thường là localhost
$username = "root";        // Tên người dùng cơ sở dữ liệu
$password = "";            // Mật khẩu cơ sở dữ liệu (nếu có)
$dbname = "btl";           // Tên cơ sở dữ liệu mà bạn sẽ kết nối

try {
    // Tạo kết nối PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Thiết lập chế độ báo lỗi cho PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Nếu kết nối thành công, bạn có thể thêm thông báo thành công ở đây, ví dụ:
    // echo "Kết nối thành công!";
} catch (PDOException $e) {
    // Xử lý lỗi kết nối nếu có
    die("Kết nối thất bại: " . $e->getMessage());
}
?>
