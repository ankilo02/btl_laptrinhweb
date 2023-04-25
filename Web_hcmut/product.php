<?php
include "header.php";
?>

<!-- SECTION -->
<div class="section main main-raised">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- Product main img -->

			<?php
			include 'db.php';
			$product_id = $_GET['p'];

			$sql = "SELECT * FROM products WHERE product_id = $product_id";
			if (!$con) {
				die("Connection failed: " . mysqli_connect_error());
			}
			$result = mysqli_query($con, $sql);
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					$img = $row['product_image'];
					echo "
						<div class='col-lg-4 col-md-6 col-xs-12'>
						<img src='product_images/$img' width='100%' alt=''>
					</div>
					"

			?>


			<?php
					include 'db.php';

					$sql_review = "SELECT COUNT(*) FROM review WHERE product_id=$product_id";
					$result_review = mysqli_query($con, $sql_review);
					$review_num = mysqli_fetch_assoc($result_review)['COUNT(*)'];

					$sql_review = "SELECT AVG(star) FROM review WHERE product_id=$product_id";
					$result_review = mysqli_query($con, $sql_review);
					$avg_star = mysqli_fetch_assoc($result_review)['AVG(star)'];
					if(isset($avg_star)){
						$sql = "UPDATE products SET product_rating=$avg_star WHERE product_id=$product_id";

						$result_update = mysqli_query($con, $sql);
					}
					

					$sql_review = "SELECT * FROM review r, user_info u WHERE product_id=$product_id AND r.user_id=u.user_id ";
					$result_review = mysqli_query($con, $sql_review);

					$star_array = array(0, 0, 0, 0, 0);
					if (mysqli_num_rows($result_review) > 0) {
						while ($row_review = mysqli_fetch_assoc($result_review)) {
							switch ($row_review['star']) {
								case 1:
									$star_array[0]++;
									break;
								case 2:
									$star_array[1]++;
									break;
								case 3:
									$star_array[2]++;
									break;
								case 4:
									$star_array[3]++;
									break;
								case 5:
									$star_array[4]++;
									break;
							}
						}
					}


					echo '       
                    <div class="col-lg-8 col-md-6 col-xs-12">
						<div class="product-details">
							<h2 class="product-name">' . $row['product_title'] . '</h2>
							<div>
								<div class="product-rating">';
					displayStar($avg_star);
					echo ' ' . number_format($avg_star, 2, '.', '') . '
								</div>
								<a class="review-link" href="#product-tab">' . $review_num . ' Đánh giá | Thêm đánh giá của bạn</a>
							</div>
							<div>
								<h3 class="product-price">' . $row['product_price'] . '&#x20AB;</h3>
							</div>

							
							<div class="add-to-cart">
								<div class="btn-group">
								<button 
									class="add-to-cart-btn" 
									id="product" 
									data-id="' . $row['product_id'] . '"
									data-title="' . $row['product_title'] . '"
									data-image="' . $row['product_image'] . '"
									data-price="' . $row['product_price'] . '"
									><i class="fa fa-shopping-cart"></i> Thêm vào giỏ</button>
                                </div>
							</div>

						</div>
					
									

					
						<div id="product-tab">
							<!-- product tab nav -->
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Mô tả</a></li>
								<li><a data-toggle="tab" href="#tab3">Đánh giá (' . $review_num . ')</a></li>
							</ul>
							<!-- /product tab nav -->

							<!-- product tab content -->
							<div class="tab-content">
								<!-- tab1  -->
								<div id="tab1" class="tab-pane fade in active">
									<div class="row">
										<div class="col-md-12">
											<p>' . $row['product_desc'] . '
										</div>
									</div>
								</div>
								<!-- /tab1  -->

								<!-- tab3  -->
								<div id="tab3" class="tab-pane fade in">
									<div class="row">
										<!-- Rating -->
										<div class="col-md-3">
											<div id="rating">
												<div class="rating-avg">
													<span>' . number_format($avg_star, 2, '.', '') . '</span>
													<div class="rating-stars">';
					displayStar($avg_star);
					echo '
													</div>
												</div>
												<ul class="rating">';

					for ($i = 4; $i >= 0; $i--) {
						if ($review_num == 0) {
							$progress = 0;
						} else {
							$progress = (int)($star_array[$i] / $review_num * 100);
						}

						echo '
													<li>
														<div class="rating-stars">';
						displayStar($i + 1);
						echo '
														</div>
													<div class="rating-progress">
													<div style="width: ' . $progress .  '%;"></div>
												</div>
												<span class="sum">' . $star_array[$i] . '</span>
											</li>';
					}

					echo '
												</ul>
											</div>
										</div>
										<!-- /Rating -->

										<!-- Reviews -->
										<div class="col-md-6">
											<div id="reviews">
												<ul class="reviews">';


					foreach ($result_review as $row_review) {
						echo '
							<li>
							<div class="review-heading">
								<h5 class="name">' . $row_review['last_name'] . '</h5>
								<div class="review-rating">';
						displayStar($row_review['star']);
						echo '
								</div>
							</div>
							<div class="review-body">
								<p>' . $row_review['comment'] . '</p>
							</div>
						</li>';
					}

					function postReview()
					{
						global $con, $product_id;
						$user = $_SESSION['uid'];
						$star = $_POST['star'];
						$comment = $_POST['comment'];

						if (!isset($user)) {
							echo "
								<script>
									alert('Vui lòng đăng nhập để đánh giá sản phẩm')
								</script>
							";
							return;
						}

						$sql = "INSERT INTO `review` (`product_id`, `user_id`, `star`, `comment`)
							VALUES ('$product_id', '$user', '$star', '$comment');";
						$result = mysqli_query($con, $sql);
						unset($_POST['submit']);
						echo ("<meta http-equiv='refresh' content='0'>");
					}
					echo '
												</ul>
											</div>
										</div>
										<!-- /Reviews -->

										<!-- Review Form -->
										<div class="col-md-3 review-container">
											<div id="review-form">
												<form class="review-form" action="" method="post">
													<div><label>Đánh giá của bạn</label></div>
													<textarea class="input form-control" placeholder="Nhận xét" name="comment"></textarea>
													<div class="input-rating">
														<span>Điểm số: </span>
														<div class="stars">
															<input id="star5" name="star" value="5" type="radio"><label for="star5"></label>
															<input id="star4" name="star" value="4" type="radio"><label for="star4"></label>
															<input id="star3" name="star" value="3" type="radio"><label for="star3"></label>
															<input id="star2" name="star" value="2" type="radio"><label for="star2"></label>
															<input id="star1" name="star" value="1" type="radio"><label for="star1"></label>
														</div>
													</div>
													<input class="btn btn-success" type="submit" name="submit" id="submit" value="Gửi">
												</form>';
					if (array_key_exists('submit', $_POST)) {
						postReview();
					}
					echo '
											</div>
										</div>
										<!-- /Review Form -->
									</div>
								</div>
								<!-- /tab3  -->
							</div>
							<!-- /product tab content  -->
						</div>
					
					<!-- /product tab -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		</div>
		<!-- /SECTION -->

		<!-- Section -->
		<div class="section main main-raised">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
                    
					<div class="col-md-12">
						<div class="section-title text-center">
							<h3 class="title">Sản phẩm liên quan</h3>
							
						</div>
					</div>
                    ';
					$_SESSION['product_id'] = $row['product_id'];
				}
			}
			?>

			<?php
			include 'db.php';
			$product_id = $_GET['p'];

			$product_query = "SELECT * FROM products,categories WHERE product_cat=cat_id AND product_id BETWEEN $product_id AND $product_id+3";
			$run_query = mysqli_query($con, $product_query);
			if (mysqli_num_rows($run_query) > 0) {
				while ($row = mysqli_fetch_array($run_query)) {
					$pro_id    = $row['product_id'];
					$pro_cat   = $row['product_cat'];
					$pro_brand = $row['product_brand'];
					$pro_title = $row['product_title'];
					$pro_price = $row['product_price'];
					$pro_image = $row['product_image'];
					$pro_rating = $row['product_rating'];

					$cat_name = $row["cat_title"];

					echo "
				
                        
                                <div class='col-md-3 col-xs-6'>
								<a href='./product.php?p=$pro_id'><div class='product'>
									<div class='product-img'>
										<img src='product_images/$pro_image' style='max-height: 170px;' alt=''>
									</div></a>
									<div class='product-body'>
										<p class='product-category'>$cat_name</p>
										<h3 class='product-name header-cart-item-name'><a href='./product.php?p=$pro_id'>$pro_title</a></h3>
										<h4 class='product-price header-cart-item-info'>$pro_price &#x20AB;</h4>
										<div class='product-rating'>";
					displayStar($pro_rating);
					echo "
										</div>
									</div>
									<div class='add-to-cart'>
										<button 
											id='product' 
											class='add-to-cart-btn block2-btn-towishlist' 
											data-id='$pro_id' 
											data-title='$pro_title' 
											data-price='$pro_price' 
											data-image='$pro_image' 
										><i class='fa fa-shopping-cart'></i> Thêm vào giỏ hàng</button>
									</div>
								</div>
                                </div>
							
                        
			";
				};
			}
			?>
			<!-- product -->

			<!-- /product -->

		</div>
		<!-- /row -->

	</div>
	<!-- /container -->
</div>
<!-- /Section -->

<!-- NEWSLETTER -->

<!-- /NEWSLETTER -->

<!-- FOOTER -->
<?php
include "footer.php";

?>