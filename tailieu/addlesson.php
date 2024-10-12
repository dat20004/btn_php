<?php
// Kết nối với cơ sở dữ liệu
require_once('db_connect.php');

// Kiểm tra nếu có chapter_id được truyền qua URL
if (!isset($_GET['chapter_id'])) {
    die("ID chương không hợp lệ.");
}

$chapter_id = $_GET['chapter_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lesson_title = $_POST['lesson_title'];
    $lesson_content = $_POST['lesson_content'];
    $lesson_link = $_POST['lesson_link'];  // Thêm trường link

    // Kiểm tra nếu tiêu đề và nội dung không trống
    if (!empty($lesson_title) && !empty($lesson_content) && !empty($lesson_link)) {
        try {
            // Câu truy vấn thêm bài học vào cơ sở dữ liệu, bao gồm cả link
            $stmt = $conn->prepare("INSERT INTO lessons (chapter_id, title, content, link) VALUES (:chapter_id, :title, :content, :link)");
            $stmt->bindParam(':chapter_id', $chapter_id);
            $stmt->bindParam(':title', $lesson_title);
            $stmt->bindParam(':content', $lesson_content);
            $stmt->bindParam(':link', $lesson_link); // Thêm link vào câu truy vấn
            $stmt->execute();
            
            // Chuyển hướng về trang quản lý chương sau khi thêm thành công
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
    <title>Thêm Bài Học</title>
</head>
<body>
    <h1>Thêm Bài Học vào Chương</h1>
    <form action="addlesson.php?chapter_id=<?php echo $chapter_id; ?>" method="POST">
        <label for="lesson_title">Tiêu đề bài học:</label>
        <input type="text" name="lesson_title" id="lesson_title" required>
        <br><br>

        <label for="lesson_content">Nội dung bài học:</label>
        <textarea name="lesson_content" id="lesson_content" required></textarea>
        <br><br>

        <label for="lesson_link">Link bài học:</label>
        <input type="url" name="lesson_link" id="lesson_link" placeholder="https://example.com" required>
        <br><br>

        <button type="submit">Thêm Bài Học</button>
    </form>
</body>
</html>
