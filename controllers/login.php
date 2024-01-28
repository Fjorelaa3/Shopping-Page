<?php 
	session_start();
	include("../core/connection.php");
	include("../core/functions.php");
	$check2 = 0;

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		// Something was posted
		$user_name = trim($_POST['user_name']);
        $password = trim($_POST['password']);
	
		if (!empty($user_name) && !empty($password)) {
			// Use the verify_login function to check credentials
			$user_data = verify_login($con, $user_name, $password);
	
			if ($user_data) {
				$_SESSION['username'] = $user_data['username'];
				if ($user_data['username'] == 'NaDulShpejrti') {
					header("Location: ../controllers/admin.php");
				} else {
					header("Location: ../pages/myaccount.php");
				}
				exit();
			}
		}
	
		$check2 = 1; // Incorrect username or password
		//echo "Wrong username or password!";
	} else {
		$check2 = 2; // Please enter some valid info
		//echo "Please enter some valid info!";
	}
	
		

	
?>
<!DOCTYPE html>
<meta name="viewport" content="width-device-width, initial-scale=1"> <!--Po harrove kete fjalin si ben dot media query-->
<html lang="en" dir="ltr">
<head>
	<link rel="stylesheet" href="../assets/styles/style2.css">
	<title>Login</title>
</head>
<body>
	<div class="center">
		<h1>Login</h1>
		<form method="POST">
				<div class="txt_field">
					<input type="text" name="user_name" maxlength="20" required>
					<span></span>
					<label>Username</label>
				</div>
				<div class="txt_field">
					<input type="password" name="password"  maxlength="20" required>
					<span></span>
					<label>Password</label>
				</div>

				<div class="pass"> <a href="../index.html"  style="color:#007500; text-decoration: none; ">Continue as Guest </a></div>
				<input type="submit" name="" value="Login">
				<div class="signup_link">
					Not a member? <a href="signup.php">Signup</a> <br>
					<?php if ($check2 == 1): ?>
    <div class="error-message">*Wrong username or password!</div>
<?php endif; ?>
<style>
	.error-message {
    color: #D8000C; 
    background-color: #FFD2D2; 
    padding: 10px; 
    margin: 10px 0;
    border: 1px solid #D8000C; 
    border-radius: 5px; 
    text-align: center; 
    font-weight: bold; 
}
	</style>
				</div>
		</form>
	</div>


</body>
</html>