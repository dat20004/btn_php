<?php
// // view_questions.php

// // Kết nối đến cơ sở dữ liệu với PDO
// $host = 'localhost';
// $db = 'btl'; // Thay đổi với tên cơ sở dữ liệu của bạn
// $user = 'root'; // Thay đổi với tên người dùng của bạn
// $pass = ''; // Thay đổi với mật khẩu của bạn

// try {
//     $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     // Lấy dữ liệu câu hỏi và câu trả lời từ cơ sở dữ liệu
//     $stmt = $conn->prepare("
//         SELECT cq.id, u.name AS student_name, u.email, cq.question, 
//                cq.state, cq.create_at, 
//                a.answer AS student_answer
//         FROM course_questions cq
//         INNER JOIN users u ON cq.student_id = u.id
//         LEFT JOIN answers a ON cq.id = a.question_id AND a.replier_id = u.id
//     ");
//     $stmt->execute();
//     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// } catch (PDOException $e) {
//     echo "Kết nối không thành công: " . $e->getMessage();
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Câu Hỏi của Học Sinh</title>
    <!-- Thêm Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Thêm Font Awesome cho biểu tượng -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: #f8f9fa;
        }
        .container { 
            margin-top: 40px; 
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }
        table { 
            width: 100%; 
            margin-top: 20px; 
        }
        th, td { 
            padding: 15px; 
            text-align: left; 
            border-bottom: 1px solid #dee2e6;
        }
        th {
            background-color: #f1f3f5;
            font-weight: bold;
        }
        .action-buttons button {
            margin-right: 5px;
        }
        .action-buttons form {
            display: inline;
        }
        textarea {
            width: 100%;
            height: 100px;
        }
        .btn-custom {
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center mb-4">Quản Lý Câu Hỏi của Học Sinh</h1>

    <!-- Bảng hiển thị câu hỏi -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>Tên Sinh Viên</th>
                    <th>Email</th>
                    <th>Nội Dung Câu Hỏi</th>
                    <th>Câu Trả Lời của Bạn</th>
                    <th>Trạng Thái</th>
                    <th>Ngày Tạo</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($result) > 0): ?>
                    <?php foreach ($result as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['question']); ?></td>
                            <td>
                                <!-- Hiển thị câu trả lời, nếu có -->
                                <?php if ($row['student_answer']): ?>
                                    <?php echo htmlspecialchars($row['student_answer']); ?>
                                <?php else: ?>
                                    <span class="text-warning">Chưa trả lời</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($row['state']); ?></td>
                            <td><?php echo date("d-m-Y H:i", strtotime($row['create_at'])); ?></td>
                            <td class="action-buttons">
                                <!-- Nút trả lời -->
                                <form method="POST" action="reply_question.php" style="display:inline;">
                                    <input type="hidden" name="question_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn btn-success btn-sm btn-custom">
                                        <i class="fas fa-reply"></i> Trả Lời
                                    </button>
                                </form>

                                <!-- Nút xóa -->
                                <form method="POST" action="delete_question.php" style="display:inline;">
                                    <input type="hidden" name="question_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm btn-custom" onclick="return confirm('Bạn có chắc muốn xóa câu hỏi này?')">
                                        <i class="fas fa-trash-alt"></i> Xóa
                                    </button>
                                </form>

                                <!-- Cập nhật câu trả lời -->
                                <form method="GET" action="update_answer.php" style="display:inline;">
                                    <input type="hidden" name="question_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn btn-primary btn-sm btn-custom">
                                        <i class="fas fa-edit"></i> Cập Nhật
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Không có câu hỏi nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Thêm Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
$conn = null; // Đóng kết nối
?>
