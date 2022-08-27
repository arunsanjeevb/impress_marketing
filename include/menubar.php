<?php
$foldername = 'dashboard';
$url = $_SERVER['REQUEST_URI'];
if (strpos($url, '/index.php') !== false) {
    $foldername = 'dashboard';
}
if (strpos($url, '/master/') !== false) {
    $foldername = 'master';
}

if ($_SERVER['SERVER_NAME'] == "15.206.173.184") {
    $path_menu = 'upload/impress_marketing/';
} else {
    $path_menu = 'impress_marketing/';
}
//$user_id = $_SESSION['userid'];

?>
<div id="menubar" class="menubar-inverse ">
    <div class="menubar-fixed-panel">
        <div>
            <a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <div class="expanded">
            <a href="dashboard.php">
                <span class="text-lg text-bold text-primary ">Impress Marketing - Admin</span>
            </a>
        </div>
    </div>
    <div class="menubar-scroll-panel">
        <ul id="main-menu" class="gui-controls">
<!--            <li class="--><?php //echo strpos($url, 'dashboard') !== false ? 'active expanded' : ''; ?><!--">-->
<!--                <a href="/upload/whatsapp_manager/admin/dashboard.php">-->
<!--                    <div class="gui-icon"><i class="md md-home"></i></div>-->
<!--                    <span class="title" style="font-size: 14px;">Dashboard</span>-->
<!--                </a>-->
<!--            </li>-->
            <li class="<?php echo strpos($url, 'dashboard') !== false ? 'active expanded' : ''; ?>">
                <a href="<?php echo $actual_link . "://" . $_SERVER['SERVER_NAME']; ?>/<?php echo $path_menu; ?>dashboard.php">
                    <div class="gui-icon"><i class="md md-home"></i></div>
                    <span class="title" style="font-size: 14px;">Dashboard</span>
                </a>
            </li>

            <li class="gui-folder <?php echo strpos($url, '/master/') !== false ? 'active expanded' : ''; ?> ">
                <a>
                    <div class="gui-icon  "><i class="md md-assessment"></i></div>
                    <span class="title" style="font-size: 14px;">Master</span>
                </a>
                <ul>
                    <li class="gui-folder  expanded">
                        <ul>
                            <li>
                                <a href="<?php echo $actual_link . "://" . $_SERVER['SERVER_NAME']; ?>/<?php echo $path_menu; ?>master/add_user.php"><span
                                            class="title" style="font-size: 14px;">Add User</span></a>
                            </li>
                            <li>
                                <a href="<?php echo $actual_link . "://" . $_SERVER['SERVER_NAME']; ?>/<?php echo $path_menu; ?>master/college.php"><span
                                            class="title" style="font-size: 14px;">Add College</span></a>
                            </li>
                            <li>
                                <a href="<?php echo $actual_link . "://" . $_SERVER['SERVER_NAME']; ?>/<?php echo $path_menu; ?>master/college_type.php"><span
                                            class="title" style="font-size: 14px;">Add College Type</span></a>
                            </li>

                        </ul>
                    </li>
                </ul>
            </li>
        </ul>


        <div class="menubar-foot-panel">
            <small class="no-linebreak hidden-folded">
                <span class="opacity-75">Copyright &copy; <?php echo date('Y'); ?></span> <strong>Nithra Edu
                    Solutions</strong>
            </small>
        </div>
    </div>
</div>
