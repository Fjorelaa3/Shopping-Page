<?php
session_start();
include("../core/connection.php");
include("../core/functions.php");

// Check if the user is logged in
$user_data = check_login($con);

// Initialize variables for form validation
$updateError = "";

// Handle form submission for updating information
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the input data
    $newUsername = htmlspecialchars($_POST['newUsername']);
    $newPassword = htmlspecialchars($_POST['newPassword']);
    $newAge = htmlspecialchars($_POST['newAge']);
    $newEmail = htmlspecialchars($_POST['newEmail']);
    $hash = $newPassword; 

    // Update user information in the database
    $updateResult = update_user_info($con, $user_data['id'], $newUsername, $hash, $newAge, $newEmail);

    if ($updateResult) {
        $_SESSION['username'] = $newUsername;
        // Update successful
        header("Location: ../pages/myaccount.php");
        exit();
    } else {

        $updateError = "Failed to update information. Please try again.";
    }
}
?>

<!DOCTYPE html>
<meta name="viewport" content="width-device-width, initial-scale=1"> <!--Po harrove kete fjalin si ben dot media query-->
<html lang="en" dir="ltr">

<head>
    <link rel="stylesheet" href="../assets/styles/style2.css">
    <title>Update My Information</title>
</head>

<body>

    <div class="center1">
        <h1>Update My Information</h1>
        <form method="POST">
            <div class="txt_field">
                <input type="text" name="newUsername" maxlength="20" required>
                <span></span>
                <label>New Username</label>
            </div>
            <div class="txt_field">
                <input type="text" name="newEmail" maxlength="40" required>
                <span></span>
                <label>New Email</label>
            </div>
            <div class="txt_field">
                <input type="number" name="newAge" maxlength="3" required>
                <span></span>
                <label>New Age</label>
            </div>
            <div class="txt_field">
                <input type="password" name="newPassword" maxlength="20" required>
                <span></span>
                <label>New Password</label>
            </div>

            <input type="submit" name="" value="Update Information">
            <?php
            // Display any update error messages here if needed
            if (!empty($updateError)) {
                echo '<p class="error">' . $updateError . '</p>';
            }
            ?>
        </form>
    </div>

</body>

</html>
