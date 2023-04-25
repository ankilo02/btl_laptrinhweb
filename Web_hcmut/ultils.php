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
    $url = $url[3];
    $path = explode('?', $url)[0];
    $title="";
    if(isset($_GET['cat'])){
        $cat = $_GET['cat'];
        $result = mysqli_query($con, "SELECT cat_title FROM categories WHERE cat_id=$cat");
        $cat_title = mysqli_fetch_assoc($result)['cat_title'];
        $title = "$cat_title | ";
    }
    if(isset($_GET['keyword'])){
        $key = $_GET['keyword'];
        $title = "$key | ";
    }
    if(isset($_GET['p'])){
        $p_id = $_GET['p'];
        $result = mysqli_query($con, "SELECT product_title FROM products WHERE product_id=$p_id");
        $p_title = mysqli_fetch_assoc($result)['product_title'];
        $title = "$p_title | ";
    }
    
    

    switch ($path) {
        case '':
        case 'index.php':
            $title = "BK Coffee";
            break;
        case 'store.php':
        case 'product.php':
            $title .= "BK Coffee - Store";
            break;
        case 'profile.php':
        case 'editprofile.php':
            $title .= "Tài khoản | BK Coffee";
            break;
        case 'cart.php':
            $title .= "Giỏ hàng | BK Coffee";
            break;
        case 'checkout.php':
            $title .= "Đặt hàng | BK Coffee";
            break;
        default:
            # code...
            break;
    }
    echo  $title;
}

function getDocumentKeyword($con)
{
    $keyword = "";
    if (isset($_GET['p'])) {
        $p_id = $_GET['p'];
        $result = mysqli_query($con, "SELECT product_keywords FROM products WHERE product_id=$p_id");
        $key = mysqli_fetch_assoc($result)['product_keywords'];
        $keyword .= $key;
    }
    return $keyword;
}
