<?php

if (!isset($_SESSION['admin_name'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: .././login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['admin_name']);
    header("location: .././login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="../assets/images/logo.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Amin | BK Coffee
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="../assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/jquery.min.js" defer></script>
    <script src="../assets/js/script.js" defer></script>
</head>

<body class="dark-edition">
    <div class="wrapper ">
        <div class="sidebar" data-color="orange" data-background-color="black" data-image="../assets/img/sidebar-2.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="logo"><a href="./index.php" class="simple-text logo-normal">
                    <p style="font-family: 'Brush Script MT', cursive; font-size: 25px;"> <i class="fa fa-coffee" aria-hidden="true"></i> BK Coffee</p>
                </a></div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php">
                            <i class="material-icons">dashboard</i>
                            <p>Trang chủ</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="./add_products.php">
                            <i class="material-icons">add</i>
                            <p>Thêm sản phẩm</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./products_list.php">
                            <i class="material-icons">list</i>
                            <p>Danh sách sản phẩm</p>
                        </a>

                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="./manageuser.php">
                            <i class="material-icons">person</i>
                            <p>Quản lý người dùng</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="./orders.php">
                            <i class="material-icons">shopping_cart</i>
                            <p>Đơn hàng</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="./profile.php">
                            <icons-image _ngcontent-aye-c22="" _nghost-aye-c19=""><i _ngcontent-aye-c19="" class="material-icons icon-image-preview">settings</i></icons-image>
                            <p>Cài đặt</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>