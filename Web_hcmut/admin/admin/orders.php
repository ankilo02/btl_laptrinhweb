<?php
session_start();
include("../../db.php");

error_reporting(0);
if (isset($_GET['action']) && $_GET['action'] != "" && $_GET['action'] == 'delete') {
  $order_id = $_GET['order_id'];

  /*this is delet query*/
  mysqli_query($con, "delete from orders where order_id='$order_id'") or die("delete query is incorrect...");
}

///pagination
$page = $_GET['page'];

if ($page == "" || $page == "1") {
  $page1 = 0;
} else {
  $page1 = ($page * 10) - 10;
}

include "sidenav.php";
include "topheader.php";

?>
<!-- End Navbar -->
<div class="content">
  <div class="container-fluid">
    <!-- your content here -->
    <div class="col-md-14">
      <div class="card ">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Đơn hàng <?php echo $page; ?> </h4>
        </div>
        <div class="card-body">
          <div class="table-responsive ps">
            <table class="table table-hover tablesorter " id="">
              <thead class=" text-primary">
                <tr>
                  <th>Tên khách hàng</th>
                  <th>Sản phẩm</th>
                  <th>Số lượng</th>
                  <th>Ngày mua hàng</th>
                  <th>Số điện thoại | Email</th>
                  <th>Địa chỉ</th>
                  <th>Giá</th>
                  <th>Trạng thái</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $result = mysqli_query($con, "SELECT op.order_id,qty,f_name,product_title,
                email,address,total,status,date 
                FROM order_products AS op 
                LEFT JOIN orders_info AS oi ON op.order_id=oi.order_id 
                INNER JOIN products AS p ON p.product_id = op.product_id 
                ORDER BY order_id DESC LIMIT $page1,10") or die("query 1 incorrect.....");
                $prev_order_id = -1;
                while ($row = mysqli_fetch_assoc($result)) {
                  $order_id = $row['order_id'];
                  $count = mysqli_num_rows(mysqli_query($con, "SELECT order_id 
                  FROM order_products WHERE order_id=$order_id"));
                  if ($order_id != $prev_order_id) {
                    echo "
                        <tr>
                          <td rowspan='$count'>$row[f_name]</td>
                    ";
                  } else {
                    echo "
                        <tr>
                    ";
                  }
                  echo "
                      <td>$row[product_title]</td>
                      <td>$row[qty]</td>
                    ";

                  if ($order_id != $prev_order_id) {
                    $prev_order_id = $order_id;
                    echo "
                        <td rowspan='$count'>$row[date]</td>
                        <td rowspan='$count'>$row[email]</td>
                        <td rowspan='$count'>$row[address]</td>
                        <td rowspan='$count'>$row[total]</td>
                      ";
                    if ($row["status"] == 'Delivering') {
                      echo "<td rowspan='$count' class='text-secondary'>$row[status]</td>";
                    } else if ($row["status"] == 'Cancelled') {
                      echo "<td rowspan='$count' class='text-danger'>$row[status]</td>";
                    } else {
                      echo "<td rowspan='$count' class='text-success'>$row[status]</td>";
                    }

                    if ($row["status"] == 'Delivering') {
                      echo "
                          <td rowspan='$count'>
                                <a class='btn btn-sm btn-danger' href='./edit_orders.php?order_id=$row[order_id]&action=cancel'>Hủy</a>
                                <a class='btn btn-sm btn-success' href='./edit_orders.php?order_id=$row[order_id]&action=complete'>Hoàn thành</a>
                          </td>
                              ";
                    }
                  }
                }
                echo "</tr>";
                ?>
              </tbody>
            </table>

            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
              <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
            </div>
            <div class="ps__rail-y" style="top: 0px; right: 0px;">
              <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>