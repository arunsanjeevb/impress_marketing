<?php
$prefix = '';
$prefix1 = '../';

session_start();
$location = "index.php";
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    header("Location:$location");
    exit;
}
include_once 'db.php';
$id = $i = '';


if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Impress Marketing || Dashboard </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="your,keywords">
    <meta name="description" content="Short explanation about this website">
    <?php include_once 'include/css.php'; ?>
    <link type="text/css" rel="stylesheet"
          href="../<?php echo $prefix; ?>templeteV2/assets/css/theme-default/libs/morris/morris.core.css?1420463396"/>
    <link type="text/css" rel="stylesheet"
          href="../templeteV2/assets/css/theme-default/libs/summernote/summernote.css?1425218701"/>
    <script src="include1/daterange/moment.min.js"></script>
    <link type="text/css" rel="stylesheet" href="include1/daterange/daterangepicker.css"/>

    <style>
        #vizzuCanvas {
            width: 100%;
            height: 446px;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .blinking {
            animation: blinkingText 1.2s infinite;
        }

        @keyframes blinkingText {
            0% {
                color: red;
            }
            49% {
                color: red;
            }
            60% {
                color: transparent;
            }
            99% {
                color: transparent;
            }
            100% {
                color: red;
            }
        }

        .content_img span {
            border: 2px solid red;
            display: inline-block;
            /*width: 99%;*/
            text-align: center;
            color: red;
        }

        .content_img span:hover {
            cursor: pointer;
        }

        .img-wrap {
            position: relative;
            display: inline-block;
            font-size: 0;
        }

        .img-wrap .close1 {
            position: absolute;
            top: 2px;
            right: 2px;
            z-index: 100;
            background-color: red;
            padding: 5px 2px 2px;
            color: #000;
            font-weight: bold;
            cursor: pointer;
            opacity: .2;
            text-align: center;
            font-size: 22px;
            line-height: 10px;
            border-radius: 50%;
        }

        .note-editor .note-editable {
            padding: 10px;
            overflow: auto;
            outline: none;
            height: 250px !important;;
        }

        .img-wrap:hover .close1 {
            opacity: 1;
        }
    </style>

</head>

<body class="menubar-hoverable header-fixed ">
<?php include_once 'include/header.php'; ?>
<div id="base">
    <div class="offcanvas">
    </div>

    <?php include_once 'include/menubar.php'; ?>
</div>

<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/jquery/jquery-1.11.2.min.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/jquery-ui/jquery-ui.min.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/bootstrap/bootstrap.min.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/spin.js/spin.min.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/autosize/jquery.autosize.min.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/select2/select2.min.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/multi-select/jquery.multi-select.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/inputmask/jquery.inputmask.bundle.min.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/moment/moment.min.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/DataTables/jquery.dataTables.min.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/DataTables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/jquery-validation/dist/additional-methods.min.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/toastr/toastr.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/core/source/App.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/core/source/AppNavigation.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/core/source/AppOffcanvas.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/core/source/AppCard.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/core/source/AppForm.js"></script>
<!--<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/ckeditor/ckeditor.js"></script>-->
<!--<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/ckeditor/adapters/jquery.js"></script>-->
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/summernote/summernote.min.js"></script>
<script src="include/daterange/daterangepicker.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/core/source/AppNavSearch.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/core/source/AppVendor.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/core/demo/Demo.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/core/demo/DemoFormComponents.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/raphael/raphael-min.js"></script>
<script src="../<?php echo $prefix; ?>templeteV2/assets/js/libs/morris.js/morris.min.js"></script>
<!--<script src="include/DashboardCharts.js"></script>-->

<script>
    <?php if ($msg == '2') { ?>
    Command: toastr["success"]("Product added sucesssfully", "Sucesss")
    <?php } elseif ($msg == '1') {
    ?>
    Command: toastr["error"]("Same Product already exist", "Error")
    <?php } elseif ($msg == '3') { ?>
    Command: toastr["success"]("Product Updated Sucesssfully", "Sucesss")
    <?php } elseif ($msg == '4') { ?>
    Command: toastr["success"]("Product Deleted Sucesssfully", "Sucesss")
    <?php } ?>
</script>

</body>
</html>