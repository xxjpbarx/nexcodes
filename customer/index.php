<?php include 'db_connect.php'; ?>
<style>
    /* Styles for the cards */
    span.float-right.summary_icon {
        font-size: 3rem;
        position: absolute;
        right: 1rem;
        top: 0;
    }
    .imgs {
        margin: .5em;
        max-width: calc(100%);
        max-height: calc(100%);
    }
    .imgs img {
        max-width: calc(100%);
        max-height: calc(100%);
        cursor: pointer;
    }
    #imagesCarousel, #imagesCarousel .carousel-inner, #imagesCarousel .carousel-item {
        height: 60vh !important;
        background: black;
    }
    #imagesCarousel .carousel-item.active {
        display: flex !important;
    }
    #imagesCarousel .carousel-item-next {
        display: flex !important;
    }
    #imagesCarousel .carousel-item img {
        margin: auto;
    }
    #imagesCarousel img {
        width: auto !important;
        height: auto !important;
        max-height: calc(100%) !important;
        max-width: calc(100%) !important;
    }
    /* Centering amounts */
    .text-center-amount {
        text-align: center; /* Center the text */
    }

</style>

<div class="container-fluid">
    <div class="row mt-3 ml-3 mr-3 dashcard">
        <div class="col-md-12">
            <div class="row">
                <!-- Top Sale Product Card -->
                <div class="col-md-3 mb-3">
                    <div class="card bg-white border-0 circle-primary theme-circle">
                        <div class="card-body">
                            <h4 class="text-dark">Top Sale Product</h4>
                            <?php
                                $query = "
                                    SELECT p.name, SUM(oi.qty) AS total_quantity 
                                    FROM order_items oi 
                                    JOIN products p ON oi.product_id = p.id 
                                    JOIN orders o ON oi.order_id = o.id 
                                    WHERE MONTH(o.date_created) = MONTH(CURDATE()) 
                                    AND YEAR(o.date_created) = YEAR(CURDATE()) 
                                    GROUP BY oi.product_id 
                                    ORDER BY total_quantity DESC 
                                    LIMIT 1";
                                $result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_assoc($result);
                                $top_product_name = $row ? $row['name'] : 'No sales';
                            ?>
                            <div class="mt-3">
                                <div class="d-flex align-items-center">
                                    <span class="text-dark mr-3">
                                        <h3 class=""><?php echo $top_product_name; ?></h3>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Orders Card -->
                <div class="col-md-3 mb-3">
                    <div class="card bg-white border-0 circle-secondary theme-circle">
                        <div class="card-body">
                            <h4 class="text-dark">Orders Today</h4>
                            <?php
                                $query = "SELECT COUNT(*) AS total_orders FROM orders WHERE DATE(date_created) = CURDATE()"; // Only today's orders
                                $result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_assoc($result);
                                $total_orders_today = $row['total_orders'];
                            ?>
                            <div class="mt-3">
                                <div class="d-flex align-items-center">
                                    <span class="text-dark mr-3">
                                        <h3 class=""><?php echo $total_orders_today; ?></h3> <!-- Display total orders today -->
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Sales Today Card -->
                <div class="col-md-3 mb-3">
                    <div class="card bg-white border-0 circle-success theme-circle">
                        <div class="card-body">
                            <h4 class="text-dark">Sales Today</h4>
                            <?php
                                date_default_timezone_set('Asia/Manila'); // Ensure correct timezone is set
                                $today = date('Y-m-d'); // Get today's date
                                $query = "SELECT IFNULL(SUM(total_amount), 0) AS total_sales FROM orders WHERE DATE(date_created) = '$today'";
                                $result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_assoc($result);
                                $total_sales = $row['total_sales'] ? $row['total_sales'] : 0; // Default to 0 if no sales
                            ?>
                            <div class="mt-3">
                                <div class="d-flex align-items-center">
                                    <span class="text-dark mr-3">
                                        <h3 class=""><?php echo '₱' . number_format($total_sales, 2); ?></h3> <!-- Display total sales with peso sign -->
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Customers Account Card -->
                <div class="col-md-3 mb-3">
                    <div class="card bg-white border-0 circle-info theme-circle">
                        <div class="card-body">
                            <h4 class="text-dark">Total Customers Account</h4> <!-- Title updated to reflect customer count -->
                            <?php
                                $query = "SELECT COUNT(*) AS total_rows FROM users WHERE type = 3";
                                $result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_assoc($result);
                                $total_rows = $row['total_rows'];
                            ?>
                            <div class="mt-3">
                                <div class="d-flex align-items-center">
                                    <span class="text-dark mr-3">
                                        <h3 class=""><?php echo $total_rows; ?></h3> <!-- Display the count of customers -->
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Table Panel -->
</div>
</div>

<?php include 'footer.php'; ?>

<script>
    $('#manage-records').submit(function(e) {
        e.preventDefault();
        start_load();
        const inChargeUser = "<?php echo $_SESSION['login_name']; ?>"; // Logged-in user for in_charge
        const formData = new FormData($(this)[0]);
        formData.append('in_charge', inChargeUser);

        $.ajax({
            url: 'ajax.php?action=save_track',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            success: function(resp) {
                resp = JSON.parse(resp);
                if(resp.status == 1) {
                    alert_toast("Data successfully saved", 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 800);
                }
            }
        });
    });

    $('#tracking_id').on('keypress', function(e) {
        if(e.which == 13) {
            get_person();
        }
    });

    $('#check').on('click', function() {
        get_person();
    });

    function get_person() {
        start_load();
        $.ajax({
            url: 'ajax.php?action=get_person',
            method: 'POST',
            data: { tracking_id: $('#tracking_id').val() },
            success: function(resp) {
                if(resp) {
                    $('#person').html(resp);
                } else {
                    alert_toast("No record found.", 'warning');
                }
                end_load();
            }
        });
    }
</script>
