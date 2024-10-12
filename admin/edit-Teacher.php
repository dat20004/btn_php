<?php include 'header.php';

?>

<div class="content-wrapper subject">
    <div id="courseForm edit-courseForm" class=" courseForm edit-courseForm">
        <h1>Thông tin giảng viên</h1>
        <form action="" method="POST">
            <div>
                <label for="username">Tên giảng viên</label><br>
                <input class="form-control" type="text" id="username" name="username">
            </div>

            <div>
                <label for="email">Email</label><br>
                <input type="email" id="email" name="email"></input>
            </div>
            <div>
                <label for="lesson">Ngành</label><br>

                <select name="" id="input" class="form-control" required="required">
                    <option value="">dsdsd</option>
                    <option value="">dsdsd</option>
                    <option value="">dsdsd</option>
                </select>

            </div>

            <div>
                <label for="subject">Khóa học</label><br>
                <input id="subject" name="subject">
            </div>
            <div>
                <label for="subject">Thông tin đầy đủ</label><br>
                <textarea name="" id=""></textarea>
            </div>
            <div class="btn-key">
                <button type="submit" class=" edit-User__btn">Cập nhật</button>
                <button type="submit" class=" edit-User__btn-key edit-User__btn">Khóa tài khoản</button>
            </div>
        </form>
    </div>

</div>


<?php include 'footer.php' ?>