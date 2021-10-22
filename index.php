<?php

require_once "autoload.php";

// user login check 
if (userLogin() == true) {
	header('location:profile.php');
}

if (isset($_COOKIE['login_user_cooke_id'])) {
	$login_cookie_id = $_COOKIE['login_user_cooke_id'];
	$_SESSION['id']	= $login_cookie_id;
	header('location:profile.php');
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Social User </title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body>

	<?php

	/**
	 * Login Isset 
	 */
	if (isset($_POST['signup'])) {
		// get values 
		$login = $_POST['login'];
		$pass = $_POST['password'];


		if (empty($login) || empty($pass)) {
			$msg = validate('All fields are requirted ');
		} else {

			$login_user_data =  authCheck('users', 'email', $login);

			if ($login_user_data !== false) {

				if (passcheck($pass, $login_user_data->password)) {

					$_SESSION['id']	= $login_user_data->id;
					setcookie('login_user_cooke_id',  $login_user_data->id, time() + (60 * 60 * 24 * 365 * 7));


					header('location:profile.php');
				} else {
					$msg = validate("Incorrect Password", 'warning');
				}
			} else {
				$msg = validate("Invalid login email address");
			}
		}
	}


	?>


	<div class="wrap shadow-sm">
		<div class="card">
			<div class="card-body">
				<h2>Log In</h2>
				<?php

				if (isset($msg)) {
					echo $msg;
				}

				?>
				<hr>
				<form action="" autocomplete="off" method="POST">

					<div class="form-group">
						<label for="">Login info</label>
						<input name="login" class="form-control" value="<?php old('login') ?>" type="text" placeholder="Email or Cell or Username">
					</div>
					<div class="form-group">
						<label for="">Password</label>
						<input name="password" class="form-control" type="password" placeholder="Password">
					</div>
					<div class="form-group">
						<input name="signup" class="btn btn-primary" type="submit" value="Log In">
					</div>
				</form>
				<hr>
				<a href="reg.php">Create an account</a>
			</div>
		</div>
	</div>








	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>

</html>