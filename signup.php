<!DOCTYPE html>
<html lang="en">

<?php 
session_start();
include('db_connect.php');
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
  <title><?php echo $_SESSION['system']['name']; ?> - Sign Up</title>

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

.form-group-terms {
    display: flex;
    align-items: center;
    font-size: 14px;
    color: #333;
}

.form-group-terms input[type="checkbox"] {
    margin-right: 10px; /* Space between checkbox and text */
    transform: scale(1.2); /* Make the checkbox slightly bigger */
}

.form-group-terms a {
    color: #007bff; /* Customize the link color */
    text-decoration: none;
}

.form-group-terms a:hover {
    text-decoration: underline; /* Optional: underline on hover */
}

/* Modal styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
    padding-top: 60px;
}

.modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px;
    border-radius: 10px;
    font-size: 16px;
    line-height: 1.5;
    color: #333;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

.link {
    color: #007bff;
}
</style>

<body class="bg-dark">

<div class="top-left-logo">
    <button class="top-left-button" onclick="window.location.href='main.php'">
        <img src="assets/uploads/nexcode.png" alt="Logo" />
    </button>
</div>

<button class="top-right-button" onclick="window.location.href='main.php'">
    <img src="assets/uploads/home-icon.png" alt="Home" class="home-icon">
</button>

<main id="main">
    <div class="card">
        <div class="card-body">
            <div class="logo-container">
                <img src="assets/uploads/logo.png" alt="Logo">
            </div>

            <!-- Sign-Up Form -->
            <form id="signup-form" method="POST" action="">
                <div class="form-group">
                    <input type="text" id="name" name="name" class="form-control" placeholder="Full Name" required>
                </div>
                <div class="form-group">
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email Address" required>
                </div>
                <div class="form-group">
                    <input type="text" id="number" name="number" class="form-control" placeholder="Phone Number" required>
                </div>
                <div class="form-group">
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
                </div>
                <div class="form-group-terms">
        <input type="checkbox" id="terms" required> 
        <label for="terms"> I agree to the 
            <a href="#" id="terms-link">Terms of Service</a> and 
            <a href="#" id="privacy-link">Privacy Policy</a>.
        </label>
        </div>
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </form>

            <!-- PHP Backend -->
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                include('db_connect.php'); // Make sure you have your DB connection file

                $name = $_POST['name'];
                $email = $_POST['email'];
                $number = $_POST['number'];
                $username = $_POST['username'];
                $password = md5($_POST['password']); // Hash password
                $confirm_password = md5($_POST['confirm_password']);

                // Check if the email or phone number already exists
                $check_query = "SELECT * FROM users WHERE email='$email' OR number='$number'";
                $check_result = $conn->query($check_query);

                if ($check_result->num_rows > 0) {
                    echo '<script>alert("Email or phone number is already in use. Please try a different one.");</script>';
                } else {
                    // Check if passwords match
                    if ($password !== $confirm_password) {
                        echo '<script>alert("Passwords do not match!");</script>';
                    } else {
                        // SQL Query to insert the new user
                        $query = "INSERT INTO users (name, email, number, username, password, type) 
                                  VALUES ('$name', '$email', '$number', '$username', '$password', 3)";
                        if ($conn->query($query) === TRUE) {
                            echo '<script>alert("Account created successfully!"); window.location.href="login.php";</script>';
                        } else {
                            echo '<script>alert("Error: ' . $conn->error . '");</script>';
                        }
                    }
                }
            }
            ?>

            <div class="form-group">
                <button type="button" class="btn btn-secondary" onclick="window.location.href='login.php'">Cancel</button>
            </div>
        </div>
    </div>
</main>

</body>
</html>
