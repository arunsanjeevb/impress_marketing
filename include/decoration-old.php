<?php
$prefix = '../';
$prefix1 = '../../../';
session_start();
$user = $_SESSION['user'];
include_once $prefix . 'db.php';
$location = $prefix . "index.php";
include_once '../invoice_order.php';
if (isset($_SESSION['user'])) {
    
} else {
    header("Location: $location");
    exit;
}
$region = $id = $msg = $etype = $ediscount = $edistrict = $eoffer_startdate = $eoffer_enddate = $eenter_amt = '';
$no_of_months = $validity = $off_startdate = $off_enddate = $new_plan_amt = $discount = $eisactive = $ecategory = '';
$off_startdate = $off_enddate = $allurl2 = '';

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
} else {
    $user_id = "";
}

$sql = "SELECT `id`, `name` FROM `registration`";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
//    $get_username[$row['id']] = $row['name'];
    $get_username = $row['id'];
}
$sql = "SELECT `id`, `name` FROM `service_type`";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $get_typename[$row['id']] = $row['name'];
}
$sql = "SELECT `id`, `tamil` FROM `n_district`";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $get_distrctname[$row['id']] = $row['tamil'];
}
$sql = "SELECT `id`, `tamil` FROM `city`";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $get_cityname[$row['id']] = $row['tamil'];
}
$sql = "SELECT `id`, `name` FROM `planmaster`";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $get_planname[$row['id']] = $row['name'];
}
$sql = "SELECT `id`, `features_type` FROM `features_table` where `service_type`='2' order by `id` asc ";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $get_dec_type_name[$row['id']] = $row['features_type'];
}
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}
//
//if (isset($_POST['delete_images'])) {
//    $img = $_POST['img_array'];
//    $imagearray = explode(',', $img);
////    echo $imagearray;
//    $img_key = $_POST['delete_images'];
//    if (($key = array_search($img_key, $imagearray)) !== false) {
//        unset($imagearray[$key]);
//    }
//    $im = explode(',', $img_key);
////    print_r($im);
////    $im = implode(',', $imagearray);
////    $im = explode(',', $im);
//    $sqlimg = "select `images` from `decoration_table` WHERE FIND_IN_SET('$img_key', images) and `is_delete`='0'";
////    echo $sqlimg;
//    $resultpo = mysqli_query($conn, $sqlimg);
//    while ($row2po = mysqli_fetch_assoc($resultpo)) {
//        $iimages = explode(',', $row2po['images']);
//        foreach ($iimages as $valueimg) {
//            if(in_array($im, $iimages)){
//                
//            } else {
//                $delected_img = $valueimg;
//            }
//        }
//    }
//    echo $delected_img;
//    print_r($iimages);print_r($imagearray);exit;
//    echo $im;
//    exit;
//}
if (isset($_GET['editid'])) {
    $id = $_GET['editid'];
    $sql = "SELECT * FROM `decoration_table` WHERE `id` = '$id'";
//    echo $sql;
    $result = mysqli_query($conn, $sql);
    while ($row2 = mysqli_fetch_assoc($result)) {

        $euser_id = $row2['user_id'];
        $edec_org_name = $row2['dec_org_name'];
        $edec_name = $row2['dec_name'];
        $edec_phone_no = $row2['dec_phone_no'];
        $edec_alternative_mno = $row2['dec_alternative_mno'];
        $edec_address = $row2['dec_address'];
        $edistrict = $row2['district'];
        $ecity = $row2['city'];
        $edec_landmark = $row2['dec_landmark'];
        $pincode = $row2['pincode'];
        $eexp = $row2['exp'];
        $exp = $row2['exp'];
        $edec_event_name = explode(',', $row2['dec_event_name']);
//        $edec_type = explode(',', $row2['dec_type']);
//        $edec_type = explode(',', $row2['dec_type']);
//        $eimages = $row2['images'];
        $eimages = explode(',', $row2['images']);
        $eimages1 = $row2['images'];
//        $eservice_plan = $row2['service_plan'];
        $eservice_plan = explode(',', $row2['service_plan']);
        $eemail_id = $row2['email_id'];
//        echo $eemail_id;exit;
        $efb_url = $row2['fb_url'];
        $egoogle_map_url = $row2['google_map_url'];
        $eyoutube_url = $row2['youtube_url'];
        $einsta_url = $row2['insta_url'];
        $eis_dnd = $row2['is_dnd'];
        $eis_active = $row2['is_active'];
        $eothers = $row2['others'];
        $ewebsite = $row2['website'];
    }
}
if (isset($_POST['save'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $serviceid = mysqli_real_escape_string($conn, $_POST['serviceid']);
    $decotrion_name = mysqli_real_escape_string($conn, $_POST['decotrion_name']);
    $manager_name = mysqli_real_escape_string($conn, $_POST['manager_name']);
    $mobile_number = mysqli_real_escape_string($conn, $_POST['mobile_number']);
    $alter_mobile_number = mysqli_real_escape_string($conn, $_POST['alter_mobile_number']);
    $district = mysqli_real_escape_string($conn, $_POST['district']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $landmark = mysqli_real_escape_string($conn, $_POST['landmark']);
    $decotrion_events = implode(',', $_POST['decotrion_events']);
//    $decotrion_types = implode(',', $_POST['decotrion_types']);
    $service_area = implode(',', $_POST['service_area']);
    $Instagram = mysqli_real_escape_string($conn, $_POST['Instagram']);
    $Facebook = mysqli_real_escape_string($conn, $_POST['Facebook']);
    $Youtube = mysqli_real_escape_string($conn, $_POST['Youtube']);
    $Website = mysqli_real_escape_string($conn, $_POST['Website']);
    $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
    $exp = mysqli_real_escape_string($conn, $_POST['exp']);
//    $pay_plan = mysqli_real_escape_string($conn, $_POST['pay_plan']);
    if (isset($_POST['pay_plan'])) {
        $pay_plan = mysqli_real_escape_string($conn, $_POST['pay_plan']);
    } else {
        $pay_plan = '';
    }
    if (isset($_POST['getidimges'])) {
//        $delete_images = $_POST['getidimges'];
        $delete_images = implode(',', $_POST['getidimges']);
    } else {
        $delete_images = '';
    }
    $others = mysqli_real_escape_string($conn, $_POST['others']);
    $is_dnd = mysqli_real_escape_string($conn, $_POST['is_dnd']);
    $main_folder = str_replace('\\', '/', dirname(__FILE__));
    $document_root = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
    $main_folder = str_replace($document_root, '', $main_folder);
    if ($main_folder) {
        $current_url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/' . ltrim($main_folder, '/') . '/';
    } else {
        $current_url = $_SERVER['REQUEST_SCHEME'] . '://' . rtrim($_SERVER['SERVER_NAME'], '/') . '/';
    }
//    echo $current_url;exit;
//    $allurl2 = '';
    if (!empty($_FILES)) {
        $s = 0;
        $total = count($_FILES['fileToUpload1']['name']['id' . $s]);
        $i = 0;
        $imagename = '';
//        $i = 0;
        if ($total != 0) {
            for ($j = 1; $j <= $total; $j++) {
                if (file_exists($_FILES["fileToUpload1"]["tmp_name"]['id' . $s][$i])) {
                    $img_array = explode('.', basename($_FILES["fileToUpload1"]["name"]['id' . $s][$i]));
                    $img_name = $img_array[0] . mt_rand(100000, 999999) . '_' . time() . '.' . $img_array[1];
                    $url = $current_url . "../profile_pic/" . $img_name;
                    $target_path = "../profile_pic/" . $img_name;
//echo $url;exit;
                    @move_uploaded_file($_FILES['fileToUpload1']['tmp_name']['id' . $s][$i], $target_path);
                    if ($j == 1) {
                        $allurl2 = $url;
                    } else {
                        $allurl2 .= "," . $url;
                    }
                }
                $i++;
            }
        }
    }
//echo $allurl2;exit;
    $cur_month = date('m');
    if ($cur_month > 3) {
        $year = date('Y') . "-" . date('y', strtotime('+1 year'));
    } else {
        $year = date('Y', strtotime('-1 year')) . "-" . date('y');
    }
    $inv_prefix = $year .= "/C";
    $sql_invoice = "Select `inv_prefix`, Max(`inv_no`) as `inv_no` from `pay_details` where `inv_prefix` = '$inv_prefix' ";
    $sql_result = mysqli_query($conn, $sql_invoice);
    if (mysqli_num_rows($sql_result)) {
        while ($sql_row = mysqli_fetch_assoc($sql_result)) {
            $inv_no = $sql_row['inv_no'] + 1;
        }
    } else {
        $inv_no = 1;
    }
    $inv_no = str_pad($inv_no, 5, "0", STR_PAD_LEFT);

    if ($pay_plan) {
        $sql2 = "SELECT `original`, `gst_percent`,`validity_days`  FROM `planmaster` WHERE `id` = '$pay_plan' ";
        $res2 = mysqli_query($conn, $sql2);
        while ($row2 = mysqli_fetch_assoc($res2)) {
            $act_amount = $row2['original'];
            $gst_percent = $row2['gst_percent'];
            $validity = $row2['validity_days'];
        }
        $gstamt = round(($gst_percent / 100) * $act_amount);
        $total_amt = round($act_amount + $gstamt);
    }
    if ($id) {
        if ($delete_images) {
            $resimg = "'" . $delete_images . "," . $resimg . "'";
        }
        if ($allurl2) {
            $resimg = trim($allurl2, ',');
            if ($eimages1) {
                $resimg = "'" . $eimages1 . "," . $resimg . "'";
            } else {
                $resimg = "'" . $resimg . "'";
            }
        } else {
            $resimg = "`images`";
        }

//        print_r ($delete_images);exit;
//        echo $delete_images;exit;
//        if ($delete_images) {
//            $resimg=$allurl2.','.$delete_images;
//        }else{
//         $resimg=$allurl2;   
//        }
//        echo $resimg;exit;
//        echo $delete_images;exit;
//print_r($delete_images);exit;
        $sql1 = "UPDATE `decoration_table` SET  `pincode`='$pincode',  `exp`='$exp',`user_id`='$user_id',`dec_org_name`='$decotrion_name',`dec_name`='$manager_name',`dec_phone_no`='$mobile_number',`dec_alternative_mno`='$alter_mobile_number',`dec_address`='$address',`district`='$district',`city`='$city',`dec_landmark`='$landmark',`dec_event_name`='$decotrion_events',`images`=$resimg,`service_plan`='$service_area',`email_id`='$email',`fb_url`='$Facebook',`youtube_url`='$Youtube',`insta_url`='$Instagram',`is_dnd`='$is_dnd',`others`='$others',`website`='$Website',`is_dnd`='$is_dnd',`mby` = CONCAT (`mby`,'|','$user'), `mdate` = CONCAT (`mdate`,'|','$datetime'), `mip` = CONCAT (`mip`,'|','$_SERVER[REMOTE_ADDR]') where `id`= '$id' ";
//        echo $sql1;exit;
        $result1 = mysqli_query($conn, $sql1) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($conn));
        if ($pay_plan) {
            $sql6 = "SELECT `start_date`, `end_date` FROM `pay_details` WHERE  `TXN_STATUS` =  'TXN_SUCCESS' AND `userid` = '$user_id'  and  `service_type` ='$serviceid' and `sevice_type_id` ='$id' order by `id` desc limit 1 ";
            $res6 = mysqli_query($conn, $sql6);
            while ($row6 = mysqli_fetch_assoc($res6)) {
                $start_date = $row6['start_date'];
                $pay_end_date = $row6['end_date'];
            }
            $start_date = date('Y-m-d', strtotime($pay_end_date . ' +1 days'));
            $end_date = date('Y-m-d', strtotime($start_date . ' + ' . $validity . 'days'));
            $sql3 = "INSERT INTO `pay_details`(`sevice_type_id`,`service_type`,`userid`, `planid`, `start_date`, `end_date`, `inv_prefix`, `inv_no`, `TXN_AMOUNT`, `TXN_DATE`, `TXN_STATUS`, `amount`, `actual_amount`, `gst_amount`, `total_amount`, `gst_percent`, `validity`, `cby`, `cdate`, `cip`) VALUES"
                    . " ('$id','$serviceid ','$user_id','$pay_plan','$start_date','$end_date','$inv_prefix','$inv_no','$total_amt','$ymd','TXN_SUCCESS','$total_amt', '$act_amount','$gstamt','$total_amt','$gst_percent','$validity','$user','$datetime','$_SERVER[REMOTE_ADDR]')";
//            echo $sql3;exit;
            $res3 = mysqli_query($conn, $sql3);
            $payids = mysqli_insert_id($conn);
            pdf_mail($conn, $serviceid, $user_id, $payids, $ymd);
        }
        header("Location: decoration-old.php?msg=3");
    } else {
        $sql2 = "SELECT * FROM `decoration_table` where `user_id` = '$user_id' AND `dec_org_name` = '$decotrion_name' AND `city` = '$city'  ";
        $result2 = mysqli_query($conn, $sql2);
        if (mysqli_num_rows($result2)) {
            $msg = 1;
        } else {
            $resimg = trim($allurl2, ',');
            $sql = "INSERT INTO `decoration_table`( `user_id`,`exp`,`dec_org_name`,`dec_name`,`dec_phone_no`,`dec_alternative_mno`, `dec_address`,`district`, `city`, `dec_landmark`, `dec_event_name`, `service_plan`,`images`,`website`,`fb_url`,`youtube_url`,`insta_url`,`others`,`is_active`, `cby`, `cdate`, `cip`, `email_id`,`is_dnd`,`pincode`) "
                    . "VALUES ('$user_id','$exp','$decotrion_name','$manager_name', '$mobile_number', '$alter_mobile_number','$address', '$district', '$city','$landmark','$decotrion_events','$service_area','$resimg','$Website','$Facebook','$Youtube','$Instagram','$others','1','$user','$datetime','$_SERVER[REMOTE_ADDR]','$email','$is_dnd','$pincode')";
//                        echo $sql; exit;
            $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($conn));
            $reg_last_id = mysqli_insert_id($conn);
            if ($pay_plan) {
                if ($validity > 1) {
                    $validity = $validity - 1;
                    $uend_date = date('Y-m-d', strtotime($ymd . ' + ' . $validity . 'days'));
                } else {
                    $uend_date = $ymd;
                }
                $sql5 = "INSERT INTO `pay_details`(`sevice_type_id`,`service_type`,`userid`, `planid`, `start_date`, `end_date`, `inv_prefix`, `inv_no`, `TXN_AMOUNT`, `TXN_DATE`, `TXN_STATUS`, `amount`, `actual_amount`, `gst_amount`, `total_amount`, `gst_percent`, `validity`, `cby`, `cdate`, `cip`) VALUES"
                        . " ('$reg_last_id','$serviceid ','$user_id','$pay_plan','$ymd','$uend_date','$inv_prefix','$inv_no','$total_amt','$ymd','TXN_SUCCESS','$total_amt', '$act_amount','$gstamt','$total_amt','$gst_percent','$validity','$user','$datetime','$_SERVER[REMOTE_ADDR]')";
//                echo $sql5;exit; 
                $result5 = mysqli_query($conn, $sql5);
                $payids = mysqli_insert_id($conn);

                pdf_mail($conn, $serviceid, $user_id, $payids, $ymd);
            }
            header("Location: decoration-old.php?msg=2");
        }
    }
}
if (isset($_POST['district_name'])) {
    $district_name = $_POST['district_name'];
    $sql4 = "SELECT * FROM `city` where district='$district_name' ";
    $res4 = mysqli_query($conn, $sql4);
    ?>    
    <option value=""> நகரத்தை   தேர்ந்தெடுக</option>
    <?php
    while ($row = mysqli_fetch_assoc($res4)) {
        $id = $row['id'];
        $name_city = $row['tamil'];
        ?>     
        <option value="<?php echo $id; ?>" style="font-size: 14px;"><?php echo $name_city; ?></option>  
        <?php
    }
    exit();
}


//echo $user_id;exit;
if (isset($_POST['search_user'])) {
    $search_user = $_POST['search_user'];
//    echo $search_user;exit;
    $sql4 = "SELECT * FROM `registration` where mobileno='$search_user'";
//    echo $sql4;
    $res4 = mysqli_query($conn, $sql4);
    if (mysqli_num_rows($res4)) {
        $i = 0;
        while ($row = mysqli_fetch_assoc($res4)) {
            $id = $row['id'];
            $is_active = $row['is_active'];
        }
    } else {
        $i = 1;
    }
    echo '###' . $i . '###' . $id . '###' . $is_active;
    exit();
}

if (isset($_POST['cat_select'])) {
    $catval = $_POST['cat_select'];
    if ($catval == '') {
        $cat = '2';
    } else {
        $cat = ' category =' . "'" . $catval . "'";
    }
    ?>        
    <table id="datatable2" class="table diagnosis_list">
        <thead>
            <tr>                                    
                <th>SlNo</th>
                <th>Actions</th>
                <th>Category</th>
                <th>Plan Name</th>
                <th>Type</th>
                <th>No. of Months</th>
                <th>Validity Days</th>
                <th>Plan Amount</th>
                <th>Discount %</th>
                <th>GST</th>
                <th>GST Amount</th>
                <th>Total Payable Amount</th>
                <th>Offer Starts On</th>
                <th>Offer Ends On</th>
                <th>Status</th>
                <th>Extra Information</th>
                <th>Tag</th>
            </tr>
        </thead>
        <tbody class="ui-sortable" >
            <?php
            $i = 1;
            $sql = "SELECT * FROM `planmaster` WHERE $cat  ORDER BY `id` DESC";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $off_startdate = $row['offer_startdate'];
                $off_enddate = $row['offer_enddate'];
                $gst_percent = $row['gst_percent'];
                $amount = $row['original'];
                $gstamt = round(($gst_percent / 100) * $amount);
                $tot_pay_amt = round($amount + $gstamt);
                ?>
                <tr  id="<?php echo $row['id']; ?>"  >
                    <td><?php echo $i; ?></td>
                    <td class="text-left">   
                        <a href="planmaster_1.php?editid=<?php echo $id; ?>"><button type="button" class="btn ink-reaction btn-floating-action btn-info" data-toggle="tooltip" data-placement="top" data-original-title="Edit row"><i class="fa fa-pencil"></i></button></a>                                                                   
                    </td>
                    <td><?php echo $row['category']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['type']; ?></td>
                    <td><?php
                        if ($row['type'] == 'Months') {
                            echo $row['no_of_months'];
                        } else {
                            echo '-';
                        };
                        ?></td>
                    <td><?php
                        if ($row['type'] == 'Days') {
                            echo $row['validity_days'];
                        } else {
                            echo '-';
                        }
                        ?></td>
                    <td><?php echo $row['original']; ?></td>
                    <td><?php
                        if ($row['discount']) {
                            echo $row['discount'] . '%<br><span style="background: green; color: #fff; padding: 5px;">Offer Plan</span>';
                        } else {
                            echo '-';
                        }
                        ?><br><?php
                        if ($row['offer_enddate'] != '0000-00-00') {
                            if ($row['offer_enddate'] < $ymd) {
                                ?><span style="background: red; color: #fff; padding: 5px;">Expired</span><?php
                            }
                        }
                        ?></td>
                    <td><?php echo $row['gst_percent'] . '%'; ?></td>
                    <td><?php echo number_format($gstamt, 2); ?></td>
                    <td><?php echo number_format($tot_pay_amt, 2); ?></td>
                    <td><?php
                        if ($off_startdate != '0000-00-00') {
                            echo date('d-m-Y', strtotime($off_startdate));
                        } else {
                            echo '-';
                        }
                        ?></td>
                    <td><?php
                        if ($off_enddate != '0000-00-00') {
                            echo date('d-m-Y', strtotime($off_enddate));
                        } else {
                            echo '-';
                        }
                        ?></td>
                    <td><?php
                        if ($row['is_active'] == 1) {
                            echo '<span style="color: green;"><b>Active</b></span>';
                        } else {
                            echo '<span style="color: red;"><b>Inactive</b></span>';
                        }
                        ?></td>
                    <td><?php echo $row['extrainfo']; ?></td>
                    <td><?php echo $row['tag']; ?></td>
                </tr>  
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>            
    <?php
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Calendar Services  - டெகரேஷன்</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="your,keywords">
        <meta name="description" content="Short explanation about this website">
        <?php include_once $prefix . 'include/css.php'; ?>
        <style>
            input[type=number]::-webkit-inner-spin-button,             
            input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0;}
        </style>
        <link type="text/css" rel="stylesheet" href="select2.min.css" />
        <script src="select2.min.js"></script>
        <script src="jquery.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#select_demo2").select2({
                    maximumSelectionLength: 3
                });
            });
        </script>
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>

        <style>
            .img-wrap {
                position: relative;
                display: inline-block;
                font-size: 0;
            }
            .img-wrap .close {
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
            .img-wrap:hover .close {
                opacity: 1;
            }
            .remove {
                display: block;
                background: red;
                border: 1px solid black;
                color: red;
                text-align: center;
                cursor: pointer;
            }
            .remove:hover {
                background: black;
                color: black;
            }
        </style>
    </head>
    <body class="menubar-hoverable header-fixed ">
        <?php include_once $prefix . 'include/header.php'; ?>
        <div id="base">
            <div class="offcanvas">
            </div>
            <div id="content" class="search_close" style="display:<?php
            if ($user_id || $id) {
                echo 'none';
            } else {
                echo 'block';
            }
            ?>" >
                <section >              
                    <div class="section-body contain-lg">
                        <div class="row">                           
                            <div class="col-lg-offset-1 col-md-10">
                                <!--<form class="form  form-validate remember" role="form" method="POST">-->
                                <div class="card">
                                    <div class="card-head style-primary">
                                        <center><header style="font-weight: 900;margin-top: 10px;">டெகரேஷன்</header> </center>
                                    </div>  
                                    <div class="card-body">																							
                                        <div class="row">                                                                                           
                                            <div class="col-md-9 form-group floating-label"><br>
                                                <input pattern="[6789][0-9]{9}" inputmode="numeric" type="tel" oninput="this.value=this.value.replace(/[^0-9]/g,'');javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" autofocus autocomplete="off" id="mobile_number_check" name="mobile_number_check" class="form-control" onkeydown="limit(this);" onkeyup="limit(this);" required>
                                                <label for="Plan Name"> &nbsp;User Mobile Number  <sup class="text-danger">*</sup></label>
                                            </div>

                                            <div class="col-md-3 form-group floating-label"><br>
                                                <button type="button" id="search" class="btn ink-reaction btn-raised btn-primary" tabindex="1" name="">Search User</button>
                                            </div>
                                        </div>
                                        <div id="append_not_uesr">

                                        </div>
                                    </div>
                                    <!--</form>-->
                                </div>
                            </div>
                        </div>
                </section>
            </div>
            <div id="content" class="search_open"  style="display:<?php
            if ($user_id || $id) {
                echo 'block';
            } else {
                echo 'none';
            }
            ?>">
                <section >              
                    <div class="section-body contain-lg">
                        <div class="row">                           
                            <div class="col-lg-offset-1 col-md-10">
                                <form class="form  form-validate remember"  role="form" method="POST"  enctype="multipart/form-data">

                                    <div class="card">
                                        <div class="card-head style-primary">
                                            <center><header style="font-weight: 900;margin-top: 10px;">டெகரேஷன் விவரங்கள் சேர்க்க</header> </center>
                                        </div>  
                                        <div class="card-body">																							
                                            <div class="row">                                                                                           
                                                <div class="col-md-4 form-group floating-label">
                                                    <input type="text"  id="user_id_search" name="user_id" value="<?php
                                                    if ($id) {
                                                        echo $user_id;
                                                    } else {
                                                        echo $user_id;
                                                    }
                                                    ?>" style="display:none">
                                                    <input type="text"  value="2" name="serviceid"  style="display:none">
                                                    <input type="text" class="form-control" name="decotrion_name" tabindex="1" value="<?php
                                                    if ($id) {
                                                        echo $edec_org_name;
                                                    }
                                                    ?>" required>
                                                    <label for="Plan Name"> &nbsp;<span style="font-size:14px;">டெகரேஷன்  நிறுவனத்தின் பெயர்  </span><sup class="text-danger">*</sup></label>
                                                </div>
                                                <div class="col-md-4 form-group floating-label">
                                                    <input type="text" class="form-control" name="manager_name" tabindex="1" value="<?php
                                                    if ($id) {
                                                        echo $edec_name;
                                                    }
                                                    ?>" required>
                                                    <label for="Plan Name"> &nbsp;<span style="font-size:14px;">உரிமையாளர் / மேலாளர் பெயர் </span> <sup class="text-danger">*</sup></label>
                                                </div>
                                                <div class="col-md-4 form-group floating-label">
                                                    <input inputmode="numeric"  class="form-control" name="mobile_number" tabindex="1"  pattern="[6789][0-9]{9}"  type="tel"   type="tel" oninput="this.value=this.value.replace(/[^0-9]/g,'');javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" autocomplete="off"  value="<?php
                                                    if ($id) {
                                                        echo $edec_phone_no;
                                                    }
                                                    ?>" required>
                                                    <label for="Plan Name"> &nbsp;<span style="font-size:14px;">அலைபேசி எண்</span> <sup class="text-danger">*</sup></label>
                                                </div>
                                            </div>
                                            <div class="row">  
                                                <div class="col-md-4 form-group floating-label">
                                                    <input pattern="[6789][0-9]{9}" inputmode="numeric" type="tel" oninput="this.value=this.value.replace(/[^0-9]/g,'');javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10"  class="form-control" name="alter_mobile_number" tabindex="1" value="<?php
                                                    if ($id) {
                                                        echo $edec_alternative_mno;
                                                    }
                                                    ?>">
                                                    <label for="Plan Name"> &nbsp; <span style="font-size:14px;">மாற்று அலைபேசி எண்</span></label>
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <select class="form-control" name="district" id="district" tabindex="1" required >
                                                        <option value=""> மாவட்டத்தை  தேர்ந்தெடுக</option>
                                                        <?php
                                                        $sql = "Select * From `n_district`";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            ?>
                                                            <option value="<?php echo $row['id']; ?>" <?php
                                                            if ($row['id'] == $edistrict) {
                                                                echo "selected";
                                                            }
                                                            ?>><?php echo $row['tamil']; ?></option><?php } ?>
                                                    </select>
                                                    <label for="Category"> &nbsp; <span style="font-size:14px;">டெகரேஷன் செய்பவரின் மாவட்டம் </span><sup class="text-danger">*</sup></label>
                                                </div>
                                                <?php if ($id) { ?>
                                                    <div class="col-md-4 form-group">
                                                        <select class="form-control" name="city" id="city" tabindex="1" required >
                                                            <option value=""> மாவட்டத்தை  தேர்ந்தெடுக</option>
                                                            <?php
                                                            $sql = "Select * From `city`";
                                                            $result = mysqli_query($conn, $sql);
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                ?>
                                                                <option value="<?php echo $row['id']; ?>" <?php
                                                                if ($row['id'] == $ecity) {
                                                                    echo "selected";
                                                                }
                                                                ?>><?php echo $row['tamil']; ?></option><?php } ?>
                                                        </select>
                                                        <label for="Category"> &nbsp;மாவட்டம் <sup class="text-danger">*</sup></label>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="col-md-4 form-group">
                                                        <select class="form-control" name="city" id="city" tabindex="1" required >
                                                            <option value=""> நகரத்தை   தேர்ந்தெடுக</option>
                                                        </select>
                                                        <label for="Category"> &nbsp;<sp    an style="font-size:14px;">டெகரேஷன் செய்பவரின் நகரம் </span><sup class="text-danger">*</sup></label>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="row"> 
                                                <div class="col-md-6 form-group floating-label">
                                                    <textarea  class="form-control"  name="address" rows="3" tabindex="1" maxlength="500" required><?php
                                                        if ($id) {
                                                            echo $edec_address;
                                                        }
                                                        ?></textarea>
                                                    <label for="extrainfo"> &nbsp;<span style="font-size:14px;">முகவரி </span> <sup class="text-danger">*</sup></label>
                                                </div>
                                                <div class="col-md-6 form-group floating-label">
                                                    <textarea  class="form-control"  name="landmark" rows="3" tabindex="1" maxlength="500"><?php
                                                        if ($id) {
                                                            echo $edec_landmark;
                                                        }
                                                        ?></textarea>
                                                    <label for="Amount"> &nbsp;<span style="font-size:14px;">Landmark</span></label>
                                                </div>
                                            </div> 
                                            <div class="row">    
                                                <div class="col-md-6 form-group floating-label"><br><br>
                                                    <input  inputmode="numeric" type="tel" oninput="this.value=this.value.replace(/[^0-9]/g,'');javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="6" class="form-control" name="pincode" tabindex="1" value="<?php
                                                    if ($id) {
                                                        echo $pincode;
                                                    }
                                                    ?>" required>
                                                    <label for="Plan Name"> &nbsp; Pincode  <sup class="text-danger">*</sup></label>
                                                </div>
                                                <div class="col-md-6 form-group floating-label"><br><br>
                                                    <input type="email" class="form-control" name="email" tabindex="1" value="<?php
                                                    if ($id) {
                                                        echo $eemail_id;
                                                    }
                                                    ?>">
                                                    <label for="Plan Name"> &nbsp;<span style="font-size:14px;">மின்னஞ்சல்</span></label>
                                                </div>
                                            </div>
                                            <div class="row">  
                                                <div class="col-md-6 form-group"><br>
                                                    <select class="form-control" name="exp" id="exp" tabindex="1"  required>
                                                        <option value="">இந்த துறையில் அனுபவம் தேர்ந்தெடுக</option>
                                                        <option value="1" <?php
                                                        if ($id) {
                                                            echo $eexp == 1 ? "selected" : "";
                                                        }
                                                        ?> >0 - 1 வருடம்</option>
                                                        <option value="2" <?php
                                                        if ($id) {
                                                            echo $eexp == 2 ? "selected" : "";
                                                        }
                                                        ?> >1 - 3 வருடங்கள்</option>
                                                        <option value="3" <?php
                                                        if ($id) {
                                                            echo $eexp == 3 ? "selected" : "";
                                                        }
                                                        ?> >3 - 5 வருடங்கள்</option>
                                                        <option value="4" <?php
                                                        if ($id) {
                                                            echo $eexp == 4 ? "selected" : "";
                                                        }
                                                        ?> >5 வருடங்களுக்கு மேல்</option>
                                                    </select>
                                                    <label for="Plan Name"> &nbsp; அனுபவம்<sup class="text-danger">*</sup> </label>
                                                </div>
                                                <div class="col-md-6 form-group floating-label"><br>
                                                    <select class="form-control select2-list country" name="decotrion_events[]" id="mySelect" data-placeholder="டெகரேஷன் விழாக்கள்  தேர்ந்தெடுக" multiple="" tabindex="-1" required>
                                                        <!--<option value=""> டெகரேஷன் விழாக்கள்  தேர்ந்தெடுக</option>-->
                                                        <?php
                                                        $sql = "Select * From `event_table` where FIND_IN_SET('2', service_type) and `is_delete`='0'";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            ?>
                                                            <option value="<?php echo $row['id']; ?>" <?php
                                                            if ($id) {
                                                                foreach ($edec_event_name as $value) {
                                                                    if ($row['id'] == $value) {
                                                                        echo "selected";
                                                                    }
                                                                }
                                                            }
                                                            ?>><?php echo $row['event_name']; ?></option><?php } ?>
                                                    </select>
                                                    <label for="டெகரேஷன் விழாக்கள்  "> &nbsp;<span style="font-size:14px;">டெகரேஷன் விழாக்கள்  </span> <sup class="text-danger">*</sup></label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 form-group floating-label"><br>
                                                    <select id="select_demo2" multiple="multiple" data-maximum-selection-length="3" class="form-control  select2-list select2 select2-container-multi country1" name="service_area[]" data-placeholder="Service Area">
                                                        <?php
                                                        $sql = "Select * From `n_district`";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            ?>
                                                            <option value="<?php echo $row['id']; ?>" <?php
                                                            if ($id) {
                                                                foreach ($eservice_plan as $check_dis) {
                                                                    if ($row['id'] == $check_dis) {
                                                                        echo "selected";
                                                                    }
                                                                }
                                                            }
                                                            ?>><?php echo $row['tamil']; ?></option><?php } ?>
                                                    </select>
                                                    <label for="டெகரேஷன் விழாக்கள்  "> &nbsp;<span style="font-size:14px;">Service Area  </span><sup class="text-danger">*</sup></label>
                                                </div>
                                                <div class="col-md-6 form-group"><br><br>
                                                    <?php echo $row['filename'] ?>
                                                    <input type="file" name="fileToUpload1[id0][]" id="fileToUpload1" multiple  class="form-control requiredval" accept="image/*" <?php
                                                    if (!$id) {
                                                        echo "required";
                                                    }
                                                    ?>>
                                                    <label for="புகைப்படம்"> &nbsp;புகைப்படம்   <sup class="text-danger">*</sup></label>
                                                    <?php
                                                    if ($id) {
                                                        foreach ($eimages as $logovalue) {
                                                            ?><div class="img-wrap">
                                                                <span class="close">&times;</span>
                                                                <!--<span class="remove">remove</span><br>-->
                                                                <input class="getidimges" type="text" name="getidimges[]" value="<?php echo $logovalue; ?>" style="display:none">
                                                                <img  class="getidimges"   data-id='<?php echo $logovalue; ?>' width="100px"  height="100px" src="<?php echo $logovalue; ?>">
                                                            </div>             <?php } ?>
                                                        <input id='getimges'  class="getidimge" name="delete_images[]" type="text"  hidden="" value="<?php echo $eimages1; ?>">
                                                    <?php }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="row"> 
                                                <div class="col-md-6 form-group floating-label">
                                                    <textarea  class="form-control"  name="others" rows="3" tabindex="1"><?php
                                                        if ($id) {
                                                            echo $eothers;
                                                        }
                                                        ?></textarea>
                                                    <label for="extrainfo"> &nbsp;<span style="font-size:14px;">மற்ற விவரங்கள் </span></label>
                                                </div>
                                                <div class="col-sm-6 form-group  floating-label">   <br><br>                                             
                                                    <select name="is_dnd"  class="form-control" tabindex="1" required="">
                                                        <option value="0" <?php
                                                        if ($id) {
                                                            echo $eis_dnd == 0 ? "selected" : " ";
                                                        }
                                                        ?>   >Show all</option>         
                                                        <option value="1" <?php
                                                        if ($id) {
                                                            echo $eis_dnd == 1 ? "selected" : " ";
                                                        }
                                                        ?>   >Not show</option>   


                                                    </select>
                                                    <label for="fb_links"> &nbsp;<span style="font-size:14px;">DND ( Do Not Distrub )</span><sup class="text-danger">*</sup> </label>
                                                </div>
                                            </div> 

                                            <label for="Plan Name"> &nbsp;சமூக வலைத்தளங்கள் </label>
                                            <div class="row"> 
                                                <div class="col-md-6 form-group">
                                                    Instagram:<input type="text"  class="form-control" name="Instagram" tabindex="1" value="<?php
                                                    if ($id) {
                                                        echo $einsta_url;
                                                    }
                                                    ?>" >

                                                    Facebook:<input type="text" class="form-control" name="Facebook" tabindex="1" value="<?php
                                                    if ($id) {
                                                        echo $efb_url;
                                                    }
                                                    ?>" >
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    Youtube:<input type="text"  class="form-control" name="Youtube" tabindex="1" value="<?php
                                                    if ($id) {
                                                        echo $eyoutube_url;
                                                    }
                                                    ?>" >
                                                    Website:<input type="text" size="30" class="form-control" name="Website" tabindex="1" value="<?php
                                                    if ($id) {
                                                        echo $ewebsite;
                                                    }
                                                    ?>" >
                                                </div>
                                            </div>
                                        </div>
                                        <div id='plandiv' >                                          
                                            <div class="card-body" >                                                
                                                <div class="row" style="border: 2px solid #3f51b5;border-radius: 10px;padding: 10px;overflow: scroll;overflow-x: scroll;">
                                                    <h3 style="margin: 10px; text-align: center;"><u>Choose Payment Plans</u></h3>                                                  
                                                    <!--OFFER PLAN-->
                                                    <?php
                                                    $sql2 = "SELECT * FROM `pay_details` where userid='$user_id' and service_type='2' and amount='0' ORDER BY `id` DESC";
