<?php

//session_start();
//session_destroy();
$error = $prefix = "";
$prefix1 = '';
include_once 'db.php';
// print_r($_COOKIE);
//echo  '<pre>';
//print_r($_SESSION);
//echo  '</pre>';
// exit;

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}
if (isset($_POST['username'])) {
//    print_r($_POST); exit;
    $user = mysqli_real_escape_string($mysql_conn, $_POST['username']);
    $pass = mysqli_real_escape_string($mysql_conn, $_POST['password']);
    $sql = "select * from `nithrausers` where username='$user' AND password='$pass' ";
//    echo $sql;exit();
//    $result = mysqli_query($mysql_conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($sql));
    $result = mysqli_query($mysql_conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num) {
        session_start();
        $_SESSION['user'] = $user;

        header("Location: dashboard.php");
    }else{
        header("Location: index.php?msg=1");

    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Impress Marketing || Login</title>
    <meta charset="UTF-8">
    <link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet'
          type='text/css'/>
    <link type="text/css" rel="stylesheet"
          href="../<?php echo $prefix; ?>templeteV2/assets/css/theme-3/bootstrap.css?1422792965"/>
    <link type="text/css" rel="stylesheet"
          href="../<?php echo $prefix; ?>templeteV2/assets/css/theme-3/materialadmin.css?1425466319"/>
    <link type="text/css" rel="stylesheet"
          href="../<?php echo $prefix; ?>templeteV2/assets/css/theme-3/font-awesome.min.css?1422529194"/>
    <link type="text/css" rel="stylesheet"
          href="../<?php echo $prefix; ?>templeteV2/assets/css/theme-3/material-design-iconic-font.min.css?1421434286"/>
    <link type="text/css" rel="stylesheet"
          href="../<?php echo $prefix; ?>templeteV2/assets/css/theme-3/libs/toastr/toastr.css?1425466569"/>

</head>
<body class="menubar-hoverable header-fixed ">
<!-- BEGIN LOGIN SECTION -->
<section class="section-account">
    <div class="spacer"></div>
    <div class="card contain-sm style-transparent">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <br/>
                    <span class="text-lg text-bold text-primary">Impress Marketing - Admin</span>
                    <br/><br/>
                    <form class="form floating-label" action="" accept-charset="utf-8" method="post">

                        <div class="form-group">
                            <input type="text" class="form-control" id="username" name="username" required="true">
                            <label for="username">Username</label>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" required="true">
                            <label for="password">Password</label>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-xs-12 text-right">
                                <button class="btn btn-primary btn-raised" type="submit">Login</button>
                            </div><!--end .col -->
                        </div><!--end .row -->
                    </form>
                </div><!--end .col -->
            </div><!--end .row -->
        </div><!--end .card-body -->
    </div><!--end .card -->
</section>
<!-- END LOGIN SECTION -->


<!-- BEGIN JAVASCRIPT -->
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/jquery/jquery-1.11.2.min.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/bootstrap/bootstrap.min.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/spin.js/spin.min.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/autosize/jquery.autosize.min.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/moment/moment.min.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/toastr/toastr.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/core/source/App.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/core/source/AppNavigation.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/core/source/AppOffcanvas.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/core/source/AppCard.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/core/source/AppForm.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/core/source/AppNavSearch.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/core/source/AppVendor.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/core/demo/Demo.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/core/demo/DemoFormLayouts.js"></script>
<!-- END JAVASCRIPT -->
<script>
<!--    --><?php //if ($msg == '2') {
//    ?>
//    Command: toastr["error"]("In-correct User name and Password", "Error")
//    <?php //}
//
//    ?>

<?php if ($msg == '1') { ?>
Command: toastr["error"]("In-correct User name and Password", "Error")
<?php } else { ?>
<?php  } ?>


</script>
<script type="text/javascript">
    $(document).ready(function () {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-center",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    });
</script>

</body>
</html>
