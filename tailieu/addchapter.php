<?php
// Kết nối với cơ sở dữ liệu
require_once('db_connect.php'); // Đảm bảo bạn đã có file kết nối DB

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $chapter_title = isset($_POST['chapter_title']) ? $_POST['chapter_title'] : null;
    $course_id = isset($_POST['course_id']) ? $_POST['course_id'] : null;

    // Kiểm tra nếu các trường không rỗng
    if (!empty($chapter_title) && !empty($course_id)) {
        try {
            // Chuẩn bị câu lệnh SQL để thêm chương với khóa học
            $stmt = $conn->prepare("INSERT INTO chapters (title, course_id) VALUES (:title, :course_id)");
            $stmt->bindParam(':title', $chapter_title);
            $stmt->bindParam(':course_id', $course_id);
            $stmt->execute();

            header("Location: manage_chapters.php"); // Quay lại trang quản lý chương
            exit();
        } catch (PDOException $e) {
            die("Lỗi: " . $e->getMessage());
        }
    } else {
        echo "Tiêu đề chương và khóa học không thể trống!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Chương</title>
</head>
<body>
    <h1>Thêm Chương Mới</h1>
    <form action="addchapter.php" method="POST">
        <label for="chapter_title">Tiêu đề chương:</label>
        <input type="text" name="chapter_title" id="chapter_title" required>

        <!-- Thêm trường để chọn khóa học (course_id) -->
        <label for="course_id">Chọn Khóa Học:</label>
        <select name="course_id" id="course_id" required>
            <!-- Giả sử bạn đã có danh sách khóa học từ cơ sở dữ liệu -->
            <?php
            // Lấy danh sách khóa học từ cơ sở dữ liệu
            try {
                // Chuẩn bị câu lệnh SQL để lấy danh sách khóa học
                $stmt = $conn->prepare("SELECT id, name FROM courses");
                $stmt->execute();
                $courses = $stmt->fetchAll(PDO::FETCH_ASSOC); // Lấy tất cả các khóa học
                foreach ($courses as $course) {
                    echo "<option value='" . htmlspecialchars($course['id']) . "'>" . htmlspecialchars($course['name']) . "</option>";
                }
            } catch (PDOException $e) {
                die("Lỗi: " . $e->getMessage());
            }
            ?>
        </select>

        <button type="submit">Thêm Chương</button>
    </form>
</body>
</html>
