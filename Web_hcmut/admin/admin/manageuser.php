<?php
session_start();
include("../../db.php");
if (isset($_GET['action']) && $_GET['action'] != "" && $_GET['action'] == 'delete') {
    $user_id = $_GET['user_id'];

    mysqli_query($con, "DELETE FROM user_info WHERE user_id='$user_id'") or die("query is incorrect...");
}

include "sidenav.php";
include "topheader.php";
?>
<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
        <div class="col-md-14">
            <div class="card ">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Quản lý người dùng</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive ps">
                        <table class="table tablesorter table-hover" id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th>ID</th>
                                    <th>Họ</th>
                                    <th>Tên</th>
                                    <th>Email</th>


                                    <th>Số điện thoại</th>
                                    <th>Thành phố</th>
                                    <th>Địa chỉ</th>
                                    <th><a href="./addsuppliers.php" class="btn btn-success">Thêm mới</a></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = mysqli_query($con, "select user_id,first_name,last_name, email, password,mobile,address1,address2 from user_info") or die("query 2 incorrect.......");

                                while (list($user_id, $user_name, $user_last, $email, $user_password, $mobile, $address1, $address2) =
                                    mysqli_fetch_array($result)
                                ) {
                                    echo "<tr>
                        <td>$user_id</td>
                         <td>$user_name</td>
                          <td>$user_last</td>
                           <td>$email</td>

                        
                         <td>$mobile</td>
                          <td>$address1</td>
                           <td>$address2</td>";
                                    echo "<td>
                        <a class='btn btn-info' href='./edit_users.php?user_id=$user_id'>Chỉnh sửa<div class='ripple-container'></div></a>
                        <a class='btn btn-danger' href='./manageuser.php?user_id=$user_id&action=delete'>Xóa<div class='ripple-container'></div></a>
                        </td></tr>";
                                }
                                mysqli_close($con);
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