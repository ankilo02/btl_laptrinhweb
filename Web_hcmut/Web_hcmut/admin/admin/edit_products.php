<?php
session_start();
include("../../db.php");

$product_id = htmlspecialchars($_GET['product_id']);
$result = mysqli_query($con, "SELECT * FROM products WHERE product_id='$product_id'");

if (mysqli_num_rows($result) == 0) {
    echo "No product found";
    exit();
} else {
    $product = mysqli_fetch_assoc($result);
}



if (isset($_POST['btn_save'])) {
    $product_name = htmlspecialchars($_POST['product_name']);
    $details = htmlspecialchars($_POST['details']);
    $price = htmlspecialchars($_POST['price']);
    $c_price = htmlspecialchars($_POST['c_price']);
    $product_type = htmlspecialchars($_POST['product_type']);
    $brand = htmlspecialchars($_POST['brand']);
    $tags = htmlspecialchars($_POST['tags']);


    if (is_uploaded_file($_FILES['picture']['tmp_name'])) {
        //picture coding
        $picture_name = $_FILES['picture']['name'];
        $picture_type = $_FILES['picture']['type'];
        $picture_tmp_name = $_FILES['picture']['tmp_name'];
        $picture_size = $_FILES['picture']['size'];

        if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif") {
            if ($picture_size <= 50000000) //50mb

                $pic_name = time() . "_" . $picture_name;
            move_uploaded_file($picture_tmp_name, "../../product_images/" . $pic_name);

            mysqli_query($con, "UPDATE products SET product_cat='$product_type', product_brand ='$brand',product_title = '$product_name',product_price ='$price', product_desc = '$details', product_image= '$pic_name',product_keywords = '$tags' WHERE product_id=$product_id") or die("query incorrect");
        }
    } else {
        mysqli_query($con, "UPDATE products SET product_cat='$product_type', product_brand ='$brand',product_title = '$product_name', product_price ='$price', product_desc = '$details',product_keywords = '$tags' WHERE product_id=$product_id") or die("query incorrect");
    }
    header("location: sumit_form.php?success=1");
    mysqli_close($con);
}
include "sidenav.php";
include "topheader.php";
?>

<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
        <form action="" method="post" type="form" name="form" enctype="multipart/form-data">
            <div class="row">


                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h5 class="title">Chỉnh sửa sản phẩm</h5>
                        </div>
                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tiêu đề sản phẩm</label>
                                        <input type="text" id="product_name" required name="product_name" class="form-control" value=<?= '"' . $product["product_title"] . '"' ?> />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="">
                                        <label for="">Thêm hình ảnh</label>
                                        <input type="file" name="picture" class="btn btn-fill btn-success" id="picture">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea rows="4" cols="80" id="details" required name="details" class="form-control"><?= $product["product_desc"] ?></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Giá</label>
                                        <input type="text" id="price" name="price" required class="form-control" value=<?= $product["product_price"] ?>>
                                    </div>
                                </div>
                            </div>



                        </div>

                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h5 class="title">Thể loại</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Thể loại sản phẩm</label>
                                        <select name="product_type" id="product_type" class="form-control" value="hi">
                                            <?php
                                            $categoryList = mysqli_query($con, "SELECT * FROM categories");
                                            foreach ($categoryList as $cat) {
                                                $id = $cat['cat_id'];
                                                $title = $cat['cat_title'];
                                                if ($product["product_cat"] == $id) {
                                                    echo "<option value='$id' selected>$title</option>";
                                                } else {
                                                    echo "<option value='$id'>$title</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Thương hiệu sản phẩm</label>
                                        <select name="brand" id="brand" class="form-control">
                                            <?php
                                            $brandList = mysqli_query($con, "SELECT * FROM brands");
                                            foreach ($brandList as $brand) {
                                                $id = $brand['brand_id'];
                                                $title = $brand['brand_title'];
                                                if ($product["product_brand"] == $id) {
                                                    echo "<option value='$id' selected>$title</option>";
                                                } else {
                                                    echo "<option value='$id'>$title</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Từ khóa sản phẩm</label>
                                        <input type="text" id="tags" name="tags" required class="form-control" value=<?= '"' . $product["product_keywords"] . '"' ?> />
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" id="btn_save" name="btn_save" required class="btn btn-fill btn-primary">Chỉnh sửa sản phẩm</button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<?php
mysqli_close($con);
?>