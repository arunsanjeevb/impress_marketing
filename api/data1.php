<?php

include_once '../db.php';
$ipAddress = $_SERVER['REMOTE_ADDR'];
//$output[] ='';
$datetime = date("Y-m-d-H:i:s");
$action = isset($_POST['action']) ? $_POST['action'] : "";
//error_reporting(1);
//@ini_set('display_errors', E_ALL);

error_reporting(0);
@ini_set('display_errors', 0);

function send_message($no, $atitle, $template_id)
{
    ob_start();
    $ch = curl_init();
    $msg = urlencode($atitle);
//    $url = "http://smshorizon.co.in/api/sendsms.php?user=gokul.nithra&apikey=RfOXkuINM7lzds6nCOPV&mobile=" . $no . "&message=" . $msg . "&senderid=NITHRA&type=txt";
    $url = "http://api.msg91.com/api/sendhttp.php?sender=NITHRA&route=4&mobiles=" . $no . "&authkey=221068AW6ROwfK5b2782c0&country=91&message=" . $msg . "&campaign=SHIV_RATRI&DLT_TE_ID=$template_id";
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_exec($ch);
    if (curl_exec($ch) === false) {
        echo 'Curl error: ' . curl_error($ch);
    }
    curl_close($ch);
    ob_end_clean();
}

function send_email($user_email, $otp)
{
//    $user_email='vaitheswarik20@gmail';
    $output = array();
    require_once '../../PHPMailer-master/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Debugoutput = 'html';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = false;
    $mail->SMTPAuth = true;
    $mail->Username = "vaitheswari@bharath.ac.in";
    $mail->Password = "vaithe23";
    $mail->setFrom('vaitheswari@bharath.ac.in"', 'Food Share');
    $mail->addAddress($user_email);
    $mail->Subject = 'Verify OTP From Food Share ';
    $mail->isHTML(TRUE);
    $body = "<html>\n";
    $body .= "<body style=\"font-family:Helvetica,sans-serif; font-size:12px; color:#138e47;background-color: ghostwhite;\">\n";
    $body .= "<table style=\"width: 91%;padding-left: 60px\"><thead><tr style=\"background-color:#138e47;color: white;font-size: 30px;vertical-align: center;height: 60px\"><td style=\"padding-left: 15px;font-weight: bold;font-style: italic;\">OTP (One Time Password) - Email Confirmation</td></tr></thead>";
    $body .= "<tbody><tr><td><h4>Dear Sir/Madam,</h4>\n\n";
    $body .= "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; To verify your Email ID please enter the following OTP (One Time Password),</p>\n";
    $body .= "<p style=\"display: inline;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Your OTP : <h2 style=\"display: inline;\">$otp</h2>.</p>\n";
    $body .= "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Regards,</p>\n\n";
    $body .= "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Team Food Share.</p>\n\n";
    $body .= "<p>This is a system generated mail.</p>\n";
    $body .= "</td></tr><tr style=\"background-color:#138e47;color: white;font-size: 12px;vertical-align: center;line-height: 1.0;\"><td><center>\n";
    $body .= "<p><b>Food Share</b></p>\n";
    $body .= "<p style=\"line-height: 1.3;\">For any clarification you may correspond with us at <span style=\"color: #f5e84e\">$user_email</span> / 9876543210 OR 9876543211";
    $body .= "</center></td></tr></tbody></table>";
    $body .= "</body>\n";
    $body .= "</html>\n";
    $mail->Body = $body;
    $mail->send();

}

//echo send_email('vaitheswarik20@gmail.com',2569);
//exit;

//if($action == "add_seller"){
require '../../aws/aws-autoloader.php';

use Aws\Common\Exception\MultipartUploadException;
use Aws\S3\MultipartUploader;
use Aws\S3\S3Client;

$bucket ='nammaooru-local-app';
$fileuplink ="https://dd0ml4ssesdqt.cloudfront.net/";
//$bucket = 'homam-services';
//$fileuplink = "https://d3c16wgne86swu.cloudfront.net/";
$s3 = new S3Client([
    'version' => 'latest',
    'region' => 'ap-south-1',
    'credentials' => array(
        'key' => 'AKIA3FJL44PWTIPTMK4R',
        'secret' => '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',
    ),
]);
//}



if ($action == "category") {

    $sql = "select  `id`,`category`,`category_logo` from `category_master` where `is_active`='0' order by `id` desc";
    $res = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($res)) {
        while ($row = mysqli_fetch_assoc($res)) {
            $row['status'] = 'Success';
            $output1[] = $row;

        }
        $output[] = array('category' => $output1);
    } else {
        $output[] = array('status' => 'No Data');
    }
}
elseif ($action == "gift_for") {
    $sql = "select  `id`,`people`,`people_logo` from `gift_present` where `is_active`='0' order by `id` desc";

    $res = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($res)) {
        while ($row = mysqli_fetch_assoc($res)) {
            $row['status'] = 'Success';
            $output[] = $row;

        }
        $output[] = array('gift_for' => $output1);
    } else {
        $output[] = array('status' => 'No Data');
    }
}

