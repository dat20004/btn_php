<?php include 'header.php';

?>

<div class="content-wrapper subject">
    <div id="courseForm edit-courseForm" class=" courseForm edit-courseForm">
        <h1>Thông tin tài khoản</h1>
        <form action="" method="POST">
            <div>
                <label for="username">Họ và tên</label><br>
                <input class="form-control" type="text" id="username" name="username">
            </div>

            <div>
                <label for="email">Email</label><br>
                <input type="email" id="email" name="email"></input>
            </div>
            <div>
                <label for="phone">Số điện thoại</label><br>
                <input type="number" id="phone" name="phone">
            </div>
            <div>
                <label for="address">Địa chỉ:</label><br>
                <input class="form-control" type="text" id="address" name="address">
            </div>

            <div>
                <label for="nickName">Tên đăng nhập</label><br>
                <input id="nickName" name="nickName">
            </div>

            <div>
                <label for="password">Mật khẩu</label><br>
                <input id="password" name="password">
            </div>
            <div>
                <label for="newPassword">Mật khẩu mới</label><br>
                <input id="newPassword" name="newPassword">
            </div>

            <div class="btn-key">
                <button type="submit" class=" edit-User__btn">Cập nhật</button>
                <button type="submit" class=" edit-User__btn-key edit-User__btn">Khóa tài khoản</button>
            </div>
        </form>
    </div>

</div>


<?php include 'footer.php' ?>