<?php
$prefix = '../';
$prefix1 = '../';
//$prefix1 = '../';
session_start();
$location = $prefix . "index.php";
if (isset($_SESSION['user'])) {
    $user_name = $_SESSION['user'];
}
else {
    header("Location:$location");
    exit;
}
include_once $prefix . 'db.php';
$id = $i = $some = '';

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}
if (isset($_POST['add_college_name'])) {
    $english = mysqli_real_escape_string($mysqli, $_POST['english']);
    $college_type = mysqli_real_escape_string($mysqli, $_POST['college_type']);
//    $tamil = mysqli_real_escape_string($mysqli, $_POST['tamil']);
    $edit_id = mysqli_real_escape_string($mysqli, $_POST['edit_id']);
    if ($edit_id > 0) {
        $sql1 = "SELECT `id`, `english`  FROM `college` WHERE `id`!='$edit_id' and `english`='$english' and `college_type`='$college_type' ";
        $res = mysqli_query($mysqli, $sql1);
        if (mysqli_num_rows($res) > 0) {
            $msg = 1;
        } else {
            $sql = "update `college` set `english`='$english',`college_type`='$college_type',`cdate`='$datetime',`cby`='$user_name'  where  `id`='$edit_id' ";
            $res = mysqli_query($mysqli, $sql);
            header("Location:college.php?msg=3");
        }
    } else {
        $sql1 = "SELECT `id`, `english`  FROM `college` WHERE  `english`='$english' and `college_type`='$college_type' ";
        $res = mysqli_query($mysqli, $sql1);
        if (mysqli_num_rows($res) > 0) {
            $msg = 1;
        } else {
            $sql = "insert into  `college` set `english`='$english',`college_type`='$college_type',`cdate`='$datetime',`cby`='$user_name',cip='$_SERVER[REMOTE_ADDR]' ";
//            echo $sql;exit;
            $res = mysqli_query($mysqli, $sql);

            header("Location:college.php?msg=2");
        }
    }
}



