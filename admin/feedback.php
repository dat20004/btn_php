<?php include 'header.php';
?>

<div class="content-wrapper subject">
    <div class="admin-container">
        <!-- Thanh điều hướng -->


        <!-- Nội dung chính -->
        <div class="admin-main-content">
            <h1>Phản hồi từ Sinh viên</h1>

            <!-- Bảng phản hồi -->
            <table class="feedback-table">
                <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Nội dung Phản hồi</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody id="feedbackList">
                    <tr>
                        <td>Nguyễn Văn A</td>
                        <td>vana@example.com</td>
                        <td>Giảng viên dạy rất hay và dễ hiểu.</td>
                        <td>
                            <button onclick="replyFeedback(this)">Trả lời</button>
                            <button onclick="deleteFeedback(this)">Xóa</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Trần Thị B</td>
                        <td>thib@example.com</td>
                        <td>Bài giảng chưa cập nhật kịp thời.</td>
                        <td>
                            <button onclick="replyFeedback(this)">Trả lời</button>
                            <button onclick="deleteFeedback(this)">Xóa</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Form trả lời phản hồi -->
            <div id="replyForm" style="display:none;">
                <h2>Trả lời phản hồi</h2>
                <form>
                    <label for="studentName">Tên sinh viên:</label>
                    <input type="text" id="studentName" name="studentName" readonly><br><br>

                    <label for="replyMessage">Nội dung trả lời:</label><br>
                    <textarea id="replyMessage" rows="4" cols="50"
                        placeholder="Nhập câu trả lời của bạn"></textarea><br><br>

                    <label for="replyImage">Tải lên hình ảnh (nếu có):</label>
                    <input type="file" id="replyImage" name="replyImage" accept="image/*">

                    <div class="replyForm-btn">
                        <button type="button" onclick="sendReply()">Gửi trả lời</button>
                        <button type="button" onclick="closeReplyForm()">Đóng</button>
                    </div>
                </form>
            </div>

            <!-- Thông báo -->
            <p id="responseMessage" style="display:none;"></p>
        </div>
    </div>


</div>


<?php include 'footer.php' ?>