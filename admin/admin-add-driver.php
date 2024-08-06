<?php
session_start();
include ('vendor/inc/config.php');
include ('vendor/inc/checklogin.php');
check_login();
$aid = $_SESSION['a_id'];

// Add Driver
if (isset($_POST['add_driver'])) {
    $u_fname = $_POST['u_fname'];
    $u_lname = $_POST['u_lname'];
    $u_phone = $_POST['u_phone'];
    $u_addr = $_POST['u_addr'];
    $u_email = $_POST['u_email'];
    $u_pwd = $_POST['u_pwd'];
    $u_category = 'Driver'; // Set category to 'Driver' directly

    // Hash the password for security
    $hashed_pwd = password_hash($u_pwd, PASSWORD_BCRYPT);

    $query = "INSERT INTO tms_user (u_fname, u_lname, u_phone, u_addr, u_category, u_email, u_pwd) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('sssssss', $u_fname, $u_lname, $u_phone, $u_addr, $u_category, $u_email, $hashed_pwd);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $succ = "Driver Added Successfully";
    } else {
        $err = "Failed to Add Driver. Please Try Again Later";
    }
    $stmt->close();
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
                    <!-- Success alert -->
                    <script>
                        setTimeout(function () {
                            swal("Success!", "<?php echo $succ; ?>!", "success");
                        }, 100);
                    </script>
                <?php } ?>
                <?php if (isset($err)) { ?>
                    <!-- Error alert -->
                    <script>
                        setTimeout(function () {
                            swal("Failed!", "<?php echo $err; ?>!", "error");
                        }, 100);
                    </script>
                <?php } ?>

                <p>
                </p>
                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Drivers</a>
                    </li>
                    <li class="breadcrumb-item active">Add Driver</li>
                </ol>
                <hr>

                <div class="card">
                    <div class="card-header">
                        Add Driver
                    </div>
                    <div class="card-body">
                        <!-- Add Driver Form -->
                        <form method="POST">
                            <div class="form-group">
                                <label for="exampleInputEmail1">First Name</label>
                                <input type="text" required class="form-control" id="exampleInputEmail1" name="u_fname">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Last Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="u_lname">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Contact</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="u_phone">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="u_addr">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" name="u_email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" name="u_pwd" id="exampleInputPassword1">
                            </div>
                            <button type="submit" name="add_driver" class="btn btn-success">Add Driver</button>
                        </form>
                        <!-- End Form -->
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
        <!-- Inject Sweet Alert JS -->
        <script src="vendor/js/swal.js"></script>

</body>

</html>