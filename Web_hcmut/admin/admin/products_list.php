<?php
session_start();
include("../../db.php");
error_reporting(0);
if (isset($_GET['action']) && $_GET['action'] != "" && $_GET['action'] == 'delete') {
    $product_id = $_GET['product_id'];

    $result = mysqli_query($con, "SELECT product_image FROM products WHERE product_id='$product_id'")
        or die("query is incorrect...");

    list($picture) = mysqli_fetch_array($result);
    $path = "../../product_images/$picture";

    if (file_exists($path) == true) {
        unlink($path);
    }
    /*this is delete query*/
    mysqli_query($con, "DELETE FROM products WHERE product_id='$product_id'") or die("query is incorrect...");
}

///pagination

$page = $_GET['page'];

if ($page == "" || $page == "1") {
    $page1 = 0;
} else {
    $page1 = ($page * 10) - 10;
}
include "sidenav.php";
include "topheader.php";
?>
<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
        <div class="panel-body">

            <?php  //success message

            if (isset($_POST['success'])) {
                $success = $_POST["success"];
                echo "<div class='col-md-12 col-xs-12' id='product_msg'>
                        <div class='alert alert-success'>
                            <b>Thêm sản phẩm thành công</b>
                        </div>
                        </div>
                    ";
            }
            ?>
            <script>
                setTimeout(() => $('#product_msg').html(null), 5000)
            </script>
        </div>
        <div class="col-md-14">
            <div class="card ">
                <div class="card-header card-header-primary">
                    <h4 class="card-title"> Danh sách sản phẩm</h4>

                </div>
                <div class="card-body">
                    <div class="table-responsive ps">
                        <table class="table tablesorter " id="page1">
                            <thead class=" text-primary">
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Tên</th>
                                    <th>Giá</th>
                                    <th>
                                        <a class="btn btn-info" href="./add_products.php">Thêm mới</a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $result = mysqli_query($con, "select product_id,product_image, product_title,product_price from products Limit $page1,12") or die("query 1 incorrect.....");

                                while (list($product_id, $image, $product_name, $price) = mysqli_fetch_array($result)) {
                                    echo "<tr><td><img src='../../product_images/$image' style='width:50px; height:50px; border:groove #000'></td><td>$product_name</td>
                        <td>$price</td>
                        <td>
                        <a class='btn btn-info' href='./edit_products.php?product_id=$product_id'>Chỉnh sửa</a>
                        <a class='btn btn-danger' href='./products_list.php?product_id=$product_id&action=delete'>Xóa</a>
                        </td>
                        </tr>";
                                }

                                ?>
                            </tbody>
                        </table>
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps__rail-y" style="top: 0px; right: 0px;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php
                    $current_page = (int) $_GET['page'];
                    $previous_page = $current_page - 1;
                    if ($previous_page < 1) {
                        $previous_page = 1;
                    }
                    echo "
                    <li class='page-item'>
                        <a class='page-link' href='./products_list.php?page=$previous_page' aria-label='Previous'>
                            <span aria-hidden='true'>&laquo;</span>
                            <span class='sr-only'>Previous</span>
                        </a>
                    </li>"
                    ?>
                    <?php
                    //counting paging

                    $paging = mysqli_query($con, "select product_id,product_image, product_title,product_price from products");
                    $count = mysqli_num_rows($paging);

                    $a = $count / 10;
                    $a = ceil($a);

                    for ($b = 1; $b <= $a; $b++) {
                    ?>
                        <li class="page-item"><a class="page-link" href="./products_list.php?page=<?php echo $b; ?>"><?php echo $b . " "; ?></a></li>
                    <?php
                    }
                    ?>
                    <?php
                    $current_page = (int) $_GET['page'];
                    $next_page = $current_page + 1;
                    if ($next_page > $a) {
                        $next_page = $a;
                    }
                    echo "
                    <li class='page-item'>
                        <a class='page-link' href='./products_list.php?page=$next_page' aria-label='Next'>
                            <span aria-hidden='true'>&raquo;</span>
                            <span class='sr-only'>Next</span>
                        </a>
                    </li>"
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</div>