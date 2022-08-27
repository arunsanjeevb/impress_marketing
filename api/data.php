<?php
$file_name = time();
$myfile = fopen("file.txt", "w") or die("Unable to open file!");
fwrite($myfile, "Request : \n");
fwrite($myfile, print_r($_POST, true));
include_once '../db.php';
$ip_address = $_SERVER['REMOTE_ADDR'];
$date_time = date('Y-m-d H:i:s');
$today=date("Y-m-d");
$days_7 = date('Y-m-d', strtotime('+7 days', strtotime($today)));
$datas = array();
$output = array();
$action = '';
if (isset($_POST['limit'])) {
    $limit = $_POST['limit'];
} else {
    $limit = 0;
}
if (isset($_POST['action'])) {
    $action = $_POST['action'];
}
$limit = !empty($_POST['limit']) ? 'limit ' . trim($_POST['limit']) . ',10' : "limit 10";

require '../../aws/aws-autoloader.php';

use Aws\Common\Exception\MultipartUploadException;
use Aws\S3\MultipartUploader;
use Aws\S3\S3Client;

$bucket = 'impress-erp-ssm';
$fileuplink = "https://d4ft7lf2oavtn.cloudfront.net/";

$s3 = new S3Client([
    'version' => 'latest',
    'region' => 'ap-south-1',
    'credentials' => array(
        'key' => 'AKIA3FJL44PWTIPTMK4R',
        'secret' => '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',
    ),
]);

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

