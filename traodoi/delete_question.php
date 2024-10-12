<?php
// delete_question.php

// Kết nối đến cơ sở dữ liệu với PDO
$host = 'localhost';
$db = 'btl'; // Thay đổi với tên cơ sở dữ liệu của bạn
$user = 'root'; // Thay đổi với tên người dùng của bạn
$pass = ''; // Thay đổi với mật khẩu của bạn

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Xử lý xóa câu hỏi
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $questionId = $_POST['question_id'];
        $deleteStmt = $conn->prepare("DELETE FROM course_questions WHERE id = :id");
        $deleteStmt->bindParam(':id', $questionId, PDO::PARAM_INT);
        $deleteStmt->execute();

        header("Location: view_questions.php"); // Quay lại trang hiển thị câu hỏi
        exit();
    }

} catch (PDOException $e) {
    echo "Kết nối không thành công: " . $e->getMessage();
}
?>
