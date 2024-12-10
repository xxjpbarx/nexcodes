<?php
include 'db_connect.php';
// Retrieve the filter type (weekly or monthly) from the URL
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'monthly';  // Default to monthly if not set
$date_filter = isset($_GET['date_filter']) ? $_GET['date_filter'] : date('Y-m'); // Default to current month if no date filter

// Define query based on the filter type
if ($filter == 'weekly') {
    // Default to current week
    $week_filter = isset($_GET['week']) ? $_GET['week'] : date('Y-\WW');
    $week_filter = str_replace('-', '', $week_filter); // Remove dash if exists
    $query = "SELECT * FROM orders WHERE amount_tendered > 0 AND YEARWEEK(date_created, 1) = YEARWEEK('$week_filter', 1) ORDER BY unix_timestamp(date_created) ASC";
} else {
    // Monthly report query
    $query = "SELECT * FROM orders WHERE amount_tendered > 0 AND date_format(date_created, '%Y-%m') = '$date_filter' ORDER BY unix_timestamp(date_created) ASC";
}

// Execute the query
$sales = $conn->query($query);
?>
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="card">
            <div class="card_body">
                <div class="row justify-content-center pt-4">
                    <label for="" class="mt-2" style="color: white;">Monthly Report</label>
                    <div class="col-sm-3">

                    </div>
                </div>

                <div class="row justify-content-center pt-4">
                    <label for="" class="mt-2"><?php echo ($filter == 'monthly') ? 'Month' : 'Week'; ?></label>
                    <div class="col-sm-3">
                        <?php if ($filter == 'monthly'): ?>
                            <input type="month" name="month" id="month" value="<?php echo $date_filter ?>" class="form-control">
                        <?php else: ?>
                            <input type="week" name="week" id="week" value="<?php echo $date_filter ?>" class="form-control">
                        <?php endif; ?>
                    </div>
                </div>
                <hr>

                <div class="col-md-12">
                    <table class="table table-bordered" id="report-list">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="">Date</th>
                                <th class="">Invoice</th>
                                <th class="">Order Number</th>
                                <th class="">Amount</th>
                            </tr>
                        </thead>

                        <tbody>
                          <?php
                          $i = 1;
                          $total = 0;
                          if ($sales->num_rows > 0):
                              while ($row = $sales->fetch_array()):
                                  $total += $row['total_amount'];
                          ?>
                          <tr>
                              <td class="text-center"><?php echo $i++ ?></td>
                              <td>
                                  <p> <b><?php echo date("M d, Y", strtotime($row['date_created'])) ?></b></p>
                              </td>
                              <td>
                                  <p> <b><?php echo $row['amount_tendered'] > 0 ? $row['ref_no'] : 'N/A' ?></b></p>
                              </td>
                              <td>
                                  <p> <b><?php echo $row['order_number'] ?></b></p>
                              </td>
                              <td>
                                  <p class="text-right"> <b>₱<?php echo number_format($row['total_amount'], 2) ?></b></p>
                              </td>
                          </tr>
                          <?php 
                              endwhile;
                          else:
                          ?>
                          <tr>
                              <th class="text-center" colspan="5">No Data.</th>
                          </tr>
                          <?php 
                          endif;
                          ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-right">Total</th>
                                <th class="text-right">₱<?php echo number_format($total, 2) ?></th>
                            </tr>
                        </tfoot>
                    </table>
                    <hr>
                    <div class="col-md-12 mb-4">
                        <center>
                            <button class="btn btn-success btn-sm col-sm-3" type="button" id="print"><i class="fa fa-print"></i> Print</button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<noscript>
    <style>
        table#report-list {
            width:100%;
            border-collapse:collapse
        }
        table#report-list td, table#report-list th {
            border:1px solid
        }
        p {
            margin:unset;
        }
        .text-center {
            text-align:center
        }
        .text-right {
            text-align:right
        }
    </style>
</noscript>

<script>
    $(document).ready(function(){ $('table').dataTable();});

    // Change report type (weekly/monthly)
    $('#report_type').change(function(){
        var reportType = $(this).val();
        var url = 'index.php?page=sales_report&filter=' + reportType;
        location.replace(url);
    });

    // Change month or week selection
    $('#month, #week').change(function(){
        var reportType = $('#report_type').val();
        var dateFilter = $(this).val();
        location.replace('index.php?page=sales_report&filter=' + reportType + '&date_filter=' + dateFilter);
    });

    // Print the report
    $('#print').click(function(){
        var _c = $('#report-list').clone();
        var ns = $('noscript').clone();
        ns.append(_c);
        var nw = window.open('', '_blank', 'width=900,height=600');
        nw.document.write('<p class="text-center"><b>Order Report for <?php echo ($filter == "monthly") ? date("F, Y", strtotime($date_filter)) : "Week of " . date("Y-\WW", strtotime($date_filter)); ?></b></p>');
        nw.document.write(ns.html());
        nw.document.close();
        nw.print();
        setTimeout(() => {
            nw.close();
        }, 500);
    });
</script>
