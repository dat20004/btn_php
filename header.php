<?php
session_start();
include 'connect.php';

// Kiểm tra xem người dùng đã đăng nhập hay chưa
$user_logged_in = isset($_SESSION['user_login']) ? true : false;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/533aad8d01.js" crossorigin="anonymous"></script>
</head>
<style>
.nav-item .dropdown-menu {
    padding: 0;
    margin-top: 17px;
    border: none;
    background-color: #fff;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    position: relative;
    /* Đảm bảo dropdown cha có vị trí tương đối */
}

.header__dropdown__content--faculty {
    position: relative;
    /* Đảm bảo mục chính có vị trí tương đối */
    display: flex;
    flex-direction: column;
    /* Để các mục con được xếp chồng lên nhau */
    margin-right: 20px;
    /* Khoảng cách giữa các mục con */
    color: #2F4157;
    font-family: 'Poppins', sans-serif;
}

/* Định dạng cho các liên kết trong menu */
.header__dropdown__content--faculty--link {
    display: flex;
    align-items: center;
    padding: 10px 20px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    text-decoration: none;
    color: black;
}

/* Hiệu ứng khi hover vào mục cha */
.header__dropdown__content--faculty:hover {
    background-color: #f0f0f0;
}

/* Biểu tượng mũi tên bên phải */
.header__dropdown__content--faculty--link--image {
    width: 20px;
    transition: transform 0.3s ease;
}

/* Hiệu ứng khi hover vào mục cha */
.header__dropdown__content--faculty--link:hover .header__dropdown__content--faculty--link--image {
    transform: translateX(10%);
}

/* Sub-dropdown menu con (hiển thị khi hover vào mục chính) */
.header__dropdown__content--major {
    opacity: 0;
    visibility: hidden;
    position: absolute;
    left: 100%;
    /* Đẩy menu con sang bên phải */
    top: 0;
    /* Giữ vị trí top cùng mức với mục cha */
    margin-left: 21px;
    /* Khoảng cách giữa menu chính và menu con */
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    min-width: 150px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    transition: opacity 0.3s ease, visibility 0.3s ease;
    z-index: 1000;
}

.header__dropdown__content--major1 {
    opacity: 0;
    visibility: hidden;
    position: absolute;
    left: 100%;
    /* Đẩy menu con sang bên phải */
    bottom: 10%;
    /* Giữ vị trí top cùng mức với mục cha */
    margin-left: 21px;
    /* Khoảng cách giữa menu chính và menu con */
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    min-width: 150px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    transition: opacity 0.3s ease, visibility 0.3s ease;
    z-index: 1000;
}

.header__dropdown__content--faculty:hover .header__dropdown__content--major1 {
    opacity: 1;
    visibility: visible;
}

/* Hiển thị menu con khi hover vào mục chính */
.header__dropdown__content--faculty:hover .header__dropdown__content--major {
    opacity: 1;
    visibility: visible;
}

/* Link của mục con */
.header__dropdown__content--major--link a {
    display: flex;
    align-items: center;
    padding: 5px 10px;
    font-size: 14px;
    color: #2F4157;
    font-family: 'Poppins', sans-serif;
    text-decoration: none;
    transition: background-color 0.3s ease, color 0.3s ease;
}

/* Hiệu ứng khi hover vào link của mục con */
.header__dropdown__content--major--link a:hover {
    background-color: #577C8E;
    color: blue;
}

/* Biểu tượng mũi tên phải nhỏ */
.header__dropdown__content--major--link a img {
    width: 16px;
    margin-right: 8px;
}

.nav-item:hover .dropdown-menu {
    opacity: 1;
    /* Hiển thị khi hover */
    visibility: visible;
    /* Thay đổi visibility khi hover */
}

/* Đặt các icon thông báo, giỏ hàng và avatar nằm trên cùng một hàng */
.header-buttons {
    display: flex;
    align-items: center;
    gap: 20px;
    /* Khoảng cách giữa các icon */
}

