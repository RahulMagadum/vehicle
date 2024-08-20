<?php
session_start();
include ('vendor/inc/config.php');
include ('vendor/inc/checklogin.php');
check_login();
$aid = $_SESSION['u_id'];

// Update Password
if (isset($_POST['update_password'])) {
    $u_id = $_SESSION['u_id'];
    $old_pwd = $_POST['old_pwd'];
    $new_pwd = $_POST['new_pwd'];
    $confirm_pwd = $_POST['confirm_pwd'];

    // Fetch the current password from the database
    $query = "SELECT u_pwd FROM tms_user WHERE u_id=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $u_id);
    $stmt->execute();
    $stmt->bind_result($db_old_pwd);
    $stmt->fetch();
    $stmt->close();

    // Check if the old password matches the one in the database
    if ($db_old_pwd === null) {
        $err = "User not found.";
    } elseif ($old_pwd === $db_old_pwd) {
        // Check if the new password and confirm password match
        if ($new_pwd === $confirm_pwd) {
            // Update the password
            $query = "UPDATE tms_user SET u_pwd=? WHERE u_id=?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('si', $new_pwd, $u_id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $succ = "Password Updated Successfully";
            } else {
                $err = "Password Update Failed. Please Try Again Later";
            }
            $stmt->close();
        } else {
            $err = "New Password and Confirm Password do not match";
        }
    } else {
        $err = "Old Password is incorrect";
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

                <p>

                </p>
                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="user-dashboard.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">Profile</li>
                    <li class="breadcrumb-item active">Change Password</li>
                </ol>
                <hr>
                <div class="card">
                    <div class="card-header">
                        Change Password
                    </div>
                    <div class="card-body">
                        <!-- Update Password Form -->
                        <form method="POST">
                            <div class="form-group">
                                <label for="old_pwd">Old Password</label>
                                <input type="password" class="form-control" id="old_pwd" name="old_pwd" required>
                            </div>

                            <div class="form-group">
                                <label for="new_pwd">New Password</label>
                                <input type="password" class="form-control" id="new_pwd" name="new_pwd" required>
                            </div>

                            <div class="form-group">
                                <label for="confirm_pwd">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_pwd" name="confirm_pwd"
                                    required>
                            </div>

                            <button type="submit" name="update_password" class="btn btn-outline-danger">Change
                                Password</button>
                        </form>
                        <!-- End Form-->
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
        <!-- Inject Sweet alert js-->
        <script src="vendor/js/swal.js"></script>

</body>

</html>