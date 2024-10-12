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
    position: relative; /* Đảm bảo dropdown cha có vị trí tương đối */
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
.header__dropdown__content--major1{
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
    opacity: 1; /* Hiển thị khi hover */
    visibility: visible; /* Thay đổi visibility khi hover */
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
                        <input class="form-control " type="search" placeholder="Tìm kiếm" aria-label="Search">
                        <button class="btn btn-outline-light" type="submit"><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </form>

                    <div class="header-button__register">
                        <button class="btn btn-register">Đăng ký </button>
                        <button class="btn btn-primary btn-login">Đăng nhập</button>
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
    </script>