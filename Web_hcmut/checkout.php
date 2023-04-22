<?php
include "header.php";
include "db.php";

?>

<style>
    .row-checkout {
        display: -ms-flexbox;
        /* IE10 */
        display: flex;
        -ms-flex-wrap: wrap;
        /* IE10 */
        flex-wrap: wrap;
        margin: 0 -16px;
    }

    .col-25 {
        -ms-flex: 25%;
        /* IE10 */
        flex: 25%;
    }

    .col-50 {
        -ms-flex: 50%;
        /* IE10 */
        flex: 50%;
    }

    .col-75 {
        -ms-flex: 75%;
        /* IE10 */
        flex: 75%;
    }

    .col-25,
    .col-50,
    .col-75 {
        padding: 0 16px;
    }

    .container-checkout {
        background-color: #f2f2f2;
        padding: 5px 20px 15px 20px;
        border: 1px solid lightgrey;
        border-radius: 3px;
    }

    input[type=text],
    input[type=number] {
        width: 100%;
        margin-bottom: 20px;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    label {
        margin-bottom: 10px;
        display: block;
    }

    .icon-container {
        margin-bottom: 20px;
        padding: 7px 0;
        font-size: 24px;
    }

    .checkout-btn {
        background-color: #4CAF50;
        color: white;
        padding: 12px;
        margin: 10px 0;
        border: none;
        width: 100%;
        border-radius: 3px;
        cursor: pointer;
        font-size: 17px;
    }

    .checkout-btn:hover {
        background-color: #45a049;
    }



    hr {
        border: 1px solid lightgrey;
    }

    span.price {
        float: right;
        color: grey;
    }

    /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
    @media (max-width: 800px) {
        .row-checkout {
            flex-direction: column-reverse;
        }

        .col-25 {
            margin-bottom: 20px;
        }
    }
</style>


<section class="section">
    <div class="container-fluid">
        <div class="row-checkout">

            <div class="col-75">
                <div class="container-checkout">
                    <form id="checkout_form" action="checkout_process.php" method="POST" class="was-validated">

                        <div class="row-checkout">

                            <?php
                            if (isset($_SESSION['uid'])) {
                                $user_id = $_SESSION['uid'];
                                $sql = "SELECT * FROM user_info WHERE user_id=$user_id";
                                $result = mysqli_query($con, $sql);
                                $result = mysqli_fetch_assoc($result);
                                $full_name = $result['first_name'] . ' ' . $result['last_name'];
                                $email = $result['email'];
                                $phone = $result['mobile'];
                                $address = $result['address1'] . ", " . $result['address2'];

                                echo "
										<div class='col-50'>
											<h3>Billing Address</h3>
											<label for='fname'><i class='fa fa-user'></i> Full Name</label>
											<input type='text' id='fname' class='form-control' 
											name='fullname' required
											value='$full_name'>
											<label for='email'><i class='fa fa-envelope'></i> Email</label>
											<input type='text' id='email' name='email' class='form-control' 
											pattern='^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$' required
											value='$email'>
											<label for='phone'><i class='fa fa-phone'></i> Phone</label>
											<input type='number' id='phone' class='form-control' name='phone' required
											value='$phone'>
											<label for='adr'><i class='fa fa-address-card-o'></i> Address</label>
											<input type='text' id='adr' name='address' class='form-control' required
											value='$address'>

											<label>Phương thức thanh toán:
												<select name='pay-type' id='pay-type' class='form-control'>
													<option value='1'>Thanh toán khi nhận hàng</option>
													<option value='2'>Thanh toán bằng thẻ</option>
												</select>
											</label>
										</div>
									";
                            } else {
                                echo '
										<div class="col-50">
											<h3>Địa chỉ nhận hàng</h3>
											<label for="fname"><i class="fa fa-user"></i> Tên đầy đủ</label>
											<input type="text" id="fname" class="form-control" name="fullname" required>
											<label for="email"><i class="fa fa-envelope"></i> Email</label>
											<input type="text" id="email" name="email" class="form-control" pattern="^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$" required>
											<label for="phone"><i class="fa fa-phone"></i> Số điện thoại</label>
											<input type="number" id="phone" class="form-control" name="phone" required>
											<label for="adr"><i class="fa fa-address-card-o"></i> Địa chỉ</label>
											<input type="text" id="adr" name="address" class="form-control" required>

											<label>Phương thức thanh toán:
												<select name="pay-type" id="pay-type" class="form-control">
													<option value="1">Thanh toán khi nhận hàng</option>
													<option value="2">Thanh toán bằng thẻ</option>
												</select>
											</label>
										</div>
									';
                            }
                            ?>


                            <div class="col-50" id="pay-by-card">

                            </div>
                        </div>

                        <input type="hidden" name="cart" id="cart-submit">
                        <input type="hidden" name="total" id="total-submit">

                        <input type="submit" id="submit" value="Xác nhận đặt hàng" class="btn checkout-btn">
                    </form>
                </div>
            </div>

            <div class="col-25">
                <div class="container-checkout">
                    <h4>Cart
                        <span class='price' style='color:black'>
                            <i class='fa fa-shopping-cart'></i>
                        </span>
                    </h4>

                    <table class='table table-condensed'>
                        <thead>
                            <tr>
                                <th>Thứ tự</th>
                                <th>Tên sản phẩm</th>
                                <th> Giá </th>
                                <th> Số lượng</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <hr>

                    <h3>Total
                        <span id="checkout-total" class='price' style='color:black'>
                            <b></b>
                            &#x20AB;
                        </span>
                    </h3>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include "footer.php";
?>