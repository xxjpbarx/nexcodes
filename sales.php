<?php include('db_connect.php'); ?>

<style>
    input[type=checkbox] {
        /* Double-sized Checkboxes */
        -ms-transform: scale(1.3); /* IE */
        -moz-transform: scale(1.3); /* Firefox */
        -webkit-transform: scale(1.3); /* Safari and Chrome */
        -o-transform: scale(1.3); /* Opera */
        transform: scale(1.3);
        padding: 10px;
        cursor: pointer;
    }
</style>

<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12"></div>
        </div>
        <div class="row">
            <!-- Table Panel -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>Today's Orders</b>
                        <span class="float:right">
                            <a class="btn btn-primary btn-sm col-sm-2 float-right" href="billing/index.php" id="new_order">
                                <i class="fa fa-plus"></i> New
                            </a>
                        </span>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Invoice</th>
                                    <th>Order Number</th>
                                    <th>Amount</th> <!-- Includes Peso sign -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $today = date('Y-m-d'); // Get today's date
                                $order = $conn->query("SELECT * FROM orders WHERE DATE(date_created) = '$today' ORDER BY unix_timestamp(date_created) DESC");
                                while ($row = $order->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td class="text-center">' . $i . '</td>';
                                    echo '<td><p>' . date("M d, Y", strtotime($row['date_created'])) . '</p></td>';
                                    if ($row['amount_tendered'] > 0) {
                                        echo '<td><p>' . $row['ref_no'] . '</p></td>';
                                    } else {
                                        echo '<td><p>N/A</p></td>';
                                    }
                                    echo '<td><p>' . $row['order_number'] . '</p></td>';
                                    echo '<td><p class="text-right">₱' . number_format($row['total_amount'], 2) . '</p></td>';
                                    echo '<td class="text-center">';
                                    echo '<button class="btn btn-sm btn-info view_order" type="button" data-id="' . $row['id'] . '"><i class="fa fa-eye"></i></button>';
                                    echo '<button class="btn btn-sm btn-danger delete_order" type="button" data-id="' . $row['id'] . '"><i class="fa fa-trash-alt"></i></button>';
                                    echo '</td>';
                                    echo '</tr>';
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Table Panel -->
        </div>
    </div>
</div>

<style>
    td {
        vertical-align: middle !important;
    }
    td p {
        margin: unset;
    }
    img {
        max-width: 100px;
        max-height: 150px;
    }
</style>

<script>
    $(document).ready(function () {
        $('table').dataTable();
    });

    $('.view_order').click(function () {
        uni_modal("Order Details", "view_order.php?id=" + $(this).attr('data-id'), "mid-large");
    });

    $('.delete_order').click(function () {
        let password = prompt("Please enter or Contact first the admin to password to void transaction:");

        if (password) {
            verifyAdminPassword(password, $(this).attr('data-id'));
        } else {
            alert("Deletion canceled.");
        }
    });

    function verifyAdminPassword(password, orderId) {
        $.ajax({
            url: 'verify_admin_password.php', // A new PHP file to verify the password
            method: 'POST',
            data: { password: password },
            success: function (response) {
                if (response.trim() === "success") {
                    _conf("Are you sure you want to delete this order?", "delete_order", [orderId]);
                } else {
                    alert("Incorrect password. Deletion canceled.");
                }
            },
            error: function () {
                alert("An error occurred while verifying the password.");
            }
        });
    }

    function delete_order(id) {
        start_load();
        $.ajax({
            url: 'ajax.php?action=delete_order',
            method: 'POST',
            data: { id: id },
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Data successfully deleted", 'success');
                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                }
            }
        });
    }
</script>
