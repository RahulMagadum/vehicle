<?php
session_start();
include ('vendor/inc/config.php');
include ('vendor/inc/checklogin.php');
check_login();
$aid = $_SESSION['u_id'];

// Check if user already has a booking
if (isset($_POST['book_vehicle'])) {
    $u_id = $_SESSION['u_id'];

    // Query to check if the user already has a booking
    $check_query = "SELECT * FROM tms_user WHERE u_id=? AND u_car_book_status='Pending'";
    $stmt = $mysqli->prepare($check_query);
    $stmt->bind_param('i', $u_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $err = "You already have an existing booking.";
    } else {
        // Proceed with booking if no existing bookings found
        $u_car_type = $_POST['u_car_type'];
        $u_car_regno = $_POST['u_car_regno'];
        $u_car_bookdate = $_POST['u_car_bookdate'];
        $u_car_book_status = $_POST['u_car_book_status'];

        $query = "UPDATE tms_user SET u_car_type=?, u_car_bookdate=?, u_car_regno=?, u_car_book_status=? WHERE u_id=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('ssssi', $u_car_type, $u_car_bookdate, $u_car_regno, $u_car_book_status, $u_id);
        $stmt->execute();
        if ($stmt) {
            $succ = "Booking Submitted";
        } else {
            $err = "Please Try Again Later";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include ('vendor/inc/head.php'); ?>

<body id="page-top">
    <!--Start Navigation Bar-->
    <?php include ("vendor/inc/nav.php"); ?>
    <!--Navigation Bar-->

    <div id="wrapper">
        <!-- Sidebar -->
        <?php include ("vendor/inc/sidebar.php"); ?>
        <!--End Sidebar-->
        <div id="content-wrapper">
            <div class="container-fluid">
                <?php if (isset($succ)) { ?>
                    <!--This code for injecting an alert-->
                    <script>
                        setTimeout(function () {
                            swal("Success!", "<?php echo $succ; ?>!", "success");
                        }, 100);
                    </script>
                <?php } ?>
                <?php if (isset($err)) { ?>
                    <!--This code for injecting an alert-->
                    <script>
                        setTimeout(function () {
                            swal("Failed!", "<?php echo $err; ?>!", "error");
                        }, 100);
                    </script>
                <?php } ?>
                <p></p>
                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="user-dashboard.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">Online Car</li>
                    <li class="breadcrumb-item ">Book Online Car</li>
                    <li class="breadcrumb-item active">Confirm Booking</li>
                </ol>
                <hr>
                <div class="card">
                    <div class="card-header">
                        Confirm Booking
                    </div>
                    <div class="card-body">
                        <!-- Add User Form -->
                        <?php
                        $aid = $_GET['v_id'];
                        $ret = "SELECT v_category, v_reg_no, v_name, v_driver FROM tms_vehicle WHERE v_id=?";
                        $stmt = $mysqli->prepare($ret);
                        $stmt->bind_param('i', $aid);
                        $stmt->execute();
                        $res = $stmt->get_result();
                        while ($row = $res->fetch_object()) {
                            ?>

                            <form method="POST">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Online Car Category</label>
                                    <input type="text" value="<?php echo $row->v_category; ?>" readonly class="form-control"
                                        name="u_car_type">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Online Car Registration Number</label>
                                    <input type="text" value="<?php echo $row->v_reg_no; ?>" readonly class="form-control"
                                        name="u_car_regno">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Car Name</label>
                                    <input type="text" value="<?php echo $row->v_name; ?>" readonly class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Car Driver</label>
                                    <input type="text" value="<?php echo $row->v_driver; ?>" readonly class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Booking Date</label>
                                    <input type="date" class="form-control" id="exampleInputEmail1" name="u_car_bookdate">
                                </div>
                                <div class="form-group" style="display:none">
                                    <label for="exampleInputEmail1">Book Status</label>
                                    <input type="text" value="Pending" class="form-control" id="exampleInputEmail1"
                                        name="u_car_book_status">
                                </div>

                                <button type="submit" name="book_vehicle" class="btn btn-success">Confirm Booking</button>
                            </form>
                            <!-- End Form -->
                        <?php } ?>
                    </div>
                </div>

                <hr>
                <!-- Sticky Footer -->
                <?php include ("vendor/inc/footer.php"); ?>
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- /#wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger" href="admin-logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Page level plugin JavaScript-->
        <script src="vendor/chart.js/Chart.min.js"></script>
        <script src="vendor/datatables/jquery.dataTables.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="vendor/js/sb-admin.min.js"></script>

        <!-- Demo scripts for this page-->
        <script src="vendor/js/demo/datatables-demo.js"></script>
        <script src="vendor/js/demo/chart-area-demo.js"></script>
        <!-- Inject Sweet alert js -->
        <script src="vendor/js/swal.js"></script>
</body>

</html>