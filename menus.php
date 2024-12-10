<?php
// Connect to MySQL database
include('db_connect.php');

// Fetch categories from the database
$categoryQuery = "SELECT * FROM categories";
$categories = $conn->query($categoryQuery);

// Fetch products with associated categories from the database
$productQuery = "SELECT p.*, c.name AS category_name FROM products p 
                 INNER JOIN categories c ON p.category_id = c.id";
$products = $conn->query($productQuery);
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEASTREET</title>
    <link rel="stylesheet" href="assets/css/order.css">
    <link rel="stylesheet" href="assets/css/homepage.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery Library -->
    <style>
        /* Styles for the category filter */
        .category-filter {
            margin: 20px 0; /* Space above and below the filter */
            text-align: center; /* Center align the filter */
        }

        .category-filter label {
            font-size: 18px; /* Increase font size for better visibility */
            font-weight: bold; /* Make the label bold */
        }

        .category-filter select {
            padding: 10px; /* Add some padding */
            font-size: 16px; /* Font size for the dropdown */
            border: 2px solid #007bff; /* Border color */
            border-radius: 5px; /* Rounded corners */
            background-color: #f8f9fa; /* Light background color */
            transition: border-color 0.3s; /* Transition for border color */
        }

        .category-filter select:focus {
            border-color: #0056b3; /* Darker border color on focus */
            outline: none; /* Remove outline */
        }

        /* Shop content styles */
        .shop-content {
            display: flex; /* Flexbox layout for product boxes */
            flex-wrap: wrap; /* Allow wrapping */
            justify-content: center; /* Center align items */
            gap: 20px; /* Space between items */
        }

        .product-box {
            background: #ffffff; /* White background for product boxes */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Soft shadow */
            overflow: hidden; /* Hide overflow */
            width: 100px; /* Fixed width */
            text-align: center; /* Center text */
        }

        .product-img {
            width: 100%; /* Full width */
            height: 100px; /* Fixed height */
            object-fit: cover; /* Maintain aspect ratio */
        }

        .product-title {
            font-size: 14px; /* Font size for title */
            margin: 10px 0; /* Margin for spacing */
        }

        .price, .category {
            font-size: 12px; /* Font size for price and category */
            color: #000; /* Darker text color */
        }

        .add-cart {
            font-size: 20px; /* Icon size */
            color: #007bff; /* Icon color */
            cursor: pointer; /* Pointer on hover */
        }
    </style>
</head>
<body>
    <!--=============== NAVIGATION BAR ===============-->
    <?php include 'navigation.php'; ?>

    <nav>
        <button type="button" class="hamburger" id="menu-btn">
            <span class="hamburger-top"></span>
            <span class="hamburger-middle"></span>
            <span class="hamburger-bottom"></span>
        </button>
    </nav>

    <!--=============== MOBILE MENU ===============-->
    <div class="mobile-menu hidden" id="menu">
        <ul>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="listoforder.php">Order Now</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <div class="mobile-menu-bottom">
            <button class="btn btn-dark-outline">Sign in</button>
            <button class="btn btn-dark">Join now</button>
            <div>
                <a href="stores.php">
                    <img src="images/marker.svg" alt="" />
                    <span>Find a store</span>
                </a>
            </div>
        </div>
    </div>

    <section class="shop container">
        <div class="shop-content">
            <!-- Category Filter -->
            <div class="category-filter">
                <form method="GET" action="">
                    <label for="category">Choose a category:</label>
                    <select name="category" id="category" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        <?php
                        // Dynamically populate category dropdown
                        if ($categories->num_rows > 0) {
                            while ($category = $categories->fetch_assoc()) {
                                // Check if category is selected
                                $selected = (isset($_GET['category']) && $_GET['category'] == $category['id']) ? 'selected' : '';
                                echo '<option value="'.$category['id'].'" '.$selected.'>'.$category['name'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </form>
            </div>

            <!-- Products will be displayed here -->
            <div class="shop-content">
                <?php
                // Filter products by selected category
                $selectedCategory = isset($_GET['category']) ? $_GET['category'] : '';
                if ($selectedCategory != '') {
                    $productQuery .= " WHERE p.category_id = " . $selectedCategory;
                    $products = $conn->query($productQuery);
                }

                // Display products based on category selection
                if ($products->num_rows > 0) {
                    while ($product = $products->fetch_assoc()) {
                        echo '
                        <div class="product-box">
                            <img src="assets/upload/'.$product['image'].'" alt="'.$product['name'].'" class="product-img">
                            <h2 class="product-title">'.$product['name'].'</h2>
                            <span class="price">₱'.$product['price'].'</span>
                            <i class="bx bx-shopping-bag add-cart"></i>
                        </div>';
                    }
                } else {
                    echo "No products found.";
                }
                
                ?>
            </div>
        </div>
    </section>




    <!--=============== CUSTOM JS ===============-->
    <script src="assets/js/order.js"></script>
    <script src="assets/js/homepage.js"></script>
    <script>
        $(document).ready(function() {
            $('#menu-btn').on('click', function() {
                $('#menu').toggleClass('hidden'); // Toggle visibility of the mobile menu
            });
        });
    </script>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>