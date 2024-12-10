<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
include 'db_connect.php';
$crud = new Action();
if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'login2'){
	$login = $crud->login2();
	if($login)
		echo $login;
}

if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'logout2'){
	$logout = $crud->logout2();
	if($logout)
		echo $logout;
}
if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}
if($action == 'delete_user'){
	$save = $crud->delete_user();
	if($save)
		echo $save;
}
if($action == 'signup'){
	$save = $crud->signup();
	if($save)
		echo $save;
}
if($action == 'update_account'){
	$save = $crud->update_account();
	if($save)
		echo $save;
}
if($action == "save_settings"){
	$save = $crud->save_settings();
	if($save)
		echo $save;
}
if($action == "save_category"){
	$save = $crud->save_category();
	if($save)
		echo $save;
}
if($action == "delete_category"){
	$delete = $crud->delete_category();
	if($delete)
		echo $delete;
}
if($action == "save_product"){
	$save = $crud->save_product();
	if($save)
		echo $save;
}
if($action == "delete_product"){
	$delete = $crud->delete_product();
	if($delete)
		echo $delete;
}

if($action == "save_order"){
	$save = $crud->save_order();
	if($save)
		echo $save;
}
if($action == "delete_order"){
	$delete = $crud->delete_order();
	if($delete)
		echo $delete;
}

// if (isset($_SESSION['login_id'])) {
//     $logout_time = date('Y-m-d H:i:s');
//     $user_id = $_SESSION['login_id'];
    
//     // Update the logout time in user_sessions
//     $conn->query("UPDATE user_sessions SET logout_time = '$logout_time' WHERE user_id = '$user_id' AND logout_time IS NULL");

//     // Destroy session and redirect
//     session_destroy();
//     header("Location: login.php");
// }

if (isset($_GET['action']) && $_GET['action'] == 'signup') {
    // Get form data
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password for security

    // Check if username or email already exists
    $check_user = $conn->query("SELECT * FROM users WHERE username='$username' OR username='$email'");

    if ($check_user->num_rows > 0) {
        echo 0; // User already exists
        exit();
    }

    // Insert into the database
    $insert = $conn->query("INSERT INTO users (name, username, password) VALUES ('$name', '$username', '$password')");
    
    if ($insert) {
        echo 1; // Signup successful
    } else {
        echo 0; // Error signing up
    }
}

include('./db_connect.php');

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'forgot_password') {
        // Sanitize the email input
        $email = $conn->real_escape_string($_POST['email']);

        // Check if the email exists in the users table
        $result = $conn->query("SELECT * FROM users WHERE email = '$email' LIMIT 1");

        if ($result->num_rows > 0) {
            // Email found, proceed with generating reset token and sending email
            $user = $result->fetch_assoc();
            $user_id = $user['id'];

            // Generate a unique token
            $token = bin2hex(random_bytes(50));
            $expiration = date('Y-m-d H:i:s', strtotime('+1 hour'));

            // Store the token in the password_resets table
            $conn->query("INSERT INTO password_resets (user_id, token, expiration) VALUES ('$user_id', '$token', '$expiration')");

            // Send the reset link via email
            $reset_link = "http://localhost/nexpoint/reset_password.php?token=$token";
            $subject = "Password Reset Request";
            $message = "Click the following link to reset your password: $reset_link";

            // Use the mail() function or any mailing library to send the email
            if (mail($email, $subject, $message)) {
                echo 1; // Success response
            } else {
                echo 0; // Error sending email
            }
        } else {
            // Email not found
            echo 0; // Email not found response
        }
    } elseif ($_GET['action'] == 'reset_password') {
        // Sanitize the token and passwords
        $token = $conn->real_escape_string($_POST['token']);
        $password = $conn->real_escape_string($_POST['password']);
        $confirm_password = $conn->real_escape_string($_POST['confirm_password']);

        // Check if the passwords match
        if ($password !== $confirm_password) {
            echo 0; // Passwords do not match
            exit;
        }

        // Hash the new password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if the token is valid
        $token_result = $conn->query("SELECT * FROM password_resets WHERE token = '$token' AND expiration > NOW() LIMIT 1");

        if ($token_result->num_rows > 0) {
            $reset = $token_result->fetch_assoc();
            $user_id = $reset['user_id'];

            // Update the user's password
            $conn->query("UPDATE users SET password = '$hashed_password' WHERE id = '$user_id'");

            // Delete the used token
            $conn->query("DELETE FROM password_resets WHERE token = '$token'");

            echo 1; // Success response
        } else {
            echo 0; // Invalid or expired token
        }
    }
}


ob_end_flush();


?>
