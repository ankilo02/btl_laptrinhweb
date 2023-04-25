<?php
session_start();
include("../../db.php");

include "sidenav.php";
include "topheader.php";
include "activitity.php";

?>
<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
        <div class="col-md-14">
            <div class="card ">
                <div class="card-header card-header-primary">
                    <h4 class="card-title"> Danh sách người dùng</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive ps">
                        <table class="table table-hover tablesorter " id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th>ID</th>
                                    <th>Họ</th>
                                    <th>Tên</th>
                                    <th>Email</th>

                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Thành phố</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = mysqli_query($con, "select * from user_info") or die("query 1 incorrect.....");

                                while (list($user_id, $first_name, $last_name, $email, $password, $phone, $address1, $address2) = mysqli_fetch_array($result)) {
                                    echo "<tr><td>$user_id</td><td>$first_name</td><td>$last_name</td><td>$email</td><td>$phone</td><td>$address1</td><td>$address2</td>

                        </tr>";
                                }
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
        <div class="row">
            <div class="col-md-6">
                <div class="card ">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Cà phê theo loại</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ps">
                            <table class="table table-hover tablesorter " id="">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>ID</th>
                                        <th>Loại</th>
                                        <th>Số lượng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = mysqli_query($con, "select * from categories") or die("query 1 incorrect.....");
                                    $i = 1;
                                    while (list($cat_id, $cat_title) = mysqli_fetch_array($result)) {
                                        $sql = "SELECT COUNT(*) AS count_items FROM products WHERE product_cat=$i";
                                        $query = mysqli_query($con, $sql);
                                        $row = mysqli_fetch_array($query);
                                        $count = $row["count_items"];
                                        $i++;
                                        echo "<tr><td>$cat_id</td><td>$cat_title</td><td>$count</td>

                        </tr>";
                                    }
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
            <div class="col-md-6">
                <div class="card ">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Cà phê theo thương hiệu</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ps">
                            <table class="table table-hover tablesorter " id="">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>ID</th>
                                        <th>Thương hiệu</th>
                                        <th>Số lượng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = mysqli_query($con, "select * from brands") or die("query 1 incorrect.....");
                                    $i = 1;
                                    while (list($brand_id, $brand_title) = mysqli_fetch_array($result)) {

                                        $sql = "SELECT COUNT(*) AS count_items FROM products WHERE product_brand=$i";
                                        $query = mysqli_query($con, $sql);
                                        $row = mysqli_fetch_array($query);
                                        $count = $row["count_items"];
                                        $i++;
                                        echo "<tr><td>$brand_id</td><td>$brand_title</td><td>$count</td>

                        </tr>";
                                    }
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
</div>
<?php
?>