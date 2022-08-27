<!-- Load Facebook SDK for JavaScript -->
<!--<div id="fb-root"></div>-->
<!--<script>-->
<!--    window.fbAsyncInit = function() {-->
<!--        FB.init({-->
<!--            xfbml            : true,-->
<!--            version          : 'v9.0'-->
<!--        });-->
<!--    };-->
<!---->
<!--    (function(d, s, id) {-->
<!--        var js, fjs = d.getElementsByTagName(s)[0];-->
<!--        if (d.getElementById(id)) return;-->
<!--        js = d.createElement(s); js.id = id;-->
<!--        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';-->
<!--        fjs.parentNode.insertBefore(js, fjs);-->
<!--    }(document, 'script', 'facebook-jssdk'));</script>-->

<!-- Your Chat Plugin code -->
<!--<div class="fb-customerchat"-->
<!--     attribution="setup_tool"-->
<!--     page_id="148702073641501"-->
<!--     theme_color="#ff7e29">-->
<!--</div>-->
<style>
    /*.overlay {*/
    /*    background-color: #008CBA;*/
    /*}*/

    /*.hover-item:hover{*/
    /*    background-color: red;*/
    /*}*/
</style>
<?php
$file_name_url=$_SERVER['SCRIPT_NAME'];
if(isset($_GET['search'])){
    $search_text=$_GET['search'];
}else{
    $search_text='';
}
?>
<header class="header_area sticky-header">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light main_box" style="background: #FF6801;">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" style="margin: 0px;padding: 20px 0px;" href="index.php?lang=<?php echo $lang; ?>
                "><img style="width: 185px;" src="img/diya_store_logo.svg" alt=""></a>
                <select class="form-control" id="languvage_select" style="width: 25%">
                    <?php

                    $sql = "SELECT `id`,`lname` FROM `language` order by id ASC ";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <!--                                                                                <option value="--><?php //echo $row['id']; ?><!--"data-thumbnail="">--><?php //echo $row['title']; ?>
                        <!--                                                                                </option>-->
                        <option value="<?php echo $row['id']; ?>" <?php echo $row['id'] == $lang ? 'selected' : ''; ?> > <?php echo $row['lname']; ?>

                        </option>
                        <?php
                    }
                    ?>
                </select>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
                        style="border-color: white;">
                    <span class="icon-bar" style="background: white;"></span>
                    <span class="icon-bar" style="background: white;"></span>
                    <span class="icon-bar" style="background: white;"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="nav-item active"><a class="nav-link" style="color: white;margin-right: -10px;"
                                                       href="index.php?lang=<?php echo $lang; ?>">Home</a></li>
                        <!--                                <li class="nav-item submenu dropdown">
                                                            <a  class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                                               aria-expanded="false"><?php
                        if ($user) {
                            echo 'welcome, ' . $user . ' <a href="include/logout.php?lang=<?php echo $lang;?>"><button class="btn"><i class="fa fa-sign-in" aria-hidden="true"></i> Logout</button></a>';
                        } else {
                            echo '<a href="login.php?lang=<?php echo $lang;?>"><button class="btn"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</button></a>';
                        }
                        ?></a>
                                                        </li>-->


                        <li class="nav-item submenu dropdown ">
                            <a href="#" class="nav-link dropdown-toggle" style="color: white;" data-toggle="dropdown"
                               role="button" aria-haspopup="true"
                               aria-expanded="false">Product Category</a>
                            <ul class="dropdown-menu">
                                <?php
                                $sql = "SELECT * FROM `category` ORDER BY `id` ASC";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <li class="nav-item active"><a class="nav-link" style="color: white;"
                                                                   href="index.php?pro_id=<?php echo $row['id']; ?>&lang=<?php echo $lang; ?>"><?php echo $row['category']; ?></a>
                                    </li>

                                <?php } ?>
                            </ul>
                        </li>
                        <li class="nav-item active"><a class="nav-link" style="color: white;"
                                                       href="contact.php?lang=<?php echo $lang; ?>">Contact</a></li>
                        <li class="nav-item" style="color: white;"><a style="color: white;" class="nav-link" href="<?php
                            if (isset($_SESSION['mobileno'])) {
                                echo 'my_order.php?lang=' . $lang;
                            } else {
                                echo 'login.php?go=my_order?lang=' . $lang;
                            }
                            ?>">My Orders</a></li>
                        <li class="nav-item" style="color: white;"><a
                                    href="cart.php?go=card_view&lang=<?php echo $lang; ?>"
                                    class=" nav-link notification" style="color: white;">
                                My Cart <i class="fa fa-shopping-cart" style="color:white;font-size: 20px;"></i>
                                <span class="badge" style="color:red;"><?php
                                    if ($total != '0') {
                                        echo $total;
                                    } else {
                                        echo ' ';
                                    }
                                    ?></span>
                            </a></li>
                        <li class="nav-item submenu dropdown ">
                            <a href="#" class="nav-link dropdown-toggle" style="color: white;" data-toggle="dropdown"
                               role="button" aria-haspopup="true"
                               aria-expanded="false">Information</a>
                            <ul class="dropdown-menu">
                                <?php
                                $sql = "SELECT `id`,`info` FROM `general_info` ORDER BY `id` ASC";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <li class="nav-item active"><a class="nav-link" style="color: white;"
                                                                   href="information.php?about=<?php echo $row['id']; ?>"><?php echo $row['info']; ?></a>
                                    </li>

                                <?php } ?>
                            </ul>
                        </li>

                    </ul>

                </div>
            </div>
        </nav>
    </div>

    <div class="search_input hover-item1" id="search_input_box"
         style="display:block;margin-top: 2px;background: white;width: 95%;border-color: black;border: solid;">
        <div class="container">
            <form class="d-flex justify-content-between" action="search_product.php" method="GET">
                <input type="text" class="form-control placehoder task" name="search" id="search_text"  placeholder="Search Here" value="<?php echo $search_text;?>"
                       required>
                <div class="tagsget tt-dropdown-menu" style="height: 230px;position: absolute;top: 53px;left: 0px;z-index: 100;width: 100%;display: none;right: auto;overflow-x: scroll;background: #f9f9ff;">
                </div>

                <input type="hidden" name="lang" value="<?php echo $lang; ?>">

                <button type="submit" class="btn" id="searchs" style="margin-right: 41px;margin-top: 9px;color: black;">
                    <span class="lnr lnr-magnifier" id="search"></span></button>
                <button type="button" class="btn" id="close_btn" style="display:none;margin-right: 41px;margin-top: 9px;color: black;">
                    <span class="lnr lnr-cross" id="clear_text" title="Close Search" style="color: black;"></span></button>
                <!--                <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>-->
                <!--                <span class="lnr lnr-magnifier" id="search"></span>-->
            </form>
        </div>
    </div>

</header>
<section style="margin-bottom: 75px;"></section>
