<?php
session_start();
include 'connect.php';  // Giả định file này tạo kết nối PDO $conn

// Biến để lưu thông báo lỗi
$error = '';

if (isset($_POST['name'])) {
    // Lấy dữ liệu từ form
    $username = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

//     // Kiểm tra xem đã nhập đủ các trường bắt buộc chưa
//     if (empty($username)) {
//         $error = "Vui lòng nhập tên tài khoản.";
//     } elseif (empty($email)) {
//         $error = "Vui lòng nhập email.";
//     } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//         $error = "Định dạng email không hợp lệ.";
//     } elseif (empty($password)) {
//         $error = "Vui lòng nhập mật khẩu.";
//     } elseif (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password)) {
//         $error = "Mật khẩu phải có ít nhất 8 ký tự, chứa cả chữ hoa, chữ thường và số.";
//     } elseif ($password != $confirm_password) {
//         $error = "Mật khẩu nhập lại không khớp!";
//     } else {
//         // Kiểm tra xem email hoặc tên người dùng đã tồn tại chưa
//         $sql_check = "SELECT * FROM users WHERE name = :name OR email = :email";
//         $stmt_check = $conn->prepare($sql_check);
//         $stmt_check->bindParam(':name', $username);
//         $stmt_check->bindParam(':email', $email);
//         $stmt_check->execute();
        
//         if ($stmt_check->rowCount() > 0) {
//             $error = "Tên tài khoản hoặc email đã được sử dụng.";
//         } else {
//             // Nếu không có lỗi, hash mật khẩu và thêm vào cơ sở dữ liệu
//             $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
//             // Chuẩn bị câu lệnh SQL
//             $sql = "INSERT INTO users (name, password, email) VALUES (:name, :password, :email)";
//             $stmt = $conn->prepare($sql);
//             $stmt->bindParam(':name', $username);
//             $stmt->bindParam(':password', $hashed_password);
//             $stmt->bindParam(':email', $email);

//             // Thực thi câu lệnh và kiểm tra lỗi
//             if ($stmt->execute()) {
//                 // Chuyển hướng tới trang đăng nhập sau khi đăng ký thành công
//                 header("Location: login.php");
//                 exit();  // Chấm dứt tập lệnh sau khi chuyển hướng
//             } else {
//                 $error = "Lỗi khi đăng ký: " . $stmt->errorInfo()[2]; // Lấy thông báo lỗi
//             }

//             // Đóng các câu lệnh đã chuẩn bị
//             $stmt->closeCursor();
//         }

//         // Đóng câu lệnh kiểm tra
//         $stmt_check->closeCursor();
//     }

//     // Đóng kết nối PDO
//     $conn = null;
// }
$role = $_POST['role'] ?? 'Teacher'; // Mặc định là Student, có thể thay đổi thành Admin // MK Admin  : Dat22082004 // Admin

    // Kiểm tra xem đã nhập đủ các trường bắt buộc chưa
    if (empty($username)) {
        $error = "Vui lòng nhập tên tài khoản.";
    } elseif (empty($email)) {
        $error = "Vui lòng nhập email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Định dạng email không hợp lệ.";
    } elseif (empty($password)) {
        $error = "Vui lòng nhập mật khẩu.";
    } elseif (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $error = "Mật khẩu phải có ít nhất 8 ký tự, chứa cả chữ hoa, chữ thường và số.";
    } else {
        try {
            // Kiểm tra xem email hoặc tên người dùng đã tồn tại chưa
            $sql_check = "SELECT * FROM users WHERE name = :username OR email = :email";
            $stmt_check = $conn->prepare($sql_check);
            $stmt_check->execute(['username' => $username, 'email' => $email]);
            $result_check = $stmt_check->fetch(PDO::FETCH_ASSOC);

            if ($result_check) {
                $error = "Tên tài khoản hoặc email đã được sử dụng.";
            } else {
                // Nếu không có lỗi, hash mật khẩu và thêm vào cơ sở dữ liệu
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Chuẩn bị câu lệnh SQL để thêm người dùng mới
                $sql = "INSERT INTO users (name, password, email, role) VALUES (:username, :password, :email, :role)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $hashed_password);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':role', $role);

                // Thực thi câu lệnh và kiểm tra lỗi
                if ($stmt->execute()) {
                    // Chuyển hướng tới trang đăng nhập sau khi đăng ký thành công
                    header("Location: login.php");
                    exit(); // Chấm dứt tập lệnh sau khi chuyển hướng
                } else {
                    $error = "Lỗi khi đăng ký: " . implode(", ", $stmt->errorInfo());
                }
            }
        } catch (PDOException $e) {
            $error = "Lỗi khi kết nối cơ sở dữ liệu: " . $e->getMessage();
        }
    }
    $conn = null; // Đóng kết nối cơ sở dữ liệu
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/533aad8d01.js" crossorigin="anonymous"></script>
    <style>
        .password-field {
    position: relative;
    display: flex; /* Sử dụng Flexbox để căn chỉnh phần tử con */
    align-items: center; /* Căn giữa theo chiều dọc */
    width: 100%; /* Đảm bảo chiều rộng đủ để chứa cả input và icon */
}

.password-field input {
    width: 100%; /* Làm cho input chiếm hết không gian có sẵn */
    padding: 10px; /* Padding cho input */
    font-size: 16px; /* Kích thước font của input */
    border: 1px solid #ccc; /* Đường viền của input */
    border-radius: 5px; /* Bo góc của input */
}

.eye-icon {
    position: absolute; /* Đặt mắt vào vị trí tuyệt đối */
    right: 10px; /* Căn phải cho biểu tượng con mắt */
    cursor: pointer; /* Khi hover lên mắt sẽ có con trỏ pointer */
    font-size: 20px; /* Kích thước của biểu tượng con mắt */
    z-index: 1; /* Đảm bảo biểu tượng mắt nằm trên input */
}

.eye-icon i {
    color: #666; /* Màu cho biểu tượng con mắt */
}

.password-field input:focus {
    border-color: #5cb85c; /* Màu đường viền khi input được focus */
    outline: none; /* Loại bỏ outline mặc định khi focus */
}

.password-field input:focus + .eye-icon i {
    color: #5cb85c; /* Thay đổi màu mắt khi input được focus */
}

    </style>
</head>

<body>

<section class="login-fastLearn">
    <div class="container">
        <div class="inner-wrap">
            <img src="./images/fastlearn-removebg-preview.png" alt="">
            <h1>Đăng ký tài khoản tại FastLearn</h1>

            <!-- Hiển thị thông báo lỗi nếu có -->
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST" role="form">
                <div class="form-group">
                    <div>
                        <input type="text" name="name" placeholder="Họ tên" required>
                    </div>
                    <div>
                        <input type="email" name="email" placeholder="Nhập email" required>
                    </div>
                    <div class="password-field">
                        <input type="password" name="password" id="password" placeholder="Mật khẩu" required>
                        <span class="eye-icon" id="toggle-password">
                            <i class="bi bi-eye"></i>
                        </span>
                    </div>
                    <div class="password-field">
                        <input type="password" name="confirm_password" id="confirm-password" placeholder="Nhập lại mật khẩu" required>
                        <span class="eye-icon" id="toggle-confirm-password">
                            <i class="bi bi-eye"></i>
                        </span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Đăng ký</button>
            </form>

            <p>Hoặc</p>
            <div class="login-fastLearn__link">
                <a href="">
                    <img src="./images/google.png" alt="">
                </a>
                <a href="">
                    <img src="./images/facebook.png" alt="">
                </a>
                <a href="">
                    <img src="./images/github.png" alt="">
                </a>
            </div>
            <p>Bạn đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
            <p>Việc bạn sử dụng trang web cũng đồng nghĩa việc bạn đồng ý với điều khoản dịch vụ của chúng tôi.</p>
        </div>
    </div>
</section>

<script>
    // Lấy các biểu tượng mắt và trường mật khẩu
    const togglePassword = document.getElementById('toggle-password');
    const passwordField = document.getElementById('password');
    const toggleConfirmPassword = document.getElementById('toggle-confirm-password');
    const confirmPasswordField = document.getElementById('confirm-password');

    // Chức năng để ẩn/hiển thị mật khẩu
    togglePassword.addEventListener('click', function() {
        const type = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = type;
        this.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
    });

    toggleConfirmPassword.addEventListener('click', function() {
        const type = confirmPasswordField.type === 'password' ? 'text' : 'password';
        confirmPasswordField.type = type;
        this.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</body>
</html>