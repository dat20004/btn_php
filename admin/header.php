<?php 
// ob_start();
// session_start();
// include'../connect.php';
// if(empty($_SESSION['admin_login'])){
//     header('location: login.php');
// }

// $admin = $_SESSION['admin_login'];

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Blank Page</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/summernote/summernote.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <script src="https://kit.fontawesome.com/533aad8d01.js" crossorigin="anonymous"></script>
    <style>
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
        margin-left: 8px;
        /* Khoảng cách giữa chữ và icon */
        font-size: 18px;
        /* Kích thước của icon */
        transition: color 0.3s ease;
    }

    /* Hiệu ứng khi hover vào "Đăng xuất" */
    .dropdown-item:hover {
        background-color: #f0f0f0;
        color: #007bff;
    }

    .dropdown-item:hover i {
        color: #007bff;
        /* Màu của icon khi hover */
    }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        <header class="main-header header-h">
            <!-- Logo -->
            <div class="header-img"><img src="./dist/img/logo-btl.jpg" alt=""></div>
            <div class="header-input">
                <i class="fa-solid fa-magnifying-glass"></i><input type="text" name="" placeholder="Tìm kiếm">
            </div>
            <div class="header-icon">
                <ul>
                    <li>
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
                    </li>
                    <li>
                        <div class="dropdown">
                            <button class="btn btn-avatar dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://via.placeholder.com/30" alt="avatar" class="rounded-circle">
                                <!-- Icon avatar -->
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="margin-top :15px;">
                                <li><a class="dropdown-item" href="myProfile.php">Thông tin tài khoản</a></li>
                                <li><a class="dropdown-item" href="settings.php">Khoá học của tôi</a></li>
                                <li><a class="dropdown-item" href="settings.php">Giỏ hàng</a></li>
                                <li><a class="dropdown-item" href="settings.php">Lịch sử giao dịch</a></li>
                                <li><a class="dropdown-item" href="settings.php">Cài đặt</a></li>
                                <hr>
                                <li><a class="dropdown-item" href="logout.php"> Đăng xuất <i
                                            class="fa-solid fa-sign-out-alt"></i></a></li>

                            </ul>
                        </div>
                    </li>
                </ul>
            </div>

        </header>
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->

                <hr>
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li>
                        <a href="index.php">
                            <i class="fa fa-home"></i> <span>Quản lý nội dung</span> <i
                                class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="subject.php"><i class="fa fa-circle-o"></i>Khóa học</a></li>
                            <li><a href="teacher.php"><i class="fa fa-circle-o"></i>Giảng viên</a></li>
                            <li><a href="feedback.php"><i class="fa fa-circle-o"></i>Đánh giá</a></li>
                            <li><a href="nganh.php"><i class="fa fa-circle-o"></i>Ngành</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-th"></i> <span>Quản lý tài khoản</span> <i
                                class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="account.php"><i class="fa fa-circle-o"></i>Tài khoản</a></li>
                            <li><a href="role-decentralization.php"><i class="fa fa-circle-o"></i>Vai trò và phân
                                    quyền</a>
                            </li>
                            <li><a href="manager-notifi.php"><i class="fa fa-circle-o"></i>Quản lý thông báo</a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-th"></i> <span>Quản lý đơn hàng</span> <i
                                class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="list-account.php"><i class="fa fa-circle-o"></i> Danh sách đơn hàng</a></li>
                            <li><a href="manager-cod.php"><i class="fa fa-circle-o"></i>Quản lý COD</a></li>
                            <li><a href="edit-cod.php"><i class="fa fa-circle-o"></i>Xử lý COD</a></li>
                            <li><a href="call-customer.php"><i class="fa fa-circle-o"></i>Liên hệ khách hàng</a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-user"></i> <span>Thống kê</span> <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="statistics.php"><i class="fa fa-circle-o"></i>Thống kê chung</a></li>
                            <li><a href="course.php"><i class="fa fa-circle-o"></i>Khóa học</a></li>
                        </ul>
                    </li>
                    <hr>
                    <li><a class="dropdown-item" href="logout.php"> <button style="display: flex;
    align-items: center;" class="btn btn-success mt-3"> Đăng xuất <i class="fa-solid fa-sign-out-alt"></button></i></a>
                    </li>

                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
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