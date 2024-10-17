<?php include 'header.php';

include '../connect.php';
try {
    // Khởi tạo PDO
    $conn = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password);

    // Thiết lập chế độ lỗi PDO thành Exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Kiểm tra xem form có được gửi hay không
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy thông tin từ form
        $courseName = $_POST['courseName'];
        $courseDesc = $_POST['courseDesc'];
        $courseField = $_POST['courseField']; // ID ngành
        $courseTeacher = $_POST['courseTeacher']; // ID giảng viên
        $coursePrice = $_POST['coursePrice'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];

        // Xử lý hình ảnh
        $courseImage = $_FILES['courseImage']['name'];
        $targetDir = "uploads/"; // Đường dẫn lưu hình ảnh
        $targetFile = $targetDir . basename($courseImage);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Kiểm tra file có phải là hình ảnh không
        if (getimagesize($_FILES['courseImage']['tmp_name']) === false) {
            die("File không phải là hình ảnh.");
        }

        // Kiểm tra kích thước file hình ảnh (tối đa 5MB)
        if ($_FILES['courseImage']['size'] > 5000000) {
            die("Kích thước file quá lớn.");
        }

        // Chỉ cho phép các định dạng file là JPG, JPEG, PNG và GIF
        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            die("Chỉ cho phép các định dạng file JPG, JPEG, PNG và GIF.");
        }

        // Di chuyển file từ thư mục tạm đến thư mục uploads
        if (!move_uploaded_file($_FILES['courseImage']['tmp_name'], $targetFile)) {
            die("Lỗi khi tải ảnh lên.");
        }

        // Lưu thông tin khóa học vào cơ sở dữ liệu
        $sql = "INSERT INTO courses (name, description, fee, major_id, teacher_id, start_date, end_date, image)
                VALUES (:courseName, :courseDesc, :coursePrice, :courseField, :courseTeacher, :startDate, :endDate, :courseImage)";

        // Chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);

        // Gán giá trị cho các biến trong câu lệnh SQL
        $stmt->bindParam(':courseName', $courseName);
        $stmt->bindParam(':courseDesc', $courseDesc);
        $stmt->bindParam(':coursePrice', $coursePrice);
        $stmt->bindParam(':courseField', $courseField);
        $stmt->bindParam(':courseTeacher', $courseTeacher);
        $stmt->bindParam(':startDate', $startDate);
        $stmt->bindParam(':endDate', $endDate);
        $stmt->bindParam(':courseImage', $targetFile);

        // Thực thi câu lệnh
        $stmt->execute();

        // Thông báo thành công
        echo "Thêm khóa học thành công!";
    }
} catch (PDOException $e) {
    // Hiển thị lỗi nếu có vấn đề trong quá trình thực thi SQL
    echo "Lỗi: " . $e->getMessage();
}

// Đóng kết nối
$conn = null;
?>

?>

<div class="content-wrapper subject">
    <section class="content-header">
        <h1>
            Khóa học
        </h1>

    </section>
    <section class="content-header d-flex justify-content-between subject-head">
        <h1></h1>
        <button class="btn btn-primary " id="addCourseBtn">+ Thêm mới khóa học</button>
    </section>
    <section class="courseForm-container">
        <div id="courseForm" style="display: none; " class=" courseForm">
            <h1>Thêm khóa học</h1>
            <form action="" method="POST">
                <div>
                    <label for="courseName">Tên khóa học:</label><br>
                    <input type="text" id="courseName" name="courseName" placeholder="Nhập tên khóa học">
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
    </section>

    <!-- Main content -->
    <section class="content subject">
        <div class="box">
            <div class="box-body">
                <form action="" method="GET" class="form-inline">

                    <div class="radio">
                        <label>
                            <input type="radio" name="" id="input" value="" checked="checked">
                            Tất cả
                        </label>
                    </div>

                    <div class="form-group">
                        <input type="text" name="search_key" class="form-control" id="" placeholder="Tìm kiếm">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </form>
                <p>Danh sách</p>
                <div class="subject-in4">
                    <div class="subject-in4__img">
                        <img src="./dist/img/Nghiên-cứu-khoa-học.jpg" alt="">
                    </div>
                    <p class="subject-in4__desc">Hướng dẫn khởi tạo website</p>
                    <div class="subject-in4__time">
                        <p>HOẠT ĐỘNG</p>
                        <span>CHỈNH SỬA: 9/23/2024</span>
                    </div>
                    <div class="subject-in4__btn">
                        <a href="edit.php" class="btn btn-primary">Sửa</a>
                        <a class="btn btn-danger">Xóa</a>
                    </div>
                </div>
                <hr>
                <div class="subject-in4">
                    <div class="subject-in4__img">
                        <img src="./dist/img/Nghiên-cứu-khoa-học.jpg" alt="">
                    </div>
                    <p class="subject-in4__desc">Hướng dẫn khởi tạo website</p>
                    <div class="subject-in4__time">
                        <p>HOẠT ĐỘNG</p>
                        <span>CHỈNH SỬA: 9/23/2024</span>
                    </div>
                    <div class="subject-in4__btn">
                        <a class="btn btn-primary">Sửa</a>
                        <a class="btn btn-danger">Xóa</a>
                    </div>
                </div>
                <hr>
                <div class="subject-in4">
                    <div class="subject-in4__img">
                        <img src="./dist/img/Nghiên-cứu-khoa-học.jpg" alt="">
                    </div>
                    <p class="subject-in4__desc">Hướng dẫn khởi tạo website</p>
                    <div class="subject-in4__time">
                        <p>HOẠT ĐỘNG</p>
                        <span>CHỈNH SỬA: 9/23/2024</span>
                    </div>
                    <div class="subject-in4__btn">
                        <a class="btn btn-primary">Sửa</a>
                        <a class="btn btn-danger">Xóa</a>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<?php include 'footer.php' ?>