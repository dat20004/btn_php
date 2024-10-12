<?php
// session_start(); // Đảm bảo bạn đã khởi động session

// // Kiểm tra nếu người dùng đã đăng nhập
// // if (!isset($_SESSION['user_id'])) {
// //     // Chuyển hướng đến trang đăng nhập nếu người dùng chưa đăng nhập
// //     header("Location: login.php");
// //     exit();
// // }

// // Kết nối đến cơ sở dữ liệu với PDO
// $host = 'localhost';
// $db = 'btl'; // Thay đổi với tên cơ sở dữ liệu của bạn
// $user = 'root'; // Thay đổi với tên người dùng của bạn
// $pass = ''; // Thay đổi với mật khẩu của bạn

// try {
//     $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     // Kiểm tra nếu có 'question_id' được gửi qua phương thức GET
//     if (isset($_GET['question_id'])) {
//         $question_id = $_GET['question_id'];

//         // Lấy câu trả lời hiện tại từ cơ sở dữ liệu
//         $stmt = $conn->prepare("
//             SELECT a.answer 
//             FROM answers a 
//             WHERE a.question_id = :question_id AND a.replier_id = :replier_id
//         ");
//         $stmt->execute([
//             ':question_id' => $question_id,
//             ':replier_id' => $_SESSION['user_id'] // ID người trả lời được lưu trong session
//         ]);
//         $answer = $stmt->fetch(PDO::FETCH_ASSOC);

//         // Kiểm tra nếu câu trả lời tồn tại
//         if (!$answer) {
//             echo "Không tìm thấy câu trả lời.";
//             exit();
//         }
//     } elseif (isset($_POST['question_id']) && isset($_POST['updated_answer'])) {
//         // Khi form được gửi để cập nhật
//         $question_id = $_POST['question_id'];
//         $updated_answer = $_POST['updated_answer'];

//         // Cập nhật câu trả lời trong cơ sở dữ liệu
//         $stmt = $conn->prepare("
//             UPDATE answers 
//             SET answer = :answer 
//             WHERE question_id = :question_id AND replier_id = :replier_id
//         ");
//         $stmt->execute([
//             ':answer' => $updated_answer,
//             ':question_id' => $question_id,
//             ':replier_id' => $_SESSION['user_id']
//         ]);

//         // Chuyển hướng về trang quản lý câu hỏi
//         header("Location: view_questions.php");
//         exit();
//     } else {
//         echo "Dữ liệu không hợp lệ.";
//         exit();
//     }
// } catch (PDOException $e) {
//     echo "Kết nối không thành công: " . $e->getMessage();
//     exit();
// }

// $conn = null; // Đóng kết nối
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Câu Trả Lời</title>
    <!-- Thêm Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1>Chỉnh Sửa Câu Trả Lời</h1>

    <!-- Form để cập nhật câu trả lời -->
    <form method="POST" action="update_answer.php">
        <input type="hidden" name="question_id" value="<?php echo htmlspecialchars($question_id); ?>">

        <div class="mb-3">
            <label for="updated_answer" class="form-label">Câu Trả Lời</label>
            <textarea class="form-control" name="updated_answer" rows="5"><?php echo htmlspecialchars($answer['answer']); ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="view_questions.php" class="btn btn-secondary">Hủy</a>
    </form>
</div>

<!-- Thêm Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
