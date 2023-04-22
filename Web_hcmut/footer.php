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
                        <p> Công Ty Cổ Phần Phát Hành Sách TP HCM - BK BOOKSTORE -
                            15-17 Tôn Đức Thắng, Quận 1, TP. HCM, Việt Nam, nhận đặt hàng trực tuyến và giao hàng tận
                            nơi.
                            <br>
                            KHÔNG hỗ trợ đặt mua và nhận hàng trực tiếp tại văn phòng cũng như tất cả Hệ Thống trên toàn
                            quốc.
                        </p>
                        <ul class="footer-links">
                            <li><a href="#"><i class="fa fa-map-marker"></i>15-17 Tôn Đức Thắng, Q.1, TP. HCM</a></li>
                            <li><a href="#"><i class="fa fa-phone"></i>+84-0123456789</a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i>bk@hcmut.edu.vn</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 col-xs-12 text-center" style="margin-top:80px;">
                    <ul class="footer-payments">
                        <iframe width="100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.4815584805283!2d106.70413911477142!3d10.774381392322878!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f4427cc6a63%3A0xb685b00c0b210443!2zMTUgxJAuIFTDtG4gxJDhu6ljIFRo4bqvbmcsIELhur9uIE5naMOpLCBRdeG6rW4gMSwgVGjDoG5oIHBo4buRIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1670330626941!5m2!1svi!2s" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </ul>

                    <span class="copyright">
                        Copyright &copy;2022 All rights reserved
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