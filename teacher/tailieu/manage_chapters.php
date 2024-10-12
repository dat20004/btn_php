<?php
// Kết nối với cơ sở dữ liệu
require_once('db_connect.php');

// Lấy danh sách chương và bài học
$sql = "SELECT chapters.id AS chapter_id, chapters.title AS chapter_title, 
        lessons.id AS lesson_id, lessons.title AS lesson_title
        FROM chapters
        LEFT JOIN lessons ON chapters.id = lessons.chapter_id
        ORDER BY chapters.id, lessons.id"; // Sắp xếp theo chương và bài học

try {
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Lấy tất cả kết quả
} catch (PDOException $e) {
    die("Câu truy vấn thất bại: " . $e->getMessage());
}

$last_chapter_id = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Chương và Bài Học</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: #fff;
            margin: 0;
        }

        h3 {
            color: #333;
            font-size: 1.5em;
            margin-top: 20px;
            cursor: pointer;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        li {
            background-color: #fff;
            margin: 5px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        li a {
            text-decoration: none;
            color: #007bff;
        }

        li a:hover {
            text-decoration: underline;
        }

        button {
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin-top: 10px;
        }

        button:hover {
            background-color: #218838;
        }

        a {
            text-decoration: none;
        }

        a:focus, a:hover {
            text-decoration: underline;
        }

        .button-container {
            text-align: center;
            margin: 20px;
        }

        .chapter-actions {
            text-align: right;
        }

        .lesson-list {
            display: none; /* Mặc định ẩn danh sách bài học */
        }
    </style>
    
    <script>
        // JavaScript để hiển thị hoặc ẩn danh sách bài học khi nhấn vào chương
        function toggleLessons(chapterId) {
            var lessonList = document.getElementById('lessons_' + chapterId);
            
            // Kiểm tra trạng thái hiện tại và thay đổi display
            if (lessonList.style.display === "none" || lessonList.style.display === "") {
                lessonList.style.display = "block"; // Hiển thị danh sách bài học
            } else {
                lessonList.style.display = "none"; // Ẩn danh sách bài học khi nhấn lại
            }
        }
    </script>
</head>
<body>

<h1>Danh Sách Chương và Bài Học</h1>

<a href="addchapter.php"><button>Thêm Chương</button></a>

<?php
if ($result) {
    foreach ($result as $row) {
        // Nếu là chương mới, in ra thông tin chương
        if ($last_chapter_id != $row['chapter_id']) {
            if ($last_chapter_id !== null) {
                echo "</ul>"; // Kết thúc danh sách bài học của chương trước
            }

            // In thông tin chương và thêm nút hiển thị bài học
            echo "<h3 onclick='toggleLessons(" . $row['chapter_id'] . ")'>" . htmlspecialchars($row['chapter_title']) . "</h3>";
            echo "<ul id='lessons_" . $row['chapter_id'] . "' class='lesson-list'>"; // Danh sách bài học sẽ bị ẩn mặc định
            echo "<a href='addlesson.php?chapter_id=" . $row['chapter_id'] . "'><button>Thêm bài học cho chương này</button></a>"; // Nút Thêm bài học cho chương
            $last_chapter_id = $row['chapter_id'];
        }

        // In ra bài học trong chương hiện tại
        if (!empty($row['lesson_title'])) { // Chỉ in ra bài học nếu tồn tại
            echo "<li>";
            echo "<a href='viewlesson.php?lesson_id=" . $row['lesson_id'] . "'>" . htmlspecialchars($row['lesson_title']) . "</a>";
            echo "<div class='chapter-actions'>";
            echo " [<a href='editlesson.php?lesson_id=" . $row['lesson_id'] . "'>Chỉnh sửa</a>]";
            echo " [<a href='deletelesson.php?lesson_id=" . $row['lesson_id'] . "'>Xóa</a>]";
            echo "</div>";
            echo "</li>";
        }
    }
    echo "</ul>"; // Kết thúc danh sách bài học của chương cuối
} else {
    echo "<p>Không có chương và bài học nào.</p>";
}
?>

</body>
</html>
