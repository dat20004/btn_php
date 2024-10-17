<?php
session_start(); // Đặt ở dòng đầu tiên của file PHP
// include 'header.php';
include '../connect.php';  // Kết nối cơ sở dữ liệu

// Kiểm tra xem người dùng đã đăng nhập hay chưa
// if (!isset($_SESSION['userID'])) {
//     die("Bạn cần phải đăng nhập để chỉnh sửa thông tin tài khoản."); 
// }

$userID = $_SESSION['userID'];  // ID người dùng từ session

$error = '';
$success = '';

// Truy vấn lấy thông tin người dùng từ cơ sở dữ liệu
$query = "SELECT * FROM users WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $userID, PDO::PARAM_INT);
$stmt->execute();
$userData = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $fullName = $_POST['full_name'] ?? '';
    $password = $_POST['password'] ?? '';
    $newPassword = $_POST['newPassword'] ?? '';
    $isAccountLocked = isset($_POST['lockAccount']);  // Nếu người dùng muốn khóa tài khoản

    // Cập nhật mật khẩu nếu có thay đổi
    if (!empty($password) && !empty($newPassword)) {
        // Kiểm tra mật khẩu cũ có đúng không
        if (password_verify($password, $userData['password'])) {
            // Cập nhật mật khẩu mới
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updatePasswordQuery = "UPDATE users SET password = :password WHERE id = :id";
            $updatePasswordStmt = $conn->prepare($updatePasswordQuery);
            $updatePasswordStmt->bindParam(':password', $hashedPassword);
            $updatePasswordStmt->bindParam(':id', $userID, PDO::PARAM_INT);

            if ($updatePasswordStmt->execute()) {
                $success = "Cập nhật mật khẩu thành công!";
            } else {
                $error = "Có lỗi xảy ra khi cập nhật mật khẩu.";
            }
        } else {
            $error = "Mật khẩu cũ không đúng.";
        }
    }

    // Cập nhật thông tin người dùng nếu có thay đổi
    if (empty($error)) {
        $updateFields = [];
        $updateValues = [];

        // Kiểm tra và cập nhật chỉ những trường đã thay đổi
        if ($username != $userData['username']) {
            $updateFields[] = "username = :username";
            $updateValues[':username'] = $username;
        }
        if ($email != $userData['email']) {
            $updateFields[] = "email = :email";
            $updateValues[':email'] = $email;
        }
        if ($phone != $userData['phone_number']) {
            $updateFields[] = "phone_number = :phone";
            $updateValues[':phone'] = $phone;
        }
        if ($address != $userData['address']) {
            $updateFields[] = "address = :address";
            $updateValues[':address'] = $address;
        }
        if ($fullName != $userData['full_name']) {
            $updateFields[] = "full_name = :full_name";
            $updateValues[':full_name'] = $fullName;
        }

        // Chỉ thực hiện cập nhật nếu có thay đổi
        if (!empty($updateFields)) {
            $updateQuery = "UPDATE users SET " . implode(", ", $updateFields) . " WHERE id = :id";
            $updateStmt = $conn->prepare($updateQuery);
            $updateValues[':id'] = $userID;  // Thêm ID người dùng vào tham số

            if ($updateStmt->execute($updateValues)) {
                $success = "Cập nhật thông tin thành công!";
            } else {
                $error = "Có lỗi xảy ra khi cập nhật thông tin.";
            }
        }
    }

    // Khóa tài khoản nếu có yêu cầu
    if ($isAccountLocked) {
        $lockQuery = "UPDATE users SET state = 'locked' WHERE id = :id";
        $lockStmt = $conn->prepare($lockQuery);
        $lockStmt->bindParam(':id', $userID, PDO::PARAM_INT);
        if ($lockStmt->execute()) {
            $success = "Tài khoản đã bị khóa!";
        } else {
            $error = "Có lỗi khi khóa tài khoản.";
        }
    }
}

?>

<div class="content-wrapper subject">
    <div id="courseForm" class="courseForm">
        <h1>Thông tin tài khoản</h1>

        <!-- Hiển thị thông báo lỗi hoặc thành công -->
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php elseif ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <!-- Form chỉnh sửa thông tin người dùng -->
        <form action="" method="POST">
            <div>
                <label for="full_name">Họ và tên</label><br>
                <input class="form-control" type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($userData['full_name']); ?>" required>
            </div>

            <div>
                <label for="email">Email</label><br>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" required>
            </div>

            <div>
                <label for="phone">Số điện thoại</label><br>
                <input type="number" id="phone" name="phone" value="<?php echo htmlspecialchars($userData['phone_number']); ?>" required>
            </div>

            <div>
                <label for="address">Địa chỉ</label><br>
                <input class="form-control" type="text" id="address" name="address" value="<?php echo htmlspecialchars($userData['address']); ?>" required>
            </div>

            <div>
                <label for="username">Tên đăng nhập</label><br>
                <input class="form-control" type="text" id="username" name="username" value="<?php echo htmlspecialchars($userData['username']); ?>" required>
            </div>

            <div>
                <label for="password">Mật khẩu cũ</label><br>
                <input type="password" id="password" name="password" placeholder="Mật khẩu cũ">
            </div>

            <div>
                <label for="newPassword">Mật khẩu mới</label><br>
                <input type="password" id="newPassword" name="newPassword" placeholder="Mật khẩu mới">
            </div>

            <div class="btn-key">
                <button type="submit" class="edit-User__btn">Cập nhật</button>
                <button type="submit" name="lockAccount" class="edit-User__btn-key edit-User__btn">Khóa tài khoản</button>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
