<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khôi phục mật khẩu</title>
</head>
<body>
    <h3>Khôi phục mật khẩu</h3>
    <form action="send-reset-link.php" method="POST">
        <div class="form-group">
            <label for="email">Nhập email để khôi phục mật khẩu</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Gửi liên kết khôi phục</button>
    </form>
</body>
</html>