/* Định dạng các nút icon */
.btn-icon {
    background-color: transparent;
    border: none;
    outline: none;
    padding: 5px;
    cursor: pointer;
    color: #fff;
    transition: color 0.3s ease;
}

.btn-icon i {
    font-size: 18px;
    transition: color 0.3s ease;
}

/* Tạo hiệu ứng hover cho các icon */
.btn-icon:hover i {
    color: #ff5c5c;
}

/* Giỏ hàng */
#cartButton {
    position: relative;
}

/* Số lượng sản phẩm trong giỏ hàng */
.cart-count {
    position: absolute;
    top: -5px;
    right: -5px;
    background-color: #ff5c5c;
    color: white;
    padding: 2px 8px;
    border-radius: 50%;
    font-size: 14px;
    font-weight: bold;
}

/* Định dạng avatar dropdown */
.btn-avatar {
    padding: 0;
    border: none;
    background-color: transparent;
}

.btn-avatar img {
    width: 30px;
    height: 30px;
    border-radius: 50%;
}

/* Dropdown menu và các mục trong menu */
.dropdown-menu {
    border-radius: 5px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
    /* Tạo bóng mờ cho menu */
    padding: 10px 0;
    min-width: 200px;
}

.dropdown-item {
    padding: 10px 15px;
    font-size: 16px;
    color: #333;
    transition: background-color 0.3s ease;
}

.dropdown-item:hover {
    background-color: #f0f0f0;
    color: #007bff;
}

/* Định dạng nút icon */
/* Định dạng nút icon */
/* thông báo */
.btn-icon {
    background-color: transparent;
    border: none;
    outline: none;
    padding: 5px;
    cursor: pointer;
    color: #fff;
    position: relative;
    display: inline-block;
    margin-right: 10px;
}

/* Định dạng dropdown-menu */
.dropdown-menu {
    display: none;
    /* Ẩn menu mặc định */
    position: absolute;
    top: 100%;
    /* Đặt menu xuống dưới nút */
    left: 0;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    padding: 10px;
    min-width: 200px;
    z-index: 999;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease;
    /* Hiệu ứng mượt mà */
}

/* Khi menu được hiển thị */
.dropdown-menu.show {
    display: block;
    opacity: 1;
    visibility: visible;
}

/* Định dạng danh sách trong menu */
.dropdown-menu ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.dropdown-menu ul li {
    padding: 8px 10px;
}

.dropdown-menu ul li a {
    color: #333;
    text-decoration: none;
    display: block;
}

.dropdown-menu ul li a:hover {
    background-color: #f0f0f0;
    color: #007bff;
}

/* Định dạng khi hover nút */
.btn-icon:hover {
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 5px;
}
/* Định dạng chung cho các mục trong dropdown */

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


