<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/533aad8d01.js" crossorigin="anonymous"></script>
    <style>
        /* Định dạng chung cho các mục trong dropdown */
.dropdown-item {
    padding: 10px 15px;
    font-size: 16px;
    color: #333;
    display: flex;
    align-items: center;
    transition: background-color 0.3s ease, color 0.3s ease;
}

/* Định dạng icon trong mục "Đăng xuất" */
.dropdown-item i {
    margin-left: 8px; /* Khoảng cách giữa chữ và icon */
    font-size: 18px; /* Kích thước của icon */
    transition: color 0.3s ease;
}

/* Hiệu ứng khi hover vào "Đăng xuất" */
.dropdown-item:hover {
    background-color: #f0f0f0;
    color: #007bff;
}

.dropdown-item:hover i {
    color: #007bff; /* Màu của icon khi hover */
}
    </style>
    
</head>
<header class="header-teacher">
    <div class="container">
        <div class="inner-wrap">
            <div class="teacher-img"><img src="./imgs/12-removebg-preview.png" alt=""></div>
            <div class="teacher-search">

                <form action="" method="POST" role="form">
                    <div class="form-group">
                        <input type="text" class="form-control" id="" placeholder="Tìm kiếm">
                    </div>
                    <button type="submit" class=""><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>

            </div>
            <div class="teacher-noti">
                
            <div class="header-buttons d-flex align-items-center" style="gap:1px;">
                            <!-- Icon thông báo -->
                            <!-- Icon thông báo -->
                            <!-- Icon thông báo -->
                            <div class="dropdown">
                                <button class="btn btn-icon dropdown-toggle" type="button" id="notificationButton"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-bell"></i> <!-- Icon thông báo -->
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="notificationButton">
                                    <li><a class="dropdown-item" href="#">Thông báo mới nhất</a></li>
                                    <li><a class="dropdown-item" href="#">Thông báo cũ hơn</a></li>
                                    <li><a class="dropdown-item" href="#">Đọc tất cả thông báo</a></li>
                                </ul>
                            </div>

                        
                            <!-- Dropdown avatar -->
                            <div class="dropdown">
                                <button class="btn btn-avatar dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="https://via.placeholder.com/30" alt="avatar" class="rounded-circle">
                                    <!-- Icon avatar -->
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                                    style="margin-top :15px;">
                                    <li><a class="dropdown-item" href="myProfile.php">Thông tin tài khoản</a></li>
                                    <li><a class="dropdown-item" href="settings.php">Khoá học của tôi</a></li>
                                    <li><a class="dropdown-item" href="settings.php">Giỏ hàng</a></li>
                                    <li><a class="dropdown-item" href="settings.php">Lịch sử giao dịch</a></li>
                                    <li><a class="dropdown-item" href="settings.php">Cài đặt</a></li>
                                    <hr>
                                    <li><a class="dropdown-item" href="logout.php"> Đăng xuất <i class="fa-solid fa-sign-out-alt"></i></a></li>

                                </ul>
                            </div>
                        </div>
        </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
        // Khi nhấn vào nút thông báo, hiển thị hoặc ẩn menu
        $('#notificationButton').on('click', function() {
            // Ẩn menu giỏ hàng nếu nó đang mở
            $('#cartButton').next('.dropdown-menu').removeClass('show');
            // Toggle menu thông báo
            $(this).next('.dropdown-menu').toggleClass('show');
        });


        // Khi nhấn ra ngoài các nút thông báo và giỏ hàng, ẩn các menu xổ xuống
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.dropdown').length) {
                $('.dropdown-menu').removeClass('show');
            }
        });
    });
    </script>
</header>

<body>