<?php 
session_start();
include 'header.php';
include '../connect.php'; 

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $fullName = $_POST['customerName'] ?? '';
    $email = $_POST['customerEmail'] ?? '';
    $phone = $_POST['customerPhone'] ?? '';
    $username = $_POST['customerUsername'] ?? '';  // Đổi thành $username
    $password = $_POST['customerPassword'] ?? '';
    $password2 = $_POST['customerPassword2'] ?? '';
    $gender = $_POST['customerGender'] ?? '';  // Giới tính
    $address = $_POST['customerAddress'] ?? '';  // Địa chỉ

    // Kiểm tra các trường bắt buộc
    if (empty($fullName) || empty($email) || empty($phone) || empty($username) || empty($password) || empty($password2) || empty($gender) || empty($address)) {
        $error = "Vui lòng điền đầy đủ thông tin.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Định dạng email không hợp lệ.";
    } elseif ($password !== $password2) {
        $error = "Mật khẩu và xác nhận mật khẩu không khớp.";
    } elseif (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $error = "Mật khẩu phải có ít nhất 8 ký tự, chứa cả chữ hoa, chữ thường và số.";
    } else {
        try {
            // Tạo kết nối PDO
            global $conn;

            // Kiểm tra tên người dùng hoặc email đã tồn tại chưa
            $sql_check = "SELECT * FROM users WHERE username = :username OR email = :email";  // Đổi thành username
            $stmt_check = $conn->prepare($sql_check);
            $stmt_check->execute(['username' => $username, 'email' => $email]);
            $existingUser = $stmt_check->fetch(PDO::FETCH_ASSOC);

            if ($existingUser) {
                $error = "Tên người dùng hoặc email đã được sử dụng.";
            } else {
                // Hash mật khẩu
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Thêm người dùng mới vào cơ sở dữ liệu
                $sql = "INSERT INTO users (full_name, email, username, password, role, state, created_at, gender, phone_number, address) 
                        VALUES (:full_name, :email, :username, :password, :role, :state, :created_at, :gender, :phone_number, :address)";  // Đổi name thành username
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':full_name', $fullName);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':username', $username);  // Đổi name thành username
                $stmt->bindParam(':password', $hashed_password);
                $stmt->bindValue(':role', 'student');  // Giá trị mặc định là student
                $stmt->bindValue(':state', 'active');  // Giá trị mặc định là active
                $stmt->bindValue(':created_at', date('Y-m-d H:i:s'));  // Thời gian tạo là hiện tại
                $stmt->bindParam(':gender', $gender);
                $stmt->bindParam(':phone_number', $phone);
                $stmt->bindParam(':address', $address);

                if ($stmt->execute()) {
                    $success = "Tài khoản và thông tin đã được tạo thành công!";
                } else {
                    $error = "Lỗi khi thêm tài khoản vào bảng users.";
                }
            }
        } catch (PDOException $e) {
            $error = "Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage();
        }
    }
    $conn = null; // Đóng kết nối
}
?>

<!-- HTML Form -->
<div class="container">
    <h2>Đăng ký tài khoản</h2>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php elseif ($success): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>
    
    <form action="" method="POST">
        <div class="mb-3">
            <label for="customerName" class="form-label">Họ và tên</label>
            <input type="text" class="form-control" id="customerName" name="customerName" placeholder="Nhập họ và tên" required>
        </div>
        
        <div class="mb-3">
            <label for="customerEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="customerEmail" name="customerEmail" placeholder="Nhập email" required>
        </div>
        
        <div class="mb-3">
            <label for="customerPhone" class="form-label">Số điện thoại</label>
            <input type="tel" class="form-control" id="customerPhone" name="customerPhone" placeholder="Nhập số điện thoại" required>
        </div>
        
        <div class="mb-3">
            <label for="customerUsername" class="form-label">Tên đăng nhập</label>
            <input type="text" class="form-control" id="customerUsername" name="customerUsername" placeholder="Nhập tên đăng nhập" required>
        </div>
        
        <div class="mb-3">
            <label for="customerPassword" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" id="customerPassword" name="customerPassword" placeholder="Nhập mật khẩu" required>
        </div>
        
        <div class="mb-3">
            <label for="customerPassword2" class="form-label">Xác nhận mật khẩu</label>
            <input type="password" class="form-control" id="customerPassword2" name="customerPassword2" placeholder="Xác nhận mật khẩu" required>
        </div>
        
        <div class="mb-3">
            <label for="customerGender" class="form-label">Giới tính</label>
            <select class="form-control" id="customerGender" name="customerGender" required>
                <option value="">Chọn giới tính</option>
                <option value="male">Nam</option>
                <option value="female">Nữ</option>
                <option value="other">Khác</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="customerAddress" class="form-label">Địa chỉ</label>
            <input type="text" class="form-control" id="customerAddress" name="customerAddress" placeholder="Nhập địa chỉ" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Đăng ký</button>
    </form>
</div>
