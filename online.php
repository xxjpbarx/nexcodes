<?php 
include('db_connect.php'); 
?>

<style>
    /* Add your existing styles here */
    .wrapper {
        padding: 1%;
        width: 80%;
        margin: 0 auto;
    }

    .text-center {
        text-align: center;
    }

    .tbl-full {
        width: 100%;
    }

    .btn-secondary {
        background-color: #7bed9f;
        padding: 1%;
        color: black;
        text-decoration: none;
        font-weight: bold;
    }

    /* Modal styles */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        padding-top: 60px;
    }

    .modal-content {
        background-color: #fefefe;
        margin: 5% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 50%; /* Could be more or less, depending on screen size */
    }

    .btn-danger {
        background-color: #ff6b81;
        padding: 1%;
        color: white;
        text-decoration: none;
        font-weight: bold;
    }
</style>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br /><br />

        <?php 
            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>
        <br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty.</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>

            <?php 
                $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                $sn = 1;

                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];
                        ?>

                        <tr>
                            <td><?php echo $sn++; ?>. </td>
                            <td><?php echo $food; ?></td>
                            <td><?php echo $price; ?></td>
                            <td><?php echo $qty; ?></td>
                            <td><?php echo $total; ?></td>
                            <td><?php echo $order_date; ?></td>
                            <td>
                                <?php 
                                    if ($status == "Ordered") {
                                        echo "<label>$status</label>";
                                    } elseif ($status == "On Delivery") {
                                        echo "<label style='color: orange;'>$status</label>";
                                    } elseif ($status == "Delivered") {
                                        echo "<label style='color: green;'>$status</label>";
                                    } elseif ($status == "Cancelled") {
                                        echo "<label style='color: red;'>$status</label>";
                                    }
                                ?>
                            </td>
                            <td><?php echo $customer_name; ?></td>
                            <td><?php echo $customer_contact; ?></td>
                            <td><?php echo $customer_email; ?></td>
                           <td>
                               <button onclick="openModal(<?php echo $id; ?>, '<?php echo $food; ?>', <?php echo $price; ?>, <?php echo $qty; ?>, '<?php echo $status; ?>')" class="btn btn-secondary">Update Order</button>
                           </td>
                        </tr>

                        <?php
                    }
                } else {
                    echo "<tr><td colspan='12' class='error'>Orders not Available</td></tr>";
                }
            ?>
        </table>
    </div>
</div>

<!-- Modal Structure -->
<div id="updateOrderModal" class="modal" style="display: none;">
    <div class="modal-content">
        <h2>Update Order</h2>
        <form id="updateOrderForm">
            <input type="hidden" name="id" id="orderId">
            <label>Food:</label>
            <p id="foodName"></p> <!-- Display food name -->
            <label>Price:</label>
            <p id="foodPrice"></p> <!-- Display food price -->
            <label>Qty:</label>
            <input type="number" name="qty" id="qty" required>
            <label>Status:</label>
            <select name="status" id="status">
                <option value="Ordered">Ordered</option>
                <option value="On Delivery">On Delivery</option>
                <option value="Delivered">Delivered</option>
                <option value="Cancelled">Cancelled</option>
            </select>
            <button type="button" onclick="submitUpdate()" class="btn-secondary">Update Order</button>
        </form>
    </div>
    <div class="modal-footer">
        <button onclick="closeModal()" class="btn-danger">Close</button>
    </div>
</div>

<!-- JavaScript Functions -->
<script>
function openModal(id, food, price, qty, status) {
    document.getElementById('orderId').value = id;
    document.getElementById('foodName').textContent = food;
    document.getElementById('foodPrice').textContent = '₱' + price.toFixed(2);
    document.getElementById('qty').value = qty;
    document.getElementById('status').value = status;

    document.getElementById('updateOrderModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('updateOrderModal').style.display = 'none';
}

function submitUpdate() {
    const form = document.getElementById('updateOrderForm');
    const formData = new FormData(form);

    // Debugging: Log form data to see if everything is correct
    formData.forEach((value, key) => {
        console.log(`Form Data - ${key}: ${value}`);
    });

    fetch('front/update-order.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log('Response Data:', data); // Debug the response
        if (data.success) {
            alert("Order updated successfully!");
            location.reload(); // Reload the page to reflect the changes
        } else {
            alert(data.message || "Failed to update order.");
        }
    })
    .catch(error => {
        console.error('Fetch Error:', error);
        alert("An error occurred while updating the order.");
    });
}

</script>

<script>
$('table').dataTable();
</script>

<?php include('footer.php'); ?>