if($action == 'otp_generate') {
    $mobile_num = mysqli_real_escape_string($conn, $_POST['mobile_num']);
    $is_check = isset($_POST['is_check']) ? mysqli_real_escape_string($conn, $_POST['is_check']) : 0; // Testing purpose//
    $otp = mt_rand("1111", "9999");
    $msg = $otp . " is your OTP to verify your mobile number on Nithra app/website.";
    $sql3 = "SELECT * FROM `user` where `mobile` = '$mobile_num' ";
    $result3 = mysqli_query($mysqli, $sql3);
    if(mysqli_num_rows($result3)){
        if ($mobile_num) {
            $sql2 = "SELECT * FROM `user` where `mobile` = '$mobile_num' ";
            $result = mysqli_query($mysqli, $sql2);
            if (mysqli_num_rows($result)) {
                $query = "UPDATE `user` SET `otp` = '$otp' where `mobile` = '$mobile_num' ";
//            echo $query;
            }
            mysqli_query($mysqli, $query);
            if ($is_check == '1') {
                send_message($mobile_num, $msg, "1307160853199181365");
                $output[] = array("status" => 'success', 'is_check' => '1', 'otp' => $otp);
            } else {
                $output[] = array("status" => 'success', 'is_check' => '0', 'otp' => $otp);
            }
        }
    }else {
        $output[] = array("status" => 'failure');
    }
}elseif ($action == 'check_otp') {
    $mobile_num = $_POST['mobile_num'];
    $otp = $_POST['otp'];
    if ($mobile_num && $otp) {
        $sql = "SELECT u.`id`, u.`name`,`u`.`mobile`,u.`role` as role_id,r.`english` as role_name FROM `user` u
                                     join `role` r ON `r`.`id`=u.`role` 
                                     WHERE `u`.`is_active`='0' and `mobile` = '$mobile_num' AND `otp` = '$otp' order by u.`id` desc";
        $result = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_assoc($result);
            $row["status"] = 'success';
            $output[] = $row;
        }
        else {
            $output[] = array("status" => 'failure');
        }

    } else {
        $output[] = array("status" => 'failure');
    }
}elseif($action == "district") {
    $sql2 = "select * from `district` where `state`=1  order by id asc";
    $result2 = mysqli_query($mysqli, $sql2);
    while ($row = mysqli_fetch_assoc($result2)) {
        $district_name[$row["id"]] = $row["english"];
        $dist_id[$row["id"]] = $row["id"];
        $district_array1[$row["id"]] = array_merge($district_name, $dist_id);
        $sql = "select `id` as t_id,`english` from `city` where `district`=$row[id] and `state`=1 order by id asc";
        $result = mysqli_query($mysqli, $sql);
        while ($row1 = mysqli_fetch_assoc($result)) {
            $taluk_name["taluk_name"] = $row1["english"];
            $t_id["taluk_id"] = $row1["t_id"];
            $taluk_name_array1[$row["id"]][] = array_merge($taluk_name, $t_id);
        }
    }
    foreach ($district_array1 as $key => $value) {
        array_push($output, array(
            "district_name" => $district_name[$key],
            "district_id" => $dist_id[$key],
            "taluk" => $taluk_name_array1[$key]
        ));
    }
}elseif ($action == "college") {
    $sql2 = "SELECT `id`,`english` college_type FROM `college_type` where `is_active`=0 order by id asc";
    $result2 = mysqli_query($mysqli, $sql2);
    while ($row = mysqli_fetch_assoc($result2)) {
        $college_type_id[$row["id"]] = $row["id"];
        $college_type_name[$row["id"]] = $row["college_type"];
        $college_type_array1[$row["id"]] = array_merge($college_type_id, $college_type_name);
        $sql = "select `id` as college_id,`english` college_name from `college` where `college_type`=$row[id] and `is_active`=0 order by id asc";
        $result = mysqli_query($mysqli, $sql);
        while ($row1 = mysqli_fetch_assoc($result)) {
            $college_id["college_id"] = $row1["college_id"];
            $college_name["college_name"] = $row1["college_name"];
            $college_name_array1[$row["id"]][] = array_merge($college_id, $college_name);
        }
    }
    foreach ($college_type_array1 as $key => $value) {
        array_push($output, array(
            "college_type_id" => $college_type_id[$key],
            "college_type_name" => $college_type_name[$key],
            "college_name" => $college_name_array1[$key]
        ));
    }
} elseif ($action == 'add_followup') {
    $user_id = mysqli_real_escape_string($mysqli, $_POST['user_id']);
    $user_name = mysqli_real_escape_string($mysqli, $_POST['user_name']);
    $college = mysqli_real_escape_string($mysqli, $_POST['college']);
    $city = mysqli_real_escape_string($mysqli, $_POST['city']);
    $district = mysqli_real_escape_string($mysqli, $_POST['district']);
    $source = mysqli_real_escape_string($mysqli, $_POST['source']);
    $mobile = isset($_POST['mobile']) ? mysqli_real_escape_string($mysqli, $_POST['mobile']) : '';
    $reference_name = isset($_POST['reference_name']) ? mysqli_real_escape_string($mysqli, $_POST['reference_name']) : '';
    $reference_designation = isset($_POST['designation']) ? mysqli_real_escape_string($mysqli, $_POST['designation']) : '';
//    $mobile = mysqli_real_escape_string($mysqli, $_POST['mobile']);
//    $reference_name = mysqli_real_escape_string($mysqli, $_POST['reference_name']);
//    $reference_designation = mysqli_real_escape_string($mysqli, $_POST['designation']);
    $remark = mysqli_real_escape_string($mysqli, $_POST['discussion_points']);
    $followup_Date = mysqli_real_escape_string($mysqli, $_POST['followup_date']);
    $latitude = mysqli_real_escape_string($mysqli, $_POST['latitude']);
    $longitude = mysqli_real_escape_string($mysqli, $_POST['longitude']);
    $contact_person = $_POST['contact_person']; // contact person list
    $id = isset($_POST['id']) ? mysqli_real_escape_string($mysqli, $_POST['id']) : '';
    $remove_icon = isset($_POST['remove_icon']) ? mysqli_real_escape_string($mysqli, $_POST['remove_icon']) : 0;

    if (!empty($_FILES['person_image']['name'])) {
        $total = count($_FILES['person_image']['name']);
        $imagename = '';
        $i = 0;
        if ($total != 0) {
            for ($j = 1; $j <= $total; $j++) {
                if (file_exists($_FILES["person_image"]["tmp_name"][$i])) {
                    $img_array = explode('.', basename($_FILES["person_image"]["name"][$i]));
//                    $keyname = $img_array[0] . mt_rand(100000, 999999) . '_' . time() . '.' . $img_array[1];
                    $keyname = $user_id . mt_rand(100000, 999999) . '_' . time() . '.' . "webp";
                    $uploader = new MultipartUploader($s3, $_FILES["person_image"]["tmp_name"][$i], [
                        'bucket' => $bucket,
                        'key' => $keyname,
                    ]);
                    $result = $uploader->upload();
                    if ($j == 1) {
                        $allurl1 = $fileuplink . $keyname;
                    } else {
                        $allurl1 .= ',' . $fileuplink . $keyname;
                    }
                }
                $i++;
            }
        }
    }
    if ($allurl1 != '') {
        $person_image = "`person_image`='$allurl1'";
    } else {
        $person_image = "`person_image`=''";
    }
    if ($remove_icon) {
        $person_image = "`person_image`=''";
    }
//    echo $person_image;exit;

    if ($id) {
        $sql_update1="UPDATE `college_followup_details` 
SET `college`='$college',`city`='$city',
`district`='$district',`contact_details`='$contact_person',
`userid`='$user_id',
`source`='$source',
`reference_name`='$reference_name',
`reference_designation`='$reference_designation',
`mobile`='$mobile',
$person_image,
`longitude`='$longitude',
`latitude`='$latitude',
`mby`='$user_name',
`mdate`='$datetime',
`mip`='$_SERVER[REMOTE_ADDR]' WHERE `id`='$id'";
//        echo $sql_update;exit;
        $result_update1 = mysqli_query($mysqli, $sql_update1);
        //followup details save start
        $sql_followup="UPDATE `followup` SET `discussion_points`='$remark',`fdate`='$followup_Date',`mby` = '$user_name', `mdate` = '$datetime', `mip` ='$_SERVER[REMOTE_ADDR]' where `college_add_id`='$id'";
        mysqli_query($mysqli,$sql_followup);
        //followup details save end
    } else {
        $sql_insert = "INSERT INTO `college_followup_details` 
SET `college`='$college',`city`='$city',
`district`='$district',`contact_details`='$contact_person',
`userid`='$user_id',
`source`='$source',
`reference_name`='$reference_name',
`reference_designation`='$reference_designation',
`mobile`='$mobile',
`longitude`='$longitude',
`latitude`='$latitude',
$person_image, `cby` = '$user_name', `cdate` = '$datetime', `cip` ='$_SERVER[REMOTE_ADDR]' ";
//        echo $sql_insert;exit;
        $result_insert = mysqli_query($mysqli, $sql_insert);
        $id = mysqli_insert_id($mysqli);
        //followup details save start
        $sql_followup="INSERT INTO `followup` SET `college_add_id`='$id',`discussion_points`='$remark',`fdate`='$followup_Date',`cby` = '$user_name', `cdate` = '$datetime', `cip` ='$_SERVER[REMOTE_ADDR]'";
        mysqli_query($mysqli,$sql_followup);
        //followup details save end
    }

    $sql1 = "SELECT `cd`.`id`, `cd`.`college`, `cd`.`city`, `cd`.`district`,
     `cd`.`contact_details`, `cd`.`userid`, 
    if(cd.`source`=1,'Reference','Direct') as ref_status, 
    cd.`source`, 
    `cd`.`reference_name`, 
    `cd`.`reference_designation`, 
    `cd`.`mobile`, 
    `cd`.`person_image`,
    `cd`.`longitude`,
    `cd`.`latitude`,
    IF(`cd`.`college` > 0, (SELECT d.`english` FROM `college` d WHERE `d`.`id`=`cd`.`college`), '') as `college_name`, 
    IF(`cd`.`district` > 0, (SELECT d.`english` FROM `district` d WHERE `d`.`id`=`cd`.`district`), '') as `district_name`, 
    IF(`cd`.`city` > 0, (SELECT d.`english` FROM `city` d WHERE `d`.`id`=`cd`.`city`), '') as `city_name`, 
    IF(`cd`.`userid` > 0, (SELECT d.`name` FROM `user` d WHERE `d`.`id`=`cd`.`userid`), '') as `user_name` 
    FROM `college_followup_details` `cd`
    WHERE `cd`.`id`='$id'";
//    echo $sql1;exit;
    $result = mysqli_query($mysqli, $sql1);
    while ($row = mysqli_fetch_assoc($result)) {
        $row['status'] = 'Success';
        $output[] = $row;
    }

}elseif ($action == 're_followup'){
    $user_id = mysqli_real_escape_string($mysqli, $_POST['user_id']);
    $refollowup_id = mysqli_real_escape_string($mysqli, $_POST['refollowup_id']);
    $user_name = mysqli_real_escape_string($mysqli, $_POST['user_name']);
    $college = mysqli_real_escape_string($mysqli, $_POST['college_add_id']);
    $remark = mysqli_real_escape_string($mysqli, $_POST['discussion_points']);
    $followup_Date = isset($_POST['followup_date']) ? mysqli_real_escape_string($mysqli, $_POST['followup_date']) : '';
    $type = isset($_POST['type']) ? mysqli_real_escape_string($mysqli, $_POST['type']) : 1;
    //followup details save start
    if ($type == 1){ // again followup
        $sql_followup="UPDATE `followup` SET `is_followup`=1 where `college_add_id`='$refollowup_id'"; //re followup purposed
        mysqli_query($mysqli,$sql_followup);
        $sql_followup="INSERT INTO `followup` SET `college_add_id`='$refollowup_id',`discussion_points`='$remark',`fdate`='$followup_Date',`cby` = '$user_name', `cdate` = '$datetime', `cip` ='$_SERVER[REMOTE_ADDR]'";
        mysqli_query($mysqli,$sql_followup);
    }elseif ($type == 2){ // completed followup
        $sql_followup="UPDATE `followup` SET `is_followup`=1 where `college_add_id`='$refollowup_id'"; //re followup purposed
        mysqli_query($mysqli,$sql_followup);
        $sql_followup="INSERT INTO `followup` SET `is_complete`=1,`college_add_id`='$refollowup_id',`discussion_points`='$remark',`fdate`='$followup_Date',`cby` = '$user_name', `cdate` = '$datetime', `cip` ='$_SERVER[REMOTE_ADDR]'";
        mysqli_query($mysqli,$sql_followup);
    }else{ // rejected followup
        $sql_followup="UPDATE `followup` SET `is_followup`=1 where `college_add_id`='$refollowup_id'"; //re followup purposed
        mysqli_query($mysqli,$sql_followup);
        $sql_followup="INSERT INTO `followup` SET `is_closed`=1,`college_add_id`='$refollowup_id',`discussion_points`='$remark',`fdate`='$followup_Date',`cby` = '$user_name', `cdate` = '$datetime', `cip` ='$_SERVER[REMOTE_ADDR]'";
        mysqli_query($mysqli,$sql_followup);
    }
    //followup details save end
    if(mysqli_insert_id($mysqli)){
        $output=array("status" => "Success");
    }else{
        $output=array("status" => "Failure");
    }
}elseif($action == 'college_view'){
    $view_id = mysqli_real_escape_string($mysqli, $_POST['view_id']);
    $sql1 = "SELECT `cd`.`id`, `cd`.`college`, `cd`.`city`, `cd`.`district`, `cd`.`contact_details`, `cd`.`userid`,
`cd`.`source`,
`cd`.`reference_name`,
`cd`.`reference_designation`,
`cd`.`mobile`,
`cd`.`person_image`,
`cd`.`longitude`,
`cd`.`latitude`,
DATE_FORMAT ( `f`.`fdate`,'%d-%m-%Y') as followup_date,
`f`.`discussion_points`,
IF(`cd`.`college` > 0, (SELECT d.`college_type` FROM `college` d WHERE `d`.`id`=`cd`.`college`), '') as
`college_type_id`,
IF(c.`college_type` > 0, (SELECT d.`english` FROM `college_type` d WHERE `d`.`id`=`c`.`college_type`), '') as
`college_type_name`,
IF(`cd`.`college` > 0, (SELECT d.`english` FROM `college` d WHERE `d`.`id`=`cd`.`college`), '') as `college_name`,
IF(`cd`.`district` > 0, (SELECT d.`english` FROM `district` d WHERE `d`.`id`=`cd`.`district`), '') as `district_name`,
IF(`cd`.`city` > 0, (SELECT d.`english` FROM `city` d WHERE `d`.`id`=`cd`.`city`), '') as `city_name`,
IF(`cd`.`userid` > 0, (SELECT d.`name` FROM `user` d WHERE `d`.`id`=`cd`.`userid`), '') as `user_name`
FROM `college_followup_details` `cd`
join `followup` f  on `f`.`college_add_id`=cd.`id`
join `college` c on `c`.`id`=cd.`college`
WHERE `cd`.`id`='$view_id' and `is_followup`=0 order by `cd`.`id` desc $limit";
//    echo $sql1;exit;
    $result = mysqli_query($mysqli, $sql1);
    if(mysqli_num_rows($result)){
        while ($row = mysqli_fetch_assoc($result)) {
            $res=mysqli_query($mysqli,"SELECT `english` as college_type_name FROM `impress_marketing`.`college_type` where `id`='$row[college_type_id]'");
            $row1 = mysqli_fetch_assoc($res);
            $row['college_type_name'] = $row1['college_type_name'];
            $row['status'] = 'Success';
            $output[] = $row;
        }
    }else{
        $row['status'] = 'failure';
        $row['sql'] = $sql1;
        $output[] = $row;
    }
}elseif($action == 'view_all_details'){
    $userid = mysqli_real_escape_string($mysqli, $_POST['userid']);
    $sql1 = "SELECT `cd`.`id`, `cd`.`college`, `cd`.`city`, `cd`.`district`, `cd`.`contact_details`, `cd`.`userid`,
cd.`source`,
`cd`.`reference_name`,
`cd`.`reference_designation`,
`cd`.`mobile`,
`cd`.`person_image`,
`cd`.`longitude`,
`cd`.`latitude`,
DATE_FORMAT ( `f`.`fdate`,'%d-%m-%Y') as followup_date,
`f`.`discussion_points`,
IF(`cd`.`college` > 0, (SELECT d.`college_type` FROM `college` d WHERE `d`.`id`=`cd`.`college`), '') as
`college_type_id`,
IF(c.`college_type` > 0, (SELECT d.`english` FROM `college_type` d WHERE `d`.`id`=`c`.`college_type`), '') as
`college_type_name`,
IF(`cd`.`college` > 0, (SELECT d.`english` FROM `college` d WHERE `d`.`id`=`cd`.`college`), '') as `college_name`,
IF(`cd`.`district` > 0, (SELECT d.`english` FROM `district` d WHERE `d`.`id`=`cd`.`district`), '') as `district_name`,
IF(`cd`.`city` > 0, (SELECT d.`english` FROM `city` d WHERE `d`.`id`=`cd`.`city`), '') as `city_name`,
IF(`cd`.`userid` > 0, (SELECT d.`name` FROM `user` d WHERE `d`.`id`=`cd`.`userid`), '') as `user_name`
FROM `college_followup_details` `cd`
join `followup` f  on `f`.`college_add_id`=cd.`id`
join `college` c on `c`.`id`=cd.`college`
where `cd`.`userid`=$userid and `is_followup`=0 $limit";
//    echo $sql1;
    $result = mysqli_query($mysqli, $sql1);
    if(mysqli_num_rows($result)){
        while ($row = mysqli_fetch_assoc($result)) {
            $row['status'] = 'Success';
            $output[] = $row;
        }
    }else{
        $row['status'] = 'failure';
        $row['sql'] = $sql1;
        $output[] = $row;
    }

}elseif($action == 'followup_deatails'){
    $userid = mysqli_real_escape_string($mysqli, $_POST['userid']);
    $type = isset($_POST['type']) ? mysqli_real_escape_string($mysqli, $_POST['type']) : 1;
    switch ($type){
        case 2:
            $type_con="and `f`.`is_complete`=1 and `f`.`is_followup`=0 and `f`.`is_closed`=0";
            $date_cond="date(`f`.`cdate`)";
            $order_by="`f`.`cdate` desc";
            break;
        case 3:
            $type_con="and `f`.`is_closed`=1 and `f`.`is_complete`=0 and `f`.`is_followup`=0";
            $date_cond="date(`f`.`cdate`)";
            $order_by="`f`.`cdate` desc";
            break;
        default:
            $type_con="and `f`.`is_followup`=0 and `f`.`is_complete`=0 and `f`.`is_closed`=0";
            $date_cond="date(`f`.`fdate`)";
            $order_by="`f`.`fdate` asc";
            break;
    }
    $sql1 = "SELECT `cd`.`id`, `cd`.`college`, `cd`.`city`, `cd`.`district`, `cd`.`contact_details`, `cd`.`userid`,
cd.`source`,
`cd`.`reference_name`,
`cd`.`reference_designation`,
`cd`.`mobile`,
`cd`.`person_image`,
`cd`.`longitude`,
`cd`.`latitude`,
DATE_FORMAT ( `f`.`fdate`,'%d-%m-%Y') as followup_date,
`f`.`discussion_points`,
IF(`cd`.`college` > 0, (SELECT d.`college_type` FROM `college` d WHERE `d`.`id`=`cd`.`college`), '') as
`college_type_id`,
IF(c.`college_type` > 0, (SELECT d.`english` FROM `college_type` d WHERE `d`.`id`=`c`.`college_type`), '') as
`college_type_name`,
IF(`cd`.`college` > 0, (SELECT d.`english` FROM `college` d WHERE `d`.`id`=`cd`.`college`), '') as `college_name`,
IF(`cd`.`district` > 0, (SELECT d.`english` FROM `district` d WHERE `d`.`id`=`cd`.`district`), '') as `district_name`,
IF(`cd`.`city` > 0, (SELECT d.`english` FROM `city` d WHERE `d`.`id`=`cd`.`city`), '') as `city_name`,
IF(`cd`.`userid` > 0, (SELECT d.`name` FROM `user` d WHERE `d`.`id`=`cd`.`userid`), '') as `user_name`
FROM `college_followup_details` `cd`
join `followup` f  on `f`.`college_add_id`=cd.`id`
join `college` c on `c`.`id`=cd.`college`
where `cd`.`userid`=$userid 
and $date_cond BETWEEN '$today' and '$days_7' $type_con order by $order_by $limit";
//    echo $sql1;
    $result = mysqli_query($mysqli, $sql1);
    if(mysqli_num_rows($result)){
        while ($row = mysqli_fetch_assoc($result)) {
            $row['status'] = 'Success';
            $output[] = $row;
        }
    }else{
        $row['status'] = 'failure';
        $row['sql'] = $sql1;
        $output[] = $row;
    }

}

fwrite($myfile, "Responce : \n");
fwrite($myfile, print_r($output, TRUE));
//fwrite($myfile, print_r($_FILES, TRUE));
fclose($myfile);
print(json_encode($output));
mysqli_close($mysqli);








