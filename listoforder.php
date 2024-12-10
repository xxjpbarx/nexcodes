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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Featured Menu</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        /* Navigation styling */
        .navigation { width: 100%; padding: 10px; text-align: center; }

        .navigation a { color: white; margin: 0 10px; text-decoration: none; font-weight: bold; }

        .menu-container {
            text-align: center;
            max-width: 900px;
            margin-top: 20px;
            padding: 0 20px;
        }

        .menu-container h2 { font-size: 2em; color: #333; margin-bottom: 20px; }

        .menu-items {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-bottom: 20px;
        }

        .menu-item {
            flex: 1 1 45%;
            border-radius: 10px;
            color: white;
            padding: 20px;
            position: relative;
            text-align: center;
        }

        .menu-item h3 { font-size: 1.5em; margin-bottom: 10px; }

        .menu-item p { font-size: 1em; margin-bottom: 20px; }

        .menu-item img {
            width: 80%;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            font-size: 1.2em;
            background-color: #FF6F00;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover { background-color: #E65100; }

        /* Responsive styling */
        @media (max-width: 768px) {
            .menu-item { flex: 1 1 100%; }
            .menu-container h2 { font-size: 1.5em; }
            button { font-size: 1em; }
        }

        @media (max-width: 480px) {
            .navigation a { display: block; margin: 5px 0; }
            .menu-item img { width: 100%; }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <div class="navigation">
        <?php include 'navigation.php'; ?>
    </div>
    
    <!-- Menu Container -->
    <div class="menu-container">
        <h2>Featured Category Items</h2>
        <div class="menu-items">
            <?php
            // Fetch categories data
            $sql = "SELECT name, description FROM categories";
            $result = $conn->query($sql);

            $colors = ['#ceb195', '#ffbd00', '#e5a672', '#303F9F', '#d49d8f'];
            $colorIndex = 0;

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $name = $row['name'];
                    $description = $row['description'];
                    $color = $colors[$colorIndex % count($colors)];
                    $colorIndex++;

                    // Set image path based on category name
                    $imagePath = '';
                    switch ($name) {
                        case 'Milktea': $imagePath = 'images/milktea.jpg'; break;
                        case 'Fruitea': $imagePath = 'uploads/fruitea.jpg'; break;
                        case 'Coffee': $imagePath = 'uploads/coffee.jpg'; break;
                        case 'Iced Coffee': $imagePath = 'uploads/icecoffee.jpg'; break;
                        case 'Ads On': $imagePath = 'uploads/adson.jpg'; break;
                        default: $imagePath = 'uploads/default.jpg'; break;
                    }

                    echo "<div class='menu-item' style='background-color: $color;'>";
                    echo "<h3>$name</h3>";
                    echo "<p>$description</p>";
                    echo "<img src='$imagePath' alt='$name'>";
                    echo "</div>";
                }
            } else {
                echo "<p>No menu items available.</p>";
            }

            $conn->close();
            ?>
        </div>
    </main>
    <a href="menus.php">
    <button type="button" class="btn btn-primary">SEE PRODUCT</button>
</a>
    <script>


        document.addEventListener("DOMContentLoaded", function () {
            const menuItems = document.querySelectorAll(".menu-item");

            menuItems.forEach((item) => {
                item.addEventListener("mouseover", function () {
                    item.style.transform = "scale(1.05)";
                    item.style.boxShadow = "0 4px 8px rgba(0, 0, 0, 0.2)";
                });

                item.addEventListener("mouseout", function () {
                    item.style.transform = "scale(1)";
                    item.style.boxShadow = "none";
                });
            });
        });
    </script>

</body>
</html>
