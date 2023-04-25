<?php include("./server/server.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập Admin | BK Coffee</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="assets/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="icon" type="image/x-icon" href="assets/images/logo.png">

</head>

<body>

    <div class="main" style="padding-top: 90px;">

        <!-- Sign up form -->

        <!-- Sign in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="./assets/images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="../index.php" class="signup-image-link">Quay về trang chủ</a>


                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">ADMIN LOGIN</h2>
                        <form class="register-form" id="login-form" action="login.php" method="post">
                            <div class="alert alert-danger">
                                <h4 id="e_msg"><?php include('./server/errors.php'); ?></h4>
                            </div>
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="admin_email" id="your_name" placeholder="Admin Email" />
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="your_pass" placeholder="Password" />
                            </div>

                            <div class="form-group form-button">
                                <input type="submit" name="login_admin" id="signin" class="form-submit" value="Log in" />
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>