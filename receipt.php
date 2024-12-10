<?php 
include 'db_connect.php';

// Check if 'id' is provided in the URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid order ID.";
    exit;
}

$orderId = intval($_GET['id']);

// Prepare statement to fetch the order details
$stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $orderId);
$stmt->execute();
$order = $stmt->get_result();
$orderData = $order->fetch_array(MYSQLI_ASSOC);

// Check if the order exists
if (!$orderData) {
    echo "Order not found.";
    exit;
}

// Extract order details
$id = $orderData['id'];
$ref_no = $orderData['ref_no'];
$date_created = $orderData['date_created'];
$amount_tendered = $orderData['amount_tendered'];
$total_amount = $orderData['total_amount'];
$order_number = $orderData['order_number'];

// Prepare statement to fetch the order items
$stmt_items = $conn->prepare("
    SELECT o.*, p.name 
    FROM order_items o 
    INNER JOIN products p 
    ON p.id = o.product_id 
    WHERE o.order_id = ?
");
if (!$stmt_items) {
    die("Prepare failed: " . $conn->error);
}

$stmt_items->bind_param("i", $id);
$stmt_items->execute();
$items = $stmt_items->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipts</title>
    <style>
        .flex {
            display: inline-flex;
            width: 100%;
        }
        .w-50 {
            width: 50%;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        table.wborder {
            width: 100%;
            border-collapse: collapse;
        }
        table.wborder > tbody > tr, table.wborder > tbody > tr > td {
            border: 1px solid;
        }
        p {
            margin: unset;
        }
        .receipt {
            margin-bottom: 2rem;
        }
        /* Ensure separate pages when printing */
        @media print {
            .page-break {
                page-break-after: always;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid receipt">
        <!-- Customer's Receipt -->
        <p class="text-center"><b>TEASTREET.PH</b></p>
        <p class="text-center"><b>Towerville Brgy Sto. Cristo, San Jose Del Monte, Bulacan</b></p>
        <p class="text-center"><b><?php echo $amount_tendered > 0 ? "Receipt" : "Bill"; ?></b></p>
        <hr>
        <div class="flex">
            <div class="w-100">
                <?php if ($amount_tendered > 0): ?>
                <p>Invoice Number: <b><?php echo htmlspecialchars($ref_no); ?></b></p>
                <?php endif; ?>
                <p>Date: <b><?php echo date("M d, Y", strtotime($date_created)); ?></b></p>
            </div>
        </div>
        <hr>
        <p><b>Order List</b></p>
        <table class="wborder">
            <thead>
                <tr>
                    <td><b>QTY</b></td>
                    <td><b>Order</b></td>
                    <td class="text-right"><b>Amount</b></td>
                </tr>
            </thead>
            <tbody>
                <?php if ($items->num_rows > 0): ?>
                    <?php 
                    $items->data_seek(0); // Reset pointer to reuse $items
                    while ($row = $items->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['qty']); ?></td>
                        <td>
                            <p><?php echo htmlspecialchars($row['name']); ?></p>
                            <?php if ($row['qty'] > 0): ?>
                                <small>(₱<?php echo number_format($row['price'], 2); ?>)</small>
                            <?php endif; ?>
                        </td>
                        <td class="text-right">₱<?php echo number_format($row['amount'], 2); ?></td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No items found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <hr>
        <table width="100%">
            <tbody>
                <tr>
                    <td><b>Total Amount</b></td>
                    <td class="text-right"><b>₱<?php echo number_format($total_amount, 2); ?></b></td>
                </tr>
                <?php if ($amount_tendered > 0): ?>
                <tr>
                    <td><b>Amount Tendered</b></td>
                    <td class="text-right"><b>₱<?php echo number_format($amount_tendered, 2); ?></b></td>
                </tr>
                <tr>
                    <td><b>Change</b></td>
                    <td class="text-right"><b>₱<?php echo number_format($amount_tendered - $total_amount, 2); ?></b></td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <hr>
        <p class="text-center"><b>Order No.</b></p>
        <h4 class="text-center"><b><?php echo htmlspecialchars($order_number); ?></b></h4>
    </div>

    <div class="page-break"></div>

    <div class="container-fluid receipt">
        <!-- Owner's Receipt -->
        <p class="text-center"><b>TEASTREET.PH (OWNER'S COPY)</b></p>
        <p class="text-center"><b>Towerville Brgy Sto. Cristo, San Jose Del Monte, Bulacan</b></p>
        <p class="text-center"><b>Detailed Order Receipt</b></p>
        <hr>
        <p>Date: <b><?php echo date("M d, Y", strtotime($date_created)); ?></b></p>
        <hr>
        <p><b>Detailed Order List</b></p>
        <table class="wborder">
            <thead>
                <tr>
                    <td><b>QTY</b></td>
                    <td><b>Order</b></td>
                    <td><b>Price/Item</b></td>
                    <td class="text-right"><b>Total</b></td>
                </tr>
            </thead>
            <tbody>
                <?php 
                $items->data_seek(0); // Reset pointer to reuse $items
                if ($items->num_rows > 0): ?>
                    <?php while ($row = $items->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['qty']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td>₱<?php echo number_format($row['price'], 2); ?></td>
                        <td class="text-right">₱<?php echo number_format($row['amount'], 2); ?></td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No items found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <hr>
        <p><b>Total Sales for This Order: ₱<?php echo number_format($total_amount, 2); ?></b></p>
    </div>
</body>
</html>
