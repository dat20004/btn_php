<?php
// session_start(); // Khởi tạo session

// // Kiểm tra nếu người dùng đã đăng nhập
// if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
//     echo "Vui lòng đăng nhập trước khi trả lời câu hỏi.";
//     exit;
// }

// $replierId = $_SESSION['user_id'];  // Lấy ID người trả lời từ session
// $name = $_SESSION['username'];       // Lấy tên người trả lời từ session

// // Khởi tạo $questionId
// $questionId = null;

// // Lấy question_id từ POST hoặc GET
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['question_id'])) {
//     $questionId = $_POST['question_id'];
// } elseif (isset($_GET['question_id'])) {
//     $questionId = $_GET['question_id'];
// } else {
//     echo "Không tìm thấy ID câu hỏi.";
//     exit;
// }

// // Xử lý trả lời câu hỏi
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reply_text'])) {
//     $newReply = $_POST['reply_text'];

//     // Thực hiện kiểm tra rỗng
//     if (empty(trim($newReply))) {
//         echo "Câu trả lời không được để trống.";
//         exit;
//     }

//     // Thêm câu trả lời vào bảng answers
//     $insertStmt = $conn->prepare("INSERT INTO answers (replier_id, name, answer, question_id) VALUES (:replier_id, :name, :answer, :question_id)");
//     $insertStmt->bindParam(':replier_id', $replierId, PDO::PARAM_INT);  // Đảm bảo truyền giá trị hợp lệ cho replier_id
//     $insertStmt->bindParam(':name', $name, PDO::PARAM_STR);
//     $insertStmt->bindParam(':answer', $newReply, PDO::PARAM_STR);
//     $insertStmt->bindParam(':question_id', $questionId, PDO::PARAM_INT);

//     try {
//         $insertStmt->execute();

//         // Cập nhật trạng thái câu hỏi
//         $updateStmt = $conn->prepare("UPDATE course_questions SET state = 'Closed' WHERE id = :id");
//         $updateStmt->bindParam(':id', $questionId, PDO::PARAM_INT);
//         $updateStmt->execute();

//         header("Location: view_questions.php"); // Quay lại trang hiển thị câu hỏi
//         exit();
//     } catch (PDOException $e) {
//         echo "Lỗi khi thực hiện câu lệnh: " . $e->getMessage();
//         exit;
//     }
// }

// // Lấy câu hỏi từ cơ sở dữ liệu
// $stmt = $conn->prepare("SELECT question FROM course_questions WHERE id = :id");
// $stmt->bindParam(':id', $questionId, PDO::PARAM_INT);
// $stmt->execute();
// $question = $stmt->fetch(PDO::FETCH_ASSOC);

// // Kiểm tra nếu câu hỏi tồn tại
// if (!$question) {
//     echo "Không tìm thấy câu hỏi.";
//     exit;
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trả Lời Câu Hỏi</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 80%; margin: 0 auto; }
        textarea { width: 100%; height: 100px; }
    </style>
</head>
<body>

<div class="container">
    <h1>Trả Lời Câu Hỏi</h1>

    <form method="POST">
        <input type="hidden" name="question_id" value="<?php echo htmlspecialchars($questionId); ?>">
        <p><strong>Câu Hỏi:</strong> <?php echo htmlspecialchars($question['question']); ?></p>
        <textarea name="reply_text" required></textarea><br>
        <button type="submit">Gửi Trả Lời</button>
    </form>
</div>

</body>
</html>

<?php
$conn = null; // Đóng kết nối
?>
