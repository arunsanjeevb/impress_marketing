<header id="header" >
    <div class="headerbar">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="headerbar-left">
            <ul class="header-nav header-nav-options">
                <li class="header-nav-brand" >
                    <div class="brand-holder">
                        <a href="#">
                            <span class="text-lg text-bold text-primary">Impress Marketing - Admin</span>
                        </a>
                    </div>
                </li>
                <li>
                    <a class="btn btn-icon-toggle menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                        <i class="fa fa-bars"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="headerbar-right">

            <ul class="header-nav header-nav-profile">
                <li class="dropdown">
                    <?php
                    $dash_check= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//                    echo $location;
                    $dash_check1= "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    $dash_live = "https://nithra.mobi/impress_marketing/dashboard.php";
                    $dash_test = "http://15.206.173.184/upload/impress_marketing/dashboard.php";
                    ?>

                    <a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">
                        <img src= <?php
                        echo (($dash_check == $dash_test) || ($dash_check1 == $dash_live))?>/>
                        <span class="profile-info">
                                 <?php echo $user_name; ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu animation-dock">

                        <li><a href="
                        <?php
                          echo $location;
                            ?>
                        "><i class="fa fa-fw fa-power-off text-danger"></i> Logout</a></li>
                    </ul><!--end .dropdown-menu -->
                </li><!--end .dropdown -->
            </ul><!--end .header-nav-profile -->

        </div><!--end #header-navbar-collapse -->
    </div>
</header>