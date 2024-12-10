<?php include('db_connect.php');?>
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <!-- Category List Panel -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>Category List</b>
                        <span class="float:right">

                        </span>
                    </div>
                    <a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="javascript:void(0)" data-toggle="modal" data-target="#categoryModal" id="new_category">
                                <i class="fa fa-plus"></i> Add Category
                            </a>
                    <div class="card-body">
                        <table class="table table-hover">
                            
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                $category = $conn->query("SELECT * FROM categories order by id asc");
                                while($row=$category->fetch_assoc()):
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td><?php echo $row['name'] ?></td>
                                    <td><?php echo $row['description'] ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-danger delete_category" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Table Panel -->
        </div>
    </div>    
</div>

<!-- Modal for Category Form -->
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="categoryModalLabel">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" id="manage-category">
        <div class="modal-body">
          <input type="hidden" name="id">
          <div class="form-group">
            <label class="control-label">Name</label>
            <input type="text" class="form-control" name="name" required>
          </div>
          <div class="form-group">
            <label class="control-label">Description</label>
            <textarea name="description" id="description" cols="30" rows="4" class="form-control"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
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
</style>

<script>
    $('#manage-category').on('reset', function() {
        $('input:hidden').val('');
    });

    $('#manage-category').submit(function(e) {
        e.preventDefault();
        start_load();
        $.ajax({
            url: 'ajax.php?action=save_category',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully added", 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else if (resp == 2) {
                    alert_toast("Data successfully updated", 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
            }
        });
    });

    $('.delete_category').click(function() {
        _conf("Are you sure to delete this category?", "delete_category", [$(this).attr('data-id')]);
    });

    function delete_category($id) {
        start_load();
        $.ajax({
            url: 'ajax.php?action=delete_category',
            method: 'POST',
            data: { id: $id },
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully deleted", 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
            }
        });
    }

    $('table').dataTable();

    function start_load() {
        // Add your loading animation logic here
    }

    function end_load() {
        // Add your stop loading animation logic here
    }

    function alert_toast(message, type) {
        // Add your toast alert logic here
    }
</script>

<!-- Include your custom CSS/JS files -->
<link rel="icon" type="image/x-icon" href="assets/uploads/fava.png">
<meta content="" name="description">
<meta content="" name="keywords">

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

