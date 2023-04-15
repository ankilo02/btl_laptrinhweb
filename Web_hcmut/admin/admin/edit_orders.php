<?php
include("../../db.php");

$order_id = $_GET['order_id'];
$action = $_GET['action'];

if (!empty($order_id) &&  !empty($action)) {
    if ($action == 'complete') {
        $query = "UPDATE orders_info SET status = 'Complete' WHERE order_id = '$order_id'";
        $result = mysqli_query($con, $query);
        if ($result) {
            echo "<script>alert('Đặt hàng đã hoàn tất thành công')</script>";
        }
        header("Location: ./orders.php");
    } else if ($action == 'cancel') {
        $query = "UPDATE orders_info SET status = 'Cancelled' WHERE order_id = '$order_id'";
        $result = mysqli_query($con, $query);
        if ($result) {
            echo "<script>alert('Xác nhận đơn hàng thành công')</script>";
        }
        header("Location: ./orders.php");
    }
}
