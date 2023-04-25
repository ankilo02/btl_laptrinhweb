<?php
session_start();
include 'ultils.php';
include "db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php getDocumentTitle($con) ?></title>
    <meta name="keywords" content=<?php echo "'" . getDocumentKeyword($con) . "'"; ?>>
    <meta name="description" content="BK bookstore cung cấp các loại sách thuộc nhiều thể loại như khoa học, lập trình, kỹ năng sống, ...">

    <link rel="icon" type="image/x-icon" href="img/logo.png">

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="vendor/css/bootstrap.min.css" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="vendor/css/slick.css" />
    <link type="text/css" rel="stylesheet" href="vendor/css/slick-theme.css" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="vendor/css/nouislider.min.css" />
    <link href='http://fonts.googleapis.com/css?family=Dancing+Script' rel='stylesheet' type='text/css'>

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="vendor/css/font-awesome.min.css">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="style.css" />
    <link type="text/css" rel="stylesheet" href="assets/css/accountbtn.css" />


    <style>

    </style>
</head>

<body>
    <!-- HEADER -->
    <header>
        <div id="header" >
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="./index.php" class="logo">
                                <p class="p3"><i class="fa fa-coffee" aria-hidden="true"></i>BK Coffee
                                </p>
                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->
                    <div class="col-md-1"></div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">

                            <!-- Wishlist -->
                            <div>
                                <ul class="header-links pull-right">

                                    <li><?php
                                        if (isset($_SESSION["uid"])) {
                                            $sql = "SELECT first_name, last_name FROM user_info WHERE user_id='$_SESSION[uid]'";
                                            $query = mysqli_query($con, $sql);
                                            $row = mysqli_fetch_array($query);

                                            if (isset($row)) {
                                                echo '
                                <div class="dropdownn">
                                  <a href="#" class="dropdownn" data-toggle="modal" data-target="#myModal" ><i class="fa fa-user-o"></i> HI ' . $row["first_name"] . ' ' . $row['last_name'] . '</a>
                                  <div class="dropdownn-content">
                                    <a href="./profile.php"><i class="fa fa-user-circle" aria-hidden="true" ></i>Thông tin cá nhân</a>
                                    <a href="./logout.php"  ><i class="fa fa-sign-in" aria-hidden="true"></i>Đăng xuất</a>
                                    
                                  </div>
                                  </div>';
                                            } else {
                                                echo '<div class="dropdownn">
                                                <a href="#" class="dropdownn" data-toggle="modal" data-target="#myModal" ><i class="fa fa-user-o"></i> Tài khoản</a>
                                                <div class="dropdownn-content">
                                                  <a href="" data-toggle="modal" data-target="#Modal_login"><i class="fa fa-sign-in" aria-hidden="true" ></i>Đăng nhập</a>
                                                  <a href="" data-toggle="modal" data-target="#Modal_register"><i class="fa fa-user-plus" aria-hidden="true"></i>Đăng ký</a>
                                                  
                                                </div>
                                              </div>';
                                            }
                                        } else {
                                            echo '
                                <div class="dropdownn">
                                  <a href="#" class="dropdownn" data-toggle="modal" data-target="#myModal" ><i class="fa fa-user-o"></i> Tài khoản</a>
								  <div class="dropdownn-content">
								  	<a href="admin/login.php" ><i class="fa fa-user" aria-hidden="true" ></i>Admin</a>
                                    <a href="" data-toggle="modal" data-target="#Modal_login"><i class="fa fa-sign-in" aria-hidden="true" ></i>Đăng nhập</a>
                                    <a href="" data-toggle="modal" data-target="#Modal_register"><i class="fa fa-user-plus" aria-hidden="true"></i>Đăng ký</a>
                                    
                                  </div>
                                </div>';
                                        }
                                        ?>

                                    </li>
                                </ul>
                            </div>
                            <!-- /Wishlist -->



                            <!-- Menu Toogle -->
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                            <!-- /Menu Toogle -->
                            <div>
                                <!-- Cart -->
                                <div class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span>Giỏ hàng</span>
                                        <div class="badge qty">0</div>
                                    </a>
                                    <div class="cart-dropdown">
                                        <div class="cart-list" id="cart_product">


                                        </div>

                                        <div class="cart-btns">
                                            <a href="./cart.php" style="width:100%;"><i class="fa fa-edit"></i>
                                                Chỉnh sửa giỏ hàng
                                            </a>
                                        </div>
                                    </div>

                                </div>
                                <!-- /Cart -->
                            </div>

                        </div>
                    </div>
                    <!-- /ACCOUNT -->
                    <div class=rec>
                        <div class='menu'>
                            <!-- container -->
                            <p><a href='./index.php' class ="headerfont">Trang chủ</a></p>
                            <p><a href='./index.php#section2' class ="headerfont">Giới thiệu</a></p>
                            <p><a href='./index.php#section3' class ="headerfont">Dịch vụ</a></p>
                            <p><a href='./menu.php' class ="headerfont">Thực đơn</a></p>
                            <p><a href='./index.php#section6' class ="headerfont">Tin tức</a></p>
                            <p><a href='./index.php#footer' class ="headerfont">Liên hệ</a></p>
                            
                            <!-- responsive-nav -->

                            <!-- /container -->
                        </div>
                    </div>
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- /MAIN HEADER -->
    </header>
    <!-- /HEADER -->
                                        

    <!-- NAVIGATION -->
    <div class="modal fade" id="Modal_login" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <?php
                    include "login_form.php";

                    ?>

                </div>

            </div>

        </div>
    </div>
    <div class="modal fade" id="Modal_register" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <?php
                    include "register_form.php";
                    ?>

                </div>

            </div>

        </div>
    </div>