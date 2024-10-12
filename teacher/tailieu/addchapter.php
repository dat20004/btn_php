<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Chương</title>
    <style>
    /* Global Styles */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f7f7f7;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    h1 {
        text-align: center;
        font-size: 24px;
        color: #333;
    }

    /* Form Container */
    .form-container {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 400px;
        margin: auto;
    }

    /* Form Styling */
    form {
        display: flex;
        flex-direction: column;
    }

    label {
        font-size: 16px;
        margin-bottom: 5px;
        color: #555;
    }

    input[type="text"],
    select {
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 4px;
        border: 1px solid #ddd;
        font-size: 16px;
        transition: border-color 0.3s ease;
    }

    input[type="text"]:focus,
    select:focus {
        border-color: #4CAF50;
        outline: none;
    }

    button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 15px;
        font-size: 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #45a049;
    }

    /* Add some spacing and centering */
    .form-container button {
        align-self: center;
        width: 100%;
    }

    /* Error message styling */
    .error {
        color: red;
        font-size: 14px;
        text-align: center;
        margin-bottom: 10px;
    }
    </style>
</head>

<body>

    <div class="form-container">
        <h1>Thêm Chương Mới</h1>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && (empty($chapter_title) || empty($course_id))) {
            echo "<p class='error'>Tiêu đề chương và khóa học không thể trống!</p>";
        }
        ?>

        <form action="addchapter.php" method="POST">
            <label for="chapter_title">Tiêu đề chương:</label>
            <input type="text" name="chapter_title" id="chapter_title" required>

            <!-- Thêm trường để chọn khóa học (course_id) -->
            <label for="course_id">Chọn Khóa Học:</label>
            <select name="course_id" id="course_id" required>
                <!-- Giả sử bạn đã có danh sách khóa học từ cơ sở dữ liệu -->
                <?php
                // try {
                //     // Lấy danh sách khóa học từ cơ sở dữ liệu
                //     $stmt = $conn->prepare("SELECT id, name FROM courses");
                //     $stmt->execute();
                //     $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
                //     foreach ($courses as $course) {
                //         echo "<option value='" . htmlspecialchars($course['id']) . "'>" . htmlspecialchars($course['name']) . "</option>";
                //     }
                // } catch (PDOException $e) {
                //     die("Lỗi: " . $e->getMessage());
                // }
                ?>
                <option value="">1</option>
                <option value="">1</option>
                <option value="">1</option>
                <option value="">1</option>

            </select>

            <button type="submit">Thêm Chương</button>
        </form>
    </div>

</body>

</html>