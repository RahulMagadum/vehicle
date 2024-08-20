<?php
include ('vendor/inc/config.php');

if (isset($_POST['add_user'])) {
    $u_fname = $_POST['u_fname'];
    $u_lname = $_POST['u_lname'];
    $u_phone = $_POST['u_phone'];
    $u_addr = $_POST['u_addr'];
    $u_email = $_POST['u_email'];
    $u_pwd = $_POST['u_pwd'];
    $u_category = 'User'; // Fixed value as per the hidden input

    $query = "INSERT INTO `tms_user` (u_fname, u_lname, u_phone, u_addr, u_category, u_email, u_pwd) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('sssssss', $u_fname, $u_lname, $u_phone, $u_addr, $u_category, $u_email, $u_pwd);

    if ($stmt->execute()) {
        $succ = "Account Created. Proceed To Log In.";
        header("refresh:3;url=index.php"); // Redirect to login page after 3 seconds
    } else {
        $err = "Please Try Again Later.";
    }

    $stmt->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Transport Management System, Saccos, Matwana Culture">
    <meta name="author" content="MartDevelopers ">

    <title>Transport Management System Client - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="vendor/css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
    <?php if (isset($succ)) { ?>
        <script>
            setTimeout(function () {
                swal("Success!", "<?php echo $succ; ?>", "success");
            }, 100);
        </script>
    <?php } ?>
    <?php if (isset($err)) { ?>
        <script>
            setTimeout(function () {
                swal("Failed!", "<?php echo $err; ?>", "error");
            }, 100);
        </script>
    <?php } ?>
    <div class="container">
        <p>

        </p>
        <div class="card card-register mx-auto mt-5">
            <div class="card-header">Create An Account With Us</div>
            <div class="card-body">
                <!-- Start Form -->
                <form method="post">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-label-group">
                                    <input type="text" required class="form-control" name="u_fname" id="u_fname">
                                    <label for="u_fname">First name</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-label-group">
                                    <input type="text" required class="form-control" name="u_lname" id="u_lname">
                                    <label for="u_lname">Last name</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-label-group">
                                    <input type="text" required class="form-control" name="u_phone" id="u_phone">
                                    <label for="u_phone">Contact</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" required class="form-control" name="u_addr" id="u_addr">
                            <label for="u_addr">Address</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="email" required class="form-control" name="u_email" id="u_email">
                            <label for="u_email">Email address</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-label-group">
                                    <input type="password" required class="form-control" name="u_pwd" id="u_pwd">
                                    <label for="u_pwd">Password</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="add_user" class="btn btn-success">Create Account</button>
                </form>
                <!-- End Form -->
                <div class="text-center">
                    <a class="d-block small mt-3" href="index.php">Login Page</a>
                    <a class="d-block small" href="usr-forgot-pwd.php">Forgot Password?</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Inject Sweet alert js -->
    <script src="vendor/js/swal.js"></script>
</body>

</html>