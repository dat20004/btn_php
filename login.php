<?php 
ob_start();
session_start();
include 'connect.php';

if(isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Kiểm tra thông tin đăng nhập
    $stmt = $conn->prepare("SELECT id, name, email, role, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $query = $stmt->get_result();

    if ($query && $query->num_rows == 1) {
        $user = $query->fetch_object();
        
        // Kiểm tra mật khẩu
        if (password_verify($password, $user->password)) {
            // Lưu thông tin người dùng vào session
            $_SESSION['user_login'] = $user;

            // Chuyển hướng dựa trên vai trò
            switch ($user->role) {
                case 'Admin':
                    header('Location: admin/index.php');
                    exit();
                case 'Teacher':
                    header('Location: teacher/index.php');
                    exit();
                case 'Student':
                    header('Location: index.php');
                    exit();
                default:
                    // Nếu không có vai trò hợp lệ, có thể thông báo lỗi hoặc chuyển hướng về trang chủ
                    header('Location: login.php');
                    exit();
            }
        } else {
            // Thông báo mật khẩu không chính xác
            $errors['failed'] = 'Mật khẩu không chính xác';
        }
    } else {
        // Thông báo tài khoản không tồn tại
        $errors['failed'] = 'Tài khoản không tồn tại';
    }

    $stmt->close();
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <script src="https://kit.fontawesome.com/533aad8d01.js" crossorigin="anonymous"></script>
</head>

<body>

    <section class="login-fastLearn">
        <div class="container">
            <div class="inner-wrap">
                <img src="./images/fastlearn-removebg-preview.png" alt="">
                <h1>Đăng nhập tài khoản tại FastLearn</h1>

                <form action="" method="POST" role="form">
                    <label for="role">Role:</label>
                    <select name="role">
                        <option value="Admin">Quản trị viên</option>
                        <option value="Teacher">Giảng viên</option>
                        <option value="Student">Sinh viên</option>
                    </select>
                    <div class="form-group">

                        <div>
                            <input type="text" id="" placeholder="Nhập email">
                        </div>
                        <div>
                            <input type="password" id="" placeholder="Mật khẩu">
                        </div>

                    </div>
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
                <p>Bạn đã có tài khoản? <a href="register.php">Đăng ký</a></p>
                <p>Việc bạn sử dụng trang web cũng đồng nghĩa việc bạn đồng ý
                    với điều khoản dịch vụ của chúng tôi.</p>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>