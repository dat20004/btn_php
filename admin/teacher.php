<?php include 'header.php'; 
$error = ''; 
if(isset($_POST['name'])){ 
    $name = $_POST['name']; 
    $status = $_POST['status']; 
    if($name == ''){ $error = 'Tên danh mục không được trống'; } 
    $query = $conn->query("SELECT * FROM category where name='$name'"); 
    if( $query->num_rows>0){ $error=  'Tên danh mục đã được sử dụng'; } 
    if(!$error){ $sql = "INSERT INTO category (name,status) values('$name','$status')"; if($conn->query($sql)){ header('location: category.php'); } else{ $error = 'Thêm mới không thành công!'; } } } ?>
<div class="content-wrapper teacher">
    <section class="content-header d-flex justify-content-between">
        <h1> Teacher </h1>
        <a class="btn btn-primary" id="btnOpenModal">+ Teacher</a>
    </section> <!-- Main content -->
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
                    <label for="customerLearn" class="form-label">Tên khóa học</label>
                    <input type="text" class="form-control" id="customerLearn" name="customerLearn"
                        placeholder="Nhập tên khách hàng" required>
                </div>
                <div class="mb-3">
                    <label for="customerLearn" class="form-label">Tên khóa học</label>

                    <select name="" id="input" class="form-control" required="required">
                        <option value="">dsds</option>
                        <option value="">dsds</option>
                        <option value="">dsds</option>
                    </select>

                </div>
                <button type="submit" class="btn btn-primary">Lưu tài khoản</button>
            </form>
        </div>
    </div>
    <section class="content-header d-flex justify-content-between ">
        <select name="" id="input" required="required">
            <option value="">Sắp xếp</option>
            <option value="">1</option>
            <option value="">1</option>
            <option value="">1</option>
        </select>
        <div class="teacher-input">
            <label for="">Tìm kiếm</label>
            <input type="text" name="" id="">
        </div>
    </section>
    <hr>
    <section class="content">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Tên </th>
                    <th>Email</th>
                    <th>Chức danh</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Phan Đăng Dũng</td>
                    <td>pdd@gmail.com</td>
                    <td>Học sinh</td>
                    <td><a href="edit-Teacher.php" class="btn btn-primary">Sửa</a></td>
                    <td><a class="btn btn-danger">Xóa</a></td>
                </tr>
                <tr>
                    <td>Phan Đăng Dũng</td>
                    <td>pdd@gmail.com</td>
                    <td>Học sinh</td>
                    <td><a href="edit-Teacher.php" class="btn btn-primary">Sửa</a></td>
                    <td><a class="btn btn-danger">Xóa</a></td>
                </tr>
                <tr>
                    <td>Phan Đăng Dũng</td>
                    <td>pdd@gmail.com</td>
                    <td>Học sinh</td>
                    <td><a href="edit-Teacher.php" class="btn btn-primary">Sửa</a></td>
                    <td><a class="btn btn-danger">Xóa</a></td>
                </tr>
                <tr>
                    <td>Phan Đăng Dũng</td>
                    <td>pdd@gmail.com</td>
                    <td>Học sinh</td>
                    <td><a href="edit-Teacher.php" class="btn btn-primary">Sửa</a></td>
                    <td><a class="btn btn-danger">Xóa</a></td>
                </tr>
            </tbody>
        </table>


    </section>
</div> <?php include 'footer.php' ?>