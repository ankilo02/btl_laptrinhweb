<footer id="footer">
    <!-- top footer -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="footer">
                        <h3 class="footer-title">Về chúng tôi</h3>
                        <p> BK Coffee Store - 101H6 Đại học Bách Khoa cơ sở 2.
                            <br>
                            KHÔNG hỗ trợ đặt mua và nhận hàng trực tiếp tại cửa hàng.
                        </p>
                        <ul class="footer-links">
                            <li><a href="#"><i class="fa fa-map-marker"></i>Trường Đại học Bách Khoa - Đại học Quốc gia Thành phố Hồ Chí Minh (cơ sở 2) - Đông Hoà, Dĩ An, Bình Dương, Việt Nam</a></li>
                            <li><a href="#"><i class="fa fa-phone"></i>1900 9999</a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i>bk@hcmut.edu.vn</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 col-xs-12 text-center" style="margin-top:80px;">
                    <ul class="footer-payments">
                        <iframe width="100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1745.3139387011606!2d106.80620799650355!3d10.880235281351178!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174d914866b51c9%3A0x913146948e01ee20!2zTmjDoCBINiBUcsaw4budbmcgxJHhuqFpIGjhu41jIELDoWNoIEtob2EgVHBIQ00!5e0!3m2!1svi!2s!4v1682423833675!5m2!1svi!2s" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </ul>

                    <span class="copyright">
                        Copyright &copy;2023 All rights reserved
                    </span>
                </div>

                <div class="col-lg-4 hidden-md hidden-sm hidden-xs">
                    <div class="footer">
                        <h3 class="footer-title">Thể loại</h3>
                        <ul class="footer-links">
                            <?php
                            include 'db.php';
                            $result = mysqli_query($con, 'SELECT * FROM categories');
                            foreach ($result as $cat) {
                                $cat_id = $cat['cat_id'];
                                $cat_title = $cat['cat_title'];
                                echo "<li><a href='store?cat=$cat_id'>$cat_title</a></li>";
                            }
                            ?>

                        </ul>

                    </div>
                    <div class="footer">
                        <h3 class="footer-title">Liên hệ </h3>
                        <div class="social">
                            <img src="assets/images/facebook.png" alt="facebook" />
                            <img src="assets/images/twitter.png" alt="twitter" />
                            <img src="assets/images/instagram.png" alt="instagram" />
                            <img src="assets/images/youtube.png" alt="youtube" />
                            <img src="assets/images/telegram.png" alt="telegram" />
                        </div>
                    </div>
                </div>

                <div class="clearfix visible-xs"></div>


            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /top footer -->

    <div id="go-to-top">
        <i class='fa fa-caret-up'></i>
    </div>

</footer>

    <script src="vendor/js/jquery.min.js"></script>
    <script src="vendor/js/bootstrap.min.js"></script>
    <script src="vendor/js/slick.min.js"></script>
    <script src="assets/js/actions.js"></script>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

</body>

</html>