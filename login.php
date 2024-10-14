<?php 
ob_start();
session_start();
include 'connect.php';  // Giả định file này tạo kết nối PDO $conn

$errors = [];  // Tạo biến $errors để lưu thông báo lỗi

if(isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];  // Lấy giá trị của role từ form

    // Kiểm tra thông tin đăng nhập
    if(empty($email)) {
        $errors['email'] = 'Email không được để trống.';
    }
    
    if(empty($password)) {
        $errors['password'] = 'Mật khẩu không được để trống.';
    }

    if(empty($role)) {
        $errors['role'] = 'Vui lòng chọn vai trò.';
    }

    if (empty($errors)) {  // Nếu không có lỗi thì mới tiến hành truy vấn
        $stmt = $conn->prepare("SELECT id, name, email, role, password FROM users WHERE email = :email AND role = :role");
        $stmt->bindParam(':email', $email);  // Sử dụng bindParam với PDO
        $stmt->bindParam(':role', $role);    // Bind role
        
        $stmt->execute();
        $query = $stmt->fetch(PDO::FETCH_OBJ);  // Sử dụng fetch thay vì get_result

        if ($query) {
            // Kiểm tra mật khẩu
            if (password_verify($password, $query->password)) {
                // Lưu thông tin người dùng vào session
                $_SESSION['user_login'] = $query;

                // Chuyển hướng dựa trên vai trò
                switch ($query->role) {
                    case 'Admin':
                        header('Location: ./admin/index.php');
                        exit();
                    case 'Teacher':
                        header('Location: ./teacher/index.php');
                        exit();
                    case 'Student':
                        header('Location: index.php');
                        exit();
                    default:
                        // Nếu không có vai trò hợp lệ, chuyển hướng về trang đăng nhập
                        $errors['failed'] = 'Vai trò không hợp lệ.';
                        header('Location: login.php');
                        exit();
                }
            } else {
                // Thông báo mật khẩu không chính xác
                $errors['failed'] = 'Mật khẩu không chính xác.';
            }
        } else {
            // Thông báo tài khoản không tồn tại hoặc sai vai trò
            $errors['failed'] = 'Tài khoản không tồn tại hoặc vai trò không hợp lệ.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
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
                <h1>Đăng nhập tài khoản tại FastLearn</h1>

                <!-- Form đăng nhập -->
                <form action="" method="POST" role="form">
                    <label for="role">Vai trò:</label>
                    <select name="role" required>
                        <option value="Admin">Quản trị viên</option>
                        <option value="Teacher">Giảng viên</option>
                        <option value="Student">Sinh viên</option>
                    </select>

                    <!-- Hiển thị lỗi vai trò -->
                    <?php if (!empty($errors['role'])): ?>
                        <div class="alert alert-danger">
                            <?php echo $errors['role']; ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="form-group">
                        <div>
                            <input type="email" name="email" placeholder="Nhập email" required>
                        </div>
                        <!-- Hiển thị lỗi email -->
                        <?php if (!empty($errors['email'])): ?>
                            <div class="alert alert-danger">
                                <?php echo $errors['email']; ?>
                            </div>
                        <?php endif; ?>
                        <div class="password-field">
                        <input type="password" name="password" id="password" placeholder="Mật khẩu" required>
                        <span class="eye-icon" id="toggle-password">
                            <i class="bi bi-eye"></i>
                        </span>
                    </div>
                        <!-- Hiển thị lỗi mật khẩu -->
                        <?php if (!empty($errors['password'])): ?>
                            <div class="alert alert-danger">
                                <?php echo $errors['password']; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Hiển thị lỗi nếu có lỗi đăng nhập -->
                    <?php if (!empty($errors['failed'])): ?>
                        <div class="alert alert-danger">
                            <?php echo $errors['failed']; ?>
                        </div>
                    <?php endif; ?>
                    <a href="forgot-password.php" class="text-decoration-none">Quên mật khẩu?</a>
                    
                    <button type="submit" class="btn btn-primary">Đăng nhập</button>
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
                <p>Bạn chưa có tài khoản? <a href="register.php">Đăng ký</a></p>
                <p>Việc bạn sử dụng trang web cũng đồng nghĩa với việc bạn đồng ý với điều khoản dịch vụ của chúng tôi.</p>
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
