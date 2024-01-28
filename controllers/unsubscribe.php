<?php
session_start();
include("../core/connection.php");
include("../core/functions.php");

$user_data = check_login($con);

// Delete the user from the 'customers' table
$user_id = $user_data['id'];
$sql = "DELETE FROM customers WHERE id = $user_id";

if ($con->query($sql) === TRUE) {
    // If deletion is successful, redirect to the login page or any other appropriate page
    header("Location: login.php");
    exit();
} else {
    // If an error occurs during deletion, display an error message
    echo "Error deleting record: " . $con->error;
}

$con->close();
?>
