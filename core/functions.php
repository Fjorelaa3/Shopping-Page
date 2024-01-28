<?php
// functions.php

function check_login($con) {
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        // Fetch user data from the database based on the updated session username
        $query = "SELECT * FROM customers WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    // If the session username is not set or user data is not found, redirect to login
    header("Location: ../pages/login.php");
    exit();
}

function verify_login($con, $username, $password) {
    $query = "SELECT * FROM customers WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);

        // Verify the password against the hashed password in the database
        if (password_verify($password, $user_data['password'])) {
            return $user_data;
        }
    }

    return false; // Incorrect username or password
}


	function executeQuery($conn,$query){
		if ($conn->query($query) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $query . "<br>" . $conn->error;
		}
	}



	function get_points($user_data){
		include("connection.php");
		$username = $_SESSION['username'];
		$query ="select * from customers where username= '$username' limit 1 ";
			$result= mysqli_query($con,$query);
			if($result && mysqli_num_rows($result)>0){
				$user_data=mysqli_fetch_assoc($result); // Get an associated array from it
				return $user_data['points'];
			}
	}



// Modified get_users function
function get_users($con) {
    $query = "SELECT id, username, email, age, points FROM customers"; 
    $result = mysqli_query($con, $query);
    
    $users = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
    
    mysqli_free_result($result);
    
    return $users;
}

//Nuk do punojme me cookie
	function set_points(){
		$points=$_COOKIE['points'];
		$points=intval($points);
		$points=$points/10;
		if(isset($_SESSION['username'])){
			include("connection.php");
			$username = $_SESSION['username'];
			$user_data=check_login($con);
			$points=intval(get_points($user_data))+$points;
			$query ="UPDATE customers SET points='$points' where username= '$username'  ";
			$result= mysqli_query($con,$query);
			
			setcookie('points',"",time()-3600);
			//if($result >0){
			//	$user_data=mysqli_fetch_assoc($result); // Get an associated array from it
				return;			// $user_data['points'];
			//}
		}	
	}


//nuk po e perdor 
	function random_num($length){
		$text="";
		if($length<5){
			$length=5;
		}
		$len=rand(4,$length);
		for($i=0;$i<$len; $i++){
			$text .=rand(0,9);

		}
		return $text;
	}


	function update_user_info($con, $id, $newUsername, $newPassword, $newAge, $newEmail) {
		// Hash the new password
		$hash = password_hash($newPassword, PASSWORD_DEFAULT);
	
		// Prepare the SQL statement to prevent SQL injection
		$stmt = mysqli_prepare($con, "UPDATE customers SET username=?, password=?, age=?, email=? WHERE id=?");
	

		if (!$stmt) {
			echo "Prepare failed: (" . $con->errno . ") " . $con->error;
			return false;
		}
	
		// Bind the parameters to the prepared statement
		mysqli_stmt_bind_param($stmt, "ssisi", $newUsername, $hash, $newAge, $newEmail, $id);
	

		$result = mysqli_stmt_execute($stmt);
	
		if (!$result) {
			echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
	
		mysqli_stmt_close($stmt);
	
		return $result;
	}
	
	

?>
