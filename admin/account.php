<?php include 'header.php'; ?>
<div class="content-wrapper subject">
    <section class="content-header">
        <h1> Quản lý tài khoản </h1>
    </section> <!-- Main content -->
    <div class="account">
        <ul class="nav nav-tabs__account" id="myTab">
            <li class="nav-item__account"> <button class="nav-link__account active" onclick="showTab('image')">Danh
                    sách</button> </li>
        </ul>
        <hr>

        <div id="createAccountModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span> <!-- Nút Đóng Modal -->
                <h3>Tạo Tài Khoản Mới</h3>
                <form id="createAccountForm">
                    <div class="mb-3">
                        <label for="customerName" class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" id="customerName" name="customerName"
                            placeholder="Nhập tên khách hàng" required>
                    </div>
                    <div class="mb-3">
                        <label for="customerEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="customerEmail" name="customerEmail"
                            placeholder="Nhập email khách hàng" required>
                    </div>
                    <div class="mb-3">
                        <label for="customerPhone" class="form-label">Số điện thoại</label>
                        <input type="email" class="form-control" id="customerPhone" name="customerPhone"
                            placeholder="Nhập số điện thoại" required>
                    </div>
                    <div class="mb-3">
                        <label for="customerUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="customerUsername" name="customerUsername"
                            placeholder="Nhập tên khách hàng" required>
                    </div>
                    <div class="mb-3">
                        <label for="customerPassword" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" id="customerPassword" name="customerPassword"
                            placeholder="Nhập mật khẩu" required>
                    </div>
                    <div class="mb-3">
                        <label for="customerPassword2" class="form-label">Xác nhận mật khẩu</label>
                        <input type="password" class="form-control" id="customerPassword2" name="customerPassword2"
                            placeholder="Nhập lại mật khẩu" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu tài khoản</button>
                </form>
            </div>
        </div>
        <div class="tab-content__account mt-3" id="myTabContent">
            <div id="image" class="tab-pane__account">
                <li class="nav-item__account">
                    <button id="btnOpenModal" class="btn btn-primary">+ Tạo tài khoản</button>
                </li>
                <div class="mt-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><input type="checkbox" name="" id=""></th>
                                <th>STT</th>
                                <th>TT</th>
                                <th>Tên khách hàng</th>
                                <th>Email</th>
                                <th>Nhóm</th>
                                <th>Ngày tạo tài khoản</th>
                                <th>Khóa học đã mua</th>
                                <th>Giỏ hàng</th>
                                <th>Cài đặt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="checkbox" name="" id=""></td>
                                <td>1</td>
                                <td></td>
                                <td>Nguyễn Văn Đạt</td>
                                <td>dat@gmail.com</td>
                                <td>0</td>
                                <td>24/09/2024</td>
                                <td>1</td>
                                <td>5</td>
                                <td><a href="edit-User.php" class="btn btn-success">Sửa</a></td>
                                <td><a href="" class="btn btn-success">Xóa</a></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="" id=""></td>
                                <td>1</td>
                                <td></td>
                                <td>Nguyễn Văn Đạt</td>
                                <td>dat@gmail.com</td>
                                <td>0</td>
                                <td>24/09/2024</td>
                                <td>1</td>
                                <td>5</td>
                                <td><a href="edit-User.php" class="btn btn-success">Sửa</a></td>
                                <td><a href="" class="btn btn-success">Xóa</a></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="" id=""></td>
                                <td>1</td>
                                <td></td>
                                <td>Nguyễn Văn Đạt</td>
                                <td>dat@gmail.com</td>
                                <td>0</td>
                                <td>24/09/2024</td>
                                <td>1</td>
                                <td>5</td>
                                <td><a href="edit-User.php" class="btn btn-success">Sửa</a></td>
                                <td><a href="" class="btn btn-success">Xóa</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div> <?php include 'footer.php' ?>