<!DOCTYPE html>
<html lang="en">

<?php 
session_start();
include('./db_connect.php');
ob_start();

// Fetch system settings
$system = $conn->query("SELECT * FROM system_settings LIMIT 1")->fetch_array();
foreach($system as $k => $v){
    $_SESSION['system'][$k] = $v;
}
ob_end_flush();
?>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo $_SESSION['system']['name']; ?> | Reset Password</title>

  <?php include('./header.php'); ?>
  <?php 
  if(isset($_SESSION['login_id'])){
      header("location:index.php?page=home");
  }
  ?>
</head>

<style>
    /* Add styles similar to forgot_password.php */
    body {
        position: relative;
        width: 100%;
        height: 100vh;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Helvetica', sans-serif;
        color: #333;
        overflow: hidden;
    }

    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url('assets/uploads/background 1.jpg');
        background-size: cover;
        background-position: center;
        filter: blur(8px);
        z-index: 0;
    }

    .card {
        background: rgba(255, 255, 255, 0.7);
        padding: 40px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        border-radius: 15px;
        width: 90%;
        max-width: 400px;
    }

    .form-group {
        width: 100%;
    }

    .form-control {
        width: 100%;
        padding: 12px;
        margin: 8px 0;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 16px;
    }

    .btn-primary {
        width: 100%;
        background-color: #007bff;
        border: none;
        padding: 12px;
        color: white;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
        font-size: 16px;
        margin-top: 10px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

<body class="bg-dark">

<main id="main">
    <div class="card">
        <div class="card-body">
            <h3>Reset Password</h3>
            <form id="reset-password-form">
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
                <div class="form-group">
                    <input type="password" id="password" name="password" class="form-control" placeholder="New Password" required>
                </div>
                <div class="form-group">
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
                </div>
                <button class="btn btn-primary" type="submit">Reset Password</button>
            </form>
            <p><a href="login.php" class="link">Back to Login</a></p>
        </div>
    </div>
</main>
<?php
// reset_password.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $newPassword = $_POST['new_password'];

    // Connect to your database
    $conn = new mysqli("localhost", "root", "", "nexpoint");

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if token is valid
    $stmt = $conn->prepare("SELECT user_id FROM password_resets WHERE token = ? AND expires_at > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($userId);
        $stmt->fetch();

        // Update user password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updateStmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $updateStmt->bind_param("si", $hashedPassword, $userId);
        $updateStmt->execute();

        // Delete the token from password_resets table
        $deleteStmt = $conn->prepare("DELETE FROM password_resets WHERE token = ?");
        $deleteStmt->bind_param("s", $token);
        $deleteStmt->execute();

        echo "Password has been reset successfully.";
    } else {
        echo "Invalid or expired token.";
    }
    
    $stmt->close();
    $conn->close();
}

?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#reset-password-form').submit(function(e) {
        e.preventDefault();
        var $button = $('#reset-password-form button[type="submit"]');
        $button.attr('disabled', true).html('Resetting password...');

        $.ajax({
            url: 'ajax.php?action=reset_password',
            method: 'POST',
            data: $(this).serialize(),
            error: function(err) {
                console.log(err);
                $button.removeAttr('disabled').html('Reset Password');
            },
            success: function(resp) {
                if (resp == 1) {
                    alert('Password has been reset successfully.');
                    location.href = 'login.php';
                } else {
                    $('#reset-password-form').prepend('<div class="alert alert-danger">Error resetting password.</div>');
                    $button.removeAttr('disabled').html('Reset Password');
                }
            }
        });
    });
</script>

</body>
</html>
