<?php
include "db.php";

session_start();

#Login script is begin here
#If user given credential matches successfully with the data available in database then we will echo string login_success
#login_success string will go back to called Anonymous funtion $("#login").click() 

if (isset($_POST["email"]) && isset($_POST["password"])) {
	$email = mysqli_real_escape_string($con, $_POST["email"]);
	$password = $_POST["password"];

	//encrypt password

	$sql = "SELECT * FROM user_info WHERE email = '$email'";
	$run_query = mysqli_query($con, $sql);
	$count = mysqli_num_rows($run_query);
	$row = mysqli_fetch_array($run_query);
	if ($count == 1 && password_verify($password, $row["password"])) {
		$_SESSION["uid"] = $row["user_id"];
		$_SESSION["name"] = $row["first_name"] . $row['last_name'];

		//if user is login from page we will send login_success
		echo "successful";
	} else {
		echo "<span style='color:red;'>Tài khoản không hợp lệ!</span>";
		exit();
	}
}
