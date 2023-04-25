<?php
session_start();
$uid = $_SESSION['uid'];
if (!isset($uid)) {
  echo "
    <script>window.location.href = 'index.php'</script>
  ";
  exit();
}
include "header.php";
include 'db.php';


$sql = "SELECT * FROM user_info WHERE user_id=$uid";
$run_query = mysqli_query($con, $sql);
$result = mysqli_fetch_assoc($run_query);
$first_name = $result['first_name'];
$last_name = $result['last_name'];
$email = $result['email'];
$phone = $result['mobile'];
$address1 = $result['address1'];
$address2 = $result['address2'];

echo "
    <section class='section'>
      <div class='container-fluid'>
        <div class='user-info'>
          <h4>Thông tin cá nhân
            <a href='./editprofile.php'><i class='fa fa-pencil'></i></a>
          </h4>
          <div class='row'>
            <div class='col-lg-3 col-md-6 col-sm-12'>
              <label>Họ và tên: </label>
              <span>$first_name $last_name</span>
            </div>
            <div class='col-lg-3 col-md-6 col-sm-12'>
              <label>Di động: </label>
              <span>$phone</span>
            </div>
            <div class='col-lg-3 col-md-6 col-sm-12'>
              <label>Email: </label>
              <span>$email</span>
            </div>
            <div class='col-lg-3 col-md-6 col-sm-12'>
              <label>Địa chỉ: </label>
              <span>$address1, $address2</span>
            </div>
          </div>
        </div>
";
?>

<div class="user-orders">
  <h4>Đơn hàng gần đây</h4>
  <div class="table-responsive">
    <table class="table table-hover table-condensed">
      <thead>
        <tr>
          <th style="width:10% ;">Ngày mua hàng</th>
          <th style="width:40% ;">Sản phẩm</th>
          <th style="width:10% ;">Giá</th>
          <th style="width:10% ;">Số lượng</th>
          <th style="width:20% ;">Tổng cộng</th>
          <th style="width:10% ;">Trạng thái</th>

        </tr>
      </thead>
      <tbody>

        <?php
        $sql = "SELECT * FROM orders_info WHERE phone='$phone' ORDER BY order_id DESC";
        $result = mysqli_query($con, $sql);
        $prev_order_id = -1;
        foreach ($result as $row) {
          $order_id = $row['order_id'];
          $total = $row['total'];
          $date = $row['date'];
          $status = $row['status'];
          $sql = "SELECT * FROM order_products o, products p
          WHERE order_id=$order_id AND o.product_id=p.product_id";
          $result = mysqli_query($con, $sql);
          $count = mysqli_num_rows($result);

          if ($status == 'Delivering') {
            $status = "Đang vận chuyển";
          } else if ($status == 'Complete') {
            $status = "Thành công";
          } else {
            $status = 'Không thành công';
          }

          foreach ($result as $prod) {
            $image = $prod['product_image'];
            $title = $prod['product_title'];
            $price = $prod['product_price'];
            $quantity = $prod['qty'];
            if ($order_id != $prev_order_id) {
              echo "
                  <tr>
                    <td rowspan='$count'>$date</td>
              ";
            } else {
              echo "
                  <tr>
                  ";
            }

            echo "
                <td >
                  <img src='./product_images/$image' width='40' alt='$title'>
                  $title
                </td>
                <td >
                  $price &#x20AB;
                </td>
                <td>
                    $quantity
                </td>
            ";

            if ($order_id != $prev_order_id) {
              $prev_order_id = $order_id;
              echo "
                    <td rowspan='$count'>$total &#x20AB;</td>
                    <td rowspan='$count'>$status</td>
                  </tr>
              ";
            } else {
              echo "
                  </tr>
                ";
            }
          }
        }
        ?>
        </td>
      </tbody>
    </table>
  </div>
</div>
</div>
</section>

<?php
include 'footer.php';
?>