<?php
session_start();
include ('admin/vendor/inc/config.php');
//include('vendor/inc/checklogin.php');
//check_login();
//$aid=$_SESSION['a_id'];
?>

<!DOCTYPE html>
<html lang="en">

<!--Head-->
<?php include ("vendor/inc/head.php"); ?>
<!--End Head-->
<style>
    /* Ensure all images are the same size and fit within the box */
    .img-box {
        width: 100%;
        /* Make the box take up the full width of its container */
        height: 200px;
        /* Set a fixed height for uniformity */
        overflow: hidden;
        /* Hide any overflow from images */
        position: relative;
        margin-bottom: 1rem;
        /* Add some space below each image box */
    }

    .img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Ensure the image covers the box */
        display: block;
        /* Remove any unwanted space below the image */
    }

    /* Ensure row layout looks clean */
    .row {
        margin-bottom: 1.5rem;
        border-radius: .5rem;
        overflow: hidden;
        background: #ffffff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .row:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    /* Spacing and padding adjustments */
    .col-md-7 {
        padding: 0;
    }

    .col-md-5 {
        padding: 15px;
    }
</style>

<body>


    <!-- Navigation -->
    <?php include ("vendor/inc/nav.php"); ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">Our Gallery
        </h1>

        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active">Gallery</li>
        </ol>
        <?php

        $ret = "SELECT * FROM tms_vehicle  ORDER BY RAND() LIMIT 10 "; //get all feedbacks
        $stmt = $mysqli->prepare($ret);
        $stmt->execute();//ok
        $res = $stmt->get_result();
        $cnt = 1;
        while ($row = $res->fetch_object()) {
            ?>

            <!-- Project One -->
            <div class="row">
                <div class="col-md-7">
                    <a href="#">
                        <img class="img-fluid rounded mb-3 mb-md-0" src="vendor/img/<?php echo $row->v_dpic; ?>" alt="">
                    </a>
                </div>
                <div class="col-md-5">
                    <h3><?php echo $row->v_category; ?></h3>
                    <ul class="list-group list-group-horizontal">
                        <li class="list-group-item"><?php echo $row->v_name; ?></li>
                        <li class="list-group-item"><?php echo $row->v_pass_no; ?></li>
                        <li class="list-group-item"><span class="badge badge-success">Available</span></li>
                        <li class="list-group-item"><?php echo $row->v_reg_no; ?></li>
                    </ul><br>
                    <a class="btn btn-success" href="usr/">Hire Vehicle
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
            <!-- /.row -->

            <hr>
        <?php } ?>

        <hr>


    </div>

    <?php include ("vendor/inc/footer.php"); ?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>