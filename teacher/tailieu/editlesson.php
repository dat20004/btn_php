<?php
// Kết nối với cơ sở dữ liệu
require_once('db_connect.php');

// Kiểm tra nếu có lesson_id được truyền qua URL
if (!isset($_GET['lesson_id'])) {
    die("ID bài học không hợp lệ.");
}

$lesson_id = $_GET['lesson_id'];

// Lấy thông tin bài học từ cơ sở dữ liệu
try {
    $stmt = $conn->prepare("SELECT * FROM lessons WHERE id = :lesson_id");
    $stmt->bindParam(':lesson_id', $lesson_id, PDO::PARAM_INT);
    $stmt->execute();
    $lesson = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$lesson) {
        die("Bài học không tồn tại.");
    }
} catch (PDOException $e) {
    die("Lỗi: " . $e->getMessage());
}

// Xử lý khi form được gửi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lesson_title = $_POST['lesson_title'];
    $lesson_content = $_POST['lesson_content'];
    $lesson_link = $_POST['lesson_link'];

    if (!empty($lesson_title) && !empty($lesson_content) && !empty($lesson_link)) {
        try {
            // Cập nhật thông tin bài học trong cơ sở dữ liệu
            $stmt = $conn->prepare("UPDATE lessons SET title = :title, content = :content, link = :link WHERE id = :lesson_id");
            $stmt->bindParam(':title', $lesson_title);
            $stmt->bindParam(':content', $lesson_content);
            $stmt->bindParam(':link', $lesson_link);
            $stmt->bindParam(':lesson_id', $lesson_id, PDO::PARAM_INT);
            $stmt->execute();

            // Chuyển hướng về trang quản lý chương sau khi cập nhật thành công
            header("Location: manage_chapters.php");
            exit();
        } catch (PDOException $e) {
            die("Lỗi: " . $e->getMessage());
        }
    } else {
        echo "Tiêu đề, nội dung và link bài học không thể trống!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Bài Học</title>
</head>
<body>
    <h1>Chỉnh Sửa Bài Học</h1>

    <form action="editlesson.php?lesson_id=<?php echo $lesson['id']; ?>" method="POST">
        <label for="lesson_title">Tiêu đề bài học:</label>
        <input type="text" name="lesson_title" id="lesson_title" value="<?php echo htmlspecialchars($lesson['title']); ?>" required>
        <br><br>

        <label for="lesson_content">Nội dung bài học:</label>
        <textarea name="lesson_content" id="lesson_content" required><?php echo htmlspecialchars($lesson['content']); ?></textarea>
        <br><br>

        <label for="lesson_link">Link bài học:</label>
        <input type="url" name="lesson_link" id="lesson_link" value="<?php echo htmlspecialchars($lesson['link']); ?>" required>
        <br><br>

        <button type="submit">Cập nhật Bài Học</button>
    </form>

    <a href="manage_chapters.php">Quay lại danh sách chương và bài học</a>
</body>
</html>