//                                                         echo $sql2;exit;
                                                    $res2 = mysqli_query($conn, $sql2);
                                                    if (mysqli_num_rows($res2) > 0) {
                                                        $sql1 = "SELECT * FROM `planmaster` WHERE `original` > 1  AND  `is_active` = '1'  AND  `service_type`='2'   ORDER BY `original`+1 ASC";
//                                                                 echo $sql1;exit;
                                                        $res1 = mysqli_query($conn, $sql1);
                                                        if (mysqli_num_rows($res1) > 0) {
                                                            while ($row1 = mysqli_fetch_assoc($res1)) {
                                                                $planid = $row1['id'];
                                                                $p_categ = $row1['service_type'];
                                                                $planname = $row1['name'];
                                                                $amount = $row1['original'];
                                                                $discount = $row1['discount'];
                                                                $gst_percent = $row1['gst_percent'];
                                                                $no_of_months = $row1['no_of_months'];
                                                                $valid_days = $row1['validity_days'];
                                                                $off_startdate = $row1['offer_startdate'];
                                                                $off_enddate = $row1['offer_enddate'];
                                                                if ($discount == '') {
                                                                    $discount = 0;
                                                                } else {
                                                                    $discount = $discount;
                                                                }
                                                                $gstamt = round(($gst_percent / 100) * $amount);
                                                                $disc1 = ($discount / 100);
                                                                $disc2 = 1 - $disc1;
                                                                $disc3 = ($amount / $disc2);
                                                                ?>

                                                                <?php
                                                                // if (($ymd >= $off_startdate) && ($ymd <= $off_enddate)) {
                                                                $pcat = str_replace(' ', '_', $p_categ);
                                                                ?>
                                                                <div class="col-md-12 types <?php echo $pcat; ?>" >
                                                                    <div class="radio radio-styled">
                                                                        <label class="col-md-12">
                                                                            <input type="radio" class="pay_plan <?php echo 'search_pay'; ?>" name="pay_plan" value="<?php echo $planid; ?>" <?php
                                                                            if ($id) {
                                                                                echo'';
                                                                            } else {
                                                                                echo 'required';
                                                                            }
                                                                            ?>
                                                                                   >
                                                                            <span style="font-weight: 500; font-size: 17px; color: brown"><u><?php echo $planname; ?></u> | Plan Amount: <span style="color: red;">₹<?php echo $amount; ?></span> | GST Amount (<?php echo $gst_percent . '%'; ?>): ₹<?php echo $gstamt; ?> | Total Payable Amt: ₹<?php echo round($amount + $gstamt); ?> | Validity: <?php echo $valid_days . 'days'; ?> <?php if ($discount) { ?> | <span style="color: green;">Discount: <?php
                                                                                        echo $discount . '% Offer';
                                                                                    }
                                                                                    ?></span>  </span>
                                                                        </label>                                                       
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                // }
                                                            }
                                                        }
                                                    } else {
                                                        $sql1 = "SELECT * FROM `planmaster` WHERE   `is_active` = '1'  AND  `service_type`='2'   ORDER BY `original`+1 ASC";
                                                        // echo $sql1;exit;
                                                        $res1 = mysqli_query($conn, $sql1);
                                                        if (mysqli_num_rows($res1) > 0) {
                                                            while ($row1 = mysqli_fetch_assoc($res1)) {
                                                                $planid = $row1['id'];
                                                                $p_categ = $row1['service_type'];
                                                                $planname = $row1['name'];
                                                                $amount = $row1['original'];
                                                                $discount = $row1['discount'];
                                                                $gst_percent = $row1['gst_percent'];
                                                                $no_of_months = $row1['no_of_months'];
                                                                $valid_days = $row1['validity_days'];
                                                                $off_startdate = $row1['offer_startdate'];
                                                                $off_enddate = $row1['offer_enddate'];
                                                                if ($discount == '') {
                                                                    $discount = 0;
                                                                } else {
                                                                    $discount = $discount;
                                                                }
                                                                $gstamt = round(($gst_percent / 100) * $amount);
                                                                $disc1 = ($discount / 100);
                                                                $disc2 = 1 - $disc1;
                                                                $disc3 = ($amount / $disc2);
                                                                ?>

                                                                <?php
                                                                // if (($ymd >= $off_startdate) && ($ymd <= $off_enddate)) {
                                                                $pcat = str_replace(' ', '_', $p_categ);
                                                                ?>
                                                                <div class="col-md-12 types <?php echo $pcat; ?>" >
                                                                    <div class="radio radio-styled">
                                                                        <label class="col-md-12">
                                                                            <input type="radio" class="pay_plan <?php echo 'search_pay'; ?>" name="pay_plan" value="<?php echo $planid; ?>" <?php
                                                                            if ($id) {
                                                                                echo'';
                                                                            } else {
                                                                                echo 'required';
                                                                            }
                                                                            ?>
                                                                                   >
                                                                            <span style="font-weight: 500; font-size: 17px; color: brown"><u><?php echo $planname; ?></u> | Plan Amount: <span style="color: red;">₹<?php echo $amount; ?></span> | GST Amount (<?php echo $gst_percent . '%'; ?>): ₹<?php echo $gstamt; ?> | Total Payable Amt: ₹<?php echo round($amount + $gstamt); ?> | Validity: <?php echo $valid_days . 'days'; ?> <?php if ($discount) { ?> | <span style="color: green;">Discount: <?php
                                                                                        echo $discount . '% Offer';
                                                                                    }
                                                                                    ?></span>  </span>
                                                                        </label>                                                       
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                // }
                                                            }
                                                        }
                                                    }
                                                    ?>

                                                </div>
                                            </div>                                                
                                        </div>  
                                        <div class="card-actionbar">
                                            <div class="card-actionbar-row">
                                                <?php if ($id) { ?>
                                                    <button type="submit" class="btn ink-reaction btn-raised btn-primary" id="btnSubmit" tabindex="1" name="save">Update</button>
                                                <?php } else { ?>
                                                    <button type="submit" class="btn ink-reaction btn-raised btn-primary" id="btnSubmit" tabindex="1" name="save">Save</button>
                                                <?php } ?>
                                                <?php if ($id) { ?>
                                                    <button onclick="goBack()" class="btn ink-reaction  btn-warning" tabindex="1"  style="float:left">Cancel</button>
                                                <?php } else { ?>
                                                    <button type="reset"  class="btn ink-reaction btn-warning" tabindex="1"  style="float:left">Reset</button>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <!--<h2 class="text-primary">Edit Decoration Table</h2>-->                                                                       
                                    <div class="table-responsive">
                                        <!--                                        <div class="row col-md-4 form-group">
                                                                                    <select class="form-control"  id="cat_select" tabindex="1" >
                                                                                        <option value="">Select District</option>
                                        <?php
//                                                $sql = "Select * From `n_district`";
//                                                $result = mysqli_query($conn, $sql);
//                                                while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                                                                            <option value="<?php // echo $row['id'];                                                                              ?>" <?php ?>><?php // echo $row['tamil'];                                                                              ?></option><?php // }                                                                              ?>
                                                                                    </select>
                                                                                </div>-->
                                        <div id="getstate">
                                            <table id="datatable1" class="table diagnosis_list">
                                                <thead>
                                                    <tr>                                    
                                                        <th>SlNo</th>
                                                        <th style="text-align:center;">Actions</th>
                                                        <th>  டெகரேஷன்  பெயர்  </th>
                                                        <th>  உரிமையாளர் / மேலாளர் பெயர்  </th>
                                                        <th>  அலைபேசி எண்  </th>
                                                        <th>  மாவட்டம் </th>
                                                        <th>  நகரம் </th>
                                                        <th>  Pincode </th>
                                                        <!--<th>டெகரேஷன் வகை  </th>-->
                                                        <th>PLAN</th>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>
                                                        <th>AMOUNT</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="ui-sortable" >
                                                    <?php
                                                    $i = 1;
                                                    $sql = "SELECT   `m`.`pincode`,`m`.`id`,`m`.`dec_org_name`,`m`.`dec_name`,`m`.`dec_phone_no`,`m`.`district`,`m`.`city`,`p`.`planid`,`p`.`total_amount`,`p`.`start_date`,`p`.`end_date` FROM `decoration_table`m CROSS JOIN pay_details p on m.id = p.sevice_type_id  and p.service_type = '2' where `p`.`userid`='$user_id' order by m.id DESC";
//                                     echo $sql;
                                                    $result = mysqli_query($conn, $sql);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $id = $row['id'];
                                                        $hall_name = $row['dec_org_name'];
                                                        $hall_incharger_name = $row['dec_name'];
                                                        $hall_phone_no = $row['dec_phone_no'];
                                                        $district = $row['district'];
                                                        $city = $row['city'];
                                                        $planid = $row['planid'];
//                                                        $dec_type = $row['dec_type'];
//                                                        $dec_type = explode(',', $row['dec_type']);
                                                        $total_amount = $row['total_amount'];
                                                        $start_date = $row['start_date'];
                                                        $end_date = $row['end_date'];
//    $gstamt = round(($gst_percent / 100) * $amount);
//    $tot_pay_amt = round($amount + $gstamt);
                                                        ?>
                                                        <tr  id="<?php echo $row['id']; ?>"  >
                                                            <td style="text-align:center;"><?php echo $i; ?></td>
                                                            <td class="text-left">   
                                                                <a href="decoration-old.php?editid=<?php echo $id . '&user_id=' . $user_id; ?>"><button type="button" class="btn ink-reaction btn-info" data-toggle="tooltip" data-placement="top" data-original-title="Edit / Renewal">Edit / Renewal</button></a>                                                                   
                                                            </td>
                                                            <td><?php echo $row['dec_org_name']; ?></td>
                                                            <td><?php echo $row['dec_name']; ?></td>
                                                            <td><?php echo $row['dec_phone_no']; ?></td>
                                                            <td><?php echo $get_distrctname[$row['district']]; ?></td>
                                                            <td><?php echo $get_cityname[$row['city']]; ?></td>
                                                            <td><?php echo $row['pincode']; ?></td>
                                                            <!--<td><?php // echo $get_dec_type_name[$dec_type];                                                                                                                               ?></td>-->
                                                            <td><?php echo $get_planname[$row['planid']]; ?></td>
                                                            <td><?php echo date('d-m-Y', strtotime($start_date)); ?></td>
                                                            <td><?php echo date('d-m-Y', strtotime($end_date)); ?></td>
                                                            <td><?php echo $row['total_amount']; ?></td>
                                                        </tr>  
                                                        <?php
                                                        $i++;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php include_once $prefix . 'include/menubar.php'; ?>
        </div>
        <?php include_once $prefix . 'include/js.php'; ?>
        <script>
            var count = '<?php echo count($eimages); ?>';
            if (count === '1') {
                $(".close").hide();
            }
            $("document").ready(function () {
                $(".requiredval").change(function () {
                    $(".close").show();
                });
            });
            $(document).ready(function () {
                $('.img-wrap .close').on('click', function () {
                    $(this).parent('div').remove();
                });
            });
        </script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#btnSubmit").click(function () {
                    var countries = [];
                    $.each($(".country option:selected"), function () {
                        countries.push($(this).val());
                    });
                    //        alert("You have selected Service Type - " + countries.join(", "));
                    //                                                                        alert("You have to select Service Type - ");
                    if (countries == null || countries == "") {
                        alert("டெகரேஷன் விழாக்கள்  தேர்ந்தெடுக");
                        return false;
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                $("#btnSubmit").click(function () {
                    var countries1 = [];
                    $.each($(".country1 option:selected"), function () {
                        countries1.push($(this).val());
                    });
                    //        alert("You have selected Service Type - " + countries.join(", "));
                    //                                                                        alert("You have to select Service Type - ");
                    if (countries1 == null || countries1 == "") {
                        alert("Select Service Plan");
                        return false;
                    }
                });
            });
        </script>
        <script>
