<?php
include "header.php";
?>


<section class="section">
    <div class="container-fluid">
        <div id="cart_checkout">
            <div class="main ">
                <div class="table-responsive">
                    <form method="post" action="login_form.php">

                        <table id="cart" class="table table-hover table-condensed" id="">
                            <thead>
                                <tr>
                                    <th style="width: 50%">Sản phẩm</th>
                                    <th style="width:15%">Giá</th>
                                    <th style="width:10%">Số lượng</th>
                                    <th style="width:15%" class="text-center hidden-xs">Tạm tính</th>
                                    <th style="width:10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>

                                <tr>
                                    <td><a href="./index.php" class="btn btn-warning"><i class="fa fa-angle-left"></i>
                                            Tiếp tục mua sắm</a></td>
                                    <td colspan="2" class="hidden-xs"></td>
                                    <div id="issessionset"></div>
                                    <td>
                                        <a href="./checkout.php" class="btn btn-success" id="ready-checkout-btn">Sẵn sàng
                                            thanh toán</a>
                                    </td>
                                    <td class="text-center"><b class="net_total"></b></td>
                                </tr>
                            </tfoot>

                        </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include "footer.php";
?>