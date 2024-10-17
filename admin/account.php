<?php
ob_start();  // Bắt đầu output buffering

session_start();
include 'header.php';
include '../connect.php';

global $conn;

// Câu lệnh SQL lấy dữ liệu từ bảng `users` và chỉ lọc ra 'Student'
$sql = "SELECT users.id, users.full_name, users.email, users.role, users.created_at, 
        users.username, users.phone_number
        FROM users
        WHERE users.role = 'Student'";

$stmt = $conn->prepare($sql);
$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

$error = '';
$success = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $fullName = $_POST['customerName'] ?? '';
    $email = $_POST['customerEmail'] ?? '';
    $phone = $_POST['customerPhone'] ?? '';
    $username = $_POST['customerUsername'] ?? '';
    $password = $_POST['customerPassword'] ?? '';
    $password2 = $_POST['customerPassword2'] ?? '';
    $gender = $_POST['customerGender'] ?? '';
    $address = $_POST['customerAddress'] ?? '';

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
            // Kiểm tra tên người dùng hoặc email đã tồn tại chưa
            $sql_check = "SELECT * FROM users WHERE username = :username OR email = :email OR phone_number = :phone";
            $stmt_check = $conn->prepare($sql_check);
            $stmt_check->execute(['username' => $username, 'email' => $email, 'phone' => $phone]);
            $existingUser = $stmt_check->fetch(PDO::FETCH_ASSOC);

            if ($existingUser) {
                if ($existingUser['username'] == $username) {
                    $error = "Tên người dùng đã được sử dụng.";
                } elseif ($existingUser['email'] == $email) {
                    $error = "Email đã được sử dụng.";
                } elseif ($existingUser['phone_number'] == $phone) {
                    $error = "Số điện thoại đã được sử dụng.";
                }
            } else {
                // Hash mật khẩu
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Thêm người dùng mới vào cơ sở dữ liệu
                $sql = "INSERT INTO users (full_name, email, username, password, role, state, created_at, gender, phone_number, address) 
                        VALUES (:full_name, :email, :username, :password, :role, :state, :created_at, :gender, :phone_number, :address)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':full_name', $fullName);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $hashed_password);
                $stmt->bindValue(':role', 'Student');  // Giá trị mặc định là teacher
                $stmt->bindValue(':state', 'active');  // Giá trị mặc định là active
                $stmt->bindValue(':created_at', date('Y-m-d H:i:s'));  // Thời gian tạo là hiện tại
                $stmt->bindParam(':gender', $gender);
                $stmt->bindParam(':phone_number', $phone);
                $stmt->bindParam(':address', $address);

                // Sau khi thực hiện lệnh SQL
                if ($stmt->execute()) {
                    $success = "Tài khoản và thông tin giảng viên đã được tạo thành công!";
                    
                    // Chuyển hướng lại trang để làm mới danh sách sau khi tạo tài khoản thành công
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();  // Đảm bảo script dừng lại ngay sau khi redirect
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

ob_end_flush();  // Kết thúc output buffering và gửi toàn bộ dữ liệu ra trình duyệt
?>



<div id="createAccountModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span> <!-- Nút Đóng Modal -->
            <h3>Tạo Tài Khoản Mới</h3>
            
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
    </div>

<!-- Display Teacher List -->
<div class="content-wrapper subject">
    <section class="content-header">
        <h1> Quản lý tài khoản</h1>
    </section>
    <div class="account">
        <ul class="nav nav-tabs__account" id="myTab">
            <li class="nav-item__account"> 
                <button class="nav-link__account active" onclick="showTab('image')">Danh sách</button> 
            </li>
        </ul>
        <hr>
        <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php elseif ($success): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>
        <div class="tab-content__account mt-3" id="myTabContent">
    <div id="image" class="tab-pane__account">
        <!-- Nút mở Modal Tạo tài khoản mới -->
        <li class="nav-item__account">
            <button id="btnOpenModal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTeacherModal">+ Tạo tài khoản</button>
        </li>
        
        <!-- Nút làm mới danh sách -->
        <button id="btnRefresh" class="btn btn-secondary mb-3">Làm mới</button>

        <!-- Bảng danh sách tài khoản -->
        <div class="mt-3">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên tài khoản</th>
                        <th>Email</th>
                        <th>Tên đăng nhập</th>
                        <th>Số điện thoại</th>
                        <th>Ngày tạo tài khoản</th>
                        <th>Cài đặt</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if ($users) {
                        $index = 1;
                        foreach ($users as $user) { ?>
                            <tr>
                                <td><?php echo $index++; ?></td>
                                <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td><?php echo htmlspecialchars($user['username']); ?></td>
                                <td><?php echo htmlspecialchars($user['phone_number']); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($user['created_at'])); ?></td>
                                <td><a href="edit-User.php?id=<?php echo $user['id']; ?>" class="btn btn-success">Sửa</a></td>
                                <td><a href="delete-user.php?id=<?php echo $user['id']; ?>" class="btn btn-danger">Xóa</a></td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center'>Không có dữ liệu giảng viên nào.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

    </div>
</div>

<script>
  document.getElementById("btnOpenModal").addEventListener("click", function() {
    var modal = new bootstrap.Modal(document.getElementById('createTeacherModal'));
    modal.show();
  });
  document.getElementById("btnRefresh").addEventListener("click", function() {
    location.reload(); // Reload trang để cập nhật danh sách
  });
</script>

<?php include 'footer.php'; ?>
