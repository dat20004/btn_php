<?php include 'header.php';

?>

<div class="content-wrapper subject">
    <div id="courseForm edit-courseForm" class=" courseForm edit-courseForm">
        <h1>Sửa khóa học</h1>
        <form action="" method="POST">
            <div>
                <label for="courseName">Tên khóa học:</label><br>
                <input class="form-control" type="text" id="courseName" name="courseName"
                    placeholder="Nhập tên khóa học">
            </div>

            <div>
                <label for="courseDesc">Mô tả khóa học:</label><br>
                <textarea id="courseDesc" name="courseDesc" placeholder="Nhập mô tả"></textarea>
            </div>

            <div>
                <label for="courseField">Ngành:</label><br>
                <select name="courseField" id="courseField" required="required">
                    <option value="">Chọn ngành</option>
                    <option value="IT">Công nghệ thông tin</option>
                    <option value="Business">Kinh doanh</option>
                    <option value="Design">Thiết kế</option>
                </select>
            </div>

            <div>
                <label for="courseTeacher">Giảng viên:</label><br>
                <input id="courseTeacher" name="courseTeacher" placeholder="Nhập tên giảng viên">
            </div>

            <div>
                <label for="coursePrice">Giá:</label><br>
                <input type="number" id="coursePrice" name="coursePrice" placeholder="Nhập giá khóa học">
            </div>

            <div class="course__Img">
                <label for="courseImage">Hình ảnh</label>
                <div class="upload-box" onclick="document.getElementById('courseImage').click()">
                    <span>Tải ảnh lên</span>
                    <input type="file" id="courseImage" name="courseImage">
                </div>
            </div>

            <div>
                <button type="submit" class="btn btn-success">Lưu</button>
                <button type="button" class="btn btn-secondary" id="cancelBtn">Hủy</button>
            </div>
        </form>
    </div>

</div>


<?php include 'footer.php' ?>