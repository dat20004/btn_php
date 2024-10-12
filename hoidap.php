<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giao diện hỏi đáp</title>
    <script src="https://kit.fontawesome.com/533aad8d01.js" crossorigin="anonymous"></script>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f1f1f1;
        padding: 20px;
    }

    .container {
        width: 600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .comment-box {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .comment-box textarea {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        height: 100px;
        resize: none;
    }

    .file-input {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .file-input label {
        cursor: pointer;
        color: #007BFF;
    }

    .file-input input[type="file"] {
        display: none;
    }

    .file-input span {
        font-size: 12px;
        color: #777;
    }

    button {
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .cancel {
        background-color: #f44336;
        color: #fff;
        font-size: 12px;
        padding: 5px 10px;
    }

    .submit {
        background-color: #4CAF50;
        color: #fff;
        font-size: 12px;
        padding: 5px 10px;
    }

    .comment {
        margin-top: 20px;
        padding: 10px;
        background-color: #f9f9f9;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .comment .user {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 5px;
        justify-content: space-between;
        position: relative;

    }

    .user-left {
        display: flex;
        align-items: center;

        gap: 10px;
    }

    /* .comment .user button {
        position: absolute;
        right: 0;
    } */

    .comment .username {
        font-weight: bold;
    }

    .comment .time {
        color: #777;
        font-size: 12px;
    }

    .comment p {
        margin: 10px 0;
    }

    .actions {
        margin-top: 10px;
    }

    .actions button {
        background: none;
        border: none;
        color: #007BFF;
        cursor: pointer;
        margin-right: 10px;
        font-size: 14px;
    }

    .actions button:hover {
        text-decoration: underline;
    }

    .edit-delete {
        margin-top: 10px;
        text-align: right;
        display: none;
        /* Ẩn nút sửa và xóa mặc định */
        position: absolute;
        right: 0;
        /* Đặt vị trí bên phải */
        top: 28px;
        /* Đặt vị trí bên dưới nút ba chấm */
        background: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        z-index: 10;
        /* Thêm khoảng cách cho nút */
    }

    .edit-delete button {
        background: none;
        border: none;
        color: #FFC107;
        cursor: pointer;
        font-size: 14px;
        margin: 5px 0;
        /* Khoảng cách giữa các nút */
    }

    .edit-delete button:hover {
        text-decoration: underline;
    }

    .comment-img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    /* Hiệu ứng khi di chuột qua nút ba chấm */
    .more-options:hover+.edit-delete {
        display: block;
        /* Hiện nút khi hover */
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="comment-box">
            <textarea placeholder="Nhập bình luận của bạn"></textarea>
            <div class="file-input">
                <label for="file-upload">Chọn tệp</label>
                <input type="file" id="file-upload" name="file-upload" />
                <span>Chưa có tệp nào được chọn</span>
            </div>
            <div class="comment-buttons">
                <button class="cancel">Hủy</button>
                <button class="submit">Bình luận</button>
            </div>
        </div>

        <div class="comment">
            <div class="user">
                <div class="user-left">
                    <img class="comment-img" src="./images/ava1.jpg" alt="">
                    <span class="username">Trung Kiên</span>
                    <span class="time">1 tháng trước</span>

                </div><button class="more-options"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <div class="edit-delete">
                    <button class="edit">Sửa</button>
                    <button class="delete">Xoá</button>
                </div>
            </div>
            <p>Sao không next được bài vậy ae??</p>
            <div class="actions">
                <button class="like">Thích</button>
                <button class="reply">Phản hồi</button>
            </div>
        </div>
    </div>

    <script>
    // Lấy tất cả các nút ba chấm
    const moreOptionsButtons = document.querySelectorAll('.more-options');
    const editDeleteSections = document.querySelectorAll('.edit-delete');

    moreOptionsButtons.forEach((button, index) => {
        button.addEventListener('click', (event) => {
            // Ngăn chặn sự kiện click lan ra bên ngoài
            event.stopPropagation();

            // Hiển thị hoặc ẩn phần edit-delete tương ứng khi nhấn vào nút ba chấm
            const editDelete = editDeleteSections[index];
            if (editDelete.style.display === 'none' || editDelete.style.display === '') {
                editDelete.style.display = 'block';
            } else {
                editDelete.style.display = 'none';
            }
        });
    });

    // Đóng edit-delete khi nhấn vào bất kỳ nơi nào khác
    document.addEventListener('click', () => {
        editDeleteSections.forEach((editDelete) => {
            editDelete.style.display = 'none';
        });
    });
    </script>
</body>

</html>