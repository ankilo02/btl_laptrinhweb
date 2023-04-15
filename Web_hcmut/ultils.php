<?php

function displayStar($avg)
{
    for ($i = $avg; $i > $avg - 5; $i--) {
        if ($i >= 1) {
            echo '<i class="fa fa-star"></i>';
        } elseif ($i >= 0.5) {
            echo '<i class="fa fa-star-half-o"></i>';
        } else {
            echo '<i class="fa fa-star-o"></i>';
        }
    }
}

function getDocumentTitle($con)
{
    $url = $_SERVER['REQUEST_URI'];
    $url = explode('/', $url);
    $url = $url[1];
    $path = explode('?', $url)[0];
    $cat = $_GET['cat'];
    $key = $_GET['keyword'];
    $p_id = $_GET['p'];

    $title = "";
    if (isset($cat)) {
        $result = mysqli_query($con, "SELECT cat_title FROM categories WHERE cat_id=$cat");
        $cat_title = mysqli_fetch_assoc($result)['cat_title'];
        $title = "$cat_title | ";
    }

    if (isset($key)) {
        $title = "$key | ";
    }

    if (isset($p_id)) {
        $result = mysqli_query($con, "SELECT product_title FROM products WHERE product_id=$p_id");
        $p_title = mysqli_fetch_assoc($result)['product_title'];
        $title = "$p_title | ";
    }

    switch ($path) {
        case '':
        case 'index.php':
            $title = "BK Bookstore - Bắt đầu hành trình tri thức";
            break;
        case 'store.php':
        case 'product.php':
            $title .= "BK Bookstore - Bắt đầu hành trình tri thức";
            break;
        case 'profile.php':
        case 'editprofile.php':
            $title .= "Tài khoản | BK Bookstore - Bắt đầu hành trình tri thức";
            break;
        case 'cart.php':
            $title .= "Giỏ hàng | BK Bookstore - Bắt đầu hành trình tri thức";
            break;
        case 'checkout.php':
            $title .= "Đặt hàng | BK Bookstore - Bắt đầu hành trình tri thức";
            break;
        default:
            # code...
            break;
    }
    echo $title;
}

function getDocumentKeyword($con)
{
    $keyword = "BK bookstore, BK, bookstore, sach, truyen, gia, re, kinh, 
    dien, khoa, hoc, lap, trinh, truyen, tranh, ky, nang, song, ngoai, ngu,  ";
    $p_id = $_GET['p'];
    if (isset($p_id)) {
        $result = mysqli_query($con, "SELECT product_keywords FROM products WHERE product_id=$p_id");
        $key = mysqli_fetch_assoc($result)['product_keywords'];
        $keyword .= $key;
    }
    return $keyword;
}
