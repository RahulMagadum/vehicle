<?php
session_start();
include('vendor/inc/config.php');
include('vendor/inc/checklogin.php');
check_login();
$aid = $_SESSION['a_id'];
?>

<!DOCTYPE html>
<html lang="en">

<?php include('vendor/inc/head.php'); ?>

<body id="page-top">

    <?php include("vendor/inc/nav.php"); ?>

    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('vendor/inc/sidebar.php'); ?>

        <div id="content-wrapper">

            <div class="container-fluid">
                <p>
                </p>
                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">User</a>
                    </li>
                    <li class="breadcrumb-item active">Add Booking</li>
                </ol>

                <!-- DataTables Example -->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-users"></i>
                        Registered Users
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Pickup Location</th>
                                        <th>Drop Location</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php
                                // SQL query to select all users with the category 'User'
                                $ret = "SELECT * FROM tms_user WHERE u_category = 'User'";
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); // Execute the query
                                $res = $stmt->get_result(); // Get the result set
                                $cnt = 1; // Counter for user entries
                                while ($row = $res->fetch_object()) { // Fetch each row as an object
                                    ?>

                                    <tbody>
                                        <tr>
                                            <td><?php echo $cnt; ?></td>
                                            <td><?php echo $row->u_fname; ?>     <?php echo $row->u_lname; ?></td>
                                            <td><?php echo $row->u_phone; ?></td>
                                            <td><?php echo $row->u_addr; ?></td>
                                            <td><?php echo $row->u_email; ?></td>
                                            <td><?php echo $row->pickup_location; ?></td>
                                            <td><?php echo $row->drop_location; ?></td>
                                            <td>
                                                <a href="admin-add-booking-usr.php?u_id=<?php echo $row->u_id; ?>&pickup_location=<?php echo urlencode($row->pickup_location); ?>&drop_location=<?php echo urlencode($row->drop_location); ?>"
                                                    class="badge badge-success">
                                                    <i class="fa fa-clipboard"></i>
                                                    Book Vehicle
                                                </a>
                                            </td>


                                        </tr>
                                    </tbody>
                                    <?php $cnt = $cnt + 1; // Increment the counter
                                } ?>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sticky Footer -->
            <?php include("vendor/inc/footer.php"); ?>
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
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>