<?php 
	session_start();
	include("../core/connection.php");
	include("../core/functions.php");

	// $hash = password_hash($password, PASSWORD_DEFAULT);
	// $query="insert into customers ( email,age,username,password,points) values ('$email','$age','$username','$hash',0)";
	// // $query="insert into users (id) values (123)";
	// executeQuery($con,$query);


		//kur kliokon buttonin sign up brenda faqeve por nderkohe je i loguar
	if(isset($_SESSION['username'])){
		session_unset();
	}

	$check= 0;
	if($_SERVER['REQUEST_METHOD']=="POST"){
		echo "Post entry";

		//something was posted
		$username = $_POST['username'];
		$password =  $_POST['password'];
		$email = $_POST['email'];
		$age =  $_POST['age'];
		$gender = $_POST['gender'];
		echo "HI";

		if(!empty($username) && !empty($password)){
			echo $username ;
		
			//kontrollojme nese eshte rregjistruar me pare
			$query1="select * from  customers where username ='$username' limit 1";
			$result=mysqli_query($con,$query1);
				if($result && mysqli_num_rows($result)>0){
					$check=1;
				}
			else{
			//save to database
			//enkriptojme passwordin
				$hash = password_hash($password, PASSWORD_DEFAULT);
			$query="insert into customers ( email,age,username,password,points,gender) values ('$email','$age',      
			'$username','$hash',0, '$gender')";
			echo $query;
			mysqli_query($con,$query);
			$_SESSION['username']=$username;
			header("Location: ../pages/myaccount.php");

			die; 
			}

		}else{
			echo "Please enter some valid info!";
		}

	}
	

	
?>
<!DOCTYPE html>
<meta name="viewport" content="width-device-width, initial-scale=1"> <!--Po harrove kete fjalin si ben dot media query-->
<html lang="en" dir="ltr">
<head>
	<link rel="stylesheet" href="../assets/styles/style2.css">
	<title>Signup</title>
</head>
<body>

	<div class="center">
		<h1 >Signup</h1>
		<form method="POST">
				<div class="txt_field">
					<input type="text" name="username" maxlength="20" required>
					<span></span>
					<label>Username</label>
				</div>
				<div class="txt_field">
					<input type="text" name="email" maxlength="40" required>
					<span></span>
					<label>Email</label>
				</div>
				<div class="txt_field">
					<input type="number" name="age" maxlength="3" required>
					<span></span>
					<label>Age</label>
				</div>
				<div class="txt_field">
					<input type="password" name="password" maxlength="20" required>
					<span></span>
					<label>Password</label>
				</div>
				<div class="txt_field">
                    <label>Gender:</label>
					<div class="gender">
						<div class='g1'>
                    <input type="radio" name="gender" value="M" required> 
                    <input type="radio" name="gender" value="F" required> 
                        </div>
					    <div class='g2'>
							<br>
						M
						<br><br>
						F
                       </div>
                       </div>
                </div>

				
				<input type="submit" name="" value="Signup">
				<div class="signup_link">
					Click to <a href="login.php">Login</a> <br>
					<?php  if($check==1)echo "A user has already signed up with the given username";	 ?>
				</div>
		</form>
	</div>


</body>
</html>