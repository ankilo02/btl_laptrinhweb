<?php
session_start();
if (isset($_SESSION['checkedout']) && $_SESSION['checkedout']) {
    $_SESSION['checkedout'] = false;
}

include "header.php";

include "body.php";
include "footer.php";
