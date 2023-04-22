<?php
session_start();
include("../../db.php");
$user_id = $_REQUEST['user_id'];

$current_user_query = mysqli_query($con, "SELECT * FROM user_info WHERE user_id='$user_id'") or die(mysqli_error($con));
$current_user = mysqli_fetch_assoc($current_user_query);

if (isset($_POST['btn_save'])) {
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars($_POST['phone']);
    $addr = htmlspecialchars($_POST['addr']);
    $city = htmlspecialchars($_POST['city']);



    if (
        !empty($first_name) && !empty($last_name) && !empty($email)
        && !empty($phone) && !empty($addr) && !empty($city)
    ) {
        mysqli_query($con, "UPDATE user_info 
    SET first_name='$first_name', last_name='$last_name', email='$email', 
    mobile='$phone', address1='$addr', address2='$city'
    WHERE user_id='$user_id'") or die("Query 2 is incorrect.........." . mysqli_error($con));
        header("Location: manageuser.php");
    } else {
        echo "<script>alert('Please fill all the fields')</script>";
    }
    mysqli_close($con);
}
include "sidenav.php";
include "topheader.php";
?>
<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
        <div class="col-lg-10 col-md-10 mx-auto">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h5 class="title">Chỉnh sửa thông tin người dùng</h5>
                </div>
                <form action="edit_users.php" name="form" method="post" enctype="multipart/form-data">
                    <div class="card-body row">

                        <input type="hidden" name="user_id" id="user_id" value="<?= $current_user["user_id"] ?>" />
                        <div class="col-lg-6 col-md-6 col-sx-12 ">
                            <div class="form-group">
                                <label>Họ</label>
                                <input type="text" id="first_name" name="first_name" class="form-control" value="<?= $current_user["first_name"] ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sx-12 ">
                            <div class="form-group">
                                <label>Tên</label>
                                <input type="text" id="last_name" name="last_name" class="form-control" value="<?= $current_user["last_name"] ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sx-12 ">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="<?= $current_user["email"] ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sx-12 ">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số điện thoại</label>
                                <input type="phone" id="phone" name="phone" class="form-control" value="<?= $current_user["mobile"] ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sx-12 ">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Địa chỉ</label>
                                <input type="addr" id="addr" name="addr" class="form-control" value="<?= $current_user["address1"] ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sx-12 ">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tỉnh(thành phố)</label>
                                <input type="city" id="city" name="city" class="form-control" value="<?= $current_user["address2"] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" id="btn_save" name="btn_save" class="btn btn-fill btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>