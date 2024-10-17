<?php include 'header.php';
?>

<div class="content-wrapper subject">
    <div class="myProfile">
        <div class="container">
            <div class="myProfile-container">
                <div class="myProfile-left">
                    <div class="myProfile-left__logo"><img src="./dist/img/logo-admin.png" alt=""></div>
                    <div class="myProfile-left__ava"><img src="./dist/img/avatar04.png" alt=""></div>
                    <div class="myProfile-left__exit">
                        <form action="logout.php" method="POST">
                            <button type="submit">Đăng xuất</button>
                        </form>
                    </div>
                </div>
                <div class="myProfile-right">
                    <h1>Tài khoản</h1>
                    <p>Thông tin cá nhân</p>
                    <div class="account-form">
                        <h2>Tài khoản cá nhân</h2>
                        <form action="update_account.php" method="POST">
                            <label for="name">Tên:</label>
                            <input type="text" id="name" name="name"
                                value="<?php echo htmlspecialchars($user['name']); ?>" required>

                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email"
                                value="<?php echo htmlspecialchars($user['email']); ?>" required>

                            <h3>Thay đổi mật khẩu</h3>

                            <label for="old-password">Mật khẩu cũ:</label>
                            <input type="password" id="old-password" name="old-password" required>

                            <label for="new-password">Mật khẩu mới:</label>
                            <input type="password" id="new-password" name="new-password" required>

                            <label for="confirm-password">Nhập lại mật khẩu mới:</label>
                            <input type="password" id="confirm-password" name="confirm-password" required>

                            <button type="submit">Cập nhật thông tin</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<?php include 'footer.php' ?>