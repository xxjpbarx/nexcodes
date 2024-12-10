<style>
  /* General navbar styling */
.navbar {
  background-color: #d30000; /* Red background */
  color: white;
  padding: 10px 20px;
}

.navbar-container {
  display: flex;
  align-items: center;
  justify-content: space-between;
  max-width: 1200px;
  margin: 0 auto;
}

/* Logo styling */
.navbar-brand img {
  height: 40px; /* Adjust the logo size as needed */
}

/* Navbar items */
.navbar-nav {
  display: flex;
  gap: 20px;
}

.navbar-nav li {
  list-style: none;
}

.navbar-nav a {
  color: white;
  font-weight: bold;
  text-decoration: none;
  font-size: 1rem;
  padding: 10px 0;
  position: relative;
}

/* Order Now button */
.navbar-order .order-button {
  background-color: #ff8c00; /* Orange button background */
  color: white;
  padding: 10px 20px;
  font-weight: bold;
  border-radius: 20px;
  text-decoration: none;
  font-size: 1rem;
  transition: background-color 0.3s;
}

.navbar-order .order-button:hover {
  background-color: #e07b00; /* Darker orange on hover */
}

/* Adjustments for smaller screens */
@media (max-width: 768px) {
  .navbar-container {
    flex-direction: column;
  }

  .navbar-nav {
    margin-top: 10px;
  }
}

</style>

<link rel="stylesheet" href="assets/css/homepage.css"/>

<!--=============== NAVIGATION BAR ===============-->
<nav class="navbar">
  <div class="navbar-container">
    <div class="navbar-brand">
      <a href="default.php">
        <img src="images/mainlogo.png" alt="Logo"/>
      </a>
    </div>

    <ul class="navbar-nav">
      <li><a href="default.php">Home</a></li>
      <li><a href="menu.php">Menu</a></li>
      <li><a href="stores.php">Store</a></li>
    </ul>

    <div class="navbar-order">
      <a href="listoforder.php" class="order-button">Order Now</a>
    </div>
  </div>
</nav>

<script src="assets/js/homepage.js"></script>