<?php if ($msg == '2') { ?>
                Command: toastr["success"]("Plan added sucesssfully", "Sucesss")
<?php } elseif ($msg == '1') {
    ?>
                Command: toastr["error"]("Same Plan already exist", "Error")
<?php } elseif ($msg == '3') { ?>
                Command: toastr["success"]("Plan Updated Sucesssfully", "Sucesss")
<?php } elseif ($msg == '4') { ?>
                Command: toastr["success"]("Plan Deleted Sucesssfully", "Sucesss")
<?php } ?>
        </script>
        <script>
            function limit(element)
            {
                var max_chars = 10;

                if (element.value.length > max_chars) {
                    element.value = element.value.substr(0, max_chars);
                }
            }
            function HandleBackFunctionality()
            {
                alert('hi');
                if (window.event) //Internet Explorer
                {
                    alert("Browser back button is clicked on Internet Explorer...");
                } else //Other browsers e.g. Chrome
                {
                    alert("Browser back button is clicked on other browser...");
                }
            }

        </script>
        <script>
            function calculate_amt() {
                var permonthcost = $("#permonthcost").val();
                var validity = $("#validity").val();
                var amtcalc = permonthcost * validity;
                $("#validity_days").val(amtcalc);
            }

            $(document).on('submit', 'form.remember', function () {
                $("#planvalidity").attr("disabled", false);
            });

            $('#planvalidity').on('change', function () {
                var planvalid = $(this).val();
                if (planvalid == 'Days') {
                    $('#monthdetails').hide();
                    $("#validity_days").attr("readonly", false);
                } else if (planvalid == 'Months') {
                    $('#monthdetails').show();
                    $("#validity_days").attr("readonly", true);
                }
            });

            $(document).on('keyup', '#discount', function () {
                var discount = $(this).val();
                var amount = $('#amount').val();
                //                        var calcPrice = amount - ( (amount/100) * discount ),
                var opamt = (amount * discount) / 100;
                var calcPrice = amount - opamt;

                var discountPrice = calcPrice.toFixed(2);
                $('#new_plan_amount').val(discountPrice);
                if (discount > 1) {
                    $('#offer_dates').show();
                } else {
                    $('#offer_dates').hide();
                }
            });
            $(document).on('keyup', '#amount', function () {
                var discount = $('#discount').val();
                var amount = $('#amount').val();
                if (discount !== '') {
                    var opamt = (amount * discount) / 100;
                    var calcPrice = amount - opamt;

                    var discountPrice = calcPrice.toFixed(2);
                    $('#new_plan_amount').val(discountPrice);
                }
            });

            $(function () {
                $('#date').datepicker({
                    format: 'dd-mm-yyyy',
                    autoclose: true,
                    todayHighlight: true
                });
            });
            $(function () {
                $('#date1').datepicker({
                    format: 'dd-mm-yyyy',
                    autoclose: true,
                    todayHighlight: true
                });
            });

            $('.offr_enddate').on('changeDate', function (ev) {
                var enddateval = $('#date1').val();
                var startdateval = $('#date').val();
                var eend = enddateval.split('-');
                var eeendfinal = eend[2] + '-' + eend[1] + '-' + eend[0];
                var std = startdateval.split('-');
                var stdfinal = std[2] + '-' + std[1] + '-' + std[0];
                if (new Date(eeendfinal) < new Date(stdfinal)) {
                    alert('Select Offer End Date greater than Offer Start Date ');
                    $('#date1').val('');
                }
            });

            $('.offr_stddate').on('changeDate', function (ev) {
                var stddateval = $('#date').val();
                var end_dateval = $('#date1').val();
                var sstd = stddateval.split('-');
                var sstdfinal = sstd[2] + '-' + sstd[1] + '-' + sstd[0];
                var eed = end_dateval.split('-');
                var eedfinal = eed[2] + '-' + eed[1] + '-' + eed[0];
                if (new Date(sstdfinal) > new Date(eedfinal)) {
                    alert('Select Offer Start Date lesser than Offer End Date ');
                    $('#date').val('');
                }
            });
        </script>
        <script>
            $(document).on('change', '#cat_select', function (e) {

                var cat = $(this).val();
                $('#load-images').show();
                $.post("planmaster_1.php",
                        {
                            cat_select: cat,
                        },
                        function (data, status) {
                            $('#load-images').hide();
                            $("#getstate").html(data);
                            $('#datatable2').DataTable({
                                "dom": 'lCfrtip',
                                "order": [],
                                "colVis": {
                                    "buttonText": "Columns",
                                    "overlayFade": 0,
                                    "align": "right"
                                },
                                "language": {
                                    "lengthMenu": '_MENU_ entries per page',
                                    "search": '<i class="fa fa-search"></i>',
                                    "paginate": {
                                        "previous": '<i class="fa fa-angle-left"></i>',
                                        "next": '<i class="fa fa-angle-right"></i>'
                                    }
                                }
                            });
                        });
            });

            $('.form').on('focus', 'input[type=number]', function (e) {
                $(this).on('wheel.disableScroll', function (e) {
                    e.preventDefault()
                });
            });

        </script>
        <script>



            $('#district').change(function () {
                $('#select2').val('');
                //                                                            $('#select3').val('');
                var district_name = $('#district').val();
                //                                                                        alert(district_name);

                //            alert(app_names + version_code);
                if (district_name != '') {
                    $.post("decoration-old.php",
                            {
                                district_name: district_name
                            },
                            function (data, status) {
                                $("#city").html(data);
                                console.log(data);
                            });
                }
            });

            $("#search").click(function () {
                var search = $('#mobile_number_check').val();
                $.post("decoration-old.php",
                        {
                            search_user: search
                        },
                        function (data, status) {
                            var result_search = data.split("###");
                            $('#user_id_search').val(result_search[2]);
                            //                            window.location.href = '/calendar/services/thirumanam/services/decoration-old.php?user_id=' + result_search[2];
                            var is_active = result_search[3]
                            if (result_search[1] === '0') {
                                if (is_active == '1') {
                                    window.location.href = '/calendar/services/thirumanam/services/decoration-old.php?user_id=' + result_search[2];
                                } else {
                                    alert('This user is inactive user');
                                }
                            } else {
                                $(".search_open").css("display", "none");
                                $(".search_close").css("display", "block");
                                alert('Your mobile number is not registered if you want to register click here');
                            }

                            console.log(data);
                        });
            });
            function IsEmail(email) {
                var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (!regex.test(email)) {
                    return false;
                } else {
                    window.location = "decoration-old.php";

                }
            }



//    $(document).ready(function () {
//                $('.getidimge').on('click', function () {
//                    alert('in');
//                    $(this).closest('.getidimge').remove();
//                });
//            });

        </script>
        <script>
            function goBack() {
                event.preventDefault();
                history.back(1);
            }
        </script>
    </body>
</html>