<body>
    <header class="header">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img class="header-img" src="./images/12-removebg-preview.png"
                        alt=""></a>

                <div class="collapse navbar-collapse d-flex justify-content-around" id="navbarNavDropdown">
                    <ul class="navbar-nav ">
                        <!-- Dropdown Ngành học -->


                        <!-- Dropdown Chương trình học -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="chuongTrinhHocDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Về chúng tôi
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="chuongTrinhHocDropdown"
                                style="padding: 0;margin-top:17px;">
                                <li>
                                    <a class="dropdown-item" href="#">Về FastLearn </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">Đội ngũ giảng viên</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">Học viên</a>
                                </li>
                            </ul>
                        </li>



                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="giangVienDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Ngành học
                            </a>
                            <ul class="dropdown-menu dropdown-teacher" aria-labelledby="giangVienDropdown"
                                style="padding: 0; margin-top: 17px;">
                                <li class="header__dropdown__content--faculty">
                                    <a href="#" class="header__dropdown__content--faculty--link">
                                        <span>Language</span>
                                        <img src="svg/alt-arrow-right.svg" alt=""
                                            class="header__dropdown__content--faculty--link--image">
                                    </a>
                                    <ul class="header__dropdown__content--major">
                                        <li class="header__dropdown__content--major--link">
                                            <a href="#">
                                                <span>English</span>
                                            </a>
                                        </li>
                                        <li class="header__dropdown__content--major--link">
                                            <a href="#">
                                                <span>Chinese</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="header__dropdown__content--faculty">
                                    <a href="#" class="header__dropdown__content--faculty--link">
                                        <span>Math</span>
                                        <img src="svg/alt-arrow-right.svg" alt=""
                                            class="header__dropdown__content--faculty--link--image">
                                    </a>
                                    <ul class="header__dropdown__content--major1">
                                        <li class="header__dropdown__content--major--link">
                                            <a href="#">
                                                <span>Circle</span>
                                            </a>
                                        </li>
                                        <li class="header__dropdown__content--major--link">
                                            <a href="#">
                                                <span>Square</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>


                        </li>


                    </ul>

                    <!-- Tìm kiếm -->
                    <form class="d-flex header-form" role="search">
                        <input class="form-control" type="search" placeholder="Tìm kiếm" aria-label="Search">
                        <button class="btn btn-outline-light" type="submit"><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </form>

                    <!-- Thay đổi giao diện tùy theo trạng thái đăng nhập -->
                    <div class="header-button__register"style="gap:1px;">
                        <!-- Nếu đã đăng nhập, hiển thị icon thông báo và avatar -->
                        <?php if ($user_logged_in): ?>
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

                            <!-- Icon giỏ hàng -->
                            <div class="dropdown">
                                <button class="btn btn-icon dropdown-toggle" type="button" id="cartButton"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-shopping-cart"></i> <!-- Icon giỏ hàng -->
                                    <span class="cart-count">3</span> <!-- Hiển thị số lượng sản phẩm trong giỏ -->
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="cartButton">
                                    <li><a class="dropdown-item" href="#">Sản phẩm 1</a></li>
                                    <li><a class="dropdown-item" href="#">Sản phẩm 2</a></li>
                                    <li><a class="dropdown-item" href="#">Sản phẩm 3</a></li>
                                    <li><a class="dropdown-item" href="#">Xem giỏ hàng</a></li>
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
                        <?php else: ?>
                        <!-- Nếu chưa đăng nhập, hiển thị nút Đăng ký và Đăng nhập -->
                        <a href="register.php">
                            <button class="btn btn-register">Đăng ký</button>
                        </a>
                        <a href="login.php">
                            <button class="btn btn-primary btn-login">Đăng nhập</button>
                        </a>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </nav>
    </header>


    <script>
    // Thêm jQuery để xử lý sự kiện click
    $(document).ready(function() {
        $('.header__dropdown__content--faculty--link').on('click', function(e) {
            e.preventDefault();
            // Ẩn tất cả menu con trước đó
            $('.header__dropdown__content--major').removeClass('visible').css({
                opacity: 0,
                visibility: 'hidden'
            });
            // Hiện menu con tương ứng
            $(this).siblings('.header__dropdown__content--major').toggleClass('visible').css({
                opacity: 1,
                visibility: 'visible'
            });
        });
    });
    $(document).ready(function() {
        // Khi nhấn vào nút thông báo, hiển thị hoặc ẩn menu
        $('#notificationButton').on('click', function() {
            // Ẩn menu giỏ hàng nếu nó đang mở
            $('#cartButton').next('.dropdown-menu').removeClass('show');
            // Toggle menu thông báo
            $(this).next('.dropdown-menu').toggleClass('show');
        });

        // Khi nhấn vào nút giỏ hàng, hiển thị hoặc ẩn menu
        $('#cartButton').on('click', function() {
            // Ẩn menu thông báo nếu nó đang mở
            $('#notificationButton').next('.dropdown-menu').removeClass('show');
            // Toggle menu giỏ hàng
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
</body>

</html>