<?php
// Include database connection
$servername = "localhost";
$username = "u745007485_root";
$password = "Nexpoint2024";
$dbname = "u745007485_nexpoint";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch categories from the database
$category_sql = "SELECT id, name FROM categories";
$category_result = $conn->query($category_sql);

$categories = [];
if ($category_result->num_rows > 0) {
    while ($row = $category_result->fetch_assoc()) {
        $categories[] = $row; // Store categories in an array
    }
}

// Handle adding a product
if (isset($_POST['save'])) {
    // Retrieve form data
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity']; // Now it's a 'status' field
    $image = '';

    // Handle file upload
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "assets/upload/" . basename($image);
        
        // Ensure the upload directory exists
        if (!is_dir('assets/upload')) {
            mkdir('assets/upload', 0777, true);
        }

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            echo "Failed to upload image.";
        }
    }

    $status = ($quantity == 0) ? 0 : 1; // 0 for Unavailable, 1 for Available

    // Insert product into the database
    $insert_sql = "INSERT INTO products (category_id, name, description, price, status, image) 
                   VALUES ('$category_id', '$name', '$description', '$price', '$status', '$image')";
    if ($conn->query($insert_sql) === TRUE) {
        echo "New product added successfully";
    } else {
        echo "Error: " . $insert_sql . "<br>" . $conn->error;
    }
}

// Handle updating a product
if (isset($_POST['update'])) {
    $product_id = $_POST['product_id'];
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $status = $_POST['status']; // status instead of quantity

    // Handle file upload for edit
    $image = $_POST['existing_image']; // Default to existing image
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "assets/upload/" . basename($image);
        
        if (!is_dir('assets/upload')) {
            mkdir('assets/upload', 0777, true);
        }

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            echo "Failed to upload image.";
        }
    }

    // Update product in the database
    $update_sql = "UPDATE products SET category_id = '$category_id', name = '$name', description = '$description', 
    price = '$price', status = '$status', image = '$image' WHERE id = '$product_id'";
    if ($conn->query($update_sql) === TRUE) {
        echo "<script>
        $(document).ready(function() {
            $('#successModal').modal('show');
        });
        </script>";
    } else {
        echo "Error: " . $update_sql . "<br>" . $conn->error;
    }
}

// Handle deleting a product
if (isset($_GET['delete'])) {
    $product_id = $_GET['delete'];
    $delete_sql = "DELETE FROM products WHERE id = '$product_id'";
    if ($conn->query($delete_sql) === TRUE) {
        echo "Product deleted successfully";
    } else {
        echo "Error: " . $delete_sql . "<br>" . $conn->error;
    }
}

// Fetch products for display with category names
$product_sql = "SELECT p.*, c.name AS category_name 
                FROM products p 
                JOIN categories c ON p.category_id = c.id";
$product_result = $conn->query($product_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="assets/font-awesome/css/all.min.css">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="assets/DataTables/datatables.min.css" rel="stylesheet">
    <link href="assets/css/jquery.datetimepicker.min.css" rel="stylesheet">
    <link href="assets/css/select2.min.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="assets/css/jquery-te-1.4.0.css">
    <title>Product List</title>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Product List</h1>


        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th> <!-- Changed header to show "Category" -->
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($product_result->num_rows > 0): ?>
                    <?php while ($product = $product_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $product['id']; ?></td>
                            <td><?php echo $product['category_name']; ?></td> <!-- Display category name instead of ID -->
                            <td><?php echo $product['name']; ?></td>
                            <td><?php echo $product['description']; ?></td>
                            <td><?php echo $product['price']; ?></td>
                            <td><?php echo ($product['status'] == 1) ? 'Available' : 'Unavailable'; ?></td> <!-- Status as Available/Unavailable -->
                            <td><img src="assets/upload/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" width="50px" height="50px"></td>
                            <td>
                                <button class="btn btn-warning" onclick="editProduct(<?php echo $product['id']; ?>)">Edit</button>
                                <a href="?delete=<?php echo $product['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No products found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select id="category" name="category_id" class="form-select" required>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status (Available = 1, Unavailable = 0)</label>
                            <select id="status" name="quantity" class="form-select" required>
                                <option value="1">Available</option>
                                <option value="0">Unavailable</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Product Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary" name="save">Save Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" id="editProductId" name="product_id">
                        <div class="mb-3">
                            <label for="editCategory" class="form-label">Category</label>
                            <select id="editCategory" name="category_id" class="form-select" required>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editDescription" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editPrice" class="form-label">Price</label>
                            <input type="number" class="form-control" id="editPrice" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="editStatus" class="form-label">Status (Available = 1, Unavailable = 0)</label>
                            <select id="editStatus" name="status" class="form-select" required>
                                <option value="1">Available</option>
                                <option value="0">Unavailable</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editImage" class="form-label">Product Image</label>
                            <input type="file" class="form-control" id="editImage" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary" name="update">Update Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Product updated successfully!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
            $(document).ready(function(){ $('table').dataTable();});

        function editProduct(productId) {
            // Fetch product details from the server using AJAX
            fetch('get_product.php?id=' + productId)
                .then(response => response.json())
                .then(product => {
                    document.getElementById('editProductId').value = product.id;
                    document.getElementById('editCategory').value = product.category_id;
                    document.getElementById('editName').value = product.name;
                    document.getElementById('editDescription').value = product.description;
                    document.getElementById('editPrice').value = product.price;
                    document.getElementById('editStatus').value = product.status;
                })
                .then(() => {
                    var myModal = new bootstrap.Modal(document.getElementById('editProductModal'));
                    myModal.show();
                });
        }
    </script>
</body>
</html>