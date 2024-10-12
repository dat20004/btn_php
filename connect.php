<?php
// Thay đổi kết nối từ Mysqli sang PDO
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "btl";

try {
    // Kết nối đến cơ sở dữ liệu bằng PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Thiết lập chế độ báo lỗi của PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}

// Kiểm tra kết nối
if ($conn) {
    echo "Kết nối thành công!";
} else {
    echo "Kết nối không thành công.";
}
?>
