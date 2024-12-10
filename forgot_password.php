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
  <title><?php echo $_SESSION['system']['name']; ?> | Forgot Password</title>

  <?php include('./header.php'); ?>
  <?php 
  if(isset($_SESSION['login_id'])){
      header("location:index.php?page=home");
  }
  ?>
</head>

<style>
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

    .link {
        color: #007bff;
    }

    .content {
        position: relative;
        z-index: 1;
        padding: 20px;
        text-align: center;
    }

    .card {
        background: rgba(255, 255, 255, 0.7);
        padding: 40px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        border-radius: 15px;
        width: 90%;
        max-width: 400px;
    }

    .card-body {
        display: flex;
        flex-direction: column;
        align-items: center;
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
            <h3>Forgot Password</h3>
            <form id="forgot-password-form">
                <div class="form-group">
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                </div>
                <button class="btn btn-primary" type="submit">Request Reset Link</button>
            </form>
            <p><a href="login.php" class="link">Back to Login</a></p>
        </div>
    </div>
</main>
// forgot_password.php
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    
    // Validate email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Connect to your database
        $conn = new mysqli("localhost", "username", "password", "teastreet");

        // Check for connection errors
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if email exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        // Debugging output
        echo "Email being processed: " . htmlspecialchars($email) . "<br>";

        if ($stmt->num_rows > 0) {
            // Generate a token
            $token = bin2hex(random_bytes(50));
            $expiresAt = date("Y-m-d H:i:s", strtotime('+1 hour'));

            // Fetch user ID
            $stmt->bind_result($userId);
            $stmt->fetch();

            // Insert into password_resets table
            $insertStmt = $conn->prepare("INSERT INTO password_resets (user_id, token, expires_at) VALUES (?, ?, ?)");
            $insertStmt->bind_param("iss", $userId, $token, $expiresAt);
            $insertStmt->execute();

            // Send the reset link via email
            $resetLink = "http://localhost/teastreetph/reset_password.php?token=" . $token;
            mail($email, "Password Reset", "Click this link to reset your password: " . $resetLink);
            echo "A password reset link has been sent to your email.";
        } else {
            echo "Email does not exist.";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Invalid email format.";
    }
}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#forgot-password-form').submit(function(e) {
        e.preventDefault();
        var $button = $('#forgot-password-form button[type="submit"]');
        $button.attr('disabled', true).html('Sending reset link...');

        $.ajax({
            url: 'ajax.php?action=forgot_password',
            method: 'POST',
            data: $(this).serialize(),
            error: function(err) {
                console.log(err);
                $button.removeAttr('disabled').html('Request Reset Link');
            },
            success: function(resp) {
                if (resp == 1) {
                    alert('A password reset link has been sent to your email.');
                    location.href = 'login.php';
                } else {
                    $('#forgot-password-form').prepend('<div class="alert alert-danger">Email not found.</div>');
                    $button.removeAttr('disabled').html('Request Reset Link');
                }
            }
        });
    });
</script>

</body>
</html>
