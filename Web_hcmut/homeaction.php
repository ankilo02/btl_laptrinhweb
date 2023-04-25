<?php
session_start();
include "db.php";
include 'ultils.php';

if (isset($_POST["categoryhome"])) {
	$category_query = "SELECT * FROM categories";

	$run_query = mysqli_query($con, $category_query) or die(mysqli_error($con));
	echo "
				<!-- responsive-nav -->
				<div id='responsive-nav'>
					<!-- NAV -->
					<ul class='main-nav nav navbar-nav'>
                    <li id='home'><a href='./index.php'>Trang chủ</a></li>
	";
	if (mysqli_num_rows($run_query) > 0) {
		while ($row = mysqli_fetch_array($run_query)) {
			$cid = $row["cat_id"];
			$cat_name = $row["cat_title"];

			$sql = "SELECT COUNT(*) AS count_items FROM products,categories WHERE product_cat=cat_id";
			$query = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($query);
			$count = $row["count_items"];

			echo "
               <li class='categoryhome' id='cat-$cid'><a href='./store.php?cat=$cid'>$cat_name</a></li>
			";
		}

		echo "</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
               
			";
	}
}


if (isset($_POST["page"])) {

	$sql = "SELECT * FROM products WHERE 1=1";
	if (isset($_POST['keyword'])) {
		$key = $_POST['keyword'];
		$sql .= " AND product_title LIKE '%$key%'";
	}
	if (isset($_POST['cat_id'])) {
		$cat_id = $_POST['cat_id'];
		$sql .= " AND product_cat=$cat_id";
	}
	if (isset($_POST['brandId'])) {
		$brandId = $_POST['brandId'];
		$sql .= " AND product_brand=$brandId";
	}

	$run_query = mysqli_query($con, $sql);
	$count = mysqli_num_rows($run_query);
	$pageno = ceil($count / 9);
	for ($i = 1; $i <= $pageno; $i++) {
		echo "
			<li data-page='$i' id='page'>$i</li>
		";
	}
}

if (isset($_POST["brand"])) {
	$brand_query = "SELECT * FROM brands";
	$run_query = mysqli_query($con, $brand_query);
	echo "
		<div class='aside'>
			<h3 class='aside-title'>Nhà xuất bản</h3>
			<div class='btn-group-vertical'>
	";
	if (mysqli_num_rows($run_query) > 0) {
		$i = 1;
		while ($row = mysqli_fetch_array($run_query)) {

			$bid = $row["brand_id"];
			$brand_name = $row["brand_title"];
			$i++;
			echo "
                    <div class='btn navbar-btn selectBrand' bid='$bid'>
							$brand_name
					</div>
			";
		}
		echo "</div>";
	}
}


