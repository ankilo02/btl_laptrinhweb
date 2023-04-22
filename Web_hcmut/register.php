<?php
session_start();
if (isset($_SESSION['uid'])) {
	var_dump($_SESSION['uid']);
	exit();
}
include "db.php";
if (isset($_POST["f_name"])) {

	$f_name = $_POST["f_name"];
	$l_name = $_POST["l_name"];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$repassword = $_POST['repassword'];
	$mobile = $_POST['mobile'];
	$address1 = $_POST['address1'];
	$address2 = $_POST['address2'];
	$name = "/^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\W|_]+$/";
	$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
	$number = "/^[0-9]+$/";

	//prevent sql injection
	$email = mysqli_real_escape_string($con, $email);
	$password = mysqli_real_escape_string($con, $password);


	if (
		empty($f_name) || empty($l_name) || empty($email) || empty($password) || empty($repassword) ||
		empty($mobile) || empty($address1) || empty($address2)
	) {

		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Vui lòng điền vào tất cả các ô ..!</b>
			</div>
		";
		exit();
	} else {
		if (!preg_match($name, $f_name)) {
			echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>$f_name không hợp lệ..!</b>
			</div>
		";
			exit();
		}
		if (!preg_match($name, $l_name)) {
			echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>$l_name không hợp lệ..!</b>
			</div>
		";
			exit();
		}
		if (!preg_match($emailValidation, $email)) {
			echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>$email không hợp lệ..!</b>
			</div>
		";
			exit();
		}
		if (strlen($password) < 9) {
			echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Mật khẩu yếu!</b>
			</div>
		";
			exit();
		}
		if (strlen($repassword) < 9) {
			echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Mật khẩu yếu!</b>
			</div>
		";
			exit();
		}
		if ($password != $repassword) {
			echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Mật khẩu không giống nhau</b>
			</div>
		";
		}
		if (!preg_match($number, $mobile)) {
			echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Số điện thoại $mobile không hợp lệ</b>
			</div>
		";
			exit();
		}
		if (!(strlen($mobile) == 10)) {
			echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Số điện thoại phải có 10 chữ số</b>
			</div>
		";
			exit();
		}
		//existing email address in our database
		$sql = "SELECT user_id FROM user_info WHERE email = '$email' LIMIT 1";
		$check_query = mysqli_query($con, $sql);
		$count_email = mysqli_num_rows($check_query);
		if ($count_email > 0) {
			echo "
			<div class='alert alert-danger'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Địa chỉ email đã sử dụng, hãy thử địa chỉ email khác</b>
			</div>
		";
			exit();
		} else {

			//encrypt password
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);

			$sql = "INSERT INTO `user_info` 
		(`user_id`, `first_name`, `last_name`, `email`, 
		`password`, `mobile`, `address1`, `address2`) 
		VALUES (NULL, '$f_name', '$l_name', '$email', 
		'$hashed_password', '$mobile', '$address1', '$address2')";
			$run_query = mysqli_query($con, $sql);
			$_SESSION["uid"] = mysqli_insert_id($con);
			$_SESSION["name"] = $f_name;
			if ($run_query) {
				echo "successful";
				exit();
			}
		}
	}
}