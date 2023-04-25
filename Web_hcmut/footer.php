<footer  id="footer">
    <!-- top footer -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="footer">
                        <img src="img/cafe.png" width=323px height=383px></img>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 col-xs-12 text-left" style="margin-top:0px;">
                    <div class="footer">
                    <h3 class="footer-title">Các loại đồ uống</h3>
                        <ul class="footer-links">
                            <?php
                            include 'db.php';
                            $result = mysqli_query($con, 'SELECT * FROM categories');
                            foreach ($result as $cat) {
                                $cat_id = $cat['cat_id'];
                                $cat_title = $cat['cat_title'];
                                echo "<li><a href='store.php?cat=$cat_id'>$cat_title</a></li>";
                            }
                            ?>
                        </ul>
                        </div>
                </div>

                <div class="col-lg-4 hidden-md hidden-sm hidden-xs">
                    <div class="footer">
                        <h3 class="footer-title">Về chúng tôi</h3>
                        <p class="linkss"> Công Ty Cổ Phần - BK Coffee -15-17 Tôn Đức Thắng, Quận 1
                            , TP. HCM, Việt Nam, nhận đặt hàng trực tuyến và giao hàng tận
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
                    <div class="footer">
                        <h3 class="footer-title">Liên hệ </h3>
                        <div class="social">
                            <a href="#"><img src="assets/images/facebook.png" alt="facebook" /></a>
                            <a href="#"><img src="assets/images/twitter.png" alt="twitter" /></a>
                            <a href="#"><img src="assets/images/instagram.png" alt="instagram" /></a>
                            <a href="#"><img src="assets/images/youtube.png" alt="youtube" /></a>
                            <a href="#"><img src="assets/images/telegram.png" alt="telegram" /></a>
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