if (isset($_POST["get_seleted_Category"]) ||  isset($_POST["search"]) || isset($_POST['get_seleted_brand'])) {
	if (isset($_POST['pageNo'])) {
		$limit = 9;
		$start = ($_POST['pageNo'] * $limit) - $limit;
	} else {
		$start = 0;
		$limit = 10000;
	}

	$sql = "SELECT * FROM products,categories 
		WHERE cat_id=product_cat";

	if (isset($_POST["get_seleted_Category"])) {
		$catId = $_POST["cat_id"];
		$sql .= " AND product_cat =$catId";
	}
	if (isset($_POST['get_seleted_brand'])) {
		$brandId = $_POST['brandId'];
		$sql .= " AND product_brand=$brandId";
	}
	if (isset($_POST['keyword'])) {
		$keyword = $_POST["keyword"];
		$sql .= " AND product_keywords LIKE '%$keyword%'";
	}

	if (isset($_POST['sort_opt'])) {
		$sort_opt = $_POST['sort_opt'];
		switch ($sort_opt) {
			case '1':
				$sql .= " ORDER BY product_id DESC";
				break;
			case '2':
				$sql .= " ORDER BY product_price ASC";
				break;
			case '3':
				$sql .= " ORDER BY product_price DESC";
				break;
			default:
				$sql .= " ORDER BY product_id DESC";
				break;
		}
	}

	$sql .= " LIMIT $start,$limit";

	$run_query = mysqli_query($con, $sql);
	if (mysqli_num_rows($run_query) == 0) {
		echo "<div>Không có sản phẩm nào. Vui lòng thử với lựa chọn khác!</div>";
		exit();
	}

	while ($row = mysqli_fetch_array($run_query)) {
		$pro_id    = $row['product_id'];
		$pro_cat   = $row['product_cat'];
		$pro_brand = $row['product_brand'];
		$pro_title = $row['product_title'];
		$pro_price = $row['product_price'];
		$pro_image = $row['product_image'];
		$cat_name = $row["cat_title"];
		$rating = $row['product_rating'];

		echo "
			<div class='col-md-4 col-xs-6'>
					<a href='./product.php?p=$pro_id'><div class='product'>
						<div class='product-img'>
							<img  src='product_images/$pro_image' style='max-height: 170px;' alt=''>
						</div></a>
						<div class='product-body'>
							<p class='product-category'>$cat_name</p>
							<h3 class='product-name header-cart-item-name'><a href='./product.php?p=$pro_id'>$pro_title</a></h3>
							<h4 class='product-price header-cart-item-info'>$pro_price&#x20AB;</h4>
							<div class='product-rating'>
							";
		displayStar($rating);
		echo "
							</div>
						</div>
						<div class='add-to-cart'>
							<button 
								id='product' 
								class='add-to-cart-btn'
								data-id='$pro_id' 
								data-title='$pro_title' 
								data-price='$pro_price' 
								data-image='$pro_image' 
								><i class='fa fa-shopping-cart'></i> Thêm vào giỏ hàng
							</button>
						</div>
					</div>
			</div>
			";
	}
}


if (isset($_POST["checkOutDetails"])) {
	$sql = "SELECT * FROM cart, products WHERE user_id=1 AND p_id=product_id";
	$run_query = mysqli_query($con, $sql);

	if (mysqli_num_rows($run_query) > 0) {
		//display user cart item with "Ready to checkout" button if user is not login
		$n = 0;
		while ($row = mysqli_fetch_array($run_query)) {
			$n++;
			$product_id = $row["product_id"];
			$product_title = $row["product_title"];
			$product_price = $row["product_price"];
			$product_image = $row["product_image"];
			$cart_item_id = $row["id"];
			$qty = $row["qty"];

			echo
			'
                             
						<tr>
							<td data-th="Product" >
								<div class="row">
								
									<div class="col-sm-4 "><img src="product_images/' . $product_image . '" style="height: 70px;width:75px;"/>
									<h4 class="nomargin product-name header-cart-item-name"><a href="./product.php?p=' . $product_id . '">' . $product_title . '</a></h4>
									</div>
									<div class="col-sm-6">
										<div style="max-width=50px;">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
										</div>
									</div>
									
									
								</div>
							</td>
                            <input type="hidden" name="product_id[]" value="' . $product_id . '"/>
				            <input type="hidden" name="" value="' . $cart_item_id . '"/>
							<td data-th="Price"><input type="text" class="form-control price" value="' . $product_price . '" readonly="readonly"></td>
							<td data-th="Quantity">
								<input type="text" class="form-control qty" value="' . $qty . '" >
							</td>
							<td data-th="Subtotal" class="text-center"><input type="text" class="form-control total" value="' . $product_price . '" readonly="readonly"></td>
							<td class="actions" data-th="">
							<div class="btn-group">
								<a href="#" class="btn btn-info btn-sm update" update_id="' . $product_id . '"><i class="fa fa-refresh"></i></a>
								
								<a href="#" class="btn btn-danger btn-sm remove" remove_id="' . $product_id . '"><i class="fa fa-trash-o"></i></a>		
							</div>							
							</td>
						</tr>
					
                            
                            ';
		}
	}
}