elseif ($action == "check_seller") {
//    print_r($_POST);exit;
    $name = mysqli_real_escape_string($mysqli, $_POST['name']);
    $gmail = mysqli_real_escape_string($mysqli, $_POST['gmail']);
    $sql = "SELECT `id`,`name`,`gmail`,`otp` FROM `seller_registration` where `gmail`='$gmail'";
//    echo $sql;exit;
    $result = mysqli_query($mysqli, $sql);
//    print_r($result);
    if (mysqli_num_rows($result) > 0) {
        $otp = $row['otp'] = rand('1111', '9999');
        $mail_res=send_email($gmail, $otp);
        $sql_update = "UPDATE `seller_registration` SET `otp`='$otp',`name`='$name',`otp_datetime`='$datetime',`mip`='$_SERVER[REMOTE_ADDR]' WHERE `gmail`='$gmail' ";
//        echo $sql_update;exit;
        $result_update = mysqli_query($mysqli, $sql_update);
        $result = mysqli_query($mysqli, $sql);
//        print_r($result);exit;
        while ($row = mysqli_fetch_assoc($result)) {
            $row['status'] = 'Success';
            $row['user_status'] = 'exiting';
            $output[] = $row;
        }
    } else {
        $otp = $row['otp']= rand('1111', '9999');
        $mail_res=send_email($gmail, $otp);

        $sql_update = "INSERT INTO `seller_registration` SET `otp`='$otp',`name`='$name',`gmail`='$gmail',`cdate`='$datetime',`otp_datetime`='$datetime',`cip`='$_SERVER[REMOTE_ADDR]' ";
//        echo $sql_update;exit;
        $result_update = mysqli_query($mysqli, $sql_update);
//        print_r($result);exit;
//        $sql = "SELECT `id`,`name`,`gmail`,`otp` FROM `seller_registration` where `gmail`='$gmail'";
//    echo $sql;exit;
        $result = mysqli_query($mysqli, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $row['status'] = 'Success';
            $row['user_status'] = 'new';
            $output[] = $row;
        }
    }
//    print_r($mail_res);
}
elseif($action == "check_otp"){
    $otp = mysqli_real_escape_string($mysqli, $_POST['otp']);
    $user_id = mysqli_real_escape_string($mysqli, $_POST['user_id']);
    $sql = "SELECT `id`,`name`,`gmail`,`otp` FROM `seller_registration` where `id`='$user_id' AND `otp`='$otp'";
//    echo $sql;exit;
    $result = mysqli_query($mysqli, $sql);
//    print_r($result);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $row['status'] = 'Success';
            $output[] = $row;
        }
    }else{
        $row['status'] = 'failure';
        $output[] = $row;
    }
}
elseif($action == "add_seller"){
    $user_id = mysqli_real_escape_string($mysqli, $_POST['user_id']);
    $shop_name = mysqli_real_escape_string($mysqli, $_POST['shop_name']);
    $seller_mobile = mysqli_real_escape_string($mysqli, $_POST['seller_mobile']);
    $name = mysqli_real_escape_string($mysqli, $_POST['name']);
    $state = mysqli_real_escape_string($mysqli, $_POST['state']);
    $address = mysqli_real_escape_string($mysqli, $_POST['address']);
    $pincode = mysqli_real_escape_string($mysqli, $_POST['pincode']);
    $latitude = mysqli_real_escape_string($mysqli, $_POST['latitude']);
    $longitude = mysqli_real_escape_string($mysqli, $_POST['longitude']);
    $district = mysqli_real_escape_string($mysqli, $_POST['district']);
    $city = mysqli_real_escape_string($mysqli, $_POST['city']);

    print_r($_FILES);

    if (!empty($_FILES['company_logo']['name'])) {
        $total = count($_FILES['company_logo']['name']);
        $imagename = '';
        $i = 0;

        if ($total != 0) {
            for ($j = 1; $j <= $total; $j++) {
                if (file_exists($_FILES["company_logo"]["tmp_name"][$i])) {
                    $img_array = explode('.', basename($_FILES["company_logo"]["name"][$i]));
//                    $keyname = $img_array[0] . mt_rand(100000, 999999) . '_' . time() . '.' . $img_array[1];
                    $keyname = mt_rand(100000, 999999) . '_' . time() . '.' . "webp";
                    $uploader = new MultipartUploader($s3, $_FILES["company_logo"]["tmp_name"][$i], [
                        'bucket' => $bucket,
                        'key' => $keyname,
                    ]);
                    try {
                        $result = $uploader->upload();
                    } catch (MultipartUploadException $e) {
                        echo $e->getMessage() . PHP_EOL;
                    }
                    print_r($result);
                    if ($j == 1) {
                        $allurl1 = $fileuplink . $keyname;
                    } else {
                        $allurl1 .= ','.$fileuplink . $keyname;
                    }
                }
                $i++;
            }
        }
    }

    if($allurl1!=''){
        $logo="`logo`='$allurl1'";
    }else{
        $logo="`logo`=`logo`";
    }
    echo $logo;
    exit;
//    $address = mysqli_real_escape_string($mysqli, $_POST['address']);

    $sql_update = "UPDATE `seller_registration` SET `shop_name`='$shop_name',`seller_mobile`='$seller_mobile',
 `name`='$name',`state`='$state',`address`='$address',`pincode`='$pincode',`latitude`='$latitude',`longitude`='$longitude',$logo,`district`='$district',`city`='$city' WHERE `id`='$user_id' ";
//        echo $sql_update;exit;
    $result_update = mysqli_query($mysqli, $sql_update);
//    print_r($result_update);exit;

    $sql = "SELECT `id`,`name`,`gmail`,`shop_name`,`seller_mobile`,`name`,`state`,
       `address`,`pincode`,`latitude`,`logo`,`longitude`,`district`,`city` FROM `seller_registration` where `id`='$user_id'";
    $result = mysqli_query($mysqli, $sql);
//        print_r($result);exit;
//    echo $sql;exit;

    while ($row = mysqli_fetch_assoc($result)) {
        $row['status'] = 'Success';
        $output[] = $row;
    }

}
elseif ($action == "add_gifts") {
//    print_r($_POST);exit;
    $user_id = mysqli_real_escape_string($mysqli, $_POST['user_id']);
    $gift_cat = mysqli_real_escape_string($mysqli, $_POST['gift_category']);
    $gift_for = mysqli_real_escape_string($mysqli, $_POST['gift_for']);
    $gift_name = mysqli_real_escape_string($mysqli, $_POST['gift_name']);
    $gift_desc = mysqli_real_escape_string($mysqli, $_POST['gift_description']);
    $gift_amt = mysqli_real_escape_string($mysqli, $_POST['gift_amount']);
    $discount = mysqli_real_escape_string($mysqli, $_POST['discount']);
    $total_amount = mysqli_real_escape_string($mysqli, $_POST['total_amount']);
    $gift_image = mysqli_real_escape_string($mysqli, $_POST['gift_image']);


    $sql = "SELECT `id`,`user_id`,`gift_description`,`gift_name`,`gift_amount`,`discount`,`total_amount`,`gift_image` FROM `gift_table` ";
//    echo $sql;exit;
    $result = mysqli_query($mysqli, $sql);
//    print_r($result);
    if (mysqli_num_rows($result) > 0) {

        $sql_update = "UPDATE `gift_table`   SET `gift_name`='$gift_name',`gift_description`='$gift_desc',`gift_amount`='$gift_amt',`discount` = '$discount',`total_amount` = '$total_amount',`gift_image`='$gift_image',`gift_category`='$gift_cat',`gift_for`='$gift_for',`mby` = '$user', `mdate` = '$datetime', `mip` ='$_SERVER[REMOTE_ADDR]' WHERE `id`='$user_id'";
//        echo $sql_update;exit;
        $result_update = mysqli_query($mysqli, $sql_update);
        $result = mysqli_query($mysqli, $sql);
//        print_r($result);exit;
        while ($row = mysqli_fetch_assoc($result)) {
            $row['status'] = 'Success';
            $output[] = $row;
        }
    } else {


        $sql_update = "INSERT INTO `gift_table` SET `user_id`='$user_id,`gift_name`='$gift_name',`gift_description`='$gift_desc',`gift_amount`='$gift_amt',`discount` = '$discount',`total_amount` = '$total_amount',`gift_image`='$gift_image',`gift_category`='$gift_cat',`gift_for`='$gift_for',`cby` = '$user', `cdate` = '$datetime', `cip` ='$_SERVER[REMOTE_ADDR]'  ";
//        echo $sql_update;exit;
        $result_update = mysqli_query($mysqli, $sql_update);
//        print_r($result);exit;
//        $sql = "SELECT `id`,`name`,`gmail`,`otp` FROM `seller_registration` where `gmail`='$gmail'";
//    echo $sql;exit;
        $result = mysqli_query($mysqli, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $row['status'] = 'Success';
            $output[] = $row;
        }
    }
//    print_r($mail_res);
}


print(json_encode($output));

mysqli_close($mysqli);
?>
