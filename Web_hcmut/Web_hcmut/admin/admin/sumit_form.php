<?php
$link = $_REQUEST['success'];
?>
<html>

<head>
    <script>
        function myfunction() {
            document.getElementById("success").click();
        }
    </script>
</head>

<body onLoad="myfunction()">
    <form action="products_list.php" method="post" id="myform">
        <input hidden="" type="text" name="success" value="<?php echo "$link"; ?>">
        <button hidden="" type="submit" id="success" data-modal="success" name="success" value="Thành công"></button>
    </form>

    <h1 style="padding-left:400px; padding-top:200px;"><img src="../images/loading-x.gif" /></h1>
</body>