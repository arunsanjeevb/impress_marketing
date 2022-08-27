<?php
include_once 'db.php';

?>


<footer class="footer-area" style="padding-top: 0px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-3  col-md-6 col-sm-3">
                <div class="single-footer-widget" style="text-align: center">
                    <br><h6>For Further Queries Please Contact</h6>
                    
                    <?php
                    $sql = "SELECT * FROM `contactus_master`";
                    //    echo $sql;
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    echo $row['contact'];
                    ?>

                </div>
            </div>
            <div class="col-lg-3  col-md-6 col-sm-3 mobile_res">
                <div class="single-footer-widget" style="text-align: center">
                    <br><h6>Join Our Team</h6>
                    <a href="https://chat.whatsapp.com/I9KAG1UrcprH0OsJ9rLYk4" target="_blank">
                        <span style="color:black;"> <i class="fa fa-whatsapp" style="font-size:23px;color:white;"></i></span>
                    </a>
                    <a href="https://www.youtube.com/channel/UC6pMZ0G17bjEm3MVDAodYSA" target="_blank"
                       style="color:black;"> <i class="fa fa-youtube-play" style="font-size:20px;color:red;padding-left: 5px;"></i>
                    </a>
                    <a href="https://www.facebook.com/marketplace/you/selling" target="_blank"
                       style="color:black;"> <i class="fa fa-facebook" style="font-size:20px;color:blue;padding-left: 5px;"></i>
                    </a>
                    <a href="https://www.instagram.com/sridiyastores/" target="_blank"
                       style="color:white;"> <i class="fa fa-instagram" id="insta" style="font-size:20px;padding-left: 5px;"></i>
                    </a>
                    <a href="https://t.me/joinchat/O3T_KTpEJqw3N2Q1" target="_blank"
                       style="color:black;"> <i class="fa fa-telegram" style="font-size:20px;color:#0088cc;padding-left: 5px;"></i>
                    </a>

                </div>
            </div>
            
        </div>
        
<!--        <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">

            
        </div>-->
    </div>
</footer>