if (isset($_POST['inactive'])) {
    $deleterid = mysqli_real_escape_string($mysqli, $_POST['inactive']);
    $sql = "UPDATE `college` SET `is_active`='1' where `id`='$deleterid' ";
    $result = mysqli_query($mysqli, $sql);
    if ($result) {
        echo "yes";
    } else {
        echo "no";
    }
    exit;
}
if (isset($_POST['active'])) {
    $deleterid = mysqli_real_escape_string($mysqli, $_POST['active']);
    $sql = "UPDATE `college` SET `is_active`='0' where `id`='$deleterid' ";
    $result = mysqli_query($mysqli, $sql);
    if ($result) {
        echo "yes";
    } else {
        echo "no";
    }
    exit;
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Impress Marketing</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="your,keywords">
    <meta name="description" content="Short explanation about this website">
    <?php include_once $prefix . 'include/css.php'; ?>
    <style>
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
<?php include_once $prefix . 'include/header.php'; ?>
<div id="base">
    <div class="offcanvas">
    </div>
    <div id="content">
        <section>
            <div class="section-body contain-lg">
                <!-- BEGIN DEFAULT TABLE -->
                <div class="row">
                    <div class="col-md-offset-2 col-md-8">
                        <div class="card">
                            <div class="card-body">

                                <h3 class="text-center">College<button class="btn btn-default-bright btn-raised pull-right" onclick="open_modal('', '')"  >Add New</button></h3>
                                <table class="table no-margin diagnosis_list">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th >Action</th>
                                        <th >ID</th>
                                        <th >College Name</th>
                                        <th  class="text-center">Type</th>
                                        <th  class="text-center">Add By</th>
                                    </tr>
                                    </thead>
                                    <tbody  class="ui-sortable">
                                    <?php
                                    $i = 1;
                                    $sql = "SELECT c.`id`, c.`english`,c.`college_type` as type1,ct.`english` as type,c.`cby` FROM `college` c
                                     join `college_type` ct ON `ct`.`id`=c.`college_type` 
                                     WHERE `c`.`is_active`='0' order by c.`id` desc ";
                                    $row = mysqli_query($mysqli, $sql);
                                    if(mysqli_num_rows($row)>0) {
                                        while ($data = mysqli_fetch_assoc($row)) {
                                            ?>
                                            <tr id="<?php echo $data['id']; ?>" >
                                                <td  class="priority" ><?php echo $i; ?></td>
                                                <td >
                                                    <button  onclick="open_modal('<?php echo $data['id']; ?>', '<?php echo $data['english']; ?>', '<?php echo $data['type1']; ?>',)"  class="btn btn-sm btn-info" ><i class="md md-edit"></i></button>
                                                    <button  onclick="in_active('<?php echo $data['id']; ?>', '<?php echo $data['english']; ?>','<?php echo $data['type1']; ?>', )"  class="btn btn-sm btn-danger" >In Active Now</button>

                                                </td>
                                                <td><?php echo $data['id']; ?></td>
                                                <td align="center" ><?php echo $data['english']; ?></td>
                                                <td align="center" ><?php echo $data['type']; ?></td>
                                                <td align="center" ><?php echo $data['cby']; ?></td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                    } else { ?>
                                        <tr><td colspan="5" align="center" style="font-weight:600;color:green" >No Active option</td></tr>
                                    <?php }
                                    ?>
                                    </tbody>
                                </table>
                                <hr>
                                <table class="table no-margin ">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th >Action</th>
                                        <th >ID</th>
                                        <th >College Name</th>
                                        <th  class="text-center">Type</th>
                                        <th  class="text-center">Add By</th>
                                    </tr>
                                    </thead>
                                    <tbody >
                                    <?php
                                    $i = 1;
                                    $sql = "SELECT c.`id`, c.`english`,c.`college_type` as type1,ct.`english` as type,c.`cby` FROM `college` c
                                     join `college_type` ct ON `ct`.`id`=c.`college_type` 
                                     WHERE `c`.`is_active`='1' order by c.`id` desc";
                                    $row = mysqli_query($mysqli, $sql);
                                    if(mysqli_num_rows($row)>0) {
                                        while ($data = mysqli_fetch_assoc($row)) {
                                            ?>
                                            <tr id="<?php echo $data['id']; ?>" >
                                                <td  class="priority" ><?php echo $i; ?></td>
                                                <td >
                                                    <button  onclick="open_modal('<?php echo $data['id']; ?>', '<?php echo $data['english']; ?>','<?php echo $data['type1']; ?>' )"  class="btn btn-sm btn-info" ><i class="md md-edit"></i></button>
                                                    <button  onclick="active_now('<?php echo $data['id']; ?>', '<?php echo $data['english']; ?>', '<?php echo $data['type1']; ?>')"  class="btn btn-sm btn-success" >Active Now</button>

                                                </td>
                                                <td><?php echo $data['id']; ?></td>
                                                <td align="center" ><?php echo $data['english']; ?></td>
                                                <td align="center" ><?php echo $data['type']; ?></td>
                                                <td align="center" ><?php echo $data['cby']; ?></td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }} else { ?>
                                        <tr><td colspan="5" align="center" style="font-weight:600;color:red" >No In-active option</td></tr>
                                    <?php }
                                    ?>

                                    </tbody>
                                </table>

                                <!-- BEGIN FORM MODAL MARKUP -->
                                <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="formModalLabel">College Type</h4>
                                            </div>
                                            <form class="form-horizontal" id="lsave_form"  action="" method="POST">
                                                <div class="modal-body">
                                                    <div id="loading_gif" style="display: none;"></div>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <select class="form-control" name="college_type" id="college_type" required>
                                                                <option value="">Select College Type</option>
                                                                <?php
                                                                $sql1 = "SELECT `id`, `english`  FROM `college_type` WHERE  `is_active`=0 ";
                                                                $res = mysqli_query($mysqli, $sql1);
                                                                while($row =mysqli_fetch_assoc($res)) { ?>
                                                                    <option value='<?php echo $row['id']; ?>'><?php echo $row['english']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <label for="english" class="control-label">College Type</label>
                                                            <input type="text" name="english" id="english" class="form-control" placeholder="College Name" required="">
                                                            <input type="hidden" name="edit_id" id="edit_id" class="form-control">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                    <button id="save_form" type="submit" name="add_college_name" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                <!-- END FORM MODAL MARKUP -->
                            </div><!--end .card-body -->
                        </div><!--end .card -->
                    </div><!--end .col -->
                </div><!--end .row -->
                <!-- END DEFAULT TABLE -->

                <!-- BEGIN STRIPED TABLE -->
            </div><!--end .section-body -->
        </section>
    </div>
    <?php include_once $prefix . 'include/menubar.php'; ?>
</div>
<?php include_once $prefix . 'include/js.php'; ?>

<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->


<script>

    function in_active(id, tablename)
    {
        if (confirm("Are you sure ?") == true) {
            $.post("college.php",
                {
                    inactive: id,
                    tablenames: tablename
                },
                function (data, status) {
                    console.log(data);
                    if(data=="yes") {
                        location.reload();
                    }
                });
        }
    }

    function active_now(id, tablename)
    {
        if (confirm("Are you sure ?") == true) {
            $.post("college.php",
                {
                    active: id,
                    tablenames: tablename
                },
                function (data, status) {
                    if(data=="yes") {
                        location.reload();
                    }
                });
        }
    }
    function open_modal(id, english,type) {
        $("#formModal").modal('show');
        $("#english").val(english);
        $("#college_type").val(type);
        $("#edit_id").val(id);
    }


    $('#save_form').submit(function () {
        $('#loading_gif').show();
    });


    var msg = "<?php echo $msg; ?>";
    if (msg == '1') {
        Command: toastr["error"]("Already exist", "Error")

    }
    else if (msg == '2') {
        Command: toastr["success"]("Added Successfully", "Sucesss")

    }
    else if (msg == '3') {
        Command: toastr["success"]("Updated Successfully", "Sucesss")

    }
    else if (msg == '4') {
        Command: toastr["success"]("Deleted Sucesssfully", "Sucesss")

    }
    $(document).ready(function () {
        var fixHelperModified = function (e, tr) {
            var $originals = tr.children();
            //alert($originals);
            var $helper = tr.clone();
            $helper.children().each(function (index)
            {
                $(this).width($originals.eq(index).width())
            });
            return $helper;
        };

        //Make diagnosis table sortable
        $(".diagnosis_list tbody").sortable({
            //alert('hi');
            helper: fixHelperModified,
            stop: function (event, ui) {
                renumber_table('.diagnosis_list')

            }
        }).disableSelection();

    })
    function renumber_table(tableID) {
        //alert('hi');
        var all = new Array();
        //alert(all);
        $(tableID + " tr").each(function () {
            var trid = $(this).attr('id'); // table row ID
            //alert(trid);
            count = $(this).parent().children().index($(this)) + 1;
            $(this).find('.priority').html(count);
            all[count] = trid;
            //alert(JSON.stringify(all));
        });
        $.post("college.php",
            {
                positionchange: all
            },
            function (data, status) {
                alert(status);
            });
    }
</script>



</body>

</html>