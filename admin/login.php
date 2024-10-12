<?php
session_start();
include '../connect.php'; // Đảm bảo rằng tệp kết nối sử dụng PDO
$errors = [];

if(isset($_POST['email'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Kiểm tra các trường đầu vào
    if($email == ''){
        $errors['email'] = 'Email không được để trống';
    }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = 'Email không đúng định dạng';
    }

    if($password == ''){
        $errors['password'] = 'Mật khẩu không được để trống';
    }

    // Nếu không có lỗi
    if(!$errors) {
        // Chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare("SELECT id, name, email, role FROM users WHERE email = ? AND password = ?");
        
        // Thực thi câu lệnh SQL với các tham số
        $stmt->execute([$email, $password]);

        // Kiểm tra kết quả
        if ($stmt->rowCount() == 1) {
            $admin = $stmt->fetch(PDO::FETCH_OBJ);
            if ($admin->role != 'Admin') {
                $errors['failed'] = 'Tài khoản của bạn không có quyền đăng nhập vào trang quản trị';
            } else {
                $_SESSION['admin_login'] = $admin;
                header('location: index.php');
                exit(); // Dừng script sau khi chuyển hướng
            }
        } else {
            $errors['failed'] = 'Tài khoản hoặc mật khẩu không chính xác';
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>Admin</b>cPanel</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <?php if($errors) : ?>
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                <?php foreach($errors as $error) :?>
                <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <form action="" method="post">
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email" name="email" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
    </div>
</body>

</html>
