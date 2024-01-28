<?php 
		session_start();
		include("../core/connection.php");
		include("../core/functions.php");
		
	
		if(isset($_SESSION['username'])){
			$points=$_POST['newPoints'];
			$points=intval($points);
			$points=$points/10;
			$username = $_SESSION['username'];
			$user_data=check_login($con);
			$points=intval(get_points($user_data))+$points;
			$query ="UPDATE customers SET points='$points' where username= '$username'  ";
			mysqli_query($con,$query);
	}
?>