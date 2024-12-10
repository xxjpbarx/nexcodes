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
  <title><?php echo $_SESSION['system']['name']; ?></title>

<?php include('./header.php'); ?>
<?php 
if(isset($_SESSION['login_id'])){
    header("location:index.php?page=home");
}
?>
</head>

<style>
    body {
    position: relative; /* Allows positioning of the pseudo-element */
    width: 100%;
    height: 100vh; /* Full viewport height */
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Helvetica', sans-serif;
    color: #333;
    overflow: hidden; /* Prevents overflow */
}

/* Pseudo-element for the blurred background */
body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url('assets/uploads/background.jpg');
    background-size: cover;
    background-position: center; /* Center the image */
    filter: blur(8px); /* Adjust the blur value as needed */
    z-index: 0; /* Behind the content */
}

/* Adjust styles for the top-left logo */
.top-left-logo {
    position: absolute;
    top: 10px;
    left: 10px;
    z-index: 10;
}

/* Button styling */
.top-left-button {
    background: none;
    border: none;
    padding: 0;
    cursor: pointer;
}

/* Logo image */
.top-left-logo img {
    width: 150px; /* Default size */
    height: auto;
    filter: brightness(0) invert(1); /* Optional: Make the logo white */
    transition: width 0.3s ease; /* Smooth scaling */
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .top-left-logo img {
        width: 120px; /* Smaller screens, reduce logo size */
    }
}

@media (max-width: 480px) {
    .top-left-logo img {
        width: 100px; /* Even smaller screens, reduce further */
    }
}

/* Content styling */
.content {
    position: relative; /* Keep content above the blurred background */
    z-index: 1; /* Bring the content to the front */
    padding: 20px; /* Optional padding */
    text-align: center; /* Center the text */
}

#main {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    width: 100%;
}

.card {
    background: rgb(255 255 255 / 64%);
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

.logo-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
}

.logo-container img {
    width: 200px;
    height: auto;
}

.form-group {
    width: 100%;
}

.form-control {
    width: 270px;
    padding: 12px;
    margin: 2px 0;
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
    margin-bottom: 10px; /* Adds space below the button */
}

.btn-primary:hover {
    background-color: #0056b3;
}

.btn-secondary {
    width: 100%;
    background-color: #6c757d;
    border: none;
    padding: 12px;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    font-size: 16px;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

.top-right-button {
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 10px;
    background: none; /* Remove button background */
    border: none; /* Remove button border */
    cursor: pointer;
}

.home-icon {
    width: 30px; /* Adjust size */
    height: auto; /* Maintain aspect ratio */
    filter: brightness(0) invert(1); /* Make the image white */
}

.credit {
    color: #9C9FA6;
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 10px;
    background: rgb(255, 255, 255);
    text-align: center;
}

.link {
    color: #007bff;
}
</style>

<body class="bg-dark">

<div class="top-left-logo">
    <button class="top-left-button" onclick="window.location.href='default.php'">
        <img src="assets/uploads/nexcode.png" alt="Logo" />
    </button>
</div>

<button class="top-right-button" onclick="window.location.href='default.php'">
    <img src="assets/uploads/home-icon.png" alt="Home" class="home-icon">
</button>

<main id="main">
    <div class="card">
        <div class="card-body">
            <!-- Logo and TEASTREET PH text stacked vertically -->
            <div class="logo-container">
                <img src="assets/uploads/logo.png" alt="Logo">
            </div>
            
            <form id="login-form">
                <div class="form-group">
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button class="btn btn-primary" type="submit">Login</button>
                <!-- <a href="forgot_password.php" class="link" onclick="redirectToForgotPassword()">Forgot account?</a> -->
                <hr> <!-- This will create a line separator -->
                <button class="btn btn-secondary" type="button" onclick="redirectToSignup()">Sign Up</button>
            </form>
        </div>
    </div>
</main>

<script>
function redirectToSignup() {
    window.location.href = 'signup.php'; // Change this to the actual URL of your sign-up page
}

$('#login-form').submit(function(e) {
    e.preventDefault();
    var $button = $('#login-form button[type="submit"]');
    $button.attr('disabled', true).html('Logging in...');

    if($(this).find('.alert-danger').length > 0) {
        $(this).find('.alert-danger').remove();
    }

    $.ajax({
        url: 'ajax.php?action=login',
        method: 'POST',
        data: $(this).serialize(),
        error: function(err) {
            console.log(err);
            $button.removeAttr('disabled').html('Login');
        },
        success: function(resp) {
            if (resp == 1) {
                location.href = 'index.php?page=home';
            } else {
                $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>');
                $button.removeAttr('disabled').html('Login');
            }
        }
    });
});
</script>

</body>
</html>
