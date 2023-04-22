<?php
session_start();

if (isset($_SESSION['checkedout']) && $_SESSION['checkedout']) {
    header('Location: index.php');
    exit();
}

include 'header.php';
include "db.php";
$full_name = $_POST['fullname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$cart = $_POST['cart'];
$total = (int)$_POST['total'];
$pay_type = $_POST['pay-type'];
$cart = json_decode($cart);
$date = date('d/m/Y, H:i');

if (isset($full_name) && isset($email) && isset($phone) && isset($address)  && isset($cart) && isset($total)) {
    $sql = "INSERT INTO orders_info(f_name, email, address, phone, total, date, status) 
            VALUES('$full_name', '$email', '$address', '$phone', $total, '$date', 'Delivering')";
    mysqli_query($con, $sql);

    $order_id = mysqli_insert_id($con);
    $sql = "INSERT INTO order_products(order_id, product_id, qty) 
            VALUES ";
    foreach ($cart as $index => $item) {
        $id = $item->id;
        $quantity = $item->quantity;
        if ($index < count($cart) - 1) {
            $sql .= "($order_id, $id, $quantity),";
        } else {
            $sql .= "($order_id, $id, $quantity)";
        }
    }
    mysqli_query($con, $sql);
    echo '<div style="height: 500px; padding: 20px; font-size: 20px">Đặt hàng thành công, <a href="index.php"> Trở về trang chủ</a></div>';
    $_SESSION['checkedout'] = true;
    echo "
        <script>
            localStorage.removeItem('cart');
        </script>
    ";
} else {
    echo '<div>Có sự cố xảy ra trong quá trình đặt hàng, <a href="./checkout.php">Vui lòng kiểm tra lại</a></div>';
}

mysqli_close($con);
include 'footer.php';
