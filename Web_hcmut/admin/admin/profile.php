<?php
session_start();
include("../../db.php");


if (isset($_POST['re_password'])) {
    $email = $_SESSION['admin_email'];
    $old_pass = htmlspecialchars($_POST['old_pass']);
    $new_pass = htmlspecialchars($_POST['new_pass']);
    $re_pass = htmlspecialchars($_POST['re_pass']);
    $password_query = mysqli_query($con, "SELECT admin_password FROM admin_info WHERE admin_email='$email'");

    $password_row = mysqli_fetch_assoc($password_query);
    $database_password = $password_row['admin_password'];

    if (password_verify($old_pass, $database_password)) {
        if ($new_pass == $re_pass) {
            $password = password_hash($new_pass, PASSWORD_DEFAULT);
            $update_password = mysqli_query($con, "UPDATE admin_info SET admin_password='$password' WHERE admin_email='$email'");
            echo "<script>alert('Update Successfully'); </script>";
        } else {
            echo "<script>alert('Your new and Retype Password is not match'); </script>";
        }
    } else {
        echo "<script>alert('Your old password is wrong'); </script>";
    }
}

include "sidenav.php";
include "topheader.php";

?>
<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Chỉnh sửa thông tin cá nhân</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="profile.php">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">
                                            <?php if (isset($_SESSION['admin_name'])) : ?><?php echo $_SESSION['admin_name']; ?>
                                        <?php endif ?>

                                        </label>
                                        <input type="text" class="form-control" disabled="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" class="form-control" name="old_pass" id="npwd" placeholder="Nhập mật khẩu cũ">
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" class="form-control" name="new_pass" id="npwd" placeholder="Thay đổi mật khẩu">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" class="form-control" name="re_pass" id="npwd" placeholder="Xác nhận lại mật khẩu">
                                    </div>
                                </div>

                                <button class="btn btn-primary pull-right" type="submit" name="re_password">Chỉnh sửa
                                    thông tin</button>

                                <